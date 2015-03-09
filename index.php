<?php
/**
 * @package WordPress
 * @subpackage Mob SASS
 */
 
get_header(); 
the_post(); 

breadcrumb();

?>
<article class="page-default">
	<header>
	    <h1><?php the_title(); ?></h1>
	</header>
	<div class="cms-area">
		<?php the_content(''); ?>
	</div>
	<?php get_sidebar(); ?>	
</article>
<?php get_footer();?>