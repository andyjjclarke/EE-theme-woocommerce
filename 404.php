<?php get_header(); ?>

<div class="left-content">
                
    <article>
        <header>
            <h1 class="page-title">404 Error Page &ndash; Not Found</h1>
            <time class="published" datetime="<?php echo get_the_date('Y-m-d') ?>" pubdate><?php echo get_the_date('') ?></time>
        </header>

        <div class="page-content cms-area">
            <p>The page you were looking for could not be found</p>
        </div>
    </article>

</div>


<?php
    //get_sidebar();
    get_footer();
?>