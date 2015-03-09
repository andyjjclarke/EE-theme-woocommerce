<div class="cf clear">
    <?php 
    while (have_rows('secondary_highlight_boxes')): 
    the_row(); 
    $link = get_sub_field('link') == 'internal' 
          ? get_sub_field('link_internal') 
          : get_sub_field('link_external');
    if (get_row_layout() === 'single'):
    ?>
        <section class="col secondary-highlight-box">
            <a href="<?php echo $link; ?>">
                <h1><?php the_sub_field('title'); ?></h1>
                <?php if (($image = get_sub_field('image')) !== false): ?>
                    <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                         alt="<?php echo $image['alt']; ?>" 
                         width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                         height="<?php echo $image['sizes']['one-col-square-height']; ?>"
                    ></div>
                <?php endif; ?>
                <div class="divide"></div>
                <?php the_sub_field('description'); ?>
                <span class="btn"><?php the_sub_field('button_text'); ?></span>
            </a>
        </section>
    <?php
    elseif (get_row_layout() === 'double'):
    ?>
        <section class="col col-double secondary-highlight-box">
            <a href="<?php echo $link; ?>">
                <h1><?php the_sub_field('title'); ?></h1>
                <div class="col pull-left">
                    <?php if (($image = get_sub_field('image1')) !== false): ?>
                        <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                             alt="<?php echo $image['alt']; ?>" 
                             width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                             height="<?php echo $image['sizes']['one-col-square-height']; ?>"
                        ></div>
                    <?php endif; ?>
                </div>
                <div class="col pull-right">
                    <?php if (($image = get_sub_field('image2')) !== false): ?>
                        <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                             alt="<?php echo $image['alt']; ?>" 
                             width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                             height="<?php echo $image['sizes']['one-col-square-height']; ?>"
                        ></div>
                    <?php endif; ?>
                </div>
                <div class="divide"></div>
                <?php the_sub_field('description1'); ?>
                <span class="btn"><?php the_sub_field('button_text'); ?></span>
            </a>
        </section>
    <?php
    endif;
    endwhile; 
    ?>
</div>
<script>
$(function() {
    var browserSizing = function() {
        $(".secondary-highlight-box p").magicEqualHeights();
        $(".secondary-highlight-box h1").magicEqualHeights();
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
    var $boxes = $('.secondary-highlight-box');
    $boxes.each(function(i, c) {
        $(c).css('z-index', $boxes.length - i);
    });
});
</script>