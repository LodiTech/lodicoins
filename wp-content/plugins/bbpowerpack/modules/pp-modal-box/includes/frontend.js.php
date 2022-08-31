<?php
    $responsive_display = $settings->responsive_display;
    $medium_device = $global_settings->medium_breakpoint;
    $small_device = $global_settings->responsive_breakpoint;
    $breakpoint = '';
    if ( $responsive_display == 'desktop' ) {
        $breakpoint = '> ' . $medium_device;
    }
    if ( $responsive_display == 'desktop-medium' ) {
        $breakpoint = '>= ' . $medium_device;
    }
    if ( $responsive_display == 'medium' ) {
        $breakpoint = '> ' . $small_device . ' && $(window).width() <= ' . $medium_device;
    }
    if ( $responsive_display == 'medium-mobile' ) {
        $breakpoint = '<= ' . $medium_device;
    }
    if ( $responsive_display == 'mobile' ) {
        $breakpoint = '<= ' . $small_device;
    }

	$load_on_scroll  = isset( $settings->load_on_scroll ) ? floatval( $settings->load_on_scroll ) : 0;
	$custom_class_id = isset( $settings->modal_custom_class ) && ! empty( $settings->modal_custom_class ) ? ',' . $settings->modal_custom_class : '';
?>

var pp_modal_<?php echo $id; ?> = false;

