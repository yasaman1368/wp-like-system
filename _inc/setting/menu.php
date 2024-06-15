<?php
add_action('admin_menu', 'action_admin_menu_rp_setting');

/**
 * Fires before the administration menu loads in the admin.
 *
 * @param string $context Empty context.
 */
function action_admin_menu_rp_setting(string $context): void
{

    add_options_page(
        'تنظیمات پلاگین لایک مطالب',
        ' لایک مطالب',
        'manage_options',
        'like_post',
        'callback_ls_setting',
        '',
        7
    );
}
include_once LS_PLUGIN_DIR . '_inc/setting/setting.php';
