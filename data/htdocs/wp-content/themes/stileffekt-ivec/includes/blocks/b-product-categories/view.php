<?php
/**
 * @var object $block
 * @var string $overline
 * @var string $headline
 * @var string $text
 * @var array $links
 */
?>

<section id="<?= $block->return_id(); ?>" class="<?= $block->return_classes(); ?> l-padding">

    <div class="l-width">

        <div class="l-grid">

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

            <?php if ( ! empty( $categories ) ): ?>

                <div class="b__product_categories">

                    <div class="c-product-categories">

                        <?php foreach ( $categories as $item ): ?>

                            <?php if ( ! empty( $item['url'] ) ): ?>
                                <a class="c-product-category" href="<?= $item['url'] ?>">

                                    <?php if ( ! empty( $item['image'] ) ): ?>
                                        <div class="c-product-category__image">
                                            <?= $item['image'] ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['title'] ) ): ?>
                                        <div class="c-product-category__title">
                                            <?= $item['title'] ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['text'] ) ): ?>
                                        <div class="c-product-category__text">
                                            <?= $item['text'] ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="c-product-category__arrow" aria-hidden="true">
                                        <span>Zu den Produkten</span>
                                        <svg width="22" height="15" viewBox="0 0 22 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7.06055L19 7.06055" stroke="#54EDCC" stroke-width="3"/>
                                            <path d="M12.5547 13.7705L20.0001 6.3251" stroke="#54EDCC"
                                                  stroke-width="3"/>
                                            <path d="M12.5547 1.06055L20.0001 8.50595" stroke="#54EDCC"
                                                  stroke-width="3"/>
                                        </svg>
                                    </div>

                                </a>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>

                </div>
            <?php endif; ?>

        </div>

    </div>

</section>