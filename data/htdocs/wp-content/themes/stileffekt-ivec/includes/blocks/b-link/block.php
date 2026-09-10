<?php

/**
 * @var array $block
 */

$block  = new Stilpress_Block_Helper( $block );
$link_1 = $block->output( 'link_1', 'link', [
	'icon'          => 'hex',
	'icon_position' => 'left',
] );

include __DIR__ . '/view.php';
