<?php

/**
 * @var array $block
 */

$block = new Stilpress_Block_Helper( $block );
$table = $block->output( 'table', 'text' );
$label = $block->output( 'label', 'text' );

include __DIR__ . '/view.php';
