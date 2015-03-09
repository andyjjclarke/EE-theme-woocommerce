<?php
if (comments_open()):
?>
<div class="col col-primary-content full-width forum-add-comment">

    <a href="#" class="btn">Post a comment</a>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php 
        if (is_user_logged_in()):
        $current_user = wp_get_current_user();
        ?>

            <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $current_user->display_name; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

        <?php
        else:
        ?>

            <p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ($req) echo "required"; ?> />
            <label for="author">Name <?php if ($req) echo "(required)"; ?></label></p>

            <p><input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ($req) echo "required"; ?> />
            <label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label></p>

            <p><input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" />
            <label for="url">Website</label></p>

        <?php
        endif;
        ?>

        <textarea name="comment" id="comment" cols="100%" rows="10" required></textarea>

        <button type="submit" name="submit" id="send">Submit Comment</button>

        <?php 
        comment_id_fields();
        do_action('comment_form', $post->ID);
        ?>

    </form>

</div>
<?php
endif;
?>