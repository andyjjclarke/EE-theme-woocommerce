<div class="cf clear">
    <?php 
    while (have_rows('plain_boxes')): 
    the_row(); 
    $link = get_sub_field('link') == 'internal' 
          ? get_sub_field('link_internal') 
          : get_sub_field('link_external');
    ?>
        <section class="col plain-box <?php the_sub_field('colour'); ?>">
            <a href="<?php echo $link; ?>">
                <?php if (($image = get_sub_field('image')) !== false): ?>
                    <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-rect']; ?>" 
                         alt="<?php echo $image['alt']; ?>" 
                         width="<?php echo $image['sizes']['one-col-rect-width']; ?>"
                         height="<?php echo $image['sizes']['one-col-rect-height']; ?>"
                    ></div>
                <?php endif; ?>
                <h1><?php the_sub_field('title'); ?></h1>
                <?php the_sub_field('description'); ?>
                <?php if (get_sub_field('button_text')): ?>
                  <span class="btn">
                    <?php the_sub_field('button_text'); ?>
                  </span>
                <?php endif; ?>
            </a>
        </section>
    <?php
    endwhile; 
    ?>
</div>