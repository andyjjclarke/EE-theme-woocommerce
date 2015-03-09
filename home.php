<?php
 /*
 Template Name: Home
 */
 get_header();
 the_post();

 breadcrumb();
 ?>
 <section class="col col-main">

     <section class="col feature-box is-large page-slider">
     <div class="page-slider-wrap">
        <?php
        $i = 0;
        $classValue = 'is-active';
        while (have_rows('carousel_boxes')):
            the_row();
            $imageSize = 'two-col-square';
            $link = get_sub_field('link') == 'internal'
                  ? get_sub_field('link_internal')
                  : get_sub_field('link_external');
            ?>
            <a id="slide-<?php echo $i ?>" class="page-slide <?php echo $classValue . ' '; the_sub_field('colour'); ?>" href="<?php echo $link; ?>">
                <div class="multiply">
                    <h1><?php the_sub_field('title'); ?></h1>

                    <?php if (($image = get_sub_field('image')) !== false): ?>
                        <div class="img-wrap"><img src="<?php echo $image['sizes'][$imageSize]; ?>"
                             alt="<?php echo $image['alt']; ?>"
                             width="<?php echo $image['sizes']["{$imageSize}-width"]; ?>"
                             height="<?php echo $image['sizes']["{$imageSize}-height"]; ?>"
                        ></div>
                    <?php endif; ?>
                </div>
                <div class="icon-wrap">
                    <?php if (($icon = get_sub_field('icon')) !== false): ?>
                        <img srcset="<?php echo $icon['sizes']['icon-2x']; ?> 2x, <?php echo $icon['sizes']['icon-1x']; ?> 1x"
                            alt="<?php echo $icon['alt']; ?>"
                            width="<?php echo $icon['sizes']['icon-1x-width']; ?>"
                            height="<?php echo $icon['sizes']['icon-1x-height']; ?>"
                        >
                    <?php endif; ?>
                </div>
           </a>
            <?php
        $i++;
        $classValue = '';
        endwhile;
        ?>
        <nav class="slide-navigation"></nav>
    </div>
    </section>

    <?php
    $i = 0;
    while (have_rows('feature_boxes') && $i < 2):
     the_row();
    $imageSize = $i == 0 ? 'two-col-square' : 'one-col-square';
    $link = get_sub_field('link') == 'internal'
    ? get_sub_field('link_internal')
    : get_sub_field('link_external');
    ?>
    <section class="col feature-box <?php the_sub_field('colour'); ?> <?php echo $i == 0 ? ' ' : ' '; ?>">
        <a href="<?php echo $link; ?>">
            <div class="multiply">
                <h1><?php the_sub_field('title'); ?></h1>
                <?php if (($image = get_sub_field('image')) !== false): ?>
                    <div class="img-wrap"><img src="<?php echo $image['sizes'][$imageSize]; ?>"
                       alt="<?php echo $image['alt']; ?>"
                       width="<?php echo $image['sizes']["{$imageSize}-width"]; ?>"
                       height="<?php echo $image['sizes']["{$imageSize}-height"]; ?>"
                       ></div>
                   <?php endif; ?>
               </div>
               <div class="icon-wrap">
                  <?php if (($icon = get_sub_field('icon')) !== false): ?>
                    <img srcset="<?php echo $icon['sizes']['icon-2x']; ?> 2x, <?php echo $icon['sizes']['icon-1x']; ?> 1x"
                        alt="<?php echo $icon['alt']; ?>"
                        width="<?php echo $icon['sizes']['icon-1x-width']; ?>"
                        height="<?php echo $icon['sizes']['icon-1x-height']; ?>"
                    >
                <?php endif; ?>
               </div>
           </a>
       </section>
       <?php
       $i++;
       endwhile;
       ?>

   </section>

   <section class="col col-full cf">
    <?php get_template_part('partials/boxes', 'highlight'); ?>
</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
    $(function() {
        var browserSizing = function() {
            $(".highlight-box p").magicEqualHeights();
            $('.multiply').multiplyReplace();
            $('.sidebar > ul > li > a').lineUpWith($('.col.feature-box'), 4, 1);
        };
        $(window).resize($.debounce(300, browserSizing));
        browserSizing();
    });
</script>

<?php
get_footer();
?>