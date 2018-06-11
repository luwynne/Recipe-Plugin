<?php
//file responsible for grabing the rate from ui and displaynig bring to the db

function r_rate_recipe(){

    //calling the global db object, so that we can make queries to the db
    global $wpdb;

    $output = array('status'=>1); //response
    $post_id = absint($_POST['rid']); //returns the variable as an absolute integer
    $rating = round($_POST['rating'],1); //this will round the rating variable, making the number more precise
    $user_IP = $_SERVER['REMOTE_ADDR']; //getting the user ip, in this case, the server ip

    //ensure that the user inserts into the db only once
    //the get_var method executed a querie and returns a single value
    $rating_count           =   $wpdb->get_var(
        "SELECT COUNT(*) FROM `" . $wpdb->prefix . "recipe_ratings`
		WHERE recipe_id='" . $post_id . "' AND user_ip='" . $user_IP . "'"
    );

    if($rating_count > 0){
        wp_send_json($output);
    }

    //inserting rating into the db
    $wpdb->insert(
        $wpdb->prefix .'recipe_ratings',
        array(
            'recipe_id'=>$post_id,
            'rating'=>$rating,
            'user_ip'=>$user_IP
        ),
        array('%d','%f','%s') //for security purpose, datatype values
    );

    //grabing data information
    //this is the avarage value of the recipe
    //we will then pass over this function to be displayed
    $recipe_data = get_post_meta($post_id,'recipe_data',true);
    $recipe_data['rating_count'] ++;
    $recipe_data['rating'] = round($wpdb->get_var(
        "SELECT AVG(`rating`) FROM `" . $wpdb->prefix . "recipe_ratings`
		WHERE recipe_id='" . $post_id . "'"
    ),1);

    //updating metadata. Ready to display to the user
    //this is a global metadata about this post
    //receiving information of average
    update_post_meta($post_id,'recipe_data',$recipe_data);

    //extending the functionality of the rating
    //this will make that anyone can hook into this function and use it
    //this takes the name of the action we want to trigger
    //the second parameters are optional
    do_action('recipe_rated',array(
        'post_id'=>$post_id,
        'rating'=>$rating,
        'user_ip'=>$user_IP
    ));

    $output['status'] = 2;

    //sending ajax response of the insertion
    wp_send_json($output);

}