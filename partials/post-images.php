<?php
/**
 * $field_name, $image_size and $max_images are set from within the_post_image()
 */
if (($images = get_field($field_name)) != false):
    $i = 0;
    foreach ($images as $image): 
    ?>
        <div class="post-image">
            <img src="<?php echo $image['sizes'][$image_size]; ?>" 
                 alt="<?php echo $image['alt']; ?>" 
                 width="<?php echo $image['sizes']["{$image_size}-width"]; ?>"
                 height="<?php echo $image['sizes']["{$image_size}-width"]; ?>"
            >
        </div>
    <?php
    $i++;
    if ($max_images > -1 && $i >= $max_images) {
        break;
    }
    endforeach;
endif;