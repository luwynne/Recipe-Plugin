<?php
//creating shortcode for plugin

function r_recipe_creator_shortcode(){

    $creatorHTML = file_get_contents('creator-template.php',true);

    $editorHTML = r_generate_content_editor();

    $creatorHTML = str_replace(
        'CONTENT_EDITOR',
        $editorHTML,
        $creatorHTML
    );

    return $creatorHTML;

}

//fixing issues qith the text editor
function r_generate_content_editor(){

    ob_start(); //grabbing any putputed content. this grabs any puputed content into a buffer

    //providing wp editor for the users
    wp_editor('','recipecontenteditor');

    $editor_contents = ob_get_clean();

    return $editor_contents;

}