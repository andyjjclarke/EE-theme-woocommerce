<div class="cf clear">
    <?php 
    while (have_rows('highlight_boxes')): 
    the_row(); 
    $link = get_sub_field('link') == 'internal' 
          ? get_sub_field('link_internal') 
          : get_sub_field('link_external');
    ?>
        <section class="col highlight-box <?php the_sub_field('colour'); ?>">
            <a href="<?php echo $link; ?>">
                <div class="multiply">
                    <h1><?php the_sub_field('title'); ?></h1>
                    <?php if (($image = get_sub_field('image')) !== false): ?>
                        <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                             alt="<?php echo $image['alt']; ?>" 
                             width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                             height="<?php echo $image['sizes']['one-col-square-height']; ?>"
                        ></div>
                    <?php endif; ?>
                </div>
                <?php the_sub_field('description'); ?>
                <span class="btn"><?php the_sub_field('button_text'); ?></span>
            </a>
        </section>
    <?php
    endwhile; 
    ?>
</div>