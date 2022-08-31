<div class="pp-logos-content clearfix">
    <div class="pp-logos-wrapper pp-logos-<?php echo $settings->logos_layout; ?> clearfix">
		<?php
		for ( $i = 0; $i < count( $settings->logos_grid ); $i++ ) {

			if ( ! is_object( $settings->logos_grid[ $i ] ) ) {
				continue;
			}

			$item = $settings->logos_grid[ $i ];
			$alt = $item->upload_logo_title;

			if ( empty( $alt ) ) {
				$alt = get_post_meta( $item->upload_logo_grid, '_wp_attachment_image_alt', true );
				if ( empty( $alt ) && isset( $item->upload_logo_grid_src ) ) {
					$alt = $item->upload_logo_grid_src;
				}
			}

			$img_attrs = array(
				'class' => 'logo-image',
				'src' => $item->upload_logo_grid_src,
				'alt' => $alt,
				'data-no-lazy' => 1,
			);

			$img_attrs = apply_filters( 'pp_logo_image_html_attrs', $img_attrs, $item, $settings );

			$img_attrs_str = '';

			foreach ( $img_attrs as $key => $value ) {
				$img_attrs_str .= ' ' . $key . '=' . '"' . $value . '"';
			}

		?>
		<div class="pp-logo pp-logo-<?php echo $i; ?>">
        <?php if ( $item->upload_logo_link != '' ) { ?>
            <a href="<?php echo $item->upload_logo_link; ?>" target="<?php echo $settings->upload_logo_link_target; ?>"<?php echo ( '_blank' === $settings->upload_logo_link_target && ( ! isset( $settings->link_nofollow ) || 'yes' === $settings->link_nofollow ) ) ? ' rel="nofollow noopener"' : ''; ?>>
        <?php } ?>
            <div class="pp-logo-inner">
                <div class="pp-logo-inner-wrap">
                    <?php if( $item->upload_logo_grid ) { ?>
						<div class="logo-image-wrapper">
							<img <?php echo trim( $img_attrs_str ); ?> />
						</div>
                    <?php } ?>
                    <?php if ( $item->upload_logo_title ) { ?>
                        <div class="title-wrapper">
                            <p class="logo-title">
                                <?php echo $item->upload_logo_title; ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if ( $item->upload_logo_link != '' ) { ?>
                </a>
            <?php } ?>
		</div>
		<?php } ?>
	</div>
	<?php if ( 'carousel' === $settings->logos_layout ) { ?>
		<div class="logo-slider-nav logo-slider-next"></div>
		<div class="logo-slider-nav logo-slider-prev"></div>
	<?php } ?>
</div>
