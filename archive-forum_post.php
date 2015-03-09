<?php 
get_header(); 

$queried_term = get_queried_object();

breadcrumb();
?>
<section class="col col-main cf">

    <div class="col col-primary-content full-width is-empty">
        <h1>Community Forum</h1>
    </div>

    <div class="col col-primary-content full-width">

        <?php if (isset($queried_term->term_id)): ?>
            <h1><?php echo $queried_term->name; ?></h1>
        <?php endif; ?>

        <?php
        get_template_part('loop', 'forum_posts');
        ?>
    </div>

    <?php
    get_template_part('partials/forum', 'archive');
    ?>

</section>

<section class="col col-sidebar">
    <?php 
    $GLOBALS['post']->sidebar = get_field('forum_sidebar', 'options');
    get_sidebar();
    ?>
</section>

<?php 
get_footer();
?>