<?php

/**
 * @var array $block
 */

if ( ! class_exists( 'b_posts' ) ) {

	class b_posts extends Stilpress_Block_Helper {
		private int $current_page = 1;
		private int $max_num_pages = 0;
		private int $active_filter = 0;
		private array $filters = [];

		/**
		 * Aktive Kategorie zurückgeben.
		 *
		 * @return int
		 */
		public function return_active_filter(): int {
			return $this->active_filter;
		}

		/**
		 * Alle Kategorien der ungepaginerten Beitragsabfrage zurückgeben.
		 *
		 * @return array
		 */
		public function return_filters(): array {
			return $this->filters;
		}

		/**
		 * Paginierungslinks für die Beitragsabfrage zurückgeben.
		 *
		 * @return array
		 */
		public function return_pagination(): array {
			if ( $this->max_num_pages <= 1 ) {
				return [];
			}

			$placeholder = 999999999;
			$base_url    = remove_query_arg( 'posts_category', get_pagenum_link( $placeholder ) );
			$links       = paginate_links( [
				'base'      => str_replace( (string) $placeholder, '%#%', esc_url( $base_url ) ),
				'current'   => $this->current_page,
				'total'     => $this->max_num_pages,
				'end_size'  => 2,
				'mid_size'  => 1,
				'prev_text' => stilpress__return_icon( 'Arrow-Left-1-Streamline-Ultimate' )
					. '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'stilpress' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'stilpress' ) . '</span>'
					. stilpress__return_icon( 'Arrow-Right-1-Streamline-Ultimate' ),
				'add_args'  => $this->active_filter > 0
					? [ 'posts_category' => $this->active_filter ]
					: [],
				'type'      => 'array',
			] );

			return is_array( $links ) ? $links : [];
		}

		/**
		 * Beiträge für die View aufbereiten.
		 *
		 * @param array $data Daten des Taxonomie-Feldes.
		 *
		 * @return array
		 */
		protected function output_posts( $data ): array {
			$this->filters = [];

			$requested_filter = isset( $_GET['posts_category'] )
				? wp_unslash( $_GET['posts_category'] )
				: '';

			$this->active_filter = is_scalar( $requested_filter )
				? absint( $requested_filter )
				: 0;

			$this->current_page = max(
				1,
				(int) get_query_var( 'paged' ),
				(int) get_query_var( 'page' )
			);

			$args = [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'ASC',
				'posts_per_page' => max( 1, (int) get_option( 'posts_per_page', 10 ) ),
				'paged'          => $this->current_page,
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

			$filter_query_args                   = $args;
			$filter_query_args['fields']         = 'ids';
			$filter_query_args['posts_per_page'] = -1;
			$filter_query_args['paged']          = 1;
			$filter_query_args['no_found_rows']  = true;
			$filter_query                        = new WP_Query( $filter_query_args );

			if ( ! empty( $filter_query->posts ) ) {
				$filter_terms = wp_get_object_terms(
					$filter_query->posts,
					'category',
					[
						'orderby' => 'name',
						'order'   => 'ASC',
					]
				);

				if ( ! is_wp_error( $filter_terms ) ) {
					foreach ( $filter_terms as $filter_term ) {
						$this->filters[] = [
							'id'   => $filter_term->term_id,
							'name' => $filter_term->name,
						];
					}
				}
			}

			$filter_ids = array_column( $this->filters, 'id' );

			if ( ! in_array( $this->active_filter, $filter_ids, true ) ) {
				$this->active_filter = 0;
			}

			if ( $this->active_filter > 0 ) {
				if ( ! empty( $args['tax_query'] ) ) {
					$args['tax_query']['relation'] = 'AND';
				} else {
					$args['tax_query'] = [];
				}

				$args['tax_query'][] = [
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $this->active_filter,
				];
			}

			$query = new WP_Query( $args );
			$posts = [];
			$this->max_num_pages = (int) $query->max_num_pages;

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
					$categories      = get_the_category( $post_id );
					$category        = '';
					$post_categories = [];

					foreach ( $categories as $post_category ) {
						if ( ! $post_category instanceof WP_Term ) {
							continue;
						}

						$post_categories[] = [
							'id'   => $post_category->term_id,
							'name' => $post_category->name,
						];
					}

					if ( ! empty( $post_categories ) ) {
						$category = $post_categories[0]['name'];
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
						'image'      => $image,
						'permalink'  => $permalink,
						'title'      => $title,
						'date'       => $date,
						'text'       => $text,
						'link_1'     => $link_1,
						'category'   => $category,
						'categories' => $post_categories,
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

$overline       = $block->output( 'overline', 'overline' );
$headline       = $block->output( 'headline', 'headline' );
$text           = $block->output( 'text', 'text' );
$posts          = $block->output( 'items_taxonomy', 'posts' );
$button_1       = $block->output( 'button_1', 'button' );
$filters        = $block->return_filters();
$pagination     = $block->return_pagination();
$active_filter  = $block->return_active_filter();
$filter_base_url = remove_query_arg( 'posts_category', get_pagenum_link( 1 ) );

foreach ( $filters as &$filter ) {
	$filter['url'] = add_query_arg( 'posts_category', $filter['id'], $filter_base_url );
}
unset( $filter );

/*
 * View laden.
 */
include __DIR__ . '/view.php';
