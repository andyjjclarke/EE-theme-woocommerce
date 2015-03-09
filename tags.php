<?php 
/**
* @package WordPress
* @subpackage Mob SASS
*/

get_header(); 
breadcrumb();

?>
<article class="archive-default">
	<?php
        get_template_part( 'loop', 'posts' );
        if(function_exists('wp_paginate')) { wp_paginate(); }
    ?>

    <?php get_sidebar('archive'); ?>
</div>
<?php get_footer(); ?>