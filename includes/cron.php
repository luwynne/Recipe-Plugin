<?php
//responsile for the cron jon in the

function r_generate_daily_recipe(){

    //wp cron wont run exactly at the same time everyday
    global $wpdb;

    $recipe_id              =   $wpdb->get_var(
        "SELECT `ID` FROM `" . $wpdb->posts . "`
            WHERE post_status='publish' AND post_type='recipe'
            ORDER BY rand() LIMIT 1"
    ); //selecting randomly the recipe from the db
        //we only want the post id which are published

    //start the use of transient api
    //param name of transient, value of id,expiration time in seconds
    set_transient('r_daily_recipe',$recipe_id,DAY_IN_SECONDS);

}