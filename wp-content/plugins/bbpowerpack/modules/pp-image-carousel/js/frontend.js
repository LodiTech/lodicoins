;(function ($) {

    PPImageCarousel = function (settings) {
        this.id = settings.id;
        this.nodeClass = '.fl-node-' + settings.id;
		this.wrapperClass = this.nodeClass + ' .pp-image-carousel';
		this.elements = '';
        this.slidesPerView = settings.slidesPerView;
        this.slidesToScroll = settings.slidesToScroll;
		this.settings = settings;
		this.swipers = {};

        if (this._isSlideshow()) {
            this.slidesPerView = settings.slideshow_slidesPerView;
		}
		
		if ( typeof Swiper === 'undefined' ) {
			$(window).on('load', $.proxy(function() {
				if ( typeof Swiper === 'undefined' ) {
					return;
				} else {
					this._init();
				}
			}, this) );
		} else {
			this._init();
		}
    };

    PPImageCarousel.prototype = {
        id: '',
        nodeClass: '',
        wrapperClass: '',
        elements: '',
        slidesPerView: {},
        slidesToScroll: {},
        settings: {},
        swipers: {},

        _init: function () {
            this.elements = {
                mainSwiper: this.nodeClass + ' .pp-image-carousel'
            };

            this.elements.swiperSlide = $(this.elements.mainSwiper).find('.swiper-slide');
            this.elements.thumbSwiper = this.nodeClass + ' .pp-thumbnails-swiper';

            if (1 >= this._getSlidesCount()) {
                return;
            }

            var swiperOptions = this._getSwiperOptions();

            this.swipers.main = new Swiper(this.elements.mainSwiper, swiperOptions.main);

			// Manual pause the autoplay on mouse hover.
			if ( this.settings.pause_on_interaction && this.settings.autoplay_speed !== false ) {
				var self = this;
				$( this.swipers.main.el ).on( 'mouseenter', function() {
					self.swipers.main.autoplay.stop();
				} ).on( 'mouseleave', function() {
					self.swipers.main.autoplay.start();
				} );
			}

            if (this._isSlideshow() && 1 < this._getSlidesCount()) {
                this.swipers.main.controller.control = this.swipers.thumbs = new Swiper(this.elements.thumbSwiper, swiperOptions.thumbs);
                this.swipers.thumbs.controller.control = this.swipers.main;
            }
		},
		
		_getEffect: function() {
			return this.settings.effect;
		},

        _getSlidesCount: function () {
            return this.elements.swiperSlide.length;
        },

        _getInitialSlide: function () {
            return this.settings.initialSlide;
        },

        _getSpaceBetween: function () {
            var space = this.settings.spaceBetween.desktop,
                space = parseInt(space);

            if ( isNaN( space ) ) {
                space = 20;
            }

            return space;
        },

        _getSpaceBetweenTablet: function () {
            var space = this.settings.spaceBetween.tablet,
                space = parseInt(space);

            if ( isNaN(space) ) {
                space = this._getSpaceBetween();
            }

            return space;
        },

        _getSpaceBetweenMobile: function () {
            var space = this.settings.spaceBetween.mobile,
                space = parseInt(space);

            if ( isNaN(space) ) {
                space = this._getSpaceBetweenTablet();
            }

            return space;
        },

        _getSlidesPerView: function () {
			if ( this._isSlideshow() ) {
				return 1;
			}

			var slidesPerView = this.slidesPerView.desktop;

            return Math.min(this._getSlidesCount(), +slidesPerView);
        },

        _getSlidesPerViewTablet: function () {
			if ( this._isSlideshow() ) {
				return 1;
			}

			var slidesPerView = this.slidesPerView.tablet;

			if (slidesPerView === '' || slidesPerView === 0) {
				slidesPerView = this.slidesPerView.desktop
			}

			if (!slidesPerView && 'coverflow' === this.settings.type) {
				return Math.min(this._getSlidesCount(), 3);
			}

			return Math.min(this._getSlidesCount(), +slidesPerView);
        },

        _getSlidesPerViewMobile: function () {
			if ( this._isSlideshow() ) {
				return 1;
			}

			var slidesPerView = this.slidesPerView.mobile;

			if (slidesPerView === '' || slidesPerView === 0) {
				slidesPerView = this._getSlidesPerViewTablet();
			}

			if (!slidesPerView && 'coverflow' === this.settings.type) {
				return Math.min(this._getSlidesCount(), 3);
			}

			return Math.min(this._getSlidesCount(), +slidesPerView);
		},

		_getThumbsSlidesPerView: function () {
			var slidesPerView = this.slidesPerView.desktop;

            return Math.min(this._getSlidesCount(), +slidesPerView);
        },

        _getThumbsSlidesPerViewTablet: function () {
			var slidesPerView = this.slidesPerView.tablet;

			if (slidesPerView === '' || slidesPerView === 0) {
				slidesPerView = this.slidesPerView.desktop
			}

			if (!slidesPerView && 'coverflow' === this.settings.type) {
				return Math.min(this._getSlidesCount(), 3);
			}

			return Math.min(this._getSlidesCount(), +slidesPerView);
        },

        _getThumbsSlidesPerViewMobile: function () {
			var slidesPerView = this.slidesPerView.mobile;

			if (slidesPerView === '' || slidesPerView === 0) {
				slidesPerView = this._getSlidesPerViewTablet();
			}

			if (!slidesPerView && 'coverflow' === this.settings.type) {
				return Math.min(this._getSlidesCount(), 3);
			}

			return Math.min(this._getSlidesCount(), +slidesPerView);
		},
		
		_getSlidesToScroll: function(device) {
			if ( ! this._isSlideshow() && 'slide' === this._getEffect() ) {
				var slides = this.slidesToScroll[device];

				return Math.min( this._getSlidesCount(), +slides || 1 );
			}

			return 1;
		},

		_getSlidesToScrollDesktop: function() {
			return this._getSlidesToScroll( 'desktop' );
		},

		_getSlidesToScrollTablet: function() {
			return this._getSlidesToScroll( 'tablet' );
		},

		_getSlidesToScrollMobile: function() {
			return this._getSlidesToScroll( 'mobile' );
		},

        _getSwiperOptions: function () {
            var medium_breakpoint = this.settings.breakpoint.medium,
				responsive_breakpoint = this.settings.breakpoint.responsive;
				nodeClass = this.nodeClass;

			var pagination = $(nodeClass).find('.swiper-pagination');
			var captions = pagination.data( 'captions' );

			var addAriaLabels = function() {
				var count = 0;
				setTimeout(function() {
					pagination.find( '.swiper-pagination-bullet' ).each(function() {
						var label = captions[ count ];
						if ( '' !== label ) {
							$(this).attr( 'aria-label', label );
						}
						if ( $(this).hasClass( 'swiper-pagination-bullet-active' ) ) {
							$(this).attr( 'aria-current', 'true' );
						} else {
							$(this).attr( 'aria-current', 'false' );
						}
						count++;
					});
				}, 250);
			};

            var options = {
				keyboard: {
					enabled: true,
					onlyInViewport: false,
				},
				navigation: {
					prevEl: nodeClass + ' .pp-swiper-button-prev',
					nextEl: nodeClass + ' .pp-swiper-button-next'
				},
				pagination: {
					el: nodeClass + ' .swiper-pagination',
					type: this.settings.pagination,
					clickable: true,
					renderBullet: function( index, className ) {
						var pagination = $(nodeClass).find('.swiper-pagination');
						var captions = pagination.data( 'captions' );

						return '<button class="' + className + '" aria-label="' + captions[index] + '" tabindex="0" role="button"></button>';
					},
				},
				a11y: { enabled: false },
				grabCursor: true,
                effect: this._getEffect(),
                initialSlide: this._getInitialSlide(),
                slidesPerView: this._getSlidesPerView(),
                slidesPerGroup: this._getSlidesToScrollDesktop(),
                spaceBetween: this._getSpaceBetween(),
                loop: 'undefined' !== typeof this.settings.loop ? this.settings.loop : true,
                speed: this.settings.speed,
				breakpoints: {},
				on: {
					init: addAriaLabels,
					slideChange: addAriaLabels,
				}
			};

			if ( ! this.settings.isBuilderActive ) {
				options.preloadImages = false;
				options.lazy = {
					enabled: true,
					checkInView: true
				}
			}

			if ( this._isSlideshow() ) {
				options.loopedSlides = this._getSlidesCount();

				if ( 'fade' === this._getEffect() ) {
					options.fadeEffect = {
						crossFade: true
					};
				}
			}
			
			if ( ! this.settings.isBuilderActive && this.settings.autoplay_speed !== false ) {
				options.autoplay = {
					delay: this.settings.autoplay_speed,
					disableOnInteraction: !!this.settings.pause_on_interaction,
					stopOnLastSlide: 'undefined' !== typeof this.settings.stopOnLastSlide ? this.settings.stopOnLastSlide : false,
				};
			}
			
			if ('cube' !== this._getEffect() && 'fade' !== this._getEffect()) {
				options.breakpoints[medium_breakpoint] = {
					slidesPerView: this._getSlidesPerViewTablet(),
					slidesPerGroup: this._getSlidesToScrollTablet(),
					spaceBetween: this._getSpaceBetweenTablet()
				};
				options.breakpoints[responsive_breakpoint] = {
					slidesPerView: this._getSlidesPerViewMobile(),
					slidesPerGroup: this._getSlidesToScrollMobile(),
					spaceBetween: this._getSpaceBetweenMobile()
				};
			}

			if ('coverflow' === this.settings.type) {
                options.effect = 'coverflow';
				options.centeredSlides = true;
            }

            if (this._isSlideshow()) {
                options.slidesPerView = 1;

                delete options.pagination;
                delete options.breakpoints;
            }

            var thumbsSliderOptions = {
                slidesPerView: this._getThumbsSlidesPerView(),
                initialSlide: this._getInitialSlide(),
                centeredSlides: true,
                slideToClickedSlide: true,
                spaceBetween: this._getSpaceBetween(),
                loop: 'undefined' !== typeof this.settings.loop ? this.settings.loop : true,
                loopedSlides: this._getSlidesCount(),
                speed: this.settings.speed,
                onSlideChangeEnd: function (swiper) {
                    swiper.fixLoop();
                },
                breakpoints: {}
            };

            thumbsSliderOptions.breakpoints[medium_breakpoint] = {
                slidesPerView: this._getThumbsSlidesPerViewTablet(),
                spaceBetween: this._getSpaceBetweenTablet()
            };
            thumbsSliderOptions.breakpoints[responsive_breakpoint] = {
                slidesPerView: this._getThumbsSlidesPerViewMobile(),
                spaceBetween: this._getSpaceBetweenMobile()
            };

			if ( ! this.settings.isBuilderActive ) {
				thumbsSliderOptions.preloadImages = false;
				thumbsSliderOptions.lazy = {
					enabled: true,
					checkInView: true
				}
			}

            return {
                main: options,
                thumbs: thumbsSliderOptions
            };
        },

        _isSlideshow: function () {
            return 'slideshow' === this.settings.type;
        },

        _onElementChange: function (property) {
            if (0 === property.indexOf('width')) {
                this.swipers.main.onResize();
            }

            if (0 === property.indexOf('spaceBetween')) {
                this._updateSpaceBetween(this.swipers.main, property);
            }
        },

        _updateSpaceBetween: function (swiper, property) {
            var newSpaceBw = this._getSpaceBetween(),
                deviceMatch = property.match('space_between_(.*)');

            if (deviceMatch) {
                var breakpoints = {
                    tablet: this.settings.breakpoint.medium,
                    mobile: this.settings.breakpoint.responsive
                };

                swiper.params.breakpoints[breakpoints[deviceMatch[1]]].spaceBetween = newSpaceBw;
            } else {
                swiper.originalParams.spaceBetween = newSpaceBw;
            }

            swiper.params.spaceBetween = newSpaceBw;

            swiper.onResize();
        },
    };

})(jQuery);