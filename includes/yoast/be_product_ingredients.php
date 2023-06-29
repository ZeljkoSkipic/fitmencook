<?php

use \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece;
use \Yoast\WP\SEO\Generators\Schema\Article;
use \Yoast\WP\SEO\Config\Schema_IDs;

class BE_Product_Ingredients extends Article {
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
	public function is_needed() {
		$post_types = apply_filters( 'be_product_ingredients_schema_post_types', array('recipes') );
		if( is_singular( $post_types ) ) {
			return true;
		}

        return false;
	}

	public function generate() {
		$post          = get_post( $this->context->id );
        $post_type = get_post_type($this->context->id);

		$data          = array(
			'@type'            => 'Recipe',
			'@id'              => $this->context->canonical . '#recipe',
			'isPartOf'         => array( '@id' => $this->context->canonical . Schema_IDs::ARTICLE_HASH ),
			'name'         => wp_strip_all_tags( get_the_title() ),
			'description' => wp_strip_all_tags( get_the_excerpt( $post ) ),
			'author'           => array(
				'@id'  => get_author_posts_url( get_the_author_meta( 'ID' ) ),
				'name' => get_the_author_meta( 'display_name', $post->post_author ),
			),
			'publisher'        => array( '@id' => $this->get_publisher_url() ),
			'datePublished'    => mysql2date( DATE_W3C, $post->post_date_gmt, false ),
			'dateModified'     => mysql2date( DATE_W3C, $post->post_modified_gmt, false ),
			'mainEntityOfPage' => $this->context->canonical . Schema_IDs::WEBPAGE_HASH,
		);

        $ingredients = get_field('ingredients_instacart', get_the_ID());
        $steps = get_field('steps', get_the_ID());

        if($ingredients) {
            foreach($ingredients as $ingredient) {
                $data['recipeIngredient'][] = $ingredient['ingredient'];
            }
        }

        if($steps) {
            foreach($steps as $step) {
                $data['recipeInstructions'][] =  wp_strip_all_tags( $step['step']);
            }
        }

		$data = apply_filters( 'be_ingredients_schema_data', $data, $this->context );

		return $data;
	}

	/**
	 * Determine the proper publisher URL.
	 *
	 * @return string
	 */
	private function get_publisher_url() {
		if ( $this->context->site_represents === 'person' ) {
			return $this->context->site_url . Schema_IDs::PERSON_HASH;
		}

		return $this->context->site_url . Schema_IDs::ORGANIZATION_HASH;
	}

}
