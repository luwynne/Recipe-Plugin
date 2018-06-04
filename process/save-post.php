<?php

//logic behind the post form submission

function r_save_post_admin( $post_id, $post, $update ){

    // if update is false, i know the post is new
    if( !$update ){
        return;
    }

    //sanitizing data coming from the form
    $recipe_data                        =   array();
    $recipe_data['ingredients']         =   sanitize_text_field( $_POST['r_inputIngredients'] );
    $recipe_data['time']                =   sanitize_text_field( $_POST['r_inputTime'] );
    $recipe_data['utensils']            =   sanitize_text_field( $_POST['r_inputUtensils'] );
    $recipe_data['level']               =   sanitize_text_field( $_POST['r_inputLevel'] );
    $recipe_data['meal_type']           =   sanitize_text_field( $_POST['r_inputMealType'] );
    $recipe_data['rating']              =   0;
    $recipe_data['rating_count']        =   0;

    //attaching this data to the post using a wp function
    //it will check if the date already exists. If not it will create it for us
    //it kills 2 birds with 1 stone
    //it takes the post id already gathered by wp, a name we just gave and the array with the data
    update_post_meta( $post_id, 'recipe_data', $recipe_data );


//    echo '<pre>'; //printint the post form to gather information
//    print_r($_POST);
//    echo '</pre>';
//    die();
    //this is needed to gather information such as the index number of elements array for using above

}