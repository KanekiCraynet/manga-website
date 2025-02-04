<?php

/*
Template Name: Login registration template
 */

if (is_user_logged_in()) {
    wp_redirect('/');
    exit;
}

$auth_nonce  = wp_create_nonce('komik_auth_nonce');
$redirect_to = isset($_GET['from']) ? $_GET['from'] : "";
$action      = isset($_GET['action']) ? $_GET['action'] : '';
$key         = isset($_GET['key']) ? $_GET['key'] : '';
$login       = isset($_GET['login']) ? $_GET['login'] : '';
$is_reset    = (!empty($action) && 'rp' === $action) && !empty($key) && !empty($login);

get_header();
?>
<script>
var redirect_after_login = "<?php echo $redirect_to; ?>";
var ajax_url = "/wp-json/tktm/v1";
var lore_nonce = "<?php echo $auth_nonce; ?>";
var rest_nonce = "<?php echo wp_create_nonce('wp_rest'); ?>";
<?php if ($is_reset): ?>
var reset_key = "<?php echo $key; ?>";
var reset_login = "<?php echo $login; ?>";
<?php endif;?>
</script>
<div class="container-fluid d-flex align-items-center justify-content-center" data-login-container>
    <?php if (!$is_reset): ?>
    <div id="modal-tab-login" class="tab-pane active">
        <div class="modal-header">
            <h5 class="modal-title" id="modallogintitle">Login</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="login-error" style="display: none;"></div>
            <form class="preform" id="login-form" method="post">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="name@email.com" name="email"
                        required="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                        required="">
                </div>
                <div class="form-check custom-control custom-checkbox">
                    <div class="float-start remember-me">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Remember me</label>
                    </div>
                </div>
                <div class="form-group login-btn mt-4 mb-2">
                    <button class="btn btn-primary btn-block">Sign-in</button>
                    <div class="loading-relative" id="login-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer text-center justify-content-center">
            Belum punya akun? <a class="link-highlight register-tab-link" data-kr-toggle="modal"
                data-kr-target="#modal-tab-register">Daftar</a>
        </div>
    </div>
    <div id="modal-tab-register" class="tab-pane" style="display: none;">
        <div class="modal-header">
            <h5 class="modal-title" id="modalregistertitle">Register</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="register-error" style="display: none;"></div>
            <form class="preform" id="register-form" method="post">
                <div class="form-group">
                    <label class="form-label" for="reg-username">Username</label>
                    <input type="text" class="form-control" id="reg-username" placeholder="Username" name="reg-username"
                        required="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg-email">Email</label>
                    <input type="email" class="form-control" id="reg-email" placeholder="email: name@email.com"
                        name="reg-email" required="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg-password">Password</label>
                    <input type="password" class="form-control" id="reg-password" placeholder="Kata sandi"
                        name="reg-password" required="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg-rep-password">Password</label>
                    <input type="password" class="form-control" id="reg-rep-password" placeholder="Ulangi kata sandi"
                        name="reg-rep-password" required="">
                </div>
                <div class="form-group register-btn mt-4 mb-2">
                    <button class="btn btn-primary btn-block">Sign-in</button>
                    <div class="loading-relative" id="register-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer text-center justify-content-center">
            Sudah punya akun? <a class="link-highlight login-tab-link" data-kr-toggle="modal"
                data-kr-target="#modal-tab-login">Masuk</a>
        </div>
    </div>
    <div id="modal-tab-reset" class="tab-pane" style="display: none;">
        <div class="modal-header">
            <h5 class="modal-title" id="modalresettitle">Reset Password</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="reset-error" style="display: none;"></div>
            <div class="alert alert-success" id="reset-success" style="display: none;"></div>
            <form class="preform" id="reset-form" method="post">
                <div class="form-group">
                    <label class="form-label" for="reset-user-reset">Email or Username</label>
                    <input type="text" class="form-control" id="reset-username" placeholder="email or username"
                        name="reset-user-reset" required="">
                </div>
                <div class="form-group reset-btn mt-4 mb-2">
                    <button class="btn btn-primary btn-block">Get Verification Link</button>
                    <div class="loading-relative" id="reset-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer text-center justify-content-center">
            Sudah punya akun? <a class="link-highlight login-tab-link" data-kr-toggle="modal"
                data-kr-target="#modal-tab-login">Masuk</a>
        </div>
    </div>
    <?php else: ?>
    <div id="modal-tab-reset-new" class="tab-pane">
        <div class="modal-header">
            <h5 class="modal-title" id="modalresettitle">Set New Password</h5>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="reset-new-error" style="display: none;"></div>
            <div class="alert alert-success" id="reset-new-success" style="display: none;"></div>
            <form class="preform" id="reset-new-form" method="post">
                <div class="form-group">
                    <label class="form-label" for="reset-user-new">New Password</label>
                    <input type="password" class="form-control" id="reset-new-password" name="reset-user-new"
                        required="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="reset-user-repeat">Repeat Password</label>
                    <input type="password" class="form-control" id="reset-repeat-password" name="reset-user-repeat"
                        required="">
                </div>
                <div class="form-group reset-new-btn mt-4 mb-2">
                    <button class="btn btn-primary btn-block">Save</button>
                    <div class="loading-relative" id="reset-new-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <?php endif;?>
</div>
<?php
get_footer();
?>