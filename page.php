<?php
get_header();
the_post();

breadcrumb();
?>

<section class="col col-main">

    <?php
    $content = get_the_content();
    $content = apply_filters('the_content', $content);
    ?>

    <div class="col col-primary-content full-width <?php echo!$content ? 'is-empty' : ''; ?>">

        <h1 class="<?php echo!$content ? 'no-border' : ''; ?>"><?php the_title(); ?></h1>

        <?php if ($iframe = get_field('iframe_section')): ?>
            <div class="iframe-container">
                <?php echo $iframe; ?>
            </div>
            <?php
        endif;

        if (get_field('multiple_side_images') != false): ?>
        	<div class="pull-right"><?php
        	while (has_sub_field('multiple_side_images')):
        		$image = get_sub_field('side_image');
            ?>
                <div class="multiple-side-images">
	                <img src="<?php echo $image['sizes']['two-col-square']; ?>" 
                     alt="<?php echo $image['alt']; ?>"
                     width="240"
                     height="240"
                     >
                </div>
            <?php endwhile; ?>
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

    <?php get_template_part('partials/boxes', 'plain'); ?>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
    $(function () {
        var browserSizing = function () {
            $('.col-primary-content').lineUpWith(null, null, 8);
            $('.sidebar > ul > li > a').lineUpWith($('.col-primary-content'), -5, 1);
            $(".plain-box > a").lineUpWith(null, null, 8).magicEqualHeights(true);
            $('.col-primary-content > h1').lineUpWith(null, null, 7);
            <?php if ($iframe): ?>
                $('.iframe-container').lineUpWith(null, null, 7);
            <?php endif; ?>
        };
        $(window).resize($.debounce(300, browserSizing));
        $(browserSizing);
    });
</script>

<?php
get_footer();
?>