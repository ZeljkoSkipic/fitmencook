<?php

get_header();

$selected_category = get_queried_object();
$current_category = $selected_category->term_id;

?>

<div class="fmc_archive_categories spacing_1">
<div class="fmc_archive_categories_inner">
<?php $categories = get_categories();

	foreach($categories as $category) {
	$icon = get_field('category_icon', $category);
	$current = '';
    if( $category->term_id == $current_category ){
        $current = "current_cat";
    }

	?>
	<figure class="fmc_archive_cat <?php echo $current; ?>">
	<?php echo '<a href="' . get_category_link($category->term_id) . '">'; ?>
		<img src="<?php echo $icon; ?>">
		<figcaption>
			<?php echo $category->name; ?>
		</figcaption>
	</a>
	</figure>
	<?php } ?>
</div>
</div>

<div class="fmc_archive_wrap">
<div class="fmc_archive_inner fmc_container">

<?php while ( have_posts() ) : the_post();


?>

	<div class="fmc_recipe">
		<figure class="featured_img">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('medium'); ?>
		</a>
		</figure>
		<div class="fmc_recipe_content">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<span class="calories"><?php the_field('calories'); ?> Calories</span>
			<div class="details_1">
				<div class="carbs">Carbs<span><?php the_field('carbs'); ?></span></div>
				<div class="fat">Fat<span><?php the_field('fat'); ?></span></div>
				<div class="protein">Protein<span><?php the_field('protein'); ?></span></div>
			</div>
			<div class="details_2">
				<div class="time">Prep Time<span><?php the_field('prep_time'); ?></span></div>
				<div class="portion">Total Time<span><?php the_field('total_time'); ?></span></div>
			</div>
		</div>
	</div>

<?php endwhile;
?>

</div>
<div class="fmc_container spacing_0_1">
	<?php fmc_pagination(); ?>
</div>
</div>

<?php get_footer();
