<?php 
if (have_posts()):
while (have_posts()):
the_post();
?>

    <section class="forum-post post-list cf" id="post-<?php the_ID(); ?>">

        <?php
        get_template_part('partials/forum', 'post-header');
        ?>

        <div class="post-images">
            <?php
            the_post_image('half-col-square', 1);
            ?>
        </div>

        <div class="post-body">
            <?php the_excerpt(); ?>
            <a class="btn" href="<?php the_permalink(); ?>">Read more</a>
        </div>

    </section>

<?php 
endwhile; 
endif;
?>

<script>
$(function() {
    var browserSizing = function() {
        $('.forum-post').lineUpWith(null);
        $('.sidebar > ul > li > a').lineUpWith($('.forum-post'), 8, 1);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>