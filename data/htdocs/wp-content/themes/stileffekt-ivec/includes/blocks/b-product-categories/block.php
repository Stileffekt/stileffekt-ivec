<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_product_categories' ) ) {
	class b_product_categories extends Stilpress_Block_Helper {

		public function output_categories( array $data ): array {

			if ( empty( $data['value'] ) ) {
				return [];
			}

			$output = [];

			foreach ( $data['value'] as $post ) {

				$url = get_the_permalink( $post );

				$title = $this->output_headline( [
					'value'     => get_the_title( $post ),
					'arguments' => [
						'style' => 'h3',
						'type'  => 'h3'
					]
				] );

				$data = get_field( 'ptype_page_product-category', $post );

				$text = ! empty( $data['description'] ) ? $data['description'] : '';

				$image = ! empty( $data['image'] ) ? $this->output_image( [
					'value' => $data['image'],
				] ) : '';

				$output[] = [
					'url'   => $url,
					'title' => $title,
					'text'  => $text,
					'image' => $image,
				];

			}

			return $output;
		}

	}
}

$block      = new b_product_categories( $block );
$overline   = $block->output( 'overline', 'overline' );
$headline   = $block->output( 'headline', 'headline' );
$text       = $block->output( 'text', 'text' );
$categories = $block->output( 'pages', 'categories' );

include __DIR__ . '/view.php';
