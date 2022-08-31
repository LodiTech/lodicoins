<?php $module->render_toggle_button(); ?>
<div class="pp-advanced-menu<?php if ( $settings->collapse ) echo ' pp-advanced-menu-accordion-collapse'; ?> <?php echo $settings->mobile_menu_type; ?>">
	<div class="pp-clear"></div>
	<nav class="pp-menu-nav pp-menu-overlay pp-overlay-<?php echo $settings->full_screen_effects; ?>" aria-label="<?php echo $module->get_menu_label(); ?>" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
		<div class="pp-menu-close-btn"></div>

		<?php do_action( 'pp_advanced_menu_before', $settings->mobile_menu_type, $settings, $id ); ?>

		<?php $module->render_nav(); ?>

		<?php do_action( 'pp_advanced_menu_after', $settings->mobile_menu_type, $settings, $id ); ?>
	</nav>
</div>
