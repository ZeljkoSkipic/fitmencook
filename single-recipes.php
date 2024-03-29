<?php get_header();

$video = get_field('video');
$gallery = get_field('gallery');

$times_title = get_field('times_title', 'option');

$prep_hours = get_field('prep_hours');
$prep_time = get_field('prep_time');
$cook_hours = get_field('cook_hours');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');
$total_hours = get_field('total_hours');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minutes', 'option');

$categories = get_the_terms( $post->ID, 'recipe-category' );
$author_id = $post->post_author;

?>
<div class="fmc_single_recipe fmc_container spacing_2">
	<div class="fmc_sr_main">
		<div class="fmc_recipe_hero spacing_0_3">

			<!-- Top Wrap -->
			<div class="fmc_recipe_top_wrap">
				<div class="fmc_recipe_top_left">
					<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
					} ?>
					<div class="fmc_categories">
						<?php if ( ! empty( $categories ) ) {
							echo get_the_term_list( $post->ID, 'recipe-category', '<div class="fmc_grid_cat">', '', '</div>');
						} ?>
					</div>
				</div>
				<div class="fmc_top_author">
					<?php echo get_avatar( $author_id ); ?>
					<h5 class="fmc_autor_top_name">
						<span>Author:</span>
						<?php echo wpautop( get_the_author_meta( 'display_name', $author_id ) ); ?>
					</h5>
				</div>
			</div>

			<!-- Recipe Title -->
			<h1 class="fmc_title_1 title_spacing_3">
				<?php the_title(); ?>
			</h1>

			<!-- Featured Image -->
			<?php get_template_part('template-parts/recipe/featured-image'); ?>


			<?php get_template_part('template-parts/last-updated'); ?>

			<div class="fmc_recipe_email">
				<div class="fmc_recipe_email_inner">
					<p class="fmc_form_email_title fmc_title_2 title_spacing_3"">Want to save this recipe?</p>
					<p class="fmc_form_email_text">Just type your email and I'll send it to you. And as a bonus you'll get delicious new recipes from me!</p>
				</div>
				<div class="klaviyo-form-UNLNpK"></div>
			</div>


			<!-- WP Content -->
			<?php
			$content = apply_filters( 'the_content', get_the_content() );
			if( $content ) :
			?>
			<div class="spacing_0_2 fmc_recipe_the_content fmc_ad_container">
				<?php echo $content; ?>
			</div>
			<?php endif; ?>

			<!-- Gallery -->
			<?php get_template_part('template-parts/recipe/gallery'); ?>
		</div>
		<div class="fmc_sr_recipe_content" id="fmc_recipe_content">
			<!-- Video -->
			<?php if($video): ?>
				<div class="video-wrap">
					<div class="fmc_video">
						<?php echo $video; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Ingredients and Steps -->
			<?php get_template_part('template-parts/recipe/main'); ?>
			<!-- Additional Macro Info -->
			<div class="spacing_2 fmc_additional_macro">
				<?php the_field('additional_macro_information'); ?>
			</div>
			<!-- In APP Banner -->
			<?php
			if( get_field('in_app') ) { ?>
				<div class="fmc_in_app">
					<div class="fmc_ia_left">
						<h4 class="fmc_ia_title fmc_title_4">
							<?php the_field('in_app_title', 'option'); ?>
						</h4>
						<div class="fmc_ia_text text_1">
							<?php the_field('in_app_text', 'option'); ?>
						</div>
					</div>
					<?php get_template_part('template-parts/app-badges'); ?>
				</div>
			<?php } ?>

			<!-- Comments -->
			<div class="fmc_comments spacing_3_1">
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>
			</div>
		</div>

	</div>
	<div class="fmc_sr_sidebar">
		<div class="fmc_recipe_details">
            <?php get_avarage_rating(get_the_ID(), 'sidebar'); ?>
			<!-- Recipe Times -->
			<h4 class="fmc_rs_title fmc_times_title"><?php echo $times_title; ?></h4>

			<div class="fmc_recipe_times">
				<?php if(!empty($prep_time || $prep_hours)) : ?>
					<div class="fmc_prep">
						<span class="fmc_time"><?php echo $l_prep_time ?></span>
						<?php if($prep_hours) { ?>
							<span class="fmc_amount">
								<?php echo $prep_hours ?>h
							</span>
						<?php } ?>
						</span>
						<?php if($prep_time) { ?>
						<span class="fmc_amount"><?php echo $prep_time ?><?php echo $minutes ?></span>
						<?php } ?>
					</div>
				<?php endif ?>

				<?php if(!empty($cook_time || $cook_hours)) : ?>
					<div class="fmc_cook">
						<span class="fmc_time"><?php echo $l_cook_time ?></span>
						<?php if($cook_hours) { ?>
							<span class="fmc_amount">
								<?php echo $cook_hours ?>h
							</span>
						<?php } ?>
						<?php if($cook_time) { ?>
							<span class="fmc_amount"><?php echo $cook_time ?><?php echo $minutes ?></span>
						<?php } ?>
					</div>
				<?php endif; ?>

				<?php if(!empty($total_time || $total_hours)) : ?>
					<div class="fmc_total">
						<span class="fmc_time"><?php echo $l_total_time ?></span>
						<?php if($total_hours) { ?>
							<span class="fmc_amount">
								<?php echo $total_hours ?>h
							</span>
						<?php } ?>
						<?php if($total_time) { ?>
							<span class="fmc_amount"><?php echo $total_time ?><?php echo $minutes ?></span>
						<?php } ?>
					</div>
				<?php endif; ?>
			</div>
			<!-- Macros -->
			<?php

			$noss = get_field('number_of_servings_sidebar', 'option');
			$servings_number = get_field('number_of_servings');
			$serving_size = get_field('serving_size');
			$l_serving_size = get_field('l_serving_size', 'option');

			if($servings_number) { ?>
			<div class="fmc_nos"><?php echo $noss; ?><span><?php echo $servings_number ?></span></div>
			<?php } ?>
			<?php if($serving_size) { ?>
			<div class="fmc_ss"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
			<?php } ?>
			<?php get_template_part('template-parts/recipe/macros'); ?>
			<!-- Share -->
			<div class="fmc_share fmc_recipe_share spacing_3_0">

				<div class="fmc_print"><a title="Print" href="<?php echo get_the_permalink()."?print=true"; ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zm-16-88c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z"/></svg></span></a></div>

				<div class="fmc_fb"><a title="Share to Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  get_permalink() ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span></a></div>

				<div class="fmc_pin"><a title="Pin" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>"></a><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></span></div>

				<div class="fmc_x"><a title="Tweet" href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>"><span class="fmc_icon"><svg width="20" height="20" viewBox="0 0 300 300" version="1.1" xmlns="http://www.w3.org/2000/svg">
  <path d="M178.57 127.15 290.27 0h-26.46l-97.03 110.38L89.34 0H0l117.13 166.93L0 300.25h26.46l102.4-116.59 81.8 116.59h89.34M36.01 19.54H76.66l187.13 262.13h-40.66"/>
