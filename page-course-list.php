<?php 
 /* 
 Template Name: Course listing
 */
get_header(); 
the_post(); 

breadcrumb();
?>
<section class="col col-main cf">

    <?php
    $content = get_the_content();
    $content = apply_filters( 'the_content', $content );
    ?>

    <div class="col col-primary-content full-width <?php echo ! $content ? 'is-empty' : ''; ?>">
        <h1 class="<?php echo!$content ? 'no-border' : ''; ?>"><?php the_title(); ?></h1>

        <?php if ($iframe = get_field('iframe_section')): ?>
            <div class="iframe-container">
                <?php echo $iframe; ?>
            </div>
            <?php
        endif;

        if (($image = get_field('side_image')) != false):
            ?>

            <div class="pull-right">
                <img src="<?php echo $image['sizes']['two-col-square']; ?>" 
                     alt="<?php echo $image['alt']; ?>"
                     width="<?php echo $image['sizes']['two-col-square-width']; ?>"
                     height="<?php echo $image['sizes']['two-col-square-height']; ?>">
            </div>

            <div class="col-double">
                <?php
                echo $content;
                ?>
            </div>

            <?php
        else:
            echo $content;
        endif;
        ?>

    </div>

    <div class="col col-primary-content full-width is-listing">

        <?php
        get_template_part('partials/related', 'courses');
        ?>

    </div>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $('.col-primary-content:not(.is-listing)').lineUpWith(null, null, 4);
        $('.course-listing').lineUpWith(null, null, 2);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>