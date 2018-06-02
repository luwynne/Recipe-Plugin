<?php

//activation scripts called by main index.php

function r_activate_plugin(){

    //version compare helps you comparing functions
    //checking if the wp funtion is compatible
    //this will return the current wp version
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die(__('You must update your WordPress version to use this plugin','recipe'));
    }

}