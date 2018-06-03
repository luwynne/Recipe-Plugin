<?php
//this enqueues the stylying and scripts to the admin dashboard

function r_admin_enqueue(){

    global $typenow;

    //preventing the styles from been enqueued if the user is not in the recipe post type
    if($typenow != 'recipe'){
        return;
    }

    wp_register_style(
        'ju_bootstrap',
        plugins_url('/assets/styles/bootstrap.css',RECIPE_PLUGIN_URL)  //this function points to the plugins folder
    );

    wp_enqueue_style('ju_bootstrap');

}