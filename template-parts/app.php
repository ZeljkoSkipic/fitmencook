<div class="fmc_app spacing_0_1">
    <div class="fmc_container">
		<div class="img_bg">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/app-image.png" alt="">
		</div>
        <div class="fmc_app_inner">
			<span class="fmc_fa_prefix"><?php the_field('app_prefix', 'option'); ?></span>
			<h2 class="fmc_title_2 title_spacing_2"><?php the_field('app_title', 'option'); ?></h2>
			<div class="fmc_fa_content"><?php the_field('app_content', 'option'); ?></div>
			<?php get_template_part('template-parts/app-badges'); ?>
		</div>
    </div>
</div>
