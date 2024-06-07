<?php

use \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece;
use \Yoast\WP\SEO\Generators\Schema\Article;
use \Yoast\WP\SEO\Config\Schema_IDs;

class BE_Product_Review extends Article
{
	/**
	 * A value object with context variables.
	 *
	 * @var WPSEO_Schema_Context
	 */
	public $context;

	/**
	 * Determines whether or not a piece should be added to the graph.
	 *
	 * @return bool
	 */
	public function is_needed()
	{
		$post_types = apply_filters('be_product_review_schema_post_types', array('product', 'recipes', 'meal-plans'));
		if (is_singular($post_types)) {
			return true;
		}

		return false;
	}

	/**
	 * Adds our Review piece of the graph.
	 *
	 * @return array $graph Review markup
	 */

	public function generate()
	{
		$post          = get_post($this->context->id);
		$comment_count = get_comment_count($this->context->id);
		$post_type = get_post_type($this->context->id);

		$data          = array(
			'@type'            => 'Review',
			'@id'              => $this->context->canonical . '#product-review',
			'isPartOf'         => array('@id' => $this->context->canonical . Schema_IDs::ARTICLE_HASH),
			'itemReviewed'     => array(
				'@type'    => ($post_type === 'recipes' || $post_type === 'meal-plans') ? "Recipe" :  'Product',
				'image'    => array(
					'@id'  => $this->context->canonical . Schema_IDs::PRIMARY_IMAGE_HASH,
				),
				'name'     => wp_strip_all_tags(get_the_title()),
				'aggregateRating' => array(
					'@type' => 'AggregateRating',
					'ratingValue'  => esc_attr($this->get_review_meta_avg_rating()),
					'reviewCount' => $comment_count['approved']
				),
				'author'  => [
					'@type' 	=> 'Person',
					'name'		=> get_the_author_meta('display_name', $post->post_author),
				]
			),
			'reviewRating'     => array(
				'@type'        => 'Rating',
				'ratingValue'  => esc_attr($this->get_review_meta_avg_rating()),
			),
			'author'  => [
				'@type' 	=> 'Person',
				'name'		=> get_the_author_meta('display_name', $post->post_author),
			],
			'name'         => wp_strip_all_tags(get_the_title()),
			'description' => wp_strip_all_tags(get_the_excerpt($post)),
			'reviewBody'  => wp_kses_post($post->post_content),
			'publisher'        => array('@id' => $this->get_publisher_url()),
			'datePublished'    => mysql2date(DATE_W3C, $post->post_date_gmt, false),
			'dateModified'     => mysql2date(DATE_W3C, $post->post_modified_gmt, false),
			'commentCount'     => $comment_count['approved'],
			'mainEntityOfPage' => $this->context->canonical
		);

		// Recipe Category

		$recipe_category = get_the_terms(get_the_ID(), 'recipe-category');

		if ($recipe_category && isset($recipe_category[0])) {
			$data['itemReviewed']['recipeCategory'] = $recipe_category[0]->name;
		}


		$template  = get_page_template_slug(get_the_ID());

		// Cook time and prep time

		if ($template === 'single-recipes-multiple.php' || is_singular('meal-plans')) {
			$meal_plan_calculations = meal_plan_calculations(true, get_the_ID());

			if ($meal_plan_calculations) {
				if (isset($meal_plan_calculations['total_times'])) {
					if (isset($meal_plan_calculations['total_times']['prep_times'])) {
						$pt_format_time_prep = convert_time_pt(str_replace("h", "", $meal_plan_calculations['total_times']['prep_times']['hours']), str_replace("min", "", $meal_plan_calculations['total_times']['prep_times']['min']));
					}
					if (isset($meal_plan_calculations['total_times']['cook_times'])) {
						$pt_format_time_cook = convert_time_pt(str_replace("h", "", $meal_plan_calculations['total_times']['cook_times']['hours']), str_replace("min", "", $meal_plan_calculations['total_times']['cook_times']['min']));
					}
				}
			}

			if (isset($pt_format_time_prep, $pt_format_time_cook)) {
				$data['itemReviewed']['prepTime'] = $pt_format_time_prep;
				$data['itemReviewed']['cookTime'] = $pt_format_time_cook;
			}
		} else {
			$prep_hours = get_field('prep_hours', get_the_ID());
			$prep_minutes = get_field('prep_time', get_the_ID());
			$cook_hours = get_field('cook_hours', get_the_ID());
			$cook_minutes = get_field('cook_time', get_the_ID());

			$pt_format_time_prep = convert_time_pt($prep_hours, $prep_minutes);
			$pt_format_time_cook = convert_time_pt($cook_hours, $cook_minutes);

			$data['itemReviewed']['prepTime'] = $pt_format_time_prep;
			$data['itemReviewed']['cookTime'] = $pt_format_time_cook;
		}


		if ($template === 'single-recipes-multiple.php' || is_singular('meal-plans')) {

			// Existing Recipes

			$existing_recipes = get_field('existing_recipe', get_the_ID());

			if ($existing_recipes) {
				foreach ($existing_recipes as $recipe) {
					if (isset($recipe['recipe'][0])) {
						$ingredients_groups_multiple = get_field('ing_group', $recipe['recipe'][0]->ID);
						$include_steps = $recipe['include_steps'];

						if ($include_steps) {
							$steps = get_field('steps', $recipe['recipe'][0]->ID);
							if ($steps) {
								foreach ($steps as $step) {
									$data['itemReviewed']['recipeInstructions'][] =  wp_strip_all_tags($step['step']);
								}
							}
						}


						if ($ingredients_groups_multiple) {
							foreach ($ingredients_groups_multiple as $ingredients_group) {
								if ($ingredients_group['ingredients_instacart']) {
									foreach ($ingredients_group['ingredients_instacart'] as $ingredient) {
										if ($ingredient['ingredient']) {
											$data['itemReviewed']['recipeIngredient'][] = $ingredient['ingredient'];
										}

										if ($ingredient['substitution']) {
											$data['itemReviewed']['recipeIngredient'][] = $ingredient['substitution'];
										}
									}
								}
							}
						}
					}
				}
			}

			// Custom Recipes

			$custom_recipes = get_field('custom_recipe', get_the_ID());

			if ($custom_recipes) {
				foreach ($custom_recipes as $custom_recipe) {

					$ing_groups = isset($custom_recipe['ing_group']) ?  $custom_recipe['ing_group'] : "";
					$custom_recipes_steps = isset($custom_recipe['cr_steps']) ?  $custom_recipe['cr_steps'] : "";

					if ($custom_recipes_steps) {
						foreach ($custom_recipes_steps as $custom_recipes_step) {
							$data['itemReviewed']['recipeInstructions'][] =  wp_strip_all_tags($custom_recipes_step['cr_step']);
						}
					}

					if ($ing_groups) {
						foreach ($ing_groups as $ing_group) {
							if ($ing_group['ingredients_instacart']) {
								foreach ($ing_group['ingredients_instacart'] as $ingredient) {
									if ($ingredient['ingredient']) {
										$data['itemReviewed']['recipeIngredient'][] = $ingredient['ingredient'];
									}

									if ($ingredient['substitution']) {
										$data['itemReviewed']['recipeIngredient'][] = $ingredient['substitution'];
									}
								}
							}
						}
					}
				}
			}
		} else {
			$ingredients_groups = get_field('ing_group', get_the_ID());
			$steps = get_field('steps', get_the_ID());
			if ($ingredients_groups) {
				foreach ($ingredients_groups as $ingredients_group) {
					if ($ingredients_group['ingredients_instacart']) {
						foreach ($ingredients_group['ingredients_instacart'] as $ingredient) {
							if ($ingredient['ingredient']) {
								$data['itemReviewed']['recipeIngredient'][] = $ingredient['ingredient'];
							}

							if ($ingredient['substitution']) {
								$data['itemReviewed']['recipeIngredient'][] = $ingredient['substitution'];
							}
						}
					}
				}
			}

			if ($steps) {
				foreach ($steps as $step) {
					$data['itemReviewed']['recipeInstructions'][] =  wp_strip_all_tags($step['step']);
				}
			}

			$data = apply_filters('be_ingredients_schema_data', $data, $this->context);
		}

		$data = apply_filters('be_review_schema_data', $data, $this->context);

		return $data;
	}

	/**
	 * Determine the proper publisher URL.
	 *
	 * @return string
	 */
	private function get_publisher_url()
	{
		if ($this->context->site_represents === 'person') {
			return $this->context->site_url . Schema_IDs::PERSON_HASH;
		}

		return $this->context->site_url . Schema_IDs::ORGANIZATION_HASH;
	}

	/**
	 * Get Post Avg Rating
	 *
	 * @return float
	 */

	private function get_review_meta_avg_rating()
	{
		$meta = get_avarage_rating($this->context->id, "", true);
		return $meta;
	}
}
