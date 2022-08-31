jQuery(function($) {
	<?php if ( 'lightbox' == $settings->link_type ) : ?>
	if (typeof $.fn.magnificPopup !== 'undefined') {
		$('.fl-node-<?php echo $id; ?> a').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			tLoading: '',
			preloader: true,
			image: {
					titleSrc: function(item) {
						<?php if ( 'below' == $settings->show_caption || 'hover' == $settings->show_caption ) : ?>
							return string_to_slug( '<?php echo addslashes( $module->get_caption() ); ?>' );
						<?php endif; ?>
					}
			},
			callbacks: {
				open: function() {
					$('.mfp-preloader').html('<i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>');
				}
			}
		});
	}
	<?php endif; ?>

	<?php if ( ! isset( $settings->title_hover ) || ( isset( $settings->title_hover ) && 'no' === $settings->title_hover ) ) : ?>
	$(function() {
		$( '.fl-node-<?php echo $id; ?> .fl-photo-img' )
			.on( 'mouseenter', function( e ) {
				$( this ).data( 'title', $( this ).attr( 'title' ) ).removeAttr( 'title' );
			} )
			.on( 'mouseleave', function( e ){
				$( this ).attr( 'title', $( this ).data( 'title' ) ).data( 'title', null );
			} );
	});
	<?php endif; ?>

	var string_to_slug = function (str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim

	// remove accents, swap ñ for n, etc
	var from = "àáäâèéëêìíïîòóöôùúüûñçěščřžýúůďťň·/_,:;";
	var to   = "aaaaeeeeiiiioooouuuuncescrzyuudtn------";

	for (var i=0, l=from.length ; i < l ; i++) {
			str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		}

		str = str.replace(/[^a-zA-Z0-9 -"']/g, '') // remove invalid chars
			.replace(/\s+/g, ' ') // collapse whitespace and replace by a space
			.replace( /\//g, '' ); // collapse all forward-slashes

		return str;
	}
});
