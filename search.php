<?php
get_header(); 

breadcrumb();
?>

<section class="col col-main">

    <div class="col col-primary-content full-width pull-left">

        <h1>Search</h1>

        <?php
        while (have_posts()):
            the_post();
            ?>

            <section class="search-result">
                <h1 class="entry-title h_beta">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h1>
        	<?php the_excerpt(); ?>
            </section>

        <?php 
        endwhile; 

        wp_paginate();
        ?>

    </div>

</section>

<section class="col col-sidebar">
    <?php
    unset($GLOBALS['post']);
    $GLOBALS['post'] = new stdClass;
    $GLOBALS['post']->sidebar = get_field('search_sidebar', 'options');
    get_sidebar(); 
    ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $('.search-result').lineUpWith();
        $('.sidebar > ul > li > a').lineUpWith($('.search-result'), null, 1);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>