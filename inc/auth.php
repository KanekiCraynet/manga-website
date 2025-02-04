<?php

add_action('rest_api_init', 'custom_auth_funct');
function custom_auth_funct()
{
    register_rest_route('tktm/v1', '/login', [
        'methods'             => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => 'user_login_custom_func',
    ]);
    register_rest_route('tktm/v1', '/register', [
        'methods'             => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => 'user_register_custom_func',
    ]);
    register_rest_route('tktm/v1', '/reset', [
        'methods'             => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => 'user_forgot_custom_func',
    ]);
    register_rest_route('tktm/v1', '/reset-new', [
        'methods'             => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => 'user_change_custom_func',
    ]);
    register_rest_route('tktm/v1', '/user-setting', [
        'methods'             => WP_REST_Server::CREATABLE,
        'permission_callback' => '__return_true',
        'args'                => [],
        'callback'            => 'user_modify_custom_func',
    ]);
}

function user_login_custom_func(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    if (!$data || !isset($data['nonce']) || !wp_verify_nonce($data['nonce'], 'komik_auth_nonce')) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid security nonce.']);
    }

    $user_login = sanitize_text_field($data['user_login']);
    $user_pass  = $data['user_pass'];
    $remember   = isset($data['remember']) && 'true' === $data['remember'] ? 1 : 0;
    $info       = ['user_login' => $user_login, 'user_password' => $user_pass, 'remember' => true];

    $user   = wp_signon($info, "");
    $result = [
        'status'  => false,
        'message' => "",
    ];
    if (is_wp_error($user)) {

        switch ($user->get_error_code()) {
            case 'invalid_username':
                $result['message'] = "Username salah! gunakan email jika nggak inget username.";
                break;
            case 'incorrect_password':
                $result['message'] = "Username atau password salah!";
                break;
        }
    } else {
        $result['status']     = true;
        $result['message']    = 'Success.';
        $result['rest_nonce'] = wp_create_nonce('wp_rest');
    }

    wp_set_auth_cookie($user->ID, 1, is_ssl());
    wp_set_current_user($user->ID);
    return new WP_REST_Response($result);
}

function user_register_custom_func(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    if (!$data || !isset($data['nonce']) || !wp_verify_nonce($data['nonce'], 'komik_auth_nonce')) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid security nonce.']);
    }

    $user_login = sanitize_text_field($data['user_login']);
    $user_pass  = $data['user_pass'];
    $user_name  = sanitize_text_field($data['user_name']);
    $result     = [
        'status'  => false,
        'message' => '',
    ];
    if (!is_email($user_login)) {
        $result['message'] = 'Email salah!';
    } else {
        $exists = get_user_by('email', $user_login);
        if ($exists) {
            $result['message'] = 'Email sudah digunakan!';
        } else {
            $user = wp_create_user($user_name, $user_pass, $user_login);
            if (is_wp_error($user)) {
                $result['message'] = $user->get_error_code();
            } else {
                $userdata = get_userdata($user);
                wp_set_current_user($user, $userdata->display_name);
                do_action('wp_login', $userdata->user_login);
                wp_set_auth_cookie($user, true);
                $result['status']  = true;
                $result['message'] = 'Success.';
            }
        }

    }

    return new WP_REST_Response($result);
}

function user_forgot_custom_func(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    if (!$data || !isset($data['nonce']) || !wp_verify_nonce($data['nonce'], 'komik_auth_nonce')) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid security nonce.']);
    }
    $user_reset = isset($data['user_login']) ? $data['user_login'] : '';

    if (empty($user_reset)) {
        wp_send_json_error(__('Username or email address cannot be empty'));
    }

    $user_reset = trim($user_reset);

    $result = custom_retrieve_password($user_reset);

    if (is_wp_error($result)) {
        return new WP_REST_Response(['status' => false, 'message' => $result->get_error_message(), 'login' => $user_reset]);
    }

    return new WP_REST_Response(['status' => true, 'message' => 'Please check your email to get reset password link.']);
}

