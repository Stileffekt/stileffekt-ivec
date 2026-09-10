<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_hero' ) ) {
	class b_hero extends Stilpress_Block_Helper {
		protected function output_meta(): string {
			if ( get_post_type() !== 'post' ) {
				return '';
			}

			return get_the_date( 'd.m.Y', get_the_ID() );
		}
	}
}

$block = new b_hero( $block );

$overline = $block->output( 'overline', 'overline' );
$headline = $block->output( 'headline', 'headline' );
$text     = $block->output( 'text', 'text' );
$image_1  = $block->output( 'image_1', 'image_responsive', [
	'overlay'   => false,
	'behaviour' => 'cover',
] );

$video_1  = $block->output( 'video_1', 'video_selfhosted', [
	'overlay' => true,
] );
$button_1 = $block->output( 'button_1', 'button', [
	'icon' => 'Arrow-Right-Streamline-Ultimate',
] );
$button_2 = $block->output( 'button_2', 'button', [
	'icon' => 'Arrow-Right-Streamline-Ultimate',
] );


include __DIR__ . '/view.php';
