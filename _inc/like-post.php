<?php
add_action('wp_ajax_wp_ls_like_post', 'wp_ls_like_post');
add_action('wp_ajax_nopriv_wp_ls_like_post', 'wp_ls_like_post');
function wp_ls_like_post()
{
    if (!isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce']))
        die('access denied!!!');
    if (!is_user_logged_in()) {
        wp_send_json([
            'error' => true,
            'message' => 'برای لایک کردن وارد  سایت شوید'
        ], 403);
    }
    if (!empty($_POST['userId']) && !empty($_POST['postId'])) {
        //check post liked? *
        is_user_liked_post($_POST['userId'], $_POST['postId']);
        $userId = intval($_POST['userId']);
        $postId = intval($_POST['postId']);
        if (!metadata_exists('user', $userId, '_like_post')) {
            $meta_value[] = $postId;
            add_user_meta($userId, '_like_post', $meta_value);
        } else {
            $current_meta_value = get_user_meta($userId, '_like_post', true);
            $current_meta_value[] = $postId;
            update_user_meta($userId, '_like_post', $current_meta_value);
        }
        like_post_counter($postId);
        wp_send_json([
            'success' => true,
            'message' => 'لایک شما ثبت شد',
            'likeNumber' => get_post_meta($postId, '_ls_like_number', true)
        ], 200);
    } else {
        wp_send_json(['error' => true, 'message' => 'خطایی رخ داده است!!!'], 403);
    }
}
function is_user_liked_post($userId, $postId)
{
    $postLikedArray = get_user_meta($userId, '_like_post', true);
    foreach ($postLikedArray as $item) {
        if ($item == $postId)
            wp_send_json([
                'error' => true,
                'message' => 'شما قبلا این پست را لایک کردید'
            ], 403);
    }
}
function like_post_counter($postId)
{
    if (!metadata_exists('post', $postId, '_ls_like_number')) {
        add_post_meta($postId, '_ls_like_number', '1');
    } else {
        $like_number = get_metadata('post', $postId, '_ls_like_number', true);
        $like_number++;
        update_post_meta($postId, '_ls_like_number', $like_number);
    }
}
