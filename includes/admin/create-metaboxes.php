<?php

//function called in the init.php
//responsible for creating a new metabox in the custom post type ui
function r_create_metaboxes(){
    add_meta_box(
        'r_recipe_options_mb',
        __( 'Recipe Options', 'recipe' ),
        'r_recipe_options_mb',
        'recipe', //post tyoe in which this metabox will appear in
        'normal', //this is where it will appear in the ui
        'high'
    );
}