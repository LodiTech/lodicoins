<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * PPWPFormsModule:
 */

?>
<div class="pp-wpforms-content">
	<?php if ( $settings->custom_title && ! empty( $settings->custom_title ) ) { ?>
		<h3 class="pp-form-title"><?php echo $settings->custom_title; ?></h3>
	<?php } ?>
	<?php if ( $settings->custom_description && ! empty( $settings->custom_description ) ) { ?>
		<p class="pp-form-description"><?php echo $settings->custom_description; ?></p>
	<?php } ?>

    <?php if ( $settings->select_form_field ) {
        echo do_shortcode( '[wpforms id='.$settings->select_form_field.' title='.$settings->title_field.' description='.$settings->description_field.']' );
    } ?>
</div>
