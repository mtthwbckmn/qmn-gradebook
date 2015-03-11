<?php
/**
 * Plugin Name: QMN Gradebook
 * Plugin URI: http://mylocalwebstop.com
 * Description:
 * Author: Frank Corso
 * Author URI: http://mylocalwebstop.com
 * Version: 0.1.0
 * Text Domain: wordpress-developer-toolkit
 * Domain Path: /languages
 *
 * Disclaimer of Warranties
 * The plugin is provided "as is". My Local Webstop and its suppliers and licensors hereby disclaim all warranties of any kind,
 * express or implied, including, without limitation, the warranties of merchantability, fitness for a particular purpose and non-infringement.
 * Neither My Local Webstop nor its suppliers and licensors, makes any warranty that the plugin will be error free or that access thereto will be continuous or uninterrupted.
 * You understand that you install, operate, and uninstall the plugin at your own discretion and risk.
 *
 * @author Frank Corso
 * @version 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;


/**
  * This class is the main class of the plugin
  *
  * When loaded, it loads the included plugin files and add functions to hooks or filters. The class also handles the admin menu
  *
  * @since 0.1.0
  */
class QMN_Gradebook
{
    /**
  	  * Main Construct Function
  	  *
  	  * Call functions within class
  	  *
  	  * @since 0.1.0
  	  * @uses QMN_Gradebook::load_dependencies() Loads required filed
  	  * @uses QMN_Gradebook::add_hooks() Adds actions to hooks and filters
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
      include("php/gradebook-main-page.php");
      include("php/gradebook-user-page.php");
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
        add_action('admin_menu', array( $this, 'setup_admin_menu'));
        add_action('admin_head', array( $this, 'admin_head'), 900);
    }

    /**
  	  * Setup Admin Menu
  	  *
  	  * Creates the admin menu and pages for the plugin and attaches functions to them
  	  *
  	  * @since 0.1.0
  	  * @return void
  	  */
  	public function setup_admin_menu()
  	{
  		if (function_exists('add_menu_page'))
  		{
        add_menu_page('Gradebook', 'Gradebook', 'moderate_comments', __FILE__, array('QMN_GB_Admin','generate_page'), 'dashicons-flag');
        add_submenu_page(__FILE__, 'User Scores', 'User Scores', 'moderate_comments', 'qmn_gb_user', array('QMN_GB_User_Page','generate_page'));
      }
    }

  /**
	 * Removes Unnecessary Admin Page
	 *
	 * Removes the update, quiz settings, and quiz results pages from the Quiz Menu
	 *
	 * @since 4.1.0
	 * @return void
	 */
	public function admin_head()
	{
		remove_submenu_page( 'qmn-gradebook/qmn-gradebook.php', 'qmn_gb_user' );
	}
}
$qmn_gradebook = new QMN_Gradebook();
?>
