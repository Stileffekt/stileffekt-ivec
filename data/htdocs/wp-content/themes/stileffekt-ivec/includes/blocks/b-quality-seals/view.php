<?php
/**
 * @var object $block
 * @var string $overline
 * @var string $headline
 * @var string $text
 * @var array $items
 */
?>

<div id="<?= $block->return_id(); ?>" class="<?= $block->return_classes(); ?> l-padding">

    <div class="l-width">

        <div class="l-grid">

            <?php if ( ! empty( $overline ) || ! empty( $headline ) || ! empty( $text ) ): ?>
                <div class="b__content">

                    <?php if ( ! empty( $overline ) ): ?>
                        <?= $overline ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $headline ) ): ?>
                        <?= $headline ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $text ) ): ?>
                        <?= $text ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if ( ! empty( $items ) ): ?>

                <div class="b__seals">

                    <div class="c-seals">
                        <div class="l-grid">

                            <?php foreach ( $items as $item ): ?>

                                <div class="c-seals__item">

                                    <?php if ( ! empty( $item['image'] ) ): ?>
                                        <?= $item['image'] ?>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['headline'] ) ): ?>
                                        <?= $item['headline'] ?>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['text'] ) ): ?>
                                        <?= $item['text'] ?>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>