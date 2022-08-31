<div class="pp-advanced-menu<?php if ( $settings->collapse ) echo ' pp-advanced-menu-accordion-collapse'; ?> pp-menu-default pp-menu-align-<?php echo $settings->alignment; ?>">
   	<?php
   	if ( $settings->mobile_menu_type == 'default' ) {
		$module->render_toggle_button();
   	}
   	?>
   	<div class="pp-clear"></div>
	<nav class="pp-menu-nav" aria-label="<?php echo $module->get_menu_label(); ?>" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
		<?php do_action( 'pp_advanced_menu_before', $settings->mobile_menu_type, $settings, $id ); ?>

		<?php $module->render_nav(); ?>

		<?php do_action( 'pp_advanced_menu_after', $settings->mobile_menu_type, $settings, $id ); ?>
	</nav>
</div>
