;(function( $ ) {

	PPVideo = function( settings ) {
		this.id			= settings.id;
		this.type		= settings.type;
		this.lightbox 	= settings.lightbox;
		this.aspectRatio = settings.aspectRatioLightbox;
		this.overlay	= settings.overlay;
		this.node		= $('.fl-node-' + this.id);

		this._init();
	};

	PPVideo.prototype = {
		_init: function() {
			if ( this.lightbox ) {
				this._initLightbox();
			} else if ( this.overlay ) {
				this._inlinePlay();
			}
		},

		_inlinePlay: function() {
			if ( this.node.find( '.pp-video-iframe' ).length > 0 ) {
				var videoFrame = this.node.find( '.pp-video-iframe' );

				videoFrame.data( 'src', videoFrame.data('src').replace('&autoplay=1', '') );
				videoFrame.data( 'src', videoFrame.data('src').replace('autoplay=1', '') );
			}

			this.node.find('.pp-video-image-overlay').on('click keyup', $.proxy(function(e) {
				// Click or keyboard (enter or spacebar) input?
				if ( ! this._validClick(e) ) {
					return;
				}

				e.preventDefault();

				this.node.find( '.pp-video-image-overlay' ).fadeOut(800, function() {
					this.remove();
				});

				if ( this.node.find( '.pp-video-player' ).length > 0 ) {
					this.node.find( '.pp-video-player' )[0].play();

					return;
				}

				var lazyLoad = this.node.find( '.pp-video-iframe' ).data( 'src' );

				if ( lazyLoad ) {
					this.node.find( '.pp-video-iframe' ).attr( 'src', lazyLoad );
				}

				var iframeSrc = this.node.find( '.pp-video-iframe' )[0].src.replace('&autoplay=0', '');
				iframeSrc = iframeSrc.replace('autoplay=0', '');

				var src = iframeSrc.split('#');
				iframeSrc = src[0];

				if ( 'facebook' === this.type ) {
					iframeSrc += '&autoplay=0';
				} else {
					iframeSrc += '&autoplay=1';
				}

				if ( 'undefined' !== typeof src[1] ) {
					iframeSrc += '#' + src[1];
				}
				this.node.find( '.pp-video-iframe' )[0].src = iframeSrc;
			}, this));
		},

		_initLightbox: function() {
			var id = this.id;
			var self = this;
			var options = {
				modal			: false,
				enableEscapeButton: true,
				type            : 'inline',
				baseClass		: 'fancybox-' + id + ' pp-video-lightbox',
				buttons			: [
					'close'
				],
				wheel			: false,
				touch			: false,
				afterLoad		: function(current, previous) {
					$('.fancybox-' + id).find('.fancybox-bg').addClass('fancybox-' + id + '-overlay');
					if ( $('.fancybox-' + id).find( '.pp-video-iframe' ).length > 0 ) {
						var iframeSrc = $('.fancybox-' + id).find( '.pp-video-iframe' )[0].src.replace('&autoplay=0', '');
						iframeSrc = iframeSrc.replace('autoplay=0', '');

						var src = iframeSrc.split('#');
						iframeSrc = src[0];

						if ( 'facebook' === self.type ) {
							iframeSrc += '&autoplay=0';
						} else {
							iframeSrc += '&autoplay=1';
						}

						if ( 'undefined' !== typeof src[1] ) {
							iframeSrc += '#' + src[1];
						}
						$('.fancybox-' + id).find( '.pp-video-iframe' )[0].src = iframeSrc;
						setTimeout(function() {
							$('.fancybox-' + id).trigger('focus');
						}, 1200);
					}

					$('.fancybox-' + id).on('click', '.fancybox-content', function(e) {
						if ( $(this).hasClass( 'fancybox-content' ) ) {
							$.fancybox.close();
						}
					});

					$(document).trigger( 'pp_video_lightbox_after_load', [ $('.fancybox-' + id), id ] );
				},
				afterClose: function() {
					$('.fl-node-' + id).find('.pp-video-play-icon').attr( 'tabindex', '0' );
					$('.fl-node-' + id).find('.pp-video-play-icon')[0].focus();
				},
				iframe: {
					preload: false
				},
				keys: {
					close: [27],
				},
				clickSlide: 'close',
				clickOutside: 'close'
			};

			var wrapperClasses = 'pp-aspect-ratio-' + this.aspectRatio;

			this.node.find('.pp-video-image-overlay').on('click keyup', $.proxy( function(e) {
				// Click or keyboard (enter or spacebar) input?
				if ( ! this._validClick(e) ) {
					return;
				}
				e.stopPropagation();
				$.fancybox.open($('<div class="'+wrapperClasses+'"></div>').html( $(e.target).parents('.pp-video-wrapper').find('.pp-video-lightbox-content').html() ), options);
				$(e.target).parents('.pp-video-wrapper').find('.pp-video-play-icon').attr( 'tabindex', '-1' );
			}, this ));

			$(document).on('keyup', function(e) {
				if ( e.keyCode === 27 ) {
					$.fancybox.close();
				}
			});
		},

		_validClick: function(e) {
			return (e.which == 1 || e.which == 13 || e.which == 32 || e.which == undefined) ? true : false;
		}
	};

})(jQuery);