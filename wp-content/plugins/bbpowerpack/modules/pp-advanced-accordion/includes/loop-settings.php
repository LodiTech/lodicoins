
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<h3 class="fl-builder-settings-title">Content</h3>
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">

		<table class="fl-form-table fl-post-type-filter">
			<?php
				$post_types    = array();
				$taxonomy_type = array();

			foreach ( FLBuilderLoop::post_types() as $slug => $type ) {

				$taxonomies = FLBuilderLoop::taxonomies( $slug );

				$post_types[ $slug ] = $type->label;
				if ( ! empty( $taxonomies ) ) {

					foreach ( $taxonomies as $tax_slug => $tax ) {
						$taxonomy_type[ $slug ][ $tax_slug ] = $tax->label;
					}
				}
			}

			FLBuilder::render_settings_field(
				'post_slug',
				array(
					'type'    => 'select',
					'label'   => __( 'Post Type', 'bb-powerpack' ),
					'options' => $post_types,
					'default' => isset( $settings->post_slug ) ? $settings->post_slug : 'post',
				)
			);
			?>
		</table>

		<?php
		foreach ( $post_types as $slug => $label ) :
			if ( ! isset( $taxonomy_type[ $slug ] ) ) {
				continue;
			}
			$selected = isset( $settings->{'posts_' . $slug . '_type'} ) ? $settings->{'posts_' . $slug . '_type'} : 'post';
			?>
			<table class="fl-form-table fl-custom-query-filter fl-custom-query-<?php echo $slug; ?>-filter"<?php echo ( $slug === $selected ) ? ' style="display:table;"' : ''; ?>>
				<?php

				FLBuilder::render_settings_field(
					'posts_' . $slug . '_tax_type',
					array(
						'type'    => 'select',
						'label'   => __( 'Taxonomy', 'bb-powerpack' ),
						'options' => $taxonomy_type[ $slug ],
					)
				);
				foreach ( $taxonomy_type[ $slug ] as $tax_slug => $tax_label ) {

					FLBuilder::render_settings_field(
						'tax_' . $slug . '_' . $tax_slug,
						array(
							'type'     => 'suggest',
							'action'   => 'fl_as_terms',
							'data'     => $tax_slug,
							'label'    => $tax_label,
							/* translators: %s: tax label */
							'help'     => sprintf( __( 'Enter a list of %1$s.', 'bb-powerpack' ), $tax_label ),
							'matching' => true,
						),
						$settings
					);
				}

				?>
			</table>
		<?php endforeach; ?>
		<table class="fl-form-table fl-post-type-other-setting">
			<?php
			FLBuilder::render_settings_field(
				'post_count',
				array(
					'type'    => 'unit',
					'label'   => __( 'Total Number of Posts', 'bb-powerpack' ),
					'default' => '10',
					'slider'  => true,
					'help'    => __( 'Leave Blank or add -1 for all posts.', 'bb-powerpack' ),
				),
				$settings
			);

			FLBuilder::render_settings_field('post_order_by', array(
				'type'          => 'select',
				'label'         => __('Order By', 'bb-powerpack'),
				'default'		=> 'date',
				'options'       => array(
					'author'         => __('Author', 'bb-powerpack'),
					'comment_count'  => __('Comment Count', 'bb-powerpack'),
					'date'           => __('Date', 'bb-powerpack'),
					'modified'       => __('Date Last Modified', 'bb-powerpack'),
					'ID'             => __('ID', 'bb-powerpack'),
					'menu_order'     => __('Menu Order', 'bb-powerpack'),
					'meta_value'     => __('Meta Value (Alphabetical)', 'bb-powerpack'),
					'meta_value_num' => __('Meta Value (Numeric)', 'bb-powerpack'),
					'rand'        	 => __('Random', 'bb-powerpack'),
					'title'          => __('Title', 'bb-powerpack'),
					'post__in'       => __( 'Selection Order', 'bb-powerpack' ),
				),
				'toggle'		=> array(
					'meta_value' 	=> array(
						'fields'		=> array( 'post_order_by_meta_key' )
					),
					'meta_value_num' => array(
						'fields'		=> array( 'post_order_by_meta_key' )
					)
				)
			), $settings);

			// Meta Key
			FLBuilder::render_settings_field('post_order_by_meta_key', array(
				'type'          => 'text',
				'label'         => __('Meta Key', 'bb-powerpack'),
			), $settings);

			FLBuilder::render_settings_field(
				'post_order',
				array(
					'type'    => 'pp-switch',
					'label'   => __( 'Order', 'bb-powerpack' ),
					'default' => 'DESC',
					'options' => array(
						'ASC'  => __( 'Ascending', 'bb-powerpack' ),
						'DESC' => __( 'Descending', 'bb-powerpack' ),
					),
				),
				$settings
			);

			// Offset
			FLBuilder::render_settings_field('post_offset', array(
				'type'          => 'text',
				'label'         => _x('Offset', 'How many posts to skip.', 'bb-powerpack'),
				'default'       => '0',
				'size'          => '4',
				'help'          => __('Skip this many posts that match the specified criteria.', 'bb-powerpack')
			), $settings);
			?>
		</table>
	</div>
</div>
