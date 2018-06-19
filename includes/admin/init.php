<?php
/**
 *
 *
 *
 *
 */

function recipe_admin_init(){

    include( 'create-metaboxes.php' );
    include( 'recipe-options.php' );
    include('enqueue.php');
    include('columns.php');

    //call function add meta boxes followed by the name of the post type
    add_action( 'add_meta_boxes_recipe', 'r_create_metaboxes' );

    //adding scripts and style to the recipe admin dashboard
    add_action('admin_enqueue_scripts','r_admin_enqueue');

    //adding the rating info to the admin
    add_filter( 'manage_recipe_posts_columns', 'r_add_new_recipe_columns' );

    //this has to be called as per the previous function, whenever a custom column should be
    //output for a certain post type
    add_action( 'manage_recipe_posts_custom_column', 'r_manage_recipe_columns', 10, 2 ); //priority and srguments

    //options api
    add_action('admin_post_r_save_options','r_save_options');


}