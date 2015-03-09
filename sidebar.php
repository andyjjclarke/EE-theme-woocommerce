<?php
if (!isset($GLOBALS['post']->sidebar)) {
    $sidebar = get_field('sidebar');
} else {
    $sidebar = $GLOBALS['post']->sidebar;
}

if ($sidebar):
$GLOBALS['post'] = $sidebar;
setup_postdata($GLOBALS['post']);
?>

    <div class="sidebar <?php the_field('colour'); ?>">

        <h1><?php the_field('title'); ?></h1>
        <ul>
            <?php
            while (have_rows('boxes')): 
            the_row(); 
            $link = get_sub_field('link') == 'internal' 
                  ? get_sub_field('link_internal') 
                  : get_sub_field('link_external');
            if (get_row_layout() === 'default'):
            ?>
                <li class="default">
                    <a href="<?php echo $link; ?>">
                        <div class="sidebar-body">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <?php if (($description = get_sub_field('description')) != null): ?>
                                <div class="sidebar-description"><?php echo $description; ?></div>
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
                </li>
            <?php
            elseif (get_row_layout() === 'image'):
            ?>
                <li class="image">
                    <a href="<?php echo $link; ?>">
                        <div class="sidebar-body">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <?php if (($description = get_sub_field('description')) != null): ?>
                                <div class="sidebar-description"><?php echo $description; ?></div>
                            <?php endif; ?>
                            <?php if (($ctaText = get_sub_field('cta_text')) != null): ?>
                                <div class="sidebar-cta"><?php echo $ctaText; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="image-wrap">
                            <div class="multiply">
                                <?php if (($image = get_sub_field('image')) !== false): ?>
                                    <img src="<?php echo $image['sizes']['sidebar-small']; ?>" 
                                         alt="<?php echo $image['alt']; ?>" 
                                         width="<?php echo $image['sizes']['sidebar-small-width']; ?>"
                                         height="<?php echo $image['sizes']['sidebar-small-height']; ?>"
                                    >
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </li>
            <?php
            elseif (get_row_layout() === 'twitter'):
            ?>
            	
                <li class="default">
                    <a href="http://twitter.com/<?php echo the_field('twitter_handle', 'options'); ?>">
                        <div class="sidebar-body">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <div data-twitter-feed="<?php echo the_field('twitter_handle', 'options'); ?>"></div>
                        </div>
                        <div class="icon-wrap">
                            <span class="icon icon-twitter">Twitter</span>
                        </div>
                    </a>
                </li>
            <?php
            endif;
            endwhile;
            ?>
        </ul>

    </div>

    <script>
    $(function() {
        var browserSizing = function() {
            $('.sidebar > ul > li > a').lineUpWith(null, null, 1);
            $('.multiply').multiplyReplace();
        };
        $(window).resize($.debounce(300, browserSizing));
        browserSizing();
    });
    </script>

<?php
wp_reset_postdata();
endif;
?>