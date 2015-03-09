<?php /* Template Name: Go Shopping */
get_header();
the_post();


?>
<section class="col col-main" style="width:100%; margin-left:4px; margin-right:0;">
<?php breadcrumb();?>
<h1>Shop Online</h1>


<?php

$args = array(
    'number'     => 1000,
    'orderby'    => 'parent',
    'order'      => 'asc',
    'hide_empty' => false
);

$parents = array();

$product_categories = get_terms( 'product_cat', $args );

foreach($product_categories as $product_category):
	if($product_category->parent == 29 || $product_category->parent == 39 || $product_category->parent == 24 || $product_category->parent == 34):
	$thumbnail_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	$data = array(
	"name" => $product_category->name,
	"slug" => $product_category->slug,
	"desription" => $product_category->description,
	"count" => $product_category->count,
	"image" => $image,
	"parent" => $product_category->parent
	
	);

	$parents[$product_category->parent][$product_category->term_id] = $data;
endif;
endforeach;

ksort($parents);

?>

<div class='product-cats'>

<article class='main-image'>

	<img src='<?php the_field('banner_image');?>' />

</article>

<?php foreach($parents as $parent):?>


	<?php foreach($parent as $category): ?>
    
    	<article class='product-cat category-<?php echo $category['parent'];?>'>
        <a class='cover_link' href='<?php bloginfo('home');?>/product-category/<?php echo $category['slug'];?>'></a>
        
        	<header><?php echo $category['name'];?> <a class='more' href='<?php bloginfo('home');?>/product-category/<?php echo $category['slug'];?>'>View More</a></header>
            <a href='<?php bloginfo('home');?>/product-category/<?php echo $category['slug'];?>'><img src='<?php echo $category['image'];?>' /></a>
        
        <span class='bottom'></span>
        </article>
    
    <?php endforeach; // category ?>


<?php endforeach; // parents?>

<div class='c'></div>

</div><!-- END PRODUCT CATS -->

</section>



<script>
    $(function () {
        var browserSizing = function () {
            $('.col-primary-content').lineUpWith(null, null, 8);
            $('.sidebar > ul > li > a').lineUpWith($('.col-primary-content'), -5, 1);
            $(".plain-box > a").lineUpWith(null, null, 8).magicEqualHeights(true);
            $('.col-primary-content > h1').lineUpWith(null, null, 7);
            <?php if ($iframe): ?>
                $('.iframe-container').lineUpWith(null, null, 7);
            <?php endif; ?>
        };
        $(window).resize($.debounce(300, browserSizing));
        $(browserSizing);
    });
</script>

<?php
get_footer();
?>