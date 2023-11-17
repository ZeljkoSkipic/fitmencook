<?php

use \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece;
use \Yoast\WP\SEO\Generators\Schema\Article;
use \Yoast\WP\SEO\Config\Schema_IDs;

class BE_Product_Ingredients extends Article
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
		$post_types = apply_filters('be_product_ingredients_schema_post_types', array('recipes', 'meal-plans'));
		if (is_singular($post_types)) {
			return true;
		}

		return false;
	}

	public function generate()
	{
		$post          = get_post($this->context->id);
		$post_type = get_post_type($this->context->id);

		$data          = array(
			'@type'            => 'Recipe',
			'@id'              => $this->context->canonical . '#recipe',
			'isPartOf'         => array('@id' => $this->context->canonical . Schema_IDs::ARTICLE_HASH),
			'name'         => wp_strip_all_tags(get_the_title()),
			'description' => wp_strip_all_tags(get_the_excerpt($post)),
			'author'           => array(
				'@id'  => get_author_posts_url(get_the_author_meta('ID')),
				'name' => get_the_author_meta('display_name', $post->post_author),
			),
			'publisher'        => array('@id' => $this->get_publisher_url()),
			'datePublished'    => mysql2date(DATE_W3C, $post->post_date_gmt, false),
			'dateModified'     => mysql2date(DATE_W3C, $post->post_modified_gmt, false),
			'mainEntityOfPage' => $this->context->canonical . Schema_IDs::WEBPAGE_HASH,
		);

		$template  = get_page_template_slug(get_the_ID());

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
									$data['recipeInstructions'][] =  wp_strip_all_tags($step['step']);
								}
							}
						}


						if ($ingredients_groups_multiple) {
							foreach ($ingredients_groups_multiple as $ingredients_group) {
								if ($ingredients_group['ingredients_instacart']) {
									foreach ($ingredients_group['ingredients_instacart'] as $ingredient) {
										if ($ingredient['ingredient']) {
											$data['recipeIngredient'][] = $ingredient['ingredient'];
										}

										if ($ingredient['substitution']) {
											$data['recipeIngredient'][] = $ingredient['substitution'];
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

					if($custom_recipes_steps) {
						foreach ($custom_recipes_steps as $custom_recipes_step) {
							$data['recipeInstructions'][] =  wp_strip_all_tags($custom_recipes_step['cr_step']);
						}
					}

					if ($ing_groups) {
						foreach ($ing_groups as $ing_group) {
							if ($ing_group['ingredients_instacart']) {
								foreach ($ing_group['ingredients_instacart'] as $ingredient) {
									if ($ingredient['ingredient']) {
										$data['recipeIngredient'][] = $ingredient['ingredient'];
									}

									if ($ingredient['substitution']) {
										$data['recipeIngredient'][] = $ingredient['substitution'];
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
								$data['recipeIngredient'][] = $ingredient['ingredient'];
							}

							if ($ingredient['substitution']) {
								$data['recipeIngredient'][] = $ingredient['substitution'];
							}
						}
					}
				}
			}

			if ($steps) {
				foreach ($steps as $step) {
					$data['recipeInstructions'][] =  wp_strip_all_tags($step['step']);
				}
			}

			$data = apply_filters('be_ingredients_schema_data', $data, $this->context);
		}


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
}
