<?php
$prefix = get_field('hero_prefix');
$title = get_field('hero_title');
$text = get_field('hero_text');
?>



<div class="fmc_home_hero">
	<div class="fmc_container">
		<div class="fmc_hero_text">
			<h2 class="fmc_hh_title"><?php echo $prefix ?></h2>
			<h1 class="fmc_hh_subtitle"><?php echo $title ?></h1>
			<div class="fmc_hh_text"><?php echo $text ?></div>
		</div>
		<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>

	</div>
</div>
