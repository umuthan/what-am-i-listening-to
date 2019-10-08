<?php

// Register and load the widget
function wailt_load_widget() {
  register_widget( 'wailt_widget' );
}
add_action( 'widgets_init', 'wailt_load_widget' );

// Creating the widget
class wailt_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      // Base ID of your widget
      'wailt_widget',

      // Widget name will appear in UI
      __('What Am I Listening To?', 'wailt'),

      // Widget description
      array( 'description' => __( 'A widget that shows what you are listening.', 'wailt' ), )
    );
  }

  // Creating widget front-end

  public function widget($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];

    // This is where you run the code and display the output
    echo get_tracks($instance['number']);
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form($instance) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
      $number = $instance[ 'number' ];
    } else {
      $title = __( 'What Am I Listening To?', 'wailt' );
      $number = 1;
    }
    // Widget admin form
    echo '<p>
    <label for="'.$this->get_field_id( 'number' ).'">'.__( 'Number of tracks:', 'wailt' ).'</label>
    <input class="widefat" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" value="'.esc_attr( $number ).'" />
    </p>';
  }

  // Updating widget replacing old instances with new
  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

    return $instance;
  }
} // Class wailt_widget ends here
