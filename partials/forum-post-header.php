<header class="post-head cf">
    <h1>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
        </a>
    </h1>
    <p>Date: <time class="published" datetime="<?php echo get_the_date('c') ?>">
        <?php echo get_the_date('d.m.y') ?>
    </time> / 
    Comments: <a href="<?php the_permalink(); ?>#comments">
        <?php comments_number('0', '1', '%'); ?>
    </a></p>
    <p>Post: <?php the_author(); ?></p>
</header>