<?php
function like_post_plugin()
{
?>
    <div class="like-container">

        <div class='middle-wrapper'>
            <div class='like-wrapper'>
                <?php if (metadata_exists('user', get_current_user_id(), '_like_post')) {
                    $post_id_array = get_user_meta(get_current_user_id(), '_like_post', true);
                } else {
                    $post_id_array = [];
                } ?>
                <a class='<?php echo in_array(get_the_ID(), $post_id_array) ? 'unlike-button' : 'like-button' ?>' data-post-id="<?php the_ID() ?>" data-user-id="<?php echo get_current_user_id() ?>">

                    <span class='like-icon'>
                        <div class='heart-animation-1'></div>
                        <div class='heart-animation-2'></div>
                    </span>
                    <span class="like-counter"><?php
                                                echo get_post_meta(get_the_ID(), '_ls_like_number', true) ? get_post_meta(get_the_ID(), '_ls_like_number', true) : '0'
                                                ?></span>
                </a>

            </div>
        </div>
    </div>

<?php
}
add_shortcode('like-post', 'like_post_plugin');
