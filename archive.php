<?php

get_header();

$selected_category = get_queried_object();
$current_category = $selected_category->term_id;

?>

<div class="fmc_archive_categories spacing_1">
<div class="fmc_archive_categories_inner carousel-category">
<?php $categories = get_categories(); ?>
	<?php foreach($categories as $category) {
	$icon = get_field('category_icon', $category);
	$current = '';
    if( $category->term_id == $current_category ){
        $current = "current_cat is-initial-select";
    }

	?>
	<div class="carousel-cell">
		<figure class="fmc_archive_cat <?php echo $current; ?>">
		<?php echo '<a href="' . get_category_link($category->term_id) . '">'; ?>
			<img src="<?php echo $icon; ?>">
			<figcaption>
				<?php echo $category->name; ?>
			</figcaption>
		</a>
		</figure>
	</div>
	<?php } ?>
</div>
</div>

<div class="fmc_archive_wrap">
<div class="fmc_archive_inner fmc_container">

<?php while ( have_posts() ) : the_post();


?>

	<div class="fmc_post">
		<figure class="featured_img">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('medium'); ?>
		</a>
		</figure>
		<span class="cat">
			<?php if ( ! empty( $categories ) ) {
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			} ?>
		</span>
		<div class="fmc_post_content">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<figure class="author_img">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
			</figure>
			<span class="author_name">by <?php echo get_the_author_meta('display_name', $author_id); ?></span>
			<span class="post_date"><?php the_date(); ?></span>
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
