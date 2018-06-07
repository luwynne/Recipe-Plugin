<?php
//setting down the function of the plugin when deactivating it

function r_deactivate_plugin(){

    //this function will deactivate the schedule event (cron job)
    wp_clear_scheduled_hook('r_daily_recipe_hook');

}