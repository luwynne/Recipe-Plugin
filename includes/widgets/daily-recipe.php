<?php
//been passed by the register in wodgets.php
//the reason this class is oop thats because it extends the WP_Widget class

class R_Daily_Recipe_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $widget_ops = array(
            'description' => 'Displays a random recipe each day',
        );
        parent::__construct(
            'r_daily_recipe_widget',
            'Recipe of the day',
            $widget_ops
        );

    }



    /**
     * Outputs the options form on admin
     * if there is any option for the user to customize this form
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {

        $default                =   array( 'title' => 'Recipe of the day' );

        //this function will merge 2 arrays together and return a single merged array
        //this will ensure that a have a widget independent if its settle or not EG widgtet already settle in the side bar
        $instance               =   wp_parse_args( (array) $instance, $default );

        // this html method generate an id for the field. We just have to call it by the name
        //this esc_attr wll ensure we can insert a value without braking the code

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
            <input type="text" class="widefat"
                   id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <?php

    }

    /**
     * Processing widget options on save
     * this method will be called when the user submits the form
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {

        $instance               =   [];
                            //sanitizing the title by striping any tags from the tag using this function
        $instance['title']      =   strip_tags( $new_instance['title'] );

        //return the instance and wp can save our widget settings
        return $instance;

    }


    /**
     * Outputs the content of the widget
     * this takes care of dis[laying the widget in the frontend
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        echo 'Recipe of the day';

    }


}