<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_page_links' ) ) {
	class b_page_links extends Stilpress_Block_Helper {

		public function output_links( array $data ): array {

			if ( empty( $data['value'] ) ) {
				return [];
			}

			$output = [];

			foreach ( $data['value'] as $link ) {

				$text   = $link['text'];
				$url    = ! empty( $link['link']['url'] ) ? ' href="' . $link['link']['url'] . '"' : '';
				$target = ! empty( $link['link']['target'] ) ? ' target="' . $link['link']['target'] . '"' : '';
				$title  = ! empty( $link['link']['title'] ) ? '<span>' . $link['link']['title'] . '</span>' : '';

				$output[] = [
					'text'   => $text,
					'url'    => $url,
					'target' => $target,
					'title'  => $title,
				];

			}
			echo "<pre>";
			print_r( $output );
			echo "</pre>";

			return $output;

		}

	}
}

$block    = new b_page_links( $block );
$overline = $block->output( 'overline', 'overline' );
$headline = $block->output( 'headline', 'headline' );
$text     = $block->output( 'text', 'text' );
$button_1 = $block->output( 'button_1', 'button' );
$button_2 = $block->output( 'button_2', 'button' );
$links    = $block->output( 'items', 'links' );

include __DIR__ . '/view.php';
