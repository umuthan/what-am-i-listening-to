<?php

/* Get Tracks from Last.Fm */
function WAILT_get_tracks($number) {

	global $jsonAddress;

	$readjson = wp_remote_get($jsonAddress.'&limit='.$number);
	$data = wp_remote_retrieve_body($readjson);
	$data = json_decode($data, true);

	$output = '<div class="wailt">';

	$track = $data['recenttracks']['track'];
	$nowplaying = $track[0]['@attr']['nowplaying'];

	if($nowplaying == true) $output .= '<h2>'.__('Currently Listening', 'wailt').'</h2>';
	else $output .= '<h2>'._n('Last Track That I Listened', 'Last Tracks That I Listened', $number, 'wailt').'</h2>';

	$output .= '<ul>';

	for ($i=0; $i < $number; $i++) {
		$artist = $track[$i]['artist']['#text'];
		$album  = $track[$i]['album']['#text'];
		$song   = $track[$i]['name'];
		$cover  = $track[$i]['image'][2]['#text'];
		$url    = $track[$i]['url'];

		$output .= '<li>';
		$output .= '<a href="'.$url.'" target="_blank">';
		if($nowplaying == true && $i==0) $output .= '<p><img class="cover playing" src="'.$cover.'" /></p>';
		else $output .= '<p><img class="cover" src="'.$cover.'" /></p>';
		$output .= '</a>';
		$output .= '<h3>'.$artist.' - '.$song.'</h3>';
		$output .= '</li>';
	}

	$output .= '</ul>
							</div>';

	return $output;
}
