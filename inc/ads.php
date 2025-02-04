<?php
add_action('admin_menu', 'gintheme_menu');
function gintheme_menu() {
	add_menu_page('Ads Management', 'Ads Management', 'administrator','ads', 'ads','dashicons-screenoptions',81 );
        add_menu_page('PopUp Management','PopUp Management', 'administrator', 'popup', 'popup_management', 'dashicons-screenoptions', 82);
	add_action( 'admin_init', 'register_gintheme_settings' );
}
function register_gintheme_settings() {
        register_setting( 'gintheme-settings', 'tophome' );
		register_setting('gintheme-settings', 'footerall');
        register_setting( 'gintheme-settings', 'homeslider' );
        register_setting( 'gintheme-settings', 'chaptertop' );
        register_setting( 'gintheme-settings', 'readertop' );
        register_setting( 'gintheme-settings', 'readerbottom' );
        register_setting( 'gintheme-settings', 'floatingbawah' );
        register_setting( 'gintheme-settings', 'floatingreader' );
        register_setting( 'gintheme-settings', 'readercustom' );
        register_setting( 'gintheme-settings', 'infocustom' );
        register_setting( 'gintheme-settings', 'topdaftar' );
		register_setting( 'gintheme-settings', 'singlepage' );
		register_setting( 'gintheme-settings', 'komikinfo' );
	
		
	
	
	
        register_setting('komik-redesign', 'allpagepopup');
        register_setting('komik-redesign', 'homepopup');
        register_setting('komik-redesign', 'excludehomepopup');

}
function ads_dash() { 
?>
<div class="wrap">
        <h2>Dashboard</h2>
</div>
<?php }
function ads() {
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
?>
<div class="wrap">
        <h2>Configuration</h2>
        <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields( 'gintheme-settings' ); ?>
                <?php do_settings_sections( 'gintheme-settings' ); ?>
                <table class="form-table">
					 <th scope="row">
                                Header Top Daftar Komik</th>
                        <td><textarea type="text" name="topdaftar" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('topdaftar') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 720 x 92 code here"><?php echo esc_attr( get_option('topdaftar') ); ?></textarea>
                        </td>
                        </tr>
						 <th scope="row">
                               Header Single Page</th>
                        <td><textarea type="text" name="singlepage" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('singlepage') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 720 x 92 code here"><?php echo esc_attr( get_option('singlepage') ); ?></textarea>
                        </td>
                        </tr>
						 <th scope="row">
                               Header Komik Info</th>
                        <td><textarea type="text" name="komikinfo" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('komikinfo') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 720 x 92 code here"><?php echo esc_attr( get_option('komikinfo') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">
                                Top Slider Popular Manga</th>
                        <td><textarea type="text" name="homeslider" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('homeslider') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your url homeslider"><?php echo esc_attr( get_option('homeslider') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Header all page except read page</th>
                        <td><textarea type="text" name="tophome" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('tophome') ); ?>" class="large-text code"
                                        placeholder="Place your ads 720 x 92 code here"><?php echo esc_attr( get_option('tophome') ); ?></textarea>
                        </td>
                        </tr>
						<th scope="row">Footer all page except read page</th>
                        <td><textarea type="text" name="footerall" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('footerall') ); ?>" class="large-text code"
                                        placeholder="Place your ads 720 x 92 code here"><?php echo esc_attr( get_option('footerall') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Top Chapter</th>
                        <td><textarea type="text/javascript" name="chaptertop" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('chaptertop') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 120 x 92 code here"><?php echo esc_attr( get_option('chaptertop') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Top Reader Area</th>
                        <td><textarea type="text/javascript" name="readertop" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('readertop') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 120 x 92 code here"><?php echo esc_attr( get_option('readertop') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Bottom Reader Area</th>
                        <td><textarea type="text/javascript" name="readerbottom" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('readerbottom') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 120 x 92 code here"><?php echo esc_attr( get_option('readerbottom') ); ?></textarea>
                        </td>
                        </tr>

                        <th scope="row">Reader Custom Ads</th>
                        <td><textarea type="text/javascript" name="readercustom" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('readercustom') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 120 x 92 code here"><?php echo esc_attr( get_option('readercustom') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Info Custom Ads</th>
                        <td><textarea type="text/javascript" name="infocustom" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('infocustom') ); ?>"
                                        class="large-text code"
                                        placeholder="Place your ads 120 x 92 code here"><?php echo esc_attr( get_option('infocustom') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Floating Bottom</th>
                        <td><textarea type="text/javascript" name="floatingbawah" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('floatingbawah') ); ?>"
                                        class="large-text code"
                                        placeholder="Place ads here"><?php echo esc_attr( get_option('floatingbawah') ); ?></textarea>
                        </td>
                        </tr>
                        <th scope="row">Floating Reading Page</th>
                        <td><textarea type="text/javascript" name="floatingreader" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('floatingreader') ); ?>"
                                        class="large-text code"
                                        placeholder="Place ads here"><?php echo esc_attr( get_option('floatingreader') ); ?></textarea>
                        </td>
                        </tr>

                </table>
                <?php submit_button(); ?>

        </form>
</div>

<?php } 

function popup_management(){;?>
<style>
.popup_{
        padding: 0.5rem;
}
.popup_ h2{
        font-size: 1.4rem;
        padding: 0.5rem 0;
}
.popup_items{
        display: flex;
        flex-flow: column wrap;
        gap: 1rem;
        padding: 0.5rem;

}
.popup_item{
        display: flex;
        flex-flow: column wrap;
        gap: 0.5rem;
        font-size: 1rem;
}
.popup_item-title{
        padding: 0.5rem 0;
        font-size: 1.2rem;
        font-weight: 500;
        line-height: 1.6rem;
}
.popup_item-text{
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.2rem;
        height: 10rem;
    border: none;
    outline: none;
    border-radius: 5px;
}
.popup_item-text:focus{
        outline: none;
        border: none;
        box-shadow: none;
}
</style>
<div class="popup_">
        <h2>PopUp Management</h2>
        <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields( 'komik-redesign' ); ?>
                <?php do_settings_sections( 'komik-redesign' ); ?>
                <ul class="popup_items">
                        <li class="popup_item">
                                <span class="popup_item-title">
                                        Popup untuk semua halaman
                                </span>
                                <textarea type="text" name="allpagepopup" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('allpagepopup') ); ?>"
                                        class="popup_item-text"
                                        placeholder="Script popup untuk semua halaman. Masukkan semua termasuk script tagnya. (<script>bbbbbbbssss</script>)"><?php echo esc_attr( get_option('allpagepopup') ); ?></textarea>
                        </li>
                        <li class="popup_item">
                                <span class="popup_item-title">
                                        Popup untuk halaman utama (home/index)
                                </span>
                                <textarea type="text" name="homepopup" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('homepopup') ); ?>" class="popup_item-text"
                                        placeholder="Script popup untuk home atau index. Masukkan semua termasuk script tagnya. (<script>bbbbbbbssss</script>)"><?php echo esc_attr( get_option('homepopup') ); ?></textarea>
                        </li>
                        <li class="popup_item">
                                <span class="popup_item-title">
                                        Popup untuk selain halaman utama (home/index)
                                </span>
                                <textarea type="text/javascript" name="excludehomepopup" rows="10" cols="50"
                                        value="<?php echo esc_attr( get_option('excludehomepopup') ); ?>" class="popup_item-text"
                                        placeholder="Script untuk page selain home. Masukkan semua termasuk script tagnya. (<script>bbbbbbbssss</script>)"><?php echo esc_attr( get_option('excludehomepopup') ); ?></textarea>
                        </li>
                </ul>
                <?php submit_button(null, 'primary', 'submit', false, ['class'=>'popup_submit']); ?>

        </form>
</div>

<?php }