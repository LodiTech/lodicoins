<?php $module->render_toggle_button(); ?>
<div class="pp-advanced-menu<?php if ( $settings->collapse ) echo ' pp-advanced-menu-accordion-collapse'; ?> <?php echo $settings->mobile_menu_type; ?>">
	<div class="pp-clear"></div>
	<nav class="pp-menu-nav pp-off-canvas-menu pp-menu-<?php echo $settings->offcanvas_direction; ?>" aria-label="<?php echo $module->get_menu_label(); ?>" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
		<a href="javascript:void(0)" class="pp-menu-close-btn" aria-label="<?php _e( 'Close the menu', 'bb-powerpack' ); ?>" role="button">×</a>

		<?php do_action( 'pp_advanced_menu_before', $settings->mobile_menu_type, $settings, $id ); ?>

		<?php $module->render_nav(); ?>

		<?php do_action( 'pp_advanced_menu_after', $settings->mobile_menu_type, $settings, $id ); ?>
	</nav>
</div>
