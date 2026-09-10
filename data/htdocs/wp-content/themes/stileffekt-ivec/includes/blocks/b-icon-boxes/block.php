<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_icon_boxes' ) ) {
	class b_icon_boxes extends Stilpress_Block_Helper {
		public function output_boxes( array $data ): array {

			if ( empty( $data['value'] ) ) {
				return [];
			}

			$output = [];

			foreach ( $data['value'] as $item ) {

				$icon = ! empty( $item['icon'] ) ? stilpress__return_icon( $item['icon'] ) : '';

				$title = ! empty( $item['title'] ) ? $this->output_headline( [
					'value'     => $item['title'],
					'arguments' => [
						'type'  => 'h3',
						'style' => 'h3',
					],
				] ) : '';

				$text = $this->output_text( [
					'value' => $item['text'],
				] );

				$link = $this->output_link( [
					'value'     => $item['link_1'],
					'arguments' => [
						'icon'          => 'Arrow-Right--Streamline-Ultimate',
						'icon_position' => 'right',
					]
				] );

				$output[] = [
					'icon'  => $icon,
					'title' => $title,
					'text'  => $text,
					'link'  => $link,
				];

			}

			return $output;
		}

	}
}

$block    = new b_icon_boxes( $block );
$overline = $block->output( 'overline', 'overline' );
$headline = $block->output( 'headline', 'headline' );
$text     = $block->output( 'text', 'text' );
$boxes    = $block->output( 'items', 'boxes' );

include __DIR__ . '/view.php';
