<?php 
get_header(); 
the_post(); 

breadcrumb();
?>
<section class="col col-main cf" id="post-<?php the_ID(); ?>">

    <div class="col col-primary-content full-width">

        <div class="forum-post cf">
            <?php
            get_template_part('partials/forum', 'post-header');
            ?>
            
            <div class="post-images">
                <?php
                the_post_image('one-col-square');
                ?>
            </div>

            <div class="post-body">
                <?php
                the_content();
                if (comments_open()):
                ?>
                <a href="#respond" class="btn">Post a comment</a>
                <?php
                endif;
                ?>
            </div>
        </div>
        
    </div>

    <div class="col col-primary-content full-width forum-comments" id="comments">

        <h1>Community comments</h1>
        <?php
        comments_template();
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

<script>
$(function() {
    var browserSizing = function() {
        $(".plain-box p").magicEqualHeights();
        $(".plain-box h1").magicEqualHeights();
    };
    $(window).resize($.debounce(300, browserSizing));
    browserSizing();
});
</script>

<?php 
get_footer();
?><?php 
/**
* @package WordPress
* @subpackage Mob SASS
*/	

get_header(); 
the_post(); 
?>
<article class="post" id="post-<?php the_ID(); ?>">
    <header>
        <h1><?php the_title(); ?></h2>
        <time datetime="<?php echo get_the_date('Y-m-d') ?>">
        	<?php echo get_the_date('') ?>
        </time>
    </header>
    <div class="cms-area">
    	<?php the_content(); ?>
    </div>
    <aside class="cf">
        <?php if(has_tag()): ?>
            <div class="post-tags cf">
                <h2 class="h_epsilon title">Tags</h2>
                <ul class="cf"><?php the_tags('<li>', '</li><li>', '</li>'); ?></ul>
            </div>
        <?php endif; ?>
        
        <?php get_template_part('partials/block', 'social-share'); ?>
        
    </aside>
</article>
<?php get_footer(); ?>