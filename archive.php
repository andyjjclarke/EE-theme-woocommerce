<?php 
/**
 * @package WordPress
 * @subpackage Mob SASS
 */
/* 2-col--right clone */
get_header(); 

breadcrumb();

?>
<article class="archive-default grid cols-1-8">
	<div class="grid-item span-6">
		<?php
	        get_template_part( 'loop', 'posts' );
	        if(function_exists('wp_paginate')) { wp_paginate(); }
	    ?>
	</div>
	<div class="grid-item span-2">
    	<?php get_sidebar('archive'); ?>
	</div>
</div>
<?php get_footer(); ?>