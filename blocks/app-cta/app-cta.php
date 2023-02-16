<?php

$ac_title = get_field('ac_title');
$ac_text = get_field('ac_text');

$class = 'fmc_apps_cta';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>

<div class="<?php echo $class; ?>">
	<div class="fmc_container">
		<div class="fmc_acta_content">
			<h2 class="fmc_title_2 fmc_acta_title"><?php echo $ac_title ?></h2>
			<div class="fmc_acta_text"><?php echo $ac_text; ?></div>
			<?php get_template_part('template-parts/app-badges'); ?>
		</div>
	</div>
</div>
