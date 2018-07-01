<?php

function r_recipe_options_mb( $post ){
    $recipe_data                =   get_post_meta( $post->ID, 'recipe_data', true );

    if( empty($recipe_data) ){
        $recipe_data            =   array(
            'ingredients'   =>  '',
            'time'          =>  '',
            'utensils'      =>  '',
            'level'         =>  'Beginner',
            'meal_type'     =>  '',
            'video_url'     =>  ''
        );
    }

    ?>

    <div class="form-group">
        <label>Video URL</label>
        <input type="text" class="form-control" name="r_inputVideoURL" value="<?php echo $recipe_data['video_url']; ?>">
    </div>
    <div class="form-group">
        <label>Ingredients</label>
        <input type="text" class="form-control" name="r_inputIngredients" value="<?php echo $recipe_data['ingredients']; ?>">
    </div>
    <div class="form-group">
        <label>Cooking Time Required</label>
        <input type="text" class="form-control" name="r_inputTime" value="<?php echo $recipe_data['time']; ?>">
    </div>
    <div class="form-group">
        <label>Utensils</label>
        <input type="text" class="form-control" name="r_inputUtensils" value="<?php echo $recipe_data['utensils']; ?>">
    </div>
    <div class="form-group">
        <label>Cooking Experience</label>
        <select class="form-control" name="r_inputLevel">
            <option value="Beginner">Beginner</option>
            <option value="Intermediate" <?php echo $recipe_data['level'] == "Intermediate" ? "SELECTED" : ""; ?>>Intermediate</option>
            <option value="Expert" <?php echo $recipe_data['level'] == "Expert" ? "SELECTED" : ""; ?>>Expert</option>
        </select>
    </div>
    <div class="form-group">
        <label>Meal Type</label>
        <input type="text" class="form-control" name="r_inputMealType" value="<?php echo $recipe_data['meal_type']; ?>">
    </div>
    <div class="form-group">
        <label>Featured image<a href="" id="recipe-img-upload-btn"> Upload</a> </label>
        <br>
        <img id="recipe-img-preview">
        <input type="hidden" id="r_inputImgID">

    </div>
    <?php
}