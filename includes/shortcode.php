<?php

/* What Am I Listening To? shortcode */
function WAILT_currently_playing($atts) {
	/* Shortcode Attributes:
      number: Number of songs to display (default: 1)
  */

	$attributes = shortcode_atts( array(
    'number'      => 1,
  ), $atts, 'wailt' );

	$output = WAILT_get_tracks($attributes['number']);

	return $output;
}
add_shortcode('wailt', 'wailt_currently_playing');
