<?php
/**
 * @var object $block
 * @var string $headline
 * @var string $text
 * @var string $link_1
 * @var string $link_2
 */
?>

<section id="<?= $block->return_id(); ?>" class="<?= $block->return_classes(); ?> l-padding">

    <div class="l-width">

        <div class="l-grid">

            <div class="b__content">

                <?php if ( ! empty( $link_1 ) ): ?>
                    <div class="c-links">
                        <?= $link_1 ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>

</section>
