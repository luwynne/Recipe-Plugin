<?php

//activation scripts called by main index.php

function r_activate_plugin(){

    //version compare helps you comparing functions
    //checking if the wp funtion is compatible
    //this will return the current wp version
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die(__('You must update your WordPress version to use this plugin','recipe'));
    }


    //using rewrite rules api
    //registering the custom post type
    recipe_init();

    //this function updates the rewrite rules
    flush_rewrite_rules();

    //creating new db table when activating the plugin
    global $wpdb;

    $createSQL              =   " CREATE TABLE `" . $wpdb->prefix . "recipe_ratings` (
                                `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `recipe_id` BIGINT(20) UNSIGNED NOT NULL,
                                `rating` FLOAT(3,2) UNSIGNED NOT NULL,
                                `user_ip` VARCHAR(32) NOT NULL,
                                PRIMARY KEY (`ID`)
                            ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . " AUTO_INCREMENT=1;";

    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    dbDelta( $createSQL );



    wp_schedule_event(
        time(),
        'daily',
        'r_daily_recipe_hook' //hook responsible for the plugin
    );


     //first function of the options api
    //this retrieves the value of an option
    $recipe_opts = get_option('r_opts');

    //if option doesnt exist, then wp will retun false
    if(!$recipe_opts){

        $opts = [
            'rating_login_require'=>1,
            'recipe_submission_login_required'=>1
        ];


        //inserts into the db
        //received the name of the option the value
        add_option('r_opts',$opts);

    }


}