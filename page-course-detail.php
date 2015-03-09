<?php 
 /* 
 Template Name: Course detail
 */
get_header(); 
the_post(); 

breadcrumb();
?>
<section class="col col-main cf">
	
	<?php
    $content = get_the_content();
    $content = apply_filters('the_content', $content);
    ?>

    <div class="col col-primary-content full-width <?php echo!$content ? 'is-empty' : ''; ?>">
        
        <h1 class="<?php echo!$content ? 'no-border' : ''; ?>"><?php the_title(); ?></h1>
        <?php  if (($image = get_field('side_image')) != false):
            ?>

            <div class="pull-right">
                <img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                     alt="<?php echo $image['alt']; ?>"
                     width="<?php echo $image['sizes']['one-col-square-width']; ?>"
                     height="<?php echo $image['sizes']['one-col-square-height']; ?>">
            </div>

            <div class="col-double">
                <?php
                echo $content;
                ?>
            </div>

            <?php
        else:
            echo $content;
        endif; ?>
    </div>
	<div class="col col-primary-content full-width <?php echo!$content ? 'is-empty' : ''; ?>">
        <?php 
        while (have_rows('courses')): 
        the_row(); 
        ?>
            <section class="course-detail cf <?php echo get_sub_field('highlight') ? 'is-highlight' : ''; ?>">
                
                <h1><?php the_sub_field('title'); ?></h1>
                
                <div class="course-body">

                    <?php if (($duration = get_sub_field('duration')) != false): ?>
                        <p class="course-duration"><?php echo $duration; ?></p>
                    <?php endif; ?>
                    <?php if (($led_by = get_sub_field('led_by')) != false): ?>
                        <p class="course-led-by">Led by <?php echo $led_by; ?></p>
                    <?php endif; ?>

                    <?php the_sub_field('description'); ?>

                </div>

                <div class="course-meta">

                    <?php if (($date = get_sub_field('date_picker')) != false): ?>
                        <h2>Date</h2>
                        <p><?php 
                            echo date('l jS F', strtotime($date));

                            if (($time = get_sub_field('time')) != false):
                                echo ', ' . $time;
                            endif;
                        ?></p>
                    <?php else: ?>
	                    <h2>Date</h2>
		                <p><?php the_sub_field('dateTime_manual'); ?></p>
	                <?php endif; ?>
                    <h2>Price</h2>
                    <p><?php 
                    $price = get_sub_field('price');
                    $price_qualifier = get_sub_field('price_qualifier');
                    echo $price > 0 ? '&pound;' . number_format($price, 2) : 'Free';
                    echo $price_qualifier ? ' ' . $price_qualifier : '';
                    ?></p>

                    <?php if (($audience = get_sub_field('audience')) != false): ?>
                        <h2>Audience</h2>
                        <p><?php echo $audience; ?></p>
                    <?php endif; ?>

                    <?php if (get_sub_field('allow_bookings')): ?>
                        <a class="btn popup" href="<?php the_sub_field('booking_url'); ?>" target="_blank">Book now</a>
                    <?php endif; ?>

                </div>

            </section>
        <?php
        endwhile; 
        ?>

    </div>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $('.course-detail').lineUpWith(null, null, 8);
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>