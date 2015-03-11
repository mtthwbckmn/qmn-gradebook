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
    public function generate_page()
    {
      if ( !current_user_can('moderate_comments') ) {
        echo __("You do not have proper authority to access this page",'wordpress-developer-toolkit');
        return '';
      }
      wp_enqueue_style( 'wpdt_admin_style', plugins_url( '../css/admin.css' , __FILE__ ) );
      wp_enqueue_script( 'wpdt_admin_script', plugins_url( '../js/admin.js' , __FILE__ ) );
      ?>
      <div class="wrap">
        
      </div>
      <?php
    }
}
?>
