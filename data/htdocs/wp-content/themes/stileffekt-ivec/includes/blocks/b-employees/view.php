<?php

/**
 * @var array $block
 * @var string $headline
 * @var string $overline
 * @var string $text
 * @var array $items
 */
?>

<section
        id="<?= esc_attr( $block->return_id() ); ?>"
        class="<?= esc_attr( $block->return_classes() ); ?> l-padding"
>
    <div class="l-width">

        <div class="l-grid">

            <?php if (
                    ! empty( $overline )
                    || ! empty( $headline )
                    || ! empty( $text )
            ): ?>
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

                </div>
            <?php endif; ?>

            <?php if ( ! empty( $items ) ): ?>
                <div class="b__employees">

                    <div class="c-employees">

                        <?php foreach ( $items as $item ): ?>
                            <article class="c-employee">

                                <?php if ( ! empty( $item['image_1'] ) ): ?>
                                    <div class="c-employee__media">
                                        <?= $item['image_1']; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="c-employee__content">

                                    <?php if ( ! empty( $item['name'] ) ): ?>
                                        <div class="c-employee__name">
                                            <?= $item['name']; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="c-employee__details">

                                        <?php if ( ! empty( $item['position'] ) ): ?>
                                            <div class="c-employee__position">
                                                <?= $item['position']; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (
                                                ! empty( $item['link_phone'] )
                                                || ! empty( $item['link_mail'] )
                                        ): ?>
                                            <div class="c-employee__contacts">

                                                <?php if ( ! empty( $item['link_phone'] ) ): ?>
                                                    <div class="c-employee__phone">
                                                        <?= $item['link_phone']; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $item['link_mail'] ) ): ?>
                                                    <div class="c-employee__mail">
                                                        <?= $item['link_mail']; ?>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            </article>
                        <?php endforeach; ?>

                    </div>

                </div>
            <?php endif; ?>

        </div>

    </div>
</section>