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



//HOOKS

//this is an special sort of hook made only for plugins
//this will take the file it resids and the function to be executed
register_activation_hook(__FILE__,'r_activate_plugin');

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

//SHORTCODES



