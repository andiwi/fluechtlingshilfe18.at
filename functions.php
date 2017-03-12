<?php
  function theme_enqueue_styles() {
    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style)
    );
  }
  add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

add_action('wp_enqueue_scripts', 'add_landingpage_script');
add_action('wp_enqueue_scripts', 'add_googleanalytics_script');

function add_landingpage_script()
{
  wp_enqueue_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js");
  wp_enqueue_script('landingpage', get_stylesheet_directory_uri() . '/js/landingpage-widget.js', array('jquery'));
}

function add_googleanalytics_script()
{
  wp_enqueue_script('googleanalytics', get_stylesheet_directory_uri() . '/js/analyticstracking.js');
}

  add_action('ambitionchild_init', 'ambitionchild_constants', 10);
  /**
   * This function defines the Ambition theme constants
   *
   * @since 1.0
   */
function ambitionchild_constants()
{
  /** Define Directory Location Constants */
  define('AMBITIONCHILD_PARENT_DIR', get_template_directory());
  define('AMBITIONCHILD_CHILD_DIR', get_stylesheet_directory());
  define('AMBITIONCHILD_INC_DIR', AMBITIONCHILD_CHILD_DIR . '/inc');
  //define('AMBITION_ADMIN_DIR', AMBITION_INC_DIR . '/admin');
  //define('AMBITION_ADMIN_JS_DIR', AMBITION_ADMIN_DIR . '/js');
  //define('AMBITION_ADMIN_CSS_DIR', AMBITION_ADMIN_DIR . '/css');
  define('AMBITIONCHILD_JS_DIR', AMBITIONCHILD_CHILD_DIR . '/js');
  define('AMBITIONCHILD_FUNCTIONS_DIR', AMBITIONCHILD_INC_DIR . '/functions');
  //define('AMBITION_SHORTCODES_DIR', AMBITION_INC_DIR . '/footer-info');
  define('AMBITIONCHILD_STRUCTURE_DIR', AMBITIONCHILD_INC_DIR . '/structure');
  //if (!defined('AMBITION_LANGUAGES_DIR'))
  /** So we can define with a child theme */ {
  define('AMBITION_LANGUAGES_DIR', AMBITIONCHILD_CHILD_DIR . '/languages');
  }
  define('AMBITIONCHILD_WIDGETS_DIR', AMBITIONCHILD_INC_DIR . '/widgets');
}
  add_action('ambitionchild_init', 'ambitionchild_load_files', 15);
  /**
   * Loading the included files.
   *
   * @since 1.0
   */
function ambitionchild_load_files()
{
  /**
   * ambition_add_files hook
   *
   * Adding other addtional files if needed.
   */
  do_action('ambitionchild_add_files');
  /** Load functions */
  //require_once (AMBITION_FUNCTIONS_DIR . '/i18n.php');

  //require_once (AMBITION_FUNCTIONS_DIR . '/custom-header.php');

  //require_once (AMBITIONCHILD_FUNCTIONS_DIR . '/functions.php');

  //require_once (AMBITION_FUNCTIONS_DIR . '/custom-style.php');

  //require_once (AMBITIONCHILD_FUNCTIONS_DIR . '/customizer.php');

  //require_once (AMBITION_FUNCTIONS_DIR . '/featured-content.php');

  //require_once (AMBITION_ADMIN_DIR . '/ambition-metaboxes.php');

  //require_once (AMBITIONCHILD_JS_DIR . '/functions.js');
  /** Load Footer Info */
  //require_once (AMBITION_SHORTCODES_DIR . '/ambition-footer-info.php');

  /** Load Structure */
  require_once (AMBITIONCHILD_STRUCTURE_DIR . '/header-extensions.php');

  //require_once (AMBITION_STRUCTURE_DIR . '/footer-extensions.php');

  //require_once (AMBITION_STRUCTURE_DIR . '/content-extensions.php');

  /** Load Widgets and Widgetized Area */
  require_once (AMBITIONCHILD_WIDGETS_DIR . '/ambition-child-widgets.php');
}

/**
 * ambition_init hook
 *
 * Hooking some functions of functions.php file to this action hook.
 */
do_action('ambitionchild_init');



 ?>
