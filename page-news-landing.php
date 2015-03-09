<?php 
 /* 
 Template Name: News landing page
 */
get_header(); 
the_post(); 

breadcrumb();

$columns = array();
foreach (get_field('boxes') as $box):
    $columns[$box['column']][] = $box;
endforeach;
?>
<section class="col col-main">

    <div class="col col-primary-content full-width is-empty">
        <h1><?php the_title(); ?></h1>
    </div>

    <?php
    foreach ($columns as $column):
    ?>
    <div class="col">

        <?php
        foreach ($column as $box):
        ?>

            <section class="highlight-box news-box <?php echo $box['colour']; ?>">
            <div>
                <div class="multiply">
                    <h1><?php echo $box['title']; ?></h1>
                    <?php if (($image = $box['image']) !== false): ?>
                        <div class="img-wrap"><img src="<?php echo $image['sizes']['one-col-square']; ?>" 
                             alt="<?php echo $image['alt']; ?>" 
                             width="<?php echo $image['sizes']["one-col-square-width"]; ?>"
                             height="<?php echo $image['sizes']["one-col-square-height"]; ?>"
                        ></div>
                    <?php endif; ?>
                </div>

                <ul>
                    <?php
                    foreach ($box['items'] as $item):
                        if ('single_link' === $item['acf_fc_layout']):
                        ?>
                            <li><a href="<?php echo $item['link_internal']; ?>">
                                <h2><?php echo $item['title']; ?></h2>
                                <?php echo $item['description']; ?>
                            </a></li>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </ul>

            </div>
            </section>

        <?php
        endforeach;
        ?>

    </div>
    <?php
    endforeach;
    ?>

</section>

<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
$(function() {
    var browserSizing = function() {
        $('.multiply').multiplyReplace();
        $('.news-box li > a').lineUpWith();
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?>