<?php

// Check rows existexists.
if( have_rows('gallery') ): ?>
	<div class="carousel-main">

	<?php while( have_rows('gallery') ) : the_row();

        // Load sub field value.
        $image = get_sub_field('image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		$video = get_sub_field('video');
		?>

		<div class="carousel-cell"><?php if( $image ) {
			echo wp_get_attachment_image( $image, $size );
		}
		if( $video ) {
			echo $video;
		} ?>

	</div>

   <?php endwhile; ?>
</div>
<div class="carousel-nav">

<?php while( have_rows('gallery') ) : the_row();

	// Load sub field value.
	$image = get_sub_field('image');
	$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
	$thumb = get_sub_field('thumb');
	?>

	<div class="carousel-cell"><?php if( $image ) {
		echo wp_get_attachment_image( $image, $size );
	}
	if( $thumb ) { ?>
		<img src="<?php echo $thumb; ?>">
	<?php } ?>

</div>

<?php endwhile; ?>
</div>
<?php endif; ?>





<!--
	<div class="fmc_recipe_gallery">
	<div class="fmc_gallery_item">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
		<img src="/wp-content/uploads/2022/10/iranian-lentil-stew-adasi-6.jpg" alt="">
	</div>
</div>
	-->