;(function($) {

    var modal_<?php echo $id; ?> = {
        id: '<?php echo $id; ?>',
        type: '<?php echo $settings->modal_type; ?>',
		trigger_type: '<?php echo $settings->modal_load; ?>',
        <?php echo ( 'auto' == $settings->modal_load ) ? 'auto_load: true' : 'auto_load: false'; ?>,
        <?php echo ( 'exit_intent' == $settings->modal_load ) ? 'exit_intent: true' : 'exit_intent: false'; ?>,
        <?php if ( 'exit_intent' == $settings->modal_load ) { ?>
        display_after: <?php echo intval($settings->display_after); ?>,
        <?php } ?>
        <?php if ( 'auto' == $settings->modal_load ) { ?>
        display_after: <?php echo intval($settings->display_after_auto); ?>,
		load_on_scroll: <?php echo $load_on_scroll; ?>,
        <?php } ?>
        delay: <?php echo ( FLBuilderModel::is_builder_active() ) ? 0 : $settings->modal_delay; ?>,
        animation_load: '<?php echo $settings->animation_load; ?>',
        animation_exit: '<?php echo $settings->animation_exit; ?>',
		overlay_animation: <?php echo ! isset( $settings->overlay_animation ) || 'yes' === $settings->overlay_animation ? 'true' : 'false'; ?>,
        <?php echo 'enabled' == $settings->modal_esc ? 'esc_exit: true' : 'esc_exit: false'; ?>,
        <?php echo 'yes' == $settings->modal_click_exit ? 'click_exit: true' : 'click_exit: false'; ?>,
        layout: '<?php echo $settings->modal_layout; ?>',
        <?php echo 'yes' == $settings->modal_height_auto ? 'auto_height: true' : 'auto_height: false'; ?>,
        <?php if ( 'no' == $settings->modal_height_auto && ! empty( $settings->modal_height ) ) { ?>
		height: <?php echo $settings->modal_height; ?>,
		<?php } ?>
        width: <?php echo empty( $settings->modal_width ) ? 550 : intval( $settings->modal_width ); ?>,
        breakpoint: <?php echo intval( $settings->media_breakpoint ); ?>,
        <?php if ( $responsive_display != '' && $breakpoint != '' ) { ?>
        visible: $(window).width() <?php echo $breakpoint; ?>,
        <?php } ?>
		loaderImg: '<?php echo BB_POWERPACK_URL . 'assets/images/ajax-loader.gif'; ?>',
        <?php echo ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) ? 'previewing: true' : 'previewing: false'; ?>
    };

	<?php if ( 'html' === $settings->modal_type ) { ?>
		modal_<?php echo $id; ?>.content = '<?php echo base64_encode( $settings->modal_type_html ); ?>';
	<?php } ?>

    $(document).on('click', function(e) {
        if ( e && e.target.tagName === 'A' && e.target.href.indexOf('#modal-<?php echo $id; ?>') !== -1 ) {
            modal_<?php echo $id; ?>['scrollTop'] = $(window).scrollTop();
        }
    });

    <?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
    $(document).ready(function() {
        $('#modal-<?php echo $id; ?>').appendTo(document.body);

        var tabHash     = window.location.hash;
        var modalId     = window.location.hash.split('#modal-')[1];

        // If the URL contains a hash beginning with modal, trigger that modal box.
        if ( tabHash && tabHash.indexOf('modal-') >= 0 ) {
            if ( modalId === '<?php echo $id; ?>' ) {
                pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
            }
        }

        $(window).on('hashchange', function() {
            var tabHash     = window.location.hash;
            var modalId     = window.location.hash.split('#modal-')[1];

            // If the URL contains a hash beginning with modal, trigger that modal box.
            if ( tabHash && tabHash.indexOf('modal-') >= 0 ) {
                if ( modalId === '<?php echo $id; ?>' ) {
					if ( pp_modal_<?php echo $id; ?> instanceof PPModalBox ) {
						pp_modal_<?php echo $id; ?>.show();
					} else {
                    	pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
					}
                }
            }
        });

    });

		<?php if ( 'exit_intent' == $settings->modal_load ) { // Exit Intent ?>
		document.addEventListener('mouseout', function(e) {
			e = e ? e : window.event;
			var pos = e.relatedTarget || e.toElement;
			if ( (!pos || null === pos) && ( ! pp_modal_<?php echo $id; ?> || ( pp_modal_<?php echo $id; ?> && !pp_modal_<?php echo $id; ?>.isActive) ) ) {
				pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
			}
		});
		<?php } ?>

		<?php if ( 'auto' == $settings->modal_load ) { ?>
			<?php if ( empty( $load_on_scroll ) ) { ?>
			pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
    		<?php } else { ?>
				$(window).on('scroll', function() {
					var winH = $(window).height(),
						docH = $(document).height(),
						percent = ( $(window).scrollTop() / ( docH - winH ) ) * 100,
						percent = parseFloat( percent.toFixed(2) );

					if ( percent >= <?php echo $load_on_scroll; ?> ) {
						if ( false === pp_modal_<?php echo $id; ?> instanceof PPModalBox ) {
							pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
						}
					}
				});
			<?php } ?>
		<?php } ?>
    <?php } ?>

	// Bind the click event to any element with the class.
	modal_<?php echo $id; ?>.customTrigger = '<?php echo str_replace( ',', '', $custom_class_id ); ?>';
    $(document).on('click', '.modal-<?php echo $id; ?><?php echo $custom_class_id; ?>', function(e) {
        e.preventDefault();
		if ( pp_modal_<?php echo $id; ?> instanceof PPModalBox ) {
			pp_modal_<?php echo $id; ?>.settings.clickedElement = $( e.target );
			pp_modal_<?php echo $id; ?>.show();
        } else {
			modal_<?php echo $id; ?>.clickedElement = $( e.target );
        	pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
        }
    });

    <?php if ( FLBuilderModel::is_builder_active() ) { ?>
		<?php if ( 'enabled' == $settings->modal_preview ) { ?>
		setTimeout(function() {
			$( '.fl-node-<?php echo $id; ?>' ).on( 'click', function() {
				pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
			} );

			if ( $('form[data-type="pp-modal-box"]').length > 0 ) {
				if('<?php echo $id; ?>' === $('form[data-type="pp-modal-box"]').data('node')) {
					pp_modal_<?php echo $id; ?> = new PPModalBox(modal_<?php echo $id; ?>);
				}
			}
		}, 600);
		<?php } ?>
    <?php } ?>

})(jQuery);
