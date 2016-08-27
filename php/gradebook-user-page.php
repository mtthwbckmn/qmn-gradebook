<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
  * Class Description
  *
  * @since 0.1.0
  */
class QMN_GB_User_Page
{
    /**
  	  * Main Construct Function
  	  *
  	  * Call functions within class
  	  *
  	  * @since 0.1.0
  	  * @uses QMN_GB_User_Page::load_dependencies() Loads required filed
  	  * @uses QMN_GB_User_Page::add_hooks() Adds actions to hooks and filters
  	  * @return void
  	  */
    function __construct()
    {
      $this->load_dependencies();
      $this->add_hooks();
    }

    /**
  	  * Load File Dependencies
  	  *
  	  * @since 0.1.0
  	  * @return void
  	  */
    public function load_dependencies()
    {
      //Insert code
    }

    /**
  	  * Add Hooks
  	  *
  	  * Adds functions to relavent hooks and filters
  	  *
  	  * @since 0.1.0
  	  * @return void
  	  */
    public function add_hooks()
    {
        //Insert code
    }

    /**
     * Generate Main Admin Page
     *
     * @since 0.1.0
     */
    public static function generate_page()
    {
      if ( !current_user_can('moderate_comments') || !isset($_GET["user_id"])) {
        echo __("There has been an error with your request.",'wordpress-developer-toolkit');
        return '';
      }
      wp_enqueue_script( 'gb_admin_script', plugins_url( '../js/admin.js' , __FILE__ ) );
      global $wpdb;
      $user = intval($_GET["user_id"]);
      $table = $wpdb->prefix."mlw_results";
      $grades = $wpdb->get_results("SELECT result_id, quiz_name, quiz_system, point_score, correct_score, correct, total, time_taken FROM $table WHERE user=$user AND deleted=0 ORDER BY quiz_name ASC");
      ?>
      <div class="wrap">
        <h2>Gradebook</h2>
        <table class="widefat">
          <thead>
            <tr>
              <th>Quiz</th>
              <th>Score</th>
              <th>Time Taken</th>
            </tr>
          </thead>
          <tbody id="the-list">
            <?php
            $alternate = "";
            foreach($grades as $quiz)
            {
              if($alternate) $alternate = "";
              else $alternate = " class=\"alternate\"";
              echo "<tr{$alternate}>";
                echo "<td>";
                  echo $quiz->quiz_name;
                  echo "<div class=\"row-actions\">
                    <a class='linkOptions' href='admin.php?page=mlw_quiz_result_details&&result_id=".$quiz->result_id."'>View</a>
                  </div>";
                if ($quiz->quiz_system == 0)
                {
                  echo "<td>".$quiz->correct."/".$quiz->total." or ".$quiz->correct_score."%</td>";
                }
                else
                {
                  echo "<td>".$quiz->point_score."</td>";
                }
                echo "<td>".$quiz->time_taken."</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Quiz</th>
              <th>Score</th>
              <th>Time Taken</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <?php
    }
}
?>
