<?php
 

 // The pps plugin will be split into two parts the widget side and the admin side. 

 // The two groups will be pps-widget and pps-admin. 
 // The ca theme will come already loaded with the group pps-widget.

 // If class my_widget exists 

include_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin\database\read-table-data.php';


class PPS_Widget_Plugin extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'my-text',  // Base ID
            'Plugin Logic'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'PPS_Widget_Plugin' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        echo '<div class="textwidget">';
 
       echo Read_Table_Data::display_table_pps_values()->text;

        echo esc_html__( $instance['text'], 'text_domain' );
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {

 
		echo '<p><strong>No options for this Widget!</strong><br/>You can control the fields of this Widget from <a href="./admin.php?page=ParentPagePPS">This Page</a></p>';

 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
 
        return $instance;
    }
 
}



$my_widget = new PPS_Widget_Plugin();
?>