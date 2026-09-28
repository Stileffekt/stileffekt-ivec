<?php
/**
 * @var array $block
 * @var string $headline
 * @var array $posts
 * @var array $filters
 * @var array $pagination
 * @var int $active_filter
 * @var string $filter_base_url
 */
?>

<div id="<?= $block->return_id(); ?>"
     class="<?= $block->return_classes(); ?> l-padding">

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

            <?php if ( ! empty( $posts ) ): ?>
                <div class="b__posts">

                    <?php if ( ! empty( $filters ) ): ?>
                        <div class="b__filters">
                            <div class="c-buttons" role="group" aria-label="<?= esc_attr__( 'Filter posts by category', 'stilpress' ); ?>">
                                <a class="c-button<?= 0 === $active_filter ? ' is-active' : ''; ?>"
                                   href="<?= esc_url( $filter_base_url ); ?>"
                                    <?= 0 === $active_filter ? 'aria-current="true"' : ''; ?>>
                                    <?= esc_html__( 'All', 'stilpress' ); ?>
                                </a>

                                <?php foreach ( $filters as $filter ): ?>
                                    <a class="c-button<?= $active_filter === $filter['id'] ? ' is-active' : ''; ?>"
                                       href="<?= esc_url( $filter['url'] ); ?>"
                                        <?= $active_filter === $filter['id'] ? 'aria-current="true"' : ''; ?>>
                                        <?= esc_html( $filter['name'] ); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="c-posts">

                        <?php foreach ( $posts as $item ): ?>
                            <a
                                    class="c-post"
                                    href="<?= esc_url( $item['permalink'] ); ?>"
                                    aria-label="<?= esc_attr( wp_strip_all_tags( $item['title'] ) ); ?>"
                            >

                                <?php if ( ! empty( $item['image'] ) ): ?>
                                    <div class="c-post__header">
                                        <?= $item['image']; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="c-post__body">

                                    <?php if ( ! empty( $item['category'] ) ): ?>
                                        <span class="c-post__label">
        <?= esc_html( $item['category'] ); ?>
    </span>
                                    <?php endif; ?>

                                    <div class="c-post__content">
                                        <?php if ( ! empty( $item['title'] ) ): ?>
                                            <?= $item['title']; ?>
                                        <?php endif; ?>

                                        <span class="c-post__link">
                    <span>Mehr erfahren</span>

                    <?= stilpress__return_icon(
                            'Arrow-Up-Right--Streamline-Ultimate'
                    ); ?>
                </span>
                                    </div>

                                </div>

                            </a>
                        <?php endforeach; ?>

                    </div>

                    <?php if ( ! empty( $pagination ) ): ?>
                        <nav class="c-posts-pagination" aria-label="<?= esc_attr__( 'Posts pagination', 'stilpress' ); ?>">
                            <?php foreach ( $pagination as $page_link ): ?>
                                <?= $page_link ?>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if ( ! empty( $button_1 ) ): ?>
                <div class="b__links">
                    <div class="c-buttons">
                        <?= $button_1 ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>
