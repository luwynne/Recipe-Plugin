jQuery(function($){
    //this function is called when the user rates the recipe
    $("#recipe_rating").bind( "rated", function(){
        $(this).rateit( "readonly", true );
        //thie disables the user from keep on rating after he already sleected the rate value
        var form                    =   { //this object is called when making an ajax requests
            action:                     "r_rate_recipe",
            rid:                        $(this).data('rid'),
            rating:                     $(this).rateit( 'value' )
        };

        //sending an ajax request so that the info can be saved
        //start by sendong the ajax through the url
        $.post( recipe_obj.ajax_url, form, function(data){

        });
    });





    //loading the featured image window
    var featured_frame = wp.media({ //grabbing imformation from the media upload
        title:'Select or upload media',
        button:{
            text:'Use this media'
        },
        multiple:false
    });

    //listen to click event
    $("#recipe-img-upload-btn").on('click',function (e) {
       e.preventDefault();
       featured_frame.open();
    });

    //selecting the event that willl trigger when user select an image
    featured_frame.on('select',function(){
        //returning to the variable the current selected media in the uploader as a string and converting into an object
        var attachment = featured_frame.state().get('selection').first().toJSON();
        $("recipe-img-preview").attr('src',attachment.url);
        $("r_inputImgID").val(attachment.id);
    });







    //submiting the form from website with new recipe
    $("#recipe-form").on( "submit", function(e){
        e.preventDefault();

        $(this).hide();
        $("#recipe-status").html('<div class="alert alert-info text-center">Please wait!</div>');

        var form                =   {
            action:                 "r_submit_user_recipe",
            content:                tinymce.activeEditor.getContent(),
            title:                  $("#r_inputTitle").val(),
            ingredients:            $("#r_inputIngredients").val(),
            time:                   $("#r_inputTime").val(),
            utensils:               $("#r_inputUtensils").val(),
            level:                  $("#r_inputLevel").val(),
            meal_type:              $("#r_inputMealType").val(),
            attachment_id:          $("#r_inputImgID").val()
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){
            if( data.status == 2 ){
                $('#recipe-status').html('<div class="alert alert-success">Recipe submitted successfully!</div>');
            }else{
                $('#recipe-status').html(
                    '<div class="alert alert-danger">Unable to submit recipe. Please fill in all fields.</div>'
                );
                $("#recipe-form").show();
            }
        });
    });





    //user registration and login ajax code

    $("#register-form").on( 'submit', function(e){
        e.preventDefault();

        $("#register-status").html(
            '<div class="alert alert-info">Please wait while your account is being created.</div>'
        );
        $(this).hide();

        var form                =   {
            action:                                     "recipe_create_account",
            name:                                       $("#register-form-name").val(),
            username:                                   $("#register-form-username").val(),
            email:                                      $("#register-form-email").val(),
            pass:                                       $("#register-form-password").val(),
            confirm_pass:                               $("#register-form-repassword").val(),
            _wpnonce:                                   $("#_wpnonce").val()
        };

        $.post( recipe_obj.ajax_url, form ).always(function(response){
            if( response.status == 2 ){
                $("#register-status").html('<div class="alert alert-success">Account created!</div>');
                location.href           =   recipe_obj.home_url;
            }else{
                $("#register-status").html(
                    '<div class="alert alert-danger">' +
                    'Unable to create an account. Please try again with a different username/email.' +
                    '</div>'
                );
                $("#register-form").show();
            }
        });
    });






    $('#login-form').on( 'submit', function(e){
        e.preventDefault();

        $("#login-status").html('<div class="alert alert-info">Please wait while we log you in.</div>');
        $(this).hide();

        var form                                    =   {
            _wpnonce:                                   $("#_wpnonce").val(),
            action:                                     "recipe_user_login",
            username:                                   $("#login-form-username").val(),
            pass:                                       $("#login-form-password").val()
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){
            if( data.status == 2 ){
                $("#login-status").html('<div class="alert alert-success">Success!</div>');
                location.href                       =   recipe_obj.home_url;
            }else{
                $("#login-status").html(
                    '<div class="alert alert-danger">' +
                    'Unable to login. Please try again with a different username/password.' +
                    '</div>'
                );
                $("#login-form").show();
            }
        });
    });
});