function custom_retrieve_password($user_login)
{
    if (is_email($user_login)) {
        $user_data = get_user_by('email', $user_login);
    } else {
        $user_data = get_user_by('login', $user_login);
    }

    if (!$user_data) {
        return new WP_Error('invalid_login', __('Invalid user login'));
    }

    $key = get_password_reset_key($user_data);

    if (is_wp_error($key)) {
        return $key;
    }

    if (is_multisite()) {
        $site_name = get_network()->site_name;
    } else {
        $site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    }
    $user_email = $user_data->user_email;

    $message   = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
    $loginpage = get_page_url('loginpages');
    $message .= sprintf(__('Username: %s'), $user_data->user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= "<" . $loginpage . "?action=rp&key=$key&login=" . rawurlencode($user_data->user_login) . ">\r\n\r\n";

    $title = sprintf(__('[%s] Password Reset'), $site_name);

    $title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);

    $message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);

    if (!wp_mail($user_email, wp_specialchars_decode($title), $message)) {
        return new WP_Error('sent_failed', __('The email could not be sent.'));
    }

    return true;
}

function user_change_custom_func(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    if (!$data || !isset($data['nonce']) || !wp_verify_nonce($data['nonce'], 'komik_auth_nonce')) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid security nonce.']);
    }

    if (!$data['reset_key'] || !$data['reset_login'] || !$data['new_pass']) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid reset request.']);
    }

    $user = check_password_reset_key($data['reset_key'], $data['reset_login']);
    if (is_wp_error($user)) {
        return new WP_REST_Response(['status' => false, 'message' => $user->get_error_message()]);
    }

    if (is_email($data['reset_login'])) {
        $userdata = get_user_by('email', $data['reset_login']);
    } else {
        $userdata = get_user_by('login', $data['reset_login']);
    }

    if (!$userdata) {
        return new WP_REST_Response(['status' => false, 'message' => 'User not found.']);
    }

    wp_set_password($data['new_pass'], $userdata->ID);
    return new WP_REST_Response(['status' => true, 'message' => 'Password reset successuflly! You can login now.']);
}

function user_modify_custom_func(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    if (!$data || !isset($data['nonce']) || !wp_verify_nonce($data['nonce'], 'komik_auth_nonce') || !isset($data['user_id']) || empty($data['user_id'])) {
        return new WP_REST_Response(['status' => false, 'message' => 'Invalid security nonce.']);
    }

    $user = get_userdata($data['user_id']);

    if (!$user) {
        return new WP_REST_Response(['status' => false, 'message' => 'You don\'t have permission to update this info.']);
    }

    $updated = "";

    if (isset($data['display']) && $data['display'] !== $user->display_name) {
        $up = wp_update_user(['display_name' => esc_attr($data['display']), 'ID' => $user->ID]);
        if (is_wp_error($up)) {
            $updated .= "Display Name: " . $up->get_error_message() . "\r\n";
        } else {
            $updated .= "Display name has been updated. \r\n";
        }
    }

    if (is_email($data['email']) && $data['email'] !== $user->user_email) {
        if (email_exists($data['email'])) {
            $updated .= "Email already in use.\r\n";
        } else {
            $up = wp_update_user(['user_email' => $data['email'], 'ID' => $user->ID]);
            if (is_wp_error($up)) {
                $updated .= $up->get_error_message() . "\r\n";
            } else {
                $updated .= "Email has been changed.\r\n";
            }
        }
    }

    if (isset($data['password'], $data['newpass']) && !empty($data['password']) && !empty($data['newpass'])) {
        if (!wp_check_password($data['password'], $user->user_pass, $user->ID)) {
            $updated .= "Current password is incorrect.\r\n";
        } else {
            wp_set_password($data['newpass'], $user->ID);
            $updated .= "Password has been changed.\r\n";
        }
    }

    return new WP_REST_Response(['status' => true, 'message' => $updated]);
}