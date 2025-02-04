<?php
add_action('admin_menu', 'dev_menu');
function dev_menu()
{
    add_menu_page('DevManga', 'DevManga', 'administrator', 'configuration', 'configuration', 'dashicons-admin-generic', 81);
    add_submenu_page('configuration', 'Dashboard', 'Dashboard', 'administrator', 'configuration', 'configuration');
    $submenu['configuration'][0][0] = 'Dashboard';
    add_action('admin_init', 'register_dev_settings');
}
function register_dev_settings()
{

    register_setting('dev-settings', 'logo');
    register_setting('dev-settings', 'tooltip');
    register_setting('dev-settings', 'statically_link');
    register_setting('dev-settings', 'statically_thumbnail');
    register_setting('dev-settings', 'default_server');
    register_setting('dev-settings', 'mangapost');
    register_setting('dev-settings', 'mangapostproject');
    register_setting('dev-settings', 'hotpost');
    register_setting('dev-settings', 'advancedsearch');
    register_setting('dev-settings', 'descfooter');
    register_setting('dev-settings', 'blogpost');
    register_setting('dev-settings', 'notice');
    register_setting('dev-settings', 'blogpostpage');
    register_setting('dev-settings', 'azslug');
    register_setting('dev-settings', 'mangapostprojectpage');
    register_setting('dev-settings', 'default_manga_cover');
    register_setting('dev-settings', 'lazyload_chapter');
}
function dashboard()
{
    ?>
<div class="wrap">
    <h2>Dashboard</h2>
</div>
<?php }
function configuration()
{
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
    ?>
<div class="wrapr">
    <h2>DevManga</h2>
    <div class="content">
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('dev-settings');?>
            <?php do_settings_sections('dev-settings');?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Header</th>
                    <td>
                        <input class="logo" type="text" name="logo" size="60" value="<?php echo get_option('logo'); ?>">
                        <a href="#" class="header_logo_upload button button-primary">Upload</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Desc Footer</th>
                    <td><textarea type="text/javascript" name="descfooter" rows="10" cols="50"
                            value="<?php echo esc_attr(get_option('descfooter')); ?>" class="large-text code"
                            placeholder=""><?php echo esc_attr(get_option('descfooter')); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Notice</th>
                    <td><textarea type="text/javascript" name="notice" rows="10" cols="50"
                            value="<?php echo esc_attr(get_option('notice')); ?>" class="large-text code"
                            placeholder=""><?php echo esc_attr(get_option('notice')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('A-Z Slug', 'textdomain');?></th>
                    <td><input type="text" size="30" name="azslug" value="<?php echo get_option('azslug'); ?>"> </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Twitter', 'textdomain');?></th>
                    <td><input type="text" size="30" name="twitter" value="<?php echo get_option('twitter'); ?>"> </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Instagram', 'textdomain');?></th>
                    <td><input type="text" size="30" name="instagram" value="<?php echo get_option('instagram'); ?>">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Google', 'textdomain');?></th>
                    <td><input type="text" size="30" name="google" value="<?php echo get_option('google'); ?>"> </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Show Post Advanced Search', 'textdomain');?></th>
                    <td><input type="number" size="30" name="advancedsearch"
                            value="<?php echo get_option('advancedsearch'); ?>"> </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Number of Chapters Displayed at Home', 'textdomain');?></th>
                    <td><input type="number" size="10" name="mangapost" value="<?php echo get_option('mangapost'); ?>"
                            placeholder="1"> </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Number of Chapters Project Displayed at Home', 'textdomain');?></th>
                    <td><input type="number" size="10" name="mangapostproject"
                            value="<?php echo get_option('mangapostproject'); ?>" placeholder="1"> </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Number of Chapters Project Displayed at Page', 'textdomain');?></th>
                    <td><input type="number" size="10" name="mangapostprojectpage"
                            value="<?php echo get_option('mangapostprojectpage'); ?>" placeholder="1"> </td>
                </tr>


                <tr valign="top">
                    <th scope="row"><?php _e('Number of Blog Displayed', 'textdomain');?></th>
                    <td><input type="number" size="10" name="blogpost" value="<?php echo get_option('blogpost'); ?>"
                            placeholder="1"> </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Number of Blog Page Displayed', 'textdomain');?></th>
                    <td><input type="number" size="10" name="blogpostpage"
                            value="<?php echo get_option('blogpostpage'); ?>" placeholder="1"> </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Number of Hot Displayer', 'textdomain');?></th>
                    <td><input type="number" size="10" name="hotpost" value="<?php echo get_option('hotpost'); ?>"
                            placeholder="1"> </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Default Thumbnail', 'textdomain');?></th>
                    <td><input type="text" size="100" name="default_manga_cover"
                            value="<?php echo get_option('default_manga_cover'); ?>" placeholder="default thumbnail">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Display Tooltip', 'textdomain');?></th>
                    <td>
                        <input type="checkbox" name="tooltip" id="tooltip"
                            <?php if (get_option('tooltip')) {echo 'checked';}?>>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Gunakan Statically', 'textdomain');?></th>
                    <td>
                        <input type="checkbox" name="statically_link" id="statically_link"
                            <?php if (get_option('statically_link')) {echo 'checked';}?>>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Gunakan Statically Thumbnail', 'textdomain');?></th>
                    <td>
                        <input type="checkbox" name="statically_thumbnail" id="statically_thumbnail"
                            <?php if (get_option('statically_thumbnail')) {echo 'checked';}?>>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><?php _e('Server Gambar default', 'textdomain');?></th>
                    <td>
                        <?php $default_server = get_option('default_server');?>
                        <select name="default_server" id="default_server">
                            <option value="nrm" <?php if ('nrm' === $default_server) {echo 'selected';}?>>Komikcast
                            </option>
                            <option value="cdn"
                                <?php if ('cdn' === $default_server || !$default_server) {echo 'selected';}?>>Statically
                                CDN</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Gunakan Chapter Lazyload', 'textdomain');?></th>
                    <td>
                        <input type="checkbox" name="lazyload_chapter" id="lazyload_chapter"
                            <?php if (get_option('lazyload_chapter')) {echo 'checked';}?>>
                    </td>
                </tr>

            </table>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                    value="Save Changes" /></p>
            <script>
            jQuery(document).ready(function($) {
                /*Logo Upload*/
                $('.header_logo_upload').click(function(e) {
                    e.preventDefault();

                    var custom_uploader = wp.media({
                            title: 'Custom Image',
                            button: {
                                text: 'Upload Image'
                            },
                            multiple: false // Set this to true to allow multiple files to be selected
                        })
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first()
                                .toJSON();
                            $('.logo').val(attachment.url);
                            $('.logo_img').attr('src', attachment.url);

                        })
                        .open();
                });

                /*Service 1 Image Upload*/
                $('.service_1_image_upload').click(function(e) {
                    e.preventDefault();

                    var custom_uploader = wp.media({
                            title: 'Custom Image',
                            button: {
                                text: 'Upload Image'
                            },
                            multiple: false // Set this to true to allow multiple files to be selected
                        })
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first()
                                .toJSON();
                            $('.service_1_image').val(attachment.url);
                            $('.service_1_image_img').attr('src', attachment.url);

                        })
                        .open();
                });

                /*Service 2 Image Upload*/
                $('.service_2_image_upload').click(function(e) {
                    e.preventDefault();

                    var custom_uploader = wp.media({
                            title: 'Custom Image',
                            button: {
                                text: 'Upload Image'
                            },
                            multiple: false // Set this to true to allow multiple files to be selected
                        })
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first()
                                .toJSON();
                            $('.service_2_image').val(attachment.url);
                            $('.service_2_image_img').attr('src', attachment.url);

                        })
                        .open();
                });

                /*Service 3 Image Upload*/
                $('.service_3_image_upload').click(function(e) {
                    e.preventDefault();

                    var custom_uploader = wp.media({
                            title: 'Custom Image',
                            button: {
                                text: 'Upload Image'
                            },
                            multiple: false // Set this to true to allow multiple files to be selected
                        })
                        .on('select', function() {
                            var attachment = custom_uploader.state().get('selection').first()
                                .toJSON();
                            $('.service_3_image').val(attachment.url);
                            $('.service_3_image_img').attr('src', attachment.url);

                        })
                        .open();
                });

            });
            </script>
            <style>
            .wrapr {
                width: 99%;
                background: #fff;
                box-shadow: 0 0 5px 0px #000000ad;
            }

            .wrapr h2 {
                background: #ddd;
                padding: 8px;
            }

            .content {
                padding: 0px 0px 0px 11px;
            }
            </style>
        </form>
    </div>
</div>
<?php }?>