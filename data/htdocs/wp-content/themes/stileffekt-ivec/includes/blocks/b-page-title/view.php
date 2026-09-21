<?php

/**
 * @var object $block
 * @var string $overline
 * @var string $headline
 * @var string $text
 * @var string $image_1
 * @var string $video_1
 * @var string $button_1
 * @var string $button_2
 */
?>

<section
        id="<?= esc_attr( $block->return_id() ); ?>"
        class="<?= esc_attr( $block->return_classes() ); ?> l-padding l-padding-top"
>
    <div class="l-width">

        <div class="l-grid">

            <div class="b__stage">

                <?php if ( ! empty( $image_1 ) || ! empty( $video_1 ) ): ?>
                    <div class="b__media">

                        <?php if ( ! empty( $video_1 ) ): ?>
                            <?= $video_1; ?>
                        <?php else: ?>
                            <?= $image_1; ?>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <div class="b__content">

                    <?php if ( ! empty( $overline ) ): ?>
                        <?= $overline; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $headline ) ): ?>
                        <?= $headline; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $text ) ): ?>
                        <?= $text; ?>
                    <?php endif; ?>

                    <?php if (
                            ! empty( $button_1 )
                            || ! empty( $button_2 )
                    ): ?>
                        <div class="c-buttons">

                            <?php if ( ! empty( $button_1 ) ): ?>
                                <?= $button_1; ?>
                            <?php endif; ?>

                            <?php if ( ! empty( $button_2 ) ): ?>
                                <?= $button_2; ?>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>
</section>