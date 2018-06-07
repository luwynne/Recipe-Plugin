<?php
/*
 * Plugin Name: Recipe
 * Description: Simple Wordpress plugin that allows users to create recipes and rate those recipes
 * Version: 1.0
 * Author: Luiz Wynne
 * Author URI: luizwynnedev.com
 * Text Domain: recipe
 */

if(!function_exists('add_action')){
    //checking if this function exists
    //if not, that means wp is not loaded, so that we dont want to run
    //the rest of the scripts
    die("Hi there, im just a plugin. Not much i can do when called directly");

}

//SETUP
define('RECIPE_PLUGIN_URL', __FILE__);


//INCLUDES
include ('includes/activate.php');
include ('includes/init.php');
include('includes/admin/init.php');
include('process/save-post.php');
include('process/filter-content.php');
include('includes/front/enqueue.php');
include('process/rate-recipe.php');
include(dirname(RECIPE_PLUGIN_URL).'/includes/widgets.php');
include ('includes/widgets/daily-recipe.php');
include('includes/cron.php');
include('includes/shortcodes/creator.php');



//HOOKS

//this is an special sort of hook made only for plugins
//this will take the file it resids and the function to be executed
register_activation_hook(__FILE__,'r_activate_plugin');

//deactivating the plugin
register_deactivation_hook(__FILE__,'r_deactivate_plugin');

//creating a custom post type
//this data is triggerer when wp requires the data required for the current page
add_action('init','recipe_init');

//adding a new meta box to the recipe custom post type UI
add_action('admin_init','recipe_admin_init');

//saving the post form
//triggered when the post is saves. We only wan to save if the post type is post
//save post calling the name of the post the will only gather the post saved with that post type name
add_action( 'save_post_recipe', 'r_save_post_admin', 10, 3 );

//displaying content inside the new post type url
add_filter('the_content','r_filter_recipe_content');

//including rating.js plugin for rating part of the website
//loading the asset as last
add_action('wp_enqueue_scripts','r_enqueue_scripts',100);

//calling ajax
add_action('wp_ajax_r_rate_recipe','r_rate_recipe');

//this will also proccess ajax requests from users that are not logged in
add_action('wp_ajax_nopriv_r_rate_recipe','r_rate_recipe');

//getting started with the widget recipe of the dat
//using wp widhet api using the function inside the widget.php
add_action('widgets_init','r_widget_init');

//custom hook for cron jobs daily new recipe
//wp will take care of checking the time and call the r_generate_daily_recipe
//param name of the hook, name of the function
add_action('r_daily_recipe_hook','r_generate_daily_recipe');

//SHORTCODES
//shortcode for
//received the name of the shortcode and the function to call when its used
add_shortcode( 'recipe_creator', 'r_recipe_creator_shortcode' );



