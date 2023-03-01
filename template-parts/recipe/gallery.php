<?php

$images = get_field('gallery');
// Check rows existexists.
if( $images ): ?>
	<div class="carousel-main">
	<?php foreach( $images as $image ):

        // Load sub field value.
		?>

		<div class="carousel-cell">
		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
		</div>

   	<?php endforeach; ?>
	</div>
<div class="carousel-nav">

<?php foreach( $images as $image ):

// Load sub field value.
?>

<div class="carousel-cell">
<img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
</div>

<?php endforeach; ?>
</div>
<?php

else :

	the_post_thumbnail();

endif; ?>
