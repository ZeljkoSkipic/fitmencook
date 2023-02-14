<?php

// Check rows existexists.
if( have_rows('logos') ): ?>
<div class="fmc_logos_track spacing_1">
	<div class="fmc_container">
	<h2 class="fmc_fi_title spacing_0_3"><?php the_field('fi_title'); ?></h2>
   	<?php  // Loop through rows. ?>
	<div class="fmc_lt_inner carousel-logos">
   	 <?php while( have_rows('logos') ) : the_row();

        // Load sub field value.
        $logo = get_sub_field('logo');
		$size = 'full';
		?>

				<figure class="carousel-cell">
					<?php if( $logo ) {
						echo wp_get_attachment_image( $logo, $size );
					} ?>
				</figure>

    	<?php endwhile; ?>
		</div>
	</div>
</div>
<?php endif;
