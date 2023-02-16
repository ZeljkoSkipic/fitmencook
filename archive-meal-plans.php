<?php

get_header();
$arch_title = get_field('mp_arch_title', 'option');
$arch_intro = get_field('mp_arch_intro', 'option');

?>
<div class="fmc_mp_archive_wrap fmc_container spacing_2">
	<div class="fmc_mp_archive_top">
		<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
		} ?>
			<h1 class="fmc_title_1 title_spacing_3"><?php echo $arch_title; ?></h1>
			<div class="fmc_arch_intro"><?php echo $arch_intro; ?></div>
			<div class="fmc_mp_grid fmc_archive_main">
			<div class="fmc_archive_inner">

			<?php while ( have_posts() ) : the_post();	?>

				<div class="fmc_plan">
					<div class="fmc_plan_images">
						<div class="left">
							<figure>
								<img src="/wp-content/uploads/2022/10/chicken-rice-soup-16.jpg">
							</figure>
						</div>
						<div class="right">
							<figure>
								<img src="/wp-content/uploads/2022/10/LemonChicken-4-1-scaled.jpg">
							</figure>
							<figure>
								<img src="/wp-content/uploads/2022/10/nighttime-smoothie-1.jpg">
							</figure>
						</div>
					</div>
					<a href="<?php the_permalink(); ?>"><h3 class="fmc_plan_title fmc_title_4"><?php the_title(); ?></h3></a>
					<div class="fmc_plan_bottom">
						<span>Number of Meals</span>
						4 Meals
					</div>
				</div>

			<?php endwhile;
			?>

			</div>
			<div class="spacing_3_1">
				<?php fmc_pagination(); ?>
			</div>
		</div>
	</div>

	<div class="fmc_mp_archive_main">
		<div class="fmc_mp_archive_anchors">
			<?php
			// Check rows existexists.
			if( have_rows('mp_arch_content', 'option') ):

				// Loop through rows.
				while( have_rows('mp_arch_content', 'option') ) : the_row();


					// Load sub field value.
					$mp_sec_anchor = get_sub_field('anchor_label');
					// Do something...
					if($mp_sec_anchor) : ?>
					<a href="#<?php echo str_replace(' ', '', $mp_sec_anchor); ?>">
						<?php echo $mp_sec_anchor; ?>
					</a>
				<?php endif;

				// End loop.
				endwhile;

			endif; ?>
		</div>
		<div class="fmc_mp_arch_main_inner spacing_2">
			<div class="fmc_mp_archive_left">
			<?php

				// Check rows existexists.
				if( have_rows('mp_arch_content', 'option') ):

					// Loop through rows.
					while( have_rows('mp_arch_content', 'option') ) : the_row();


						// Load sub field value.
						$mp_sec_anchor = get_sub_field('anchor_label');
						$mp_arch_sec_title = get_sub_field('mp_arch_sec_title');
						$mp_arch_sec = get_sub_field('mp_arch_sec');

						// Do something... ?>
						<div class="fmc_mp_arch_sec" id="<?php echo str_replace(' ', '', $mp_sec_anchor); ?>">
							<?php if($mp_arch_sec_title): ?>
							<h2 class="fmc_title_3 spacing_0_3"><?php echo $mp_arch_sec_title; ?></h2>
							<?php endif; ?>
							<div><?php echo $mp_arch_sec; ?></div>
						</div>
					<?php // End loop.
					endwhile;

				endif; ?>
			</div>
			<div class="fmc_archive_sidebar">

				<?php dynamic_sidebar( 'ad5' ); ?>

			</div>
		</div>
	</div>

</div>
<?php get_footer();
