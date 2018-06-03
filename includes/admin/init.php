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

    //call function add meta boxes followed by the name of the post type
    add_action( 'add_meta_boxes_recipe', 'r_create_metaboxes' );

    //adding scripts and style to the recipe admin dashboard
    add_action('admin_enqueue_scripts','r_admin_enqueue');


}