<?php
/**
 * @var object $block
 * @var string $overline
 * @var string $headline
 * @var string $text
 */
?>

<section id="<?= $block->return_id(); ?>" class="<?= $block->return_classes(); ?> l-padding">

    <div class="l-width">

        <div class="l-grid">

            <?php if ( ! empty( $table ) || ! empty( $label ) ): ?>
                <div class="b__table">
                    <?php if ( ! empty( $table ) ): ?>
                        <?= $table; ?>
                    <?php endif; ?>
                    <div class="c-label">
                        <?php if ( ! empty( $label ) ): ?>
                            <span><?= $label; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>
