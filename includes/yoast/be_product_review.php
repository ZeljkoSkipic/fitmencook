<?php
use \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece;
use \Yoast\WP\SEO\Generators\Schema\Article;
use \Yoast\WP\SEO\Config\Schema_IDs;

class BE_Product_Review extends Article {
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
		$post_types = apply_filters( 'be_product_review_schema_post_types', array( 'product', 'recipes' ) );
		if( is_singular( $post_types ) ) {
			return true;
		}

        return false;
	}

	/**
	 * Adds our Review piece of the graph.
	 *
	 * @return array $graph Review markup
	 */

	public function generate() {
		$post          = get_post( $this->context->id );
		$comment_count = get_comment_count( $this->context->id );
        $post_type = get_post_type($this->context->id);

		$data          = array(
			'@type'            => 'Review',
			'@id'              => $this->context->canonical . '#product-review',
			'isPartOf'         => array( '@id' => $this->context->canonical . Schema_IDs::ARTICLE_HASH ),
			'itemReviewed'     => array(
					'@type'    => $post_type === 'recipes' ? "Recipe" :  'Product',
					'image'    => array(
						'@id'  => $this->context->canonical . Schema_IDs::PRIMARY_IMAGE_HASH,
					),
					'name'     => wp_strip_all_tags( get_the_title() ),
					'aggregateRating' => array(
						'@type' => 'AggregateRating',
						'ratingValue'  => esc_attr( $this->get_review_meta_avg_rating() ),
						'reviewCount' => $comment_count['approved']
					)
			),
			'reviewRating'     => array(
				'@type'        => 'Rating',
				'ratingValue'  => esc_attr( $this->get_review_meta_avg_rating() ),
			),
			'name'         => wp_strip_all_tags( get_the_title() ),
			'description' => wp_strip_all_tags( get_the_excerpt( $post ) ),
			'reviewBody'  => wp_kses_post( $post->post_content ),
			'author'           => array(
				'@id'  => get_author_posts_url( get_the_author_meta( 'ID' ) ),
				'name' => get_the_author_meta( 'display_name', $post->post_author ),
			),
			'publisher'        => array( '@id' => $this->get_publisher_url() ),
			'datePublished'    => mysql2date( DATE_W3C, $post->post_date_gmt, false ),
			'dateModified'     => mysql2date( DATE_W3C, $post->post_modified_gmt, false ),
			'commentCount'     => $comment_count['approved'],
			'mainEntityOfPage' => $this->context->canonical . Schema_IDs::WEBPAGE_HASH,
		);
		$data = apply_filters( 'be_review_schema_data', $data, $this->context );

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

    /**
	 * Get Post Avg Rating
	 *
	 * @return float
	 */

    private function get_review_meta_avg_rating( ) {
		$meta = get_avarage_rating($this->context->id, "", true);
		return $meta;
	}
}