<?php
/*
Plugin Name: WP Remote Thumbnail
Plugin URI: http://magnigenie.com/wp-remote-thumbnail-set-external-images-featured-image/
Description: A small light weight plugin to set external/remote images as post thumbnail/featured image.
Version: 1.1
Author: Nirmal Kumar Ram
Author URI: http://magnigenie.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
?>
<?php

/**
 * Initialize wprthumb on the post edit screen.
 */
function init_wprthumb() {
	new wprthumb();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'init_wprthumb' );
	add_action( 'load-post-new.php', 'init_wprthumb' );
}


class wprthumb {

	/**
	 * Hook into the appropriate actions when the wprthumb is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
		if ( post_type_supports( $post_type, 'thumbnail' ) ) {
			add_meta_box(
				'some_meta_box_name'
				, 'Remote Post Thumbnail'
				, array( $this, 'render_meta_box_content' )
				, $post_type
				, 'side'
				, 'default'
			);
		}
	}

	/**
	 * Save the meta when the post is saved.
	 */
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['wprthumb_nonce'] ) )
			return $post_id;

		$nonce = $_POST['wprthumb_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'wprthumb' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* All good, its safe for us to save the data now. */

		// Sanitize the user input.
		$image = sanitize_text_field( $_POST['remote_thumb'] );
		$upload_dir = wp_upload_dir();
		//Get the remote image and save to uploads directory
		$img_name = time().'.jpg'.basename( $image, array( 'timeout' => 150 ) );
		$img = wp_remote_get( $image );

		if ( is_wp_error( $img ) ) {
			$error_message = $img->get_error_message();
			add_action( 'admin_notices', array( $this, 'wprthumb_admin_notice' ) );
		}
		else {
			$img = wp_remote_retrieve_body( $img );
			$fp = fopen( $upload_dir['path'].'/'.$img_name , 'w' );
			fwrite( $fp, $img );
			fclose( $fp );

			$wp_filetype = wp_check_filetype( $img_name , null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace( '/\.[^.]+$/', '', $img_name ),
				'post_content' => '',
				'post_status' => 'inherit'
			);

			//require for wp_generate_attachment_metadata which generates image related meta-data also creates thumbs
			require_once ABSPATH . 'wp-admin/includes/image.php';
			$attach_id = wp_insert_attachment( $attachment, $upload_dir['path'].'/'.$img_name, $post_id );
			//Generate post thumbnail of different sizes.
			$attach_data = wp_generate_attachment_metadata( $attach_id , $upload_dir['path'].'/'.$img_name );
			wp_update_attachment_metadata( $attach_id,  $attach_data );
			//Set as featured image.
			delete_post_meta( $post_id, '_thumbnail_id' );
			add_post_meta( $post_id , '_thumbnail_id' , $attach_id, true );
		}
	}

	/**
	 * Render Meta Box content.
	 */
	public function render_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'wprthumb', 'wprthumb_nonce' );

		// Display the form, using the current value.
		echo '<label for="remote_thumb">';
		_e( 'Enter remote image url', 'wprthumb' );
		echo '</label> ';
		echo '<input type="text" id="remote_thumb" name="remote_thumb" size="25" />';
	}

	/**
	 * Admin notice for errors.
	 */
	function wprthumb_admin_notice() { ?>
	    <div class="error">
	        <p><?php _e( 'Error while fetching remote thumbnail! Please try again.', 'wprthumb' ); ?></p>
	    </div>
	    <?php
	}
}