</svg></span></a></div>

				<div class="fmc_email"><a title="Email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' ' . get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></span></a></div>

			</div>

			<!-- Jump to recipe -->
			<div class="jtr_wrap">
				<a class="fmc_jtr" href="#fmc_recipe_content"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19.5949 21.6112L18.4942 13.3557H18.5249C18.8481 13.3557 19.1101 13.0937 19.1101 12.7704V0.870088C19.1101 0.664449 19.0026 0.474666 18.8269 0.368794C18.6512 0.262823 18.4331 0.256569 18.2518 0.352298C15.9697 1.55649 14.541 3.92419 14.541 6.50531V11.5231C14.541 12.5351 15.3617 13.3556 16.3737 13.3556H16.5125L15.4118 21.6112C15.3318 22.2137 15.5154 22.8225 15.9155 23.2798C16.3164 23.7373 16.8954 24 17.5034 24C18.1113 24 18.6903 23.7373 19.0913 23.2798C19.4914 22.8226 19.6749 22.2138 19.5949 21.6112Z" fill="#FF885C"/>
<path d="M10.4242 0C9.98016 0 9.62083 0.359326 9.62083 0.803301V5.29072H8.81748V0.803301C8.81748 0.359326 8.45816 0 8.01413 0C7.57011 0 7.21083 0.359326 7.21083 0.803301V5.29072H6.40748V0.803301C6.40743 0.359326 6.04811 0 5.60413 0C5.16006 0 4.80078 0.359326 4.80078 0.803301V5.29072V6.02508V8.05384C4.80078 9.24552 5.76648 10.2112 6.95817 10.2112H7.13623L5.87009 21.6049C5.80263 22.2144 5.99793 22.824 6.40664 23.2814C6.8162 23.7388 7.40066 24 8.01418 24C8.6277 24 9.21212 23.7388 9.62172 23.2814C10.0305 22.824 10.2258 22.2144 10.1583 21.6049L8.89209 10.2113H9.0702C10.2618 10.2113 11.2276 9.24557 11.2276 8.05389V6.02513V5.29077V0.803301C11.2275 0.359326 10.8682 0 10.4242 0Z" fill="#FF885C"/>
</svg>
Jump to Recipe</a>
			</div>

		</div>

	</div>




</div>

<!-- Author -->
<?php get_template_part('template-parts/author'); ?>

<!-- Related Recipes -->
<?php get_template_part('template-parts/recipe/related-recipes'); ?>

<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>

<?php get_footer();
