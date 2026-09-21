<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_posts' ) ) {

	class b_posts extends Stilpress_Block_Helper {

		/**
		 * Beiträge für die View aufbereiten.
		 *
		 * @param array $data Daten des Taxonomie-Feldes.
		 *
		 * @return array
		 */
		protected function output_posts( $data ): array {

			$items_count = $this->return_raw_data_value( 'items_count' );

			$count = (
				! empty( $items_count )
				&& is_numeric( $items_count )
			) ? (int) $items_count : - 1;

			$args = [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'ASC',
				'posts_per_page' => $count,
			];

			/*
			 * Query auf die im Block ausgewählten Kategorien begrenzen.
			 */
			if ( ! empty( $data['value'] ) ) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $data['value'],
					],
				];
			}

			$query = new WP_Query( $args );
			$posts = [];

			if ( $query->have_posts() ) {

				while ( $query->have_posts() ) {
					$query->the_post();

					$post_id   = get_the_ID();
					$post_data = get_field( 'ptype_post_data', $post_id );

					/*
					 * Beitragsbild aufbereiten.
					 */
					$image = ! empty( $post_data['image'] )
						? $this->output_image( [
							'value'     => $post_data['image'],
							'arguments' => [
								'behaviour' => 'cover',
							],
						] )
						: '';

					/*
					 * Beitragsdaten.
					 */
					$permalink = get_permalink( $post_id );
					$date      = get_the_date( '', $post_id );

					/*
					 * Erste dem Beitrag zugewiesene Kategorie verwenden.
					 *
					 * WordPress besitzt standardmäßig keine Kennzeichnung
					 * für eine primäre Kategorie.
					 */
					$categories = get_the_category( $post_id );
					$category   = '';

					if (
						! empty( $categories )
						&& $categories[0] instanceof WP_Term
					) {
						$category = $categories[0]->name;
					}

					/*
					 * Überschrift aufbereiten.
					 */
					$title = $this->output_headline( [
						'value'     => get_the_title( $post_id ),
						'arguments' => [
							'type'  => 'h3',
							'style' => 'h3',
						],
					] );

					/*
					 * Optionalen Beschreibungstext aufbereiten.
					 */
					$text = ! empty( $post_data['text'] )
						? $this->output_text( [
							'value' => $post_data['text'],
						] )
						: '';

					/*
					 * Link aufbereiten.
					 *
					 * Hinweis: Falls die gesamte Karte in der View bereits
					 * ein <a>-Element ist, darf dieser Link dort nicht als
					 * zusätzlicher verschachtelter Link ausgegeben werden.
					 */
					$link_1 = $this->output_link( [
						'value'     => [
							'url'   => $permalink,
							'title' => __( 'Read More', 'stilpress' ),
						],
						'arguments' => [
							'icon'          => 'Arrow-Right--Streamline-Ultimate',
							'icon_position' => 'right',
						],
					] );

					/*
					 * Daten für view.php bereitstellen.
					 */
					$posts[] = [
						'image'     => $image,
						'permalink' => $permalink,
						'title'     => $title,
						'date'      => $date,
						'text'      => $text,
						'link_1'    => $link_1,
						'category'  => $category,
					];
				}
			}

			/*
			 * Globale WordPress-Postdaten nach der eigenen Query
			 * wiederherstellen.
			 */
			wp_reset_postdata();

			return $posts;
		}
	}
}

/*
 * Block initialisieren und allgemeine Blockfelder aufbereiten.
 */
$block = new b_posts( $block );

$overline = $block->output( 'overline', 'overline' );
$headline = $block->output( 'headline', 'headline' );
$text     = $block->output( 'text', 'text' );
$posts    = $block->output( 'items_taxonomy', 'posts' );
$button_1 = $block->output( 'button_1', 'button' );

/*
 * View laden.
 */
include __DIR__ . '/view.php';