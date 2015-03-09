</div>
</div><!-- .main -->
<footer class="share">
<div class="wrap cf">
    <div class="col">
        <h1>Share this page</h1>
    </div>
    <div class="col">
        <ul class="share-links">
            <?php if ( get_field('social_media_channels', 'options') ):
	            while ( has_sub_field('social_media_channels', 'options') ): ?>
	            	<li class="icon-wrap">
	            		<?php $Url = get_sub_field('sharing_url'); $finalUrl = str_replace(array('{{URL}}', '{{TITLE}}'), array(get_permalink(), get_the_title()), $Url ); $icon = get_sub_field('icon');
		            	if ( !empty($icon) ):?>
						<a href="<?php echo $finalUrl; ?>">
		            		<img src="<?php echo $icon['url']; ?>" alt="<?php the_sub_field('channel_name'); ?>">
		            		<?php the_sub_field('channel_name'); ?>
		            	</a>
		            	<?php endif; ?>
		            </li>
		        <?php endwhile; ?>
		    <?php endif; ?>
        </ul>
    </div>
</div>
</footer>
<footer class="foot" itemscope itemtype="http://schema.org/ContactPoint">
<div class="wrap cf">
    <div class="col">
        <h1>
            <?php the_field('business_name', 'option'); ?>
        </h1>
        <div itemscope itemtype="http://schema.org/PostalAddress">
            <?php
            $i = 0;
            $num_rows = sizeof(get_field('contact_address', 'option'));
            while (have_rows('contact_address', 'option')) : the_row(); ?>
                <span itemprop="<?php the_sub_field('itemprop'); ?>"><?php the_sub_field('address_lines'); ?></span><?php
                if ($i < $num_rows - 2):
                    echo ',';
                endif;
                if ($i == $num_rows - 1):
                    echo '.';
                endif;
                ?>
            <?php
            $i++;
            endwhile;
            ?>
        </div>
    </div>
    <div class="col">
        <div itemprop="telephone">Telephone: <?php the_field('general_telephone', 'options'); ?></div>
        <div itemprop="faxNumber">Fax: <?php the_field('general_fax', 'options'); ?></div>
        <div itemprop="email"><a href="mailto:<?php the_field('general_email', 'options'); ?>"><?php the_field('general_email', 'options'); ?></a></div>
    </div>
    <div class="col">
        <div>Registered number: <?php the_field('registration_number', 'options'); ?></div>
        <div>VAT number: <?php the_field('vat_number', 'options'); ?></div>
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'footer',
            'container'       => false,
            'menu_class'      => false,
            'echo'            => true,
            'depth'           => 0
        ));
        ?>
    </div>
    <div class="col">
        <div>&copy; <?php
           $y = date('Y');
           echo $y;
//            echo ($y > '2014') ? '2014 &mdash; ' . $y : $y; // Commented out just to display current year instead of date span below
        ?> <?php the_field('business_name', 'option'); ?>.</div>
        <div>All rights reserved.</div>
    </div>
</div>
</footer>
<?php // Remove below when live ?>

<?php wp_footer(); ?>

</body>
</html>