(function($) {
	var fixedHeight = <?php echo 'yes' === $settings->adaptive_height ? 'true' : 'false'; ?>;
	function equalheight() {
		if ( ! fixedHeight ) {
			return;
		}
		var maxHeight = 0;
		$('.fl-node-<?php echo $id; ?> .pp-testimonial .pp-content-wrapper').each(function(index) {
			if(($(this).outerHeight()) > maxHeight) {
				maxHeight = $(this).outerHeight();
			}
		});
		$('.fl-node-<?php echo $id; ?> .pp-testimonial .pp-content-wrapper').css('height', maxHeight + 'px');
	}

<?php if ( count( $settings->testimonials ) >= 1 && isset( $settings->layout ) && 'slider' === $settings->layout ) : ?>
	var left_arrow_svg = '<?php pp_prev_icon_svg( __( 'Previous', 'bb-powerpack' ) ); ?>';
	var right_arrow_svg = '<?php pp_next_icon_svg( __( 'Next', 'bb-powerpack' ) ); ?>';

	<?php
	$breakpoints	= array(
		'mobile'		=> empty( $global_settings->responsive_breakpoint ) ? '768' : $global_settings->responsive_breakpoint,
		'tablet'		=> empty( $global_settings->medium_breakpoint ) ? '1024' : $global_settings->medium_breakpoint,
	);
	$items = empty( absint( $settings->min_slides ) ) ? 3 : absint( $settings->min_slides );
	$items_medium = ! isset( $settings->min_slides_medium ) || empty( $settings->min_slides_medium ) ? $items : $settings->min_slides_medium;
	$items_responsive = ! isset( $settings->min_slides_responsive ) || empty( $settings->min_slides_responsive ) ? $items_medium : $settings->min_slides_responsive;

	?>

	var setCenterClass = function( e ) {
		setTimeout(function() {
			$( e.target ).find( '.owl-item' ).removeClass( 'pp-testimonial--center' );
			var actives = $( e.target ).find( '.owl-item.active' );
			if ( actives.length === 3 ) {
				$( actives[1] ).addClass( 'pp-testimonial--center' );
			}
		}, 200);
	};

	var options = {
		items: <?php echo $items; ?>,
		responsive: {
			0: {
				items: <?php echo $items_responsive; ?>,
			},
			<?php echo $breakpoints['mobile']; ?>: {
				items: <?php echo $items_medium; ?>,
			},
			<?php echo $breakpoints['tablet']; ?>: {
				items: <?php echo $items; ?>,
			},
			<?php echo apply_filters( 'pp_testimonials_max_breakpoint', 1199 ); ?>: {
				items: <?php echo $items; ?>,
			},
		},
		dots: <?php echo 1 == $settings->dots ? 'true' : 'false'; ?>,
		autoplay: <?php echo 1 == $settings->autoplay ? 'true' : 'false'; ?>,
		autoplayHoverPause: <?php echo 1 == $settings->hover_pause ? 'true' : 'false'; ?>,
		autoplayTimeout: <?php echo absint( $settings->pause ) * 1000; ?>,
		autoplaySpeed: <?php echo $settings->speed * 1000; ?>,
		navSpeed: <?php echo $settings->speed * 1000; ?>,
		dotsSpeed: <?php echo $settings->speed * 1000; ?>,
		nav: <?php echo 1 == $settings->arrows ? 'true' : 'false'; ?>,
		navText: [left_arrow_svg, right_arrow_svg],
		loop: <?php echo 1 == $settings->loop ? 'true' : 'false'; ?>,
		autoHeight: ! fixedHeight,
		<?php if ( 'vertical' === $settings->transition ) { ?>
			items: 1,
			responsive: {},
			animateOut: 'slideOutUp',
  			animateIn: 'slideInUp',
		<?php } elseif ( 'fade' === $settings->transition ) { ?>
			animateOut: 'fadeOut',
  			animateIn: 'fadeIn',
		<?php } ?>
		slideBy: <?php echo ! empty( $settings->move_slides ) ? $settings->move_slides : 1; ?>,
		mouseDrag: <?php echo isset( $settings->disable_mouse_drag ) && 1 == $settings->disable_mouse_drag ? 'false' : 'true'; ?>,
		responsiveRefreshRate: 200,
		responsiveBaseWidth: window,
		margin: <?php echo ! empty( $settings->slide_margin ) ? $settings->slide_margin : '0'; ?>,
		rtl: $('body').hasClass( 'rtl' ),
		onInitialized: function(e) {
			setCenterClass(e);
			equalheight();
			
			var count = 1;
			$(e.target).find('.owl-dot').each(function() {
				$(this).append( '<span class="sr-only">Testimonial Slide ' + count + '</span>' );
				count++;
			});
		},
		onResized: equalheight,
		onRefreshed: equalheight,
		onLoadedLazy: equalheight,
		onChanged: setCenterClass,
	};

	if ( $.fn.imagesLoaded ) {
		$('.fl-node-<?php echo $id; ?>').imagesLoaded(function() {
			$('.fl-node-<?php echo $id; ?> .owl-carousel').owlCarousel( options );
		});
	} else {
		$('.fl-node-<?php echo $id; ?> .owl-carousel').owlCarousel( options );
	}
	
<?php endif; ?>

})(jQuery);
