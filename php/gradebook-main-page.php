<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
  * Class Description
  *
  * @since 0.1.0
  */
class QMN_GB_Admin
{
    /**
  	  * Main Construct Function
  	  *
  	  * Call functions within class
  	  *
  	  * @since 0.1.0
  	  * @uses QMN_GB_Admin::load_dependencies() Loads required filed
  	  * @uses QMN_GB_Admin::add_hooks() Adds actions to hooks and filters
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
      if ( !current_user_can('moderate_comments') ) {
        echo __("You do not have proper authority to access this page",'wordpress-developer-toolkit');
        return '';
      }
      wp_enqueue_style( 'gb_admin_style', plugins_url( '../css/admin.css' , __FILE__ ) );
      wp_enqueue_script( 'gb_admin_script', plugins_url( '../js/admin.js' , __FILE__ ) );
      global $wpdb;
      $table = $wpdb->prefix."mlw_results";
      $grades = $wpdb->get_results("SELECT user, name, AVG(point_score) as points, AVG(correct_score) as score FROM $table WHERE deleted=0 GROUP BY user ORDER BY name ASC");
      ?>
      <div class="wrap">
        <h2>Gradebook</h2>
        <table class="widefat">
          <thead>
            <tr>
              <th>User</th>
              <th>Average Points</th>
              <th>Average Score</th>
            </tr>
          </thead>
          <tbody id="the-list">
            <?php
            $alternate = "";
            foreach($grades as $user)
            {
              if($alternate) $alternate = "";
              else $alternate = " class=\"alternate\"";
              echo "<tr{$alternate}>";
                echo "<td>";
                  echo $user->name;
                  echo "<div class=\"row-actions\">
                        <a class='linkOptions' href='admin.php?page=qmn_gb_user&&user_id=".esc_js($user->user)."'>View User's Scores</a>
                  </div>";
                echo "</td>";
                echo "<td>".round($user->points, 2)."</td>";
                echo "<td>".round($user->score, 2)."%</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>User</th>
              <th>Average Points</th>
              <th>Average Score</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <?php
    }
}
?>
