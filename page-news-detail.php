<?php 
 /* 
 Template Name: News detail
 */
 get_header(); 
 the_post(); 

 breadcrumb();
 ?>
 <section class="col col-main cf">

    <div class="col col-primary-content full-width">
        
        <h1><?php the_title(); ?></h1>

        <?php if (($image = get_field('side_image')) != false): ?>

            <div class="pull-right">
                <img src="<?php echo $image['sizes']['two-col-square']; ?>" 
                     alt="<?php echo $image['alt']; ?>"
                     width="<?php echo $image['sizes']['two-col-square-width']; ?>"
                     height="<?php echo $image['sizes']['two-col-square-height']; ?>">
            </div>

            <div class="col-double">
                <?php 
                the_content();
                ?>
            </div>

        <?php
        else:
            the_content();
        endif;
        ?>

    </div>

    <div class="col col-primary-content full-width is-listing">

        <?php get_template_part('partials/related', 'courses'); ?>

        <footer class="news-footer">
            <h2>Updated / published:</h2>
            <?php the_modified_date('d.m.y'); ?>
        </footer>
        
    </div>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $('.col-primary-content:not(.is-listing)').lineUpWith(null, null, 35);
        $('.col-primary-content > h1').lineUpWith(null, null, 7);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>