<?php
$courses = get_field('courses');
foreach ($courses as $course):
    $GLOBALS['post'] = $course;
    setup_postdata($GLOBALS['post']);
?>

    <section class="course-detail course-listing cf">

        <h1><?php the_title(); ?></h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="data">Course</th>
                    <th class="data">Date</th>
                    <th class="data">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while (have_rows('courses')): 
                the_row(); 
                ?>
                    <tr>
                        <th><?php the_sub_field('title'); ?></th>
                        <td class="data"><?php 
                        if (($duration = get_sub_field('listing_duration')) != false):
                            echo $duration;
                        else:
                            the_sub_field('duration');
                        endif;
                        ?></td>
                        <td class="data">
                        <?php 
                            if (($date = get_sub_field('listing_time')) != false):
                                echo $date;
                            elseif (($date = get_sub_field('date_picker')) != false):
                                echo date('j M', strtotime($date));
                            else:
                                echo the_sub_field('dateTime_manual');
                            endif; 
                        ?></td>
                        <td class="data"><?php 
                            $price = get_sub_field('price');
                            echo $price > 0 ? '&pound;' . number_format($price, 2) : 'Free';
                        ?></td>
                    </tr>
                <?php
                endwhile; 
                ?>
            </tbody>
        </table>

        <footer>
            <a class="btn" href="<?php the_permalink(); ?>">View / book</a>
        </footer>

    </section>

<?php
wp_reset_postdata();
endforeach;
?>

<script>
$(function() {
    var $table = $('<table class="course-dummy-header"></table>');
    $('.course-detail').first().before($table.append($('.course-detail thead').first().clone()));
});
</script>