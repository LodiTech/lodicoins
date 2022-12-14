<?php

$layout                 = $settings->layout;
$wrapper_flex_direction = 'row';
if ( 'center' === $layout ) {
	$wrapper_flex_direction = 'column';
} elseif ( 'right' === $layout ) {
	$wrapper_flex_direction = 'row-reverse';
}

$flex_img_position = 'center';
if ( 'start' === $settings->img_position ) {
	$flex_img_position = 'flex-start';
}

if ( 'center' === $settings->alignment && 'center' === $layout ) {
	$flex_img_position = 'center';
}

FLBuilderCSS::border_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_border',
		'selector'     => ".fl-node-$id .pp-authorbox-image img",
	)
);
FLBuilderCSS::border_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'authorbox_border',
		'selector'     => ".fl-node-$id .pp-authorbox-content",
	)
);
FLBuilderCSS::border_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_border',
		'selector'     => ".fl-node-$id .pp-authorbox-button .pp-author-archive-btn",
	)
);
FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'name_typography',
		'selector'     => ".fl-node-$id .pp-authorbox-author-name",
	)
);
FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'bio_typography',
		'selector'     => ".fl-node-$id .pp-authorbox-bio",
	)
);
FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_typography',
		'selector'     => ".fl-node-$id .pp-authorbox-button",
	)
);
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'alignment',
		'selector'     => ".fl-node-$id .pp-authorbox-author",
		'prop'         => 'text-align',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_size',
		'selector'     => ".fl-node-$id .pp-authorbox-image .pp-authorbox-img, .fl-node-$id .pp-authorbox-image .pp-authorbox--wrap",
		'prop'         => 'width',
		'unit'         => $settings->img_size_unit,
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_size',
		'selector'     => ".fl-node-$id .pp-authorbox-image .pp-authorbox-img, .fl-node-$id .pp-authorbox-image .pp-authorbox--wrap",
		'prop'         => 'height',
		'unit'         => $settings->img_size_unit,
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-button .pp-author-archive-btn",
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'button_padding_top',
			'padding-right'  => 'button_padding_right',
			'padding-bottom' => 'button_padding_bottom',
			'padding-left'   => 'button_padding_left',
		),
	)
);


FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-button .pp-author-archive-btn",
		'prop'         => 'padding',
		'unit'         => 'px',
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_margin',
		'selector'     => ".fl-node-$id .pp-authorbox-button .pp-author-archive-btn",
		'unit'         => 'px',
		'props'        => array(
			'margin-top'    => 'button_margin_top',
			'margin-right'  => 'button_margin_right',
			'margin-bottom' => 'button_margin_bottom',
			'margin-left'   => 'button_margin_left',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_margin',
		'selector'     => ".fl-node-$id .pp-authorbox-button .pp-author-archive-btn",
		'prop'         => 'margin',
		'unit'         => 'px',
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'bio_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-content .pp-authorbox-author",
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'bio_padding_top',
			'padding-right'  => 'bio_padding_right',
			'padding-bottom' => 'bio_padding_bottom',
			'padding-left'   => 'bio_padding_left',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'bio_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-content .pp-authorbox-author",
		'prop'         => 'padding',
		'unit'         => 'px',
	)
);


FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'bio_gap',
		'selector'     => ".fl-node-$id .pp-authorbox-author .pp-authorbox-bio",
		'prop'         => 'margin-top',
		'unit'         => 'px',
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-image",
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'img_padding_top',
			'padding-right'  => 'img_padding_right',
			'padding-bottom' => 'img_padding_bottom',
			'padding-left'   => 'img_padding_left',
		),
	)
);


FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-image",
		'prop'         => 'padding',
		'unit'         => 'px',
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_margin',
		'selector'     => ".fl-node-$id .pp-authorbox-image",
		'unit'         => 'px',
		'props'        => array(
			'margin-top'    => 'img_margin_top',
			'margin-right'  => 'img_margin_right',
			'margin-bottom' => 'img_margin_bottom',
			'margin-left'   => 'img_margin_left',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'img_margin',
		'selector'     => ".fl-node-$id .pp-authorbox-image",
		'prop'         => 'margin',
		'unit'         => 'px',
	)
);


FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'box_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-content",
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'box_padding_top',
			'padding-right'  => 'box_padding_right',
			'padding-bottom' => 'box_padding_bottom',
			'padding-left'   => 'box_padding_left',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'box_padding',
		'selector'     => ".fl-node-$id .pp-authorbox-content",
		'prop'         => 'padding',
		'unit'         => 'px',
	)
);
?>

.fl-node-<?php echo $id; ?> .pp-authorbox-wrapper {
	flex-direction : <?php echo $wrapper_flex_direction; ?>;
}

.fl-node-<?php echo $id; ?> .pp-authorbox-wrapper .pp-authorbox-image {
	<?php
	if ( 'center' === $layout ) { //above
		?>
		display:inline;
		<?php
	}
	?>
}

.fl-node-<?php echo $id; ?> .pp-authorbox-button .pp-author-archive-btn {
	background-color: <?php echo pp_get_color_value( $settings->button_bg_color ); ?> ;
	color: <?php echo pp_get_color_value( $settings->button_text_color ); ?> ;
}
.fl-node-<?php echo $id; ?> .pp-authorbox-button .pp-author-archive-btn:hover {
	background-color: <?php echo pp_get_color_value( $settings->button_hover_bg_color ); ?> ;
	color: <?php echo pp_get_color_value( $settings->button_hover_text_color ); ?> ;
	border-color: <?php echo pp_get_color_value( $settings->button_hover_border_color ); ?> ;
}

.fl-node-<?php echo $id; ?> .pp-authorbox-content .pp-authorbox-bio {
	color: <?php echo pp_get_color_value( $settings->bio_text_color ); ?> ;
}

.fl-node-<?php echo $id; ?> .pp-authorbox-author-name * {
	color: <?php echo pp_get_color_value( $settings->name_text_color ); ?> ;
}
.fl-node-<?php echo $id; ?> .pp-authorbox-image {
	align-self: <?php echo $flex_img_position; ?> ;
}
.fl-node-<?php echo $id; ?> .pp-authorbox-content {
	<?php
	if ( '' !== $settings->authorbox_bg_color ) {
		?>
	background-color: <?php echo pp_get_color_value( $settings->authorbox_bg_color ); ?> ;
	<?php } ?>
}

<?php
// Social Icons - Size.
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'social_icons_size',
		'selector'     => ".fl-node-$id .pp-author-social-link a",
		'prop'         => 'font-size',
		'unit'         => 'px',
		'enabled'      => isset( $settings->social_icons ) && 'yes' === $settings->social_icons,
	)
);

// Social Icons - Horizontal spacing.
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'social_icons_spacing_right',
		'selector'     => ".fl-node-$id .pp-author-social-link",
		'prop'         => 'margin-right',
		'unit'         => 'px',
		'enabled'      => isset( $settings->social_icons ) && 'yes' === $settings->social_icons,
	)
);

// Social Icons - Vertical spacing.
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'social_icons_spacing_top',
		'selector'     => ".fl-node-$id .pp-author-social-link",
		'prop'         => 'margin-top',
		'unit'         => 'px',
		'enabled'      => isset( $settings->social_icons ) && 'yes' === $settings->social_icons,
	)
);
?>

<?php if ( isset( $settings->social_icons ) && 'yes' === $settings->social_icons ) { ?>
	<?php if ( ! empty( $settings->social_icons_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .pp-author-social-link a {
		color: #<?php echo $settings->social_icons_color; ?>;
	}
	<?php } ?>

	<?php if ( ! empty( $settings->social_icons_hover_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .pp-author-social-link a:hover {
		color: #<?php echo $settings->social_icons_hover_color; ?>;
	}
	<?php } ?>
<?php } ?>

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {

	.fl-node-<?php echo $id; ?> .pp-authorbox-image {
		align-self: auto;
	}
	.fl-node-<?php echo $id; ?> .pp-authorbox-wrapper {
		flex-direction : column;
	}
}
