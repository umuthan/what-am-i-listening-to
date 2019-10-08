<?php
// create custom plugin settings menu
add_action('admin_menu', 'WAILT_create_menu');

function WAILT_create_menu() {

	//add setting page to plugins menu
	add_options_page(
		__( 'What Am I Listening To? Settings', 'wailt' ),
		__( 'WAILT Settings', 'wailt' ),
		'manage_options',
		'wailt',
		'WAILT_settings_page'
	);

	//call register settings function
	add_action( 'admin_init', 'WAILT_register_settings' );
}


function WAILT_register_settings() {
	//register wailt settings
	register_setting( 'wailt-settings-group', 'wailt_lastfm_api_key' );
	register_setting( 'wailt-settings-group', 'wailt_lastfm_user_name' );
}

function WAILT_settings_page() {
?>
<div class="wrap">
<h1><?php echo __('What Am I Listening To?', 'wailt'); ?></h1>

<form method="post" action="options.php">
	<ul>
		<li><?php echo __('Go to https://last.fm/api', 'wailt'); ?></li>
		<li><?php echo __('Click "Get an API account"', 'wailt'); ?></li>
		<li><?php echo __('Fill the form', 'wailt'); ?></li>
		<li><?php echo __('Paste your Api Key to this page.', 'wailt'); ?></li>
	</ul>
	<?php settings_fields( 'wailt-settings-group' ); ?>
	<?php do_settings_sections( 'wailt-settings-group' ); ?>
	<table class="form-table">
	    <tr valign="top">
	    <th scope="row"><?php echo __('Last.fm Api Key', 'wailt'); ?></th>
	    <td><input type="text" name="wailt_lastfm_api_key" value="<?php echo esc_attr( get_option('wailt_lastfm_api_key') ); ?>" /></td>
	    </tr>
			<tr valign="top">
	    <th scope="row"><?php echo __('Last.fm User Name', 'wailt'); ?></th>
	    <td><input type="text" name="wailt_lastfm_user_name" value="<?php echo esc_attr( get_option('wailt_lastfm_user_name') ); ?>" /></td>
	    </tr>
	</table>

	<?php submit_button(); ?>

</form>
</div>
<?php } ?>
