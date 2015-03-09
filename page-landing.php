<?php 
 /* 
 Template Name: Landing page
 */
get_header(); 
the_post();

breadcrumb();
?>
<section class="col col-main">
    <div class="col col-primary-content full-width is-empty">
        <h1><?php the_title(); ?></h1>
    </div>

    <?php get_template_part('partials/boxes', 'highlight'); ?>
    <?php get_template_part('partials/boxes', 'plain'); ?>
</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $(".cta-box p").magicEqualHeights();
        $(".cta-box-secondary p").magicEqualHeights();
        $('.multiply').multiplyReplace();
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>