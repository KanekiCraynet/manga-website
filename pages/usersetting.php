<?php

/*
Template Name: User Setting Page template
 */

if (!is_user_logged_in()) {
    $loginpage    = get_page_url('loginpages');
    $bookmarkpage = get_page_url('bookmark');
    wp_safe_redirect("$loginpage?from=$bookmarkpage");
    exit;
}

$auth_nonce = wp_create_nonce('komik_auth_nonce');
$user       = get_userdata(get_current_user_id());
get_header();
?>
<script>
var ajax_url = "/wp-json/tktm/v1";
var lore_nonce = "<?php echo $auth_nonce; ?>";
var rest_nonce = "<?php echo wp_create_nonce('wp_rest'); ?>";
</script>
<style>
.user-setting-error,
.user-setting-success {
    width: min(100%, 560px);
}
</style>
<div class="container-fluid d-flex align-items-center justify-content-start" data-user-setting
    style="flex-direction: column;margin-bottom: 2.5rem;">
    <div class="pt-4" style="font-size: 1.5rem;font-weight: 500;line-height: 2.25rem;margin-bottom: 1.25rem;">
        <?php echo the_title() ?>
    </div>
    <div class="alert alert-danger" id="user-setting-error" style="display: none;"></div>
    <div class="alert alert-success" id="user-setting-success" style="display: none;"></div>
    <div class="border border-secondary my-4 w-full" style="width: min(100%, 560px);"></div>
    <form id="user-setting" style="width: min(100%, 560px);">
        <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
        <div class="row mb-3">
            <label for="input-display-name" class="col-sm-3 col-form-label">Display Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="input-display-name"
                    value="<?php echo $user->display_name ?>">
            </div>
        </div>
        <div class="border border-secondary my-4"></div>
        <div class="row mb-3">
            <label for="input-email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="input-email" value="<?php echo $user->user_email ?>">
            </div>
        </div>
        <div class="border border-secondary my-4"></div>
        <div class="row mb-3">
            <label for="input-current-password" class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="input-current-password">
            </div>
        </div>
        <div class="row mb-3">
            <label for="input-new-password" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="input-new-password">
            </div>
        </div>
        <div class="row mb-3">
            <label for="input-repeat-password" class="col-sm-3 col-form-label">Repeat Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="input-repeat-password">
            </div>
        </div>
        <div class="form-group user-setting-btn mt-4 mb-2">
            <button class="btn btn-primary btn-block">Save</button>
            <div class="loading-relative" id="user-setting-loading" style="display: none;">
                <div class="loading">
                    <div class="span1"></div>
                    <div class="span2"></div>
                    <div class="span3"></div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
get_footer();