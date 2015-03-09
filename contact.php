<?php
/**
 * @package WordPress
 * @subpackage Mob SASS
 */
/* 2-col--right clone */
get_header();
/* Template Name: Contact */
the_post();

breadcrumb();

$location = get_field('location', 'options');
?>

<section class="col col-main">

    <div class="col col-primary-content full-width pull-left three-col-overline border-bottom-small cf">

        <h1><?php the_title(); ?></h1>

        <div class="col">
            <div class="standard-line-spacing">
                <h2>Early Excellence Limited</h2>
                <?php
                if (have_rows('contact_address', 'options')) {
                    echo "<div>";
                    while (have_rows('contact_address', 'options')) : the_row();
                        echo "<span itemprop='" . get_sub_field('itemprop', 'options') . "'>" . get_sub_field('address_lines', 'options') . "</span>";
                    endwhile;
                    echo "</div>";
                }
                ?>
            </div>
            <div>
                <h2>Sat nav reference</h2>
                <?php
                echo "<span>" . get_field('sat_nav_address', 'options') . "</span>";
                ?>
            </div>
        </div>

        <div class="col">
            <div class="standard-line-spacing">
                <h2>General enquiries</h2>
                <?php echo "<span>Telephone " . get_field('general_telephone', 'options') . "</span>"; ?>
                <?php echo "<span>Fax " . get_field('general_fax', 'options') . "</span>"; ?>
                <?php echo "Email <a href='mailto:" . get_field('general_email', 'options') . "'>" . get_field('general_email', 'options') . "</a>"; ?>
            </div>

            <div>
                <h2>Account enquiries</h2>
                <?php echo "<span>Telephone " . get_field('accounts_phone', 'options') . "</span>"; ?>
                <?php echo "Email <a href='mailto" . get_field('accounts_email', 'options') . "'>" . get_field('accounts_email', 'options') . "</a>"; ?>
            </div>
        </div>

        <div class="col">
            <div>
                <h2>Centre open times</h2>
                <ul>
                    <?php echo '<li>' . str_replace("\n", '</li><li>', strip_tags(get_field('centre_open_times', 'options'))) . '</li>'; ?>
                </ul>
            </div>

            <div>
                <ul>
                    <h2>Centre closures</h2>
                    <?php echo '<li>' . str_replace("\n", '</li><li>', strip_tags(get_field('centre_holiday_closures', 'options'))) . '</li>'; ?>
                </ul>
            </div>
        </div>

        <?php get_template_part('partials/boxes', 'plain'); ?>
    </div>
    <?php if ($location): ?>
        <script>
            var mapLocation = [<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>];
    <?php require "js/acf.map.src.js"; ?>
        </script>
        <div id="acf-map">
        </div>

    <?php endif; ?>

</section>
<section class="col col-sidebar">
    <?php get_sidebar(); ?>
</section>

<script>
    $(function() {
        var browserSizing = function() {
            $('.col-primary-content').lineUpWith(null, null);
        };
        $(window).resize($.debounce(300, browserSizing));
        browserSizing();
    });
</script>

<?php get_footer(); ?>