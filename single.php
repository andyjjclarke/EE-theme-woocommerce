<?php 
/**
* @package WordPress
* @subpackage Mob SASS
*/	

get_header(); 
the_post(); 

breadcrumb();

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