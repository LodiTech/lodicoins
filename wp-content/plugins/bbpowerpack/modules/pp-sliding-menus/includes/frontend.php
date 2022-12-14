<?php
$classes  = 'pp-sliding-menus';
$classes .= ' pp-sliding-menu-effect-' . $settings->effect;
$classes .= ' pp-sliding-menu-direction-' . $settings->direction;

$args = apply_filters( 'pp_sliding_menus_nav_args', array(
	'echo'        => false,
	'menu'        => $settings->menu,
	'menu_class'  => 'pp-slide-menu__menu',
	'menu_id'     => 'menu-' . $module->get_nav_menu_index() . '-' . $id,
	'fallback_cb' => '__return_empty_string',
	'before'      => sprintf( '<span class="pp-slide-menu-arrow">%s</span>', apply_filters( 'pp_sliding_menus_arrow_right', pp_next_icon_svg( '', false ) ) ),
	'container'   => '',
), $settings );

add_filter( 'nav_menu_link_attributes', array( $module, 'handle_link_classes' ), 10, 4 );
add_filter( 'nav_menu_submenu_css_class', array( $module, 'handle_sub_menu_classes' ) );
add_filter( 'nav_menu_css_class', array( $module, 'handle_menu_item_classes' ) );

$menu_html = wp_nav_menu( $args );

remove_filter( 'nav_menu_link_attributes', array( $module, 'handle_link_classes' ), 10, 4 );
remove_filter( 'nav_menu_submenu_css_class', array( $module, 'handle_sub_menu_classes' ) );
remove_filter( 'nav_menu_css_class', array( $module, 'handle_menu_item_classes' ) );

?>
<div class="<?php echo $classes; ?>">
	<?php echo $menu_html; ?>
</div>
