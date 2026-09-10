<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_seals' ) ) {
	class b_seals extends Stilpress_Block_Helper {
		public function output_seals( array $data ): array {


			if ( empty( $data['value'] ) ) {
				return [];
			}


			$output = [];

			foreach ( $data['value'] as $item ) {

				$image = $this->output_image( [
					'value'     => $item['image_1'] ?? [],
					'arguments' => [
						'behaviour' => ! empty( $item['image_1_behaviour'] ) ? $item['image_1_behaviour'] : 'contain',
					]
				] );

				$headline = $this->output_headline( [
					'value'     => $item['headline'],
					'arguments' => [
						'type'  => 'h3',
						'style' => 'h2',
					]
				] );

				$text = $this->output_text( [
					'value' => $item['text']
				] );


				$output[] = [
					'image'    => $image,
					'headline' => $headline,
					'text'     => $text,
				];
			}

			return $output;
		}

	}
}

$block    = new b_seals( $block );
$overline = $block->output( 'overline', 'overline' );
$headline = $block->output( 'headline', 'headline' );
$text     = $block->output( 'text', 'text' );
$items    = $block->output( 'items', 'seals' );

include __DIR__ . '/view.php';
