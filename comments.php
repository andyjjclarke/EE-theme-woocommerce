<?php
if (have_comments()):
?>

    <ul>
        <?php
        wp_list_comments(array(
            'walker' => new Ex_Comment_Walker()
        ));
        ?>
    </ul>

    <?php 
    $prev = get_previous_comments_link('Older');
    $next = get_next_comments_link('Newer');
    if ($prev || $next):
    ?>
        <div class="pagination cf">
            <ul class="wp-paginate">
                <li><span class="title">Pages:</span></li>
                <li><?php echo $prev; ?></li>
                <li><?php echo $next; ?></li>
            </ul>
        </div>
    <?php
    endif;
    ?>

<?php
endif;

comment_form(array(
    'must_log_in' => 
        '<p class="must-log-in">You must be logged in to post a comment</p>' .
        sprintf(__( '<a href="%s" class="btn">Log in</a>' ),
                wp_login_url() . '?redirect_to=' . urlencode(get_permalink(). '#respond')
        ),
    'logged_in_as' => 
        '<p class="logged-in-as">' .
        sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="btn" title="Log out of this account">Log out</a>' ), 
                admin_url( 'profile.php' ),
                $user_identity,
                wp_logout_url(apply_filters('the_permalink', get_permalink()))
        ) . 
        '</p>',
    'comment_notes_after' => '',
));
if (!have_comments()) {
    echo "There are no community comments for this post.";
}