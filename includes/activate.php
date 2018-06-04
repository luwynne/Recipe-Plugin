<?php

//activation scripts called by main index.php

function r_activate_plugin(){

    //version compare helps you comparing functions
    //checking if the wp funtion is compatible
    //this will return the current wp version
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die(__('You must update your WordPress version to use this plugin','recipe'));
    }

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


}