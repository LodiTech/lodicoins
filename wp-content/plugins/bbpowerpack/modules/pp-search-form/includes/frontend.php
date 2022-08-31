<div class="pp-search-form-wrap pp-search-form--style-<?php echo $settings->style; ?> pp-search-form--button-type-<?php echo $settings->button_type; ?>">
	<form class="pp-search-form" role="search" action="<?php echo home_url(); ?>" method="get">
		<?php if ( 'full_screen' === $settings->style && ! empty( $settings->toggle_icon ) ) : ?>
			<div class="pp-search-form__toggle">
				<i class="<?php echo $settings->toggle_icon; ?>" aria-hidden="true"></i>
				<span class="pp-screen-reader-text"><?php esc_html_e( 'Search', 'bb-powerpack' ); ?></span>
			</div>
		<?php endif; ?>
		<div class="pp-search-form__container">
			<?php if ( 'minimal' === $settings->style ) :
				$input_icon = ! isset( $settings->input_icon ) ? 'fa fa-search' : $settings->input_icon;
				if ( ! empty( $input_icon ) ) :
				?>
				<div class="pp-search-form__icon">
					<i class="<?php echo esc_attr( $input_icon ); ?>" aria-hidden="true"></i>
					<span class="pp-screen-reader-text"><?php esc_html_e( 'Search', 'bb-powerpack' ); ?></span>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			<input <?php echo $module->render_input_attrs(); ?>>
			<?php if ( 'classic' === $settings->style ) : ?>
			<button class="pp-search-form__submit" type="submit">
				<?php if ( 'icon' === $settings->button_type ) : ?>
					<?php if ( ! empty( $settings->icon ) ) : ?>
					<i class="<?php echo $settings->icon; ?>" aria-hidden="true"></i>
					<span class="pp-screen-reader-text"><?php esc_html_e( 'Search', 'bb-powerpack' ); ?></span>
					<?php endif; ?>
				<?php elseif ( ! empty( $settings->button_text ) ) : ?>
					<?php echo $settings->button_text; ?>
				<?php endif; ?>
			</button>
			<?php endif; ?>
			<?php if ( 'full_screen' === $settings->style ) : ?>
			<div class="pp-search-form--lightbox-close">
				<span class="pp-icon-close" aria-hidden="true">
				<svg viewbox="0 0 40 40">
					<path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30" />
				</svg>
				</span>
				<span class="pp-screen-reader-text"><?php esc_html_e( 'Close', 'bb-powerpack' ); ?></span>
			</div>
			<?php endif ?>
		</div>
	</form>
</div>