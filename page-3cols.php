<?php 
 /* 
 Template Name: Three columns
 */
get_header(); 
the_post(); 

breadcrumb();
?>
<section class="col col-main cf">

    <div class="col col-primary-content">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>

    <aside class="col col-secondary-content">
        <ul>
            <?php
            while (have_rows('secondary_content')): 
            the_row(); 
            if (get_row_layout() === 'image'):
            ?>
                <li class="image">
                    <?php if (($image = get_sub_field('image')) !== false): ?>
                        <img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                             alt="<?php echo $image['alt']; ?>" 
                             width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                             height="<?php echo $image['sizes']['one-col-square-height']; ?>"
                        >
                    <?php endif; ?>
                </li>
            <?php
            elseif (get_row_layout() === 'quote'):
            ?>
                <li class="quote cf">
                    <blockquote>
                        <?php the_sub_field('quote'); ?>
                        <footer>
                            <h1><cite><?php the_sub_field('author'); ?></cite></h1>
                            <?php if (($author_from = get_sub_field('author_from')) != false): ?>
                                <p><?php echo $author_from; ?></p>
                            <?php endif; ?>
                        </footer>
                    </blockquote>
                    <div class="icon-wrap">
                    <?php if (($icon = get_sub_field('icon')) !== false): ?>
                        <img srcset="<?php echo $icon['sizes']['icon-2x']; ?> 2x, <?php echo $icon['sizes']['icon-1x']; ?> 1x" 
                            alt="<?php echo $icon['alt']; ?>" 
                            width="<?php echo $icon['sizes']['icon-1x-width']; ?>"
                            height="<?php echo $icon['sizes']['icon-1x-height']; ?>"
                        >
                    <?php endif; ?>
                </div>
                    
                </li>
            <?php
            endif;
            endwhile;
            ?>
        </ul>
    </aside>

    <?php get_template_part('partials/boxes', 'plain'); ?>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $(".plain-box p").magicEqualHeights();
        $(".plain-box h1").magicEqualHeights();
        $('.col-primary-content > h1').lineUpWith(null, null, 7);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>