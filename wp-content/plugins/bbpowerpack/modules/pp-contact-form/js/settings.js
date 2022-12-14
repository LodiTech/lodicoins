(function($){

	FLBuilder.registerModuleHelper('pp-contact-form', {


		rules: {
            'form_border_width': {
                number: true
            },
            'form_border_radius': {
                number: true,
            },
            'form_shadow_h': {
                number: true
            },
            'form_shadow_v': {
                number: true
            },
            'form_shadow_blur': {
                number: true
            },
            'form_shadow_spread': {
                number: true
            },
            'form_shadow_opacity': {
                number: true
            },
            'form_padding': {
                number: true
            },
            'title_margin': {
                number: true
            },
            'description_margin': {
                number: true
            },
            'input_field_height': {
                number: true
            },
            'input_textarea_height': {
                number: true
            },
            'input_field_background_opacity': {
                number: true
            },
            'input_field_border_width': {
                number: true
            },
            'input_field_border_radius': {
                number: true
            },
            'input_field_padding': {
                number: true
            },
            'input_field_margin': {
                number: true
            },
            'button_width_size': {
                number: true
            },
            'button_background_opacity': {
                number: true
            },
            'button_border_width': {
                number: true
            },
            'button_border_radius': {
                number: true
            },
            'title_font_size': {
                number: true
            },
            'title_line_height': {
                number: true
            },
            'description_font_size': {
                number: true
            },
            'description_line_height': {
                number: true
            },
            'label_font_size': {
                number: true
            },
            'input_font_size': {
                number: true
            },
            'button_font_size': {
                number: true
            },
            'validation_error_font_size': {
                number: true
            },
            'success_message_font_size': {
                number: true
            }
        },


		init: function()
		{
			var form    = $( '.fl-builder-settings' ),
				action  = form.find( 'select[name=success_action]' ),
				self	= this;

			this._actionChanged();

			action.on( 'change', this._actionChanged );
			
			this._keySourceChanged();

			$('input[name=recaptcha_key_source]').on( 'change', this._keySourceChanged );
			$('input[name=recaptcha_toggle]').on( 'change', function() {
				setTimeout( function() {
					self._keySourceChanged();
				}, 500 );
			} );
            
            // Toggle reCAPTCHA display
            this._toggleReCaptcha();
			// Toggle hCaptcha display
            this._toggleHCaptcha();
            $('input[name=recaptcha_toggle]').on('change', $.proxy(this._toggleReCaptcha, this));
            $('input[name=hcaptcha_toggle]').on('change', $.proxy(this._toggleHCaptcha, this));
            $('input[name=recaptcha_key_source]').on('change', $.proxy(this._toggleReCaptcha, this));
            $('input[name=recaptcha_site_key]').on('change', $.proxy(this._toggleReCaptcha, this));
            $('select[name=recaptcha_validate_type]').on('change', $.proxy(this._toggleReCaptcha, this));
            $('input[name=recaptcha_theme]').on('change', $.proxy(this._toggleReCaptcha, this));

            // Render reCAPTCHA after layout rendered via AJAX
            if (window.onLoadPPReCaptcha) {
                $(FLBuilder._contentClass).on('fl-builder.layout-rendered', onLoadPPReCaptcha);
            }
			// Render hCaptcha after layout rendered via AJAX
            if (window.onLoadPPHCaptcha) {
                $(FLBuilder._contentClass).on('fl-builder.layout-rendered', onLoadPPHCaptcha);
            }
		},

		_actionChanged: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ).val(),
				url       = form.find( 'input[name=success_url]' );

			url.rules('remove');

			if ( 'redirect' == action ) {
				url.rules( 'add', { required: true } );
			}
		},

		_keySourceChanged: function() {
			var form = $( '.fl-builder-settings' );
			if ( 'hide' === form.find('input[name=recaptcha_toggle]').val() ) {
				$('#fl-field-recaptcha_site_key').hide();
				$('#fl-field-recaptcha_secret_key').hide();
				return;
			}
			if ( 'default' === form.find('input[name=recaptcha_key_source]').val() ) {
				$('#fl-field-recaptcha_site_key').hide();
				$('#fl-field-recaptcha_secret_key').hide();
			} else {
				$('#fl-field-recaptcha_site_key').show();
				$('#fl-field-recaptcha_secret_key').show();
			}
		},

        /**
		 * Custom preview method for reCAPTCHA settings
		 *
		 * @param  object event  The event type of where this method been called
		 * @since 1.9.5
		 */
        _toggleReCaptcha: function (event) {
            var form = $('.fl-builder-settings'),
                nodeId = form.attr('data-node'),
                toggle = form.find('input[name=recaptcha_toggle]'),
                captchaKey = form.find('input[name=recaptcha_site_key]').val(),
                captType = form.find('select[name=recaptcha_validate_type]').val(),
                theme = form.find('input[name=recaptcha_theme]').val(),
                reCaptcha = $('.fl-node-' + nodeId).find('.pp-grecaptcha'),
                reCaptchaId = nodeId + '-pp-grecaptcha',
                target = typeof event !== 'undefined' ? $(event.currentTarget) : null,
                inputEvent = target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'recaptcha_site_key',
                selectEvent = target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'recaptcha_toggle',
                typeEvent = target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'recaptcha_validate_type',
                themeEvent = target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'recaptcha_theme',
                scriptTag = $('<script>'),
				isRender = false;
				
			if ( 'undefined' !== typeof pp_recaptcha ) {
				if ( 'default' === form.find( 'input[name=recaptcha_key_source]' ).val() ) {
					captchaKey = pp_recaptcha.site_key;
				}
			}

            // Add library if not exists
            if (0 === $('script#g-recaptcha-api').length) {
                scriptTag
                    .attr('src', 'https://www.google.com/recaptcha/api.js?onload=onLoadPPReCaptcha&render=explicit')
                    .attr('type', 'text/javascript')
                    .attr('id', 'g-recaptcha-api')
                    .attr('async', 'async')
                    .attr('defer', 'defer')
                    .appendTo('body');
            }

            if ('show' === toggle.val() && captchaKey.length) {

                // reCAPTCHA is not yet exists
                if (0 === reCaptcha.length) {
                    isRender = true;
                }
                // If reCAPTCHA element exists, then reset reCAPTCHA if existing key does not matched with the input value
                else if ((inputEvent || selectEvent || typeEvent || themeEvent) && (reCaptcha.data('sitekey') != captchaKey || reCaptcha.data('validate') != captType || reCaptcha.data('theme') != theme)
                ) {
                    reCaptcha.parent().remove();
                    isRender = true;
                }
                else {
                    reCaptcha.parent().show();
                }

                if (isRender) {
                    this._renderReCaptcha(nodeId, reCaptchaId, captchaKey, captType, theme);
				}
            }
            else if ('show' === toggle.val() && captchaKey.length === 0 && reCaptcha.length > 0) {
                reCaptcha.parent().remove();
            }
            else if ('hide' === toggle.val() && reCaptcha.length > 0) {
                reCaptcha.parent().hide();
            }
        },

		_toggleHCaptcha: function(event) {
			var form = $('.fl-builder-settings'),
				nodeId = form.attr('data-node'),
				toggle = form.find('input[name=hcaptcha_toggle]'),
				captchaKey = '',
				hCaptcha = $('.fl-node-' + nodeId).find('.h-captcha'),
				hCaptchaId = nodeId + '-pp-hcaptcha',
				target = typeof event !== 'undefined' ? $(event.currentTarget) : null,
				selectEvent = target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'hcaptcha_toggle',
				scriptTag = $('<script>'),
				isRender = false;

			if ( 'undefined' !== typeof pp_hcaptcha ) {
				captchaKey = pp_hcaptcha.site_key;
			}

			// Add API script if not exists
            if (0 === $('script#h-captcha-api').length) {
                scriptTag
					.attr('src', 'https://hcaptcha.com/1/api.js?onload=onLoadPPHCaptcha&render=explicit&recaptchacompat=off')
                    .attr('type', 'text/javascript')
                    .attr('id', 'h-captcha-api')
                    .attr('async', 'async')
                    .attr('defer', 'defer')
                    .appendTo('body');
            }

			if ('show' === toggle.val() && captchaKey.length) {

                // hCaptcha is not yet exists
                if (0 === hCaptcha.length) {
                    isRender = true;
                }
                // If hCaptcha element exists, then reset hCaptcha if existing key does not matched with the input value
                else if (selectEvent && hCaptcha.data('sitekey') != captchaKey ) {
                    hCaptcha.parent().remove();
                    isRender = true;
                }
                else {
                    hCaptcha.parent().show();
                }

                if (isRender) {
                    this._renderHCaptcha(nodeId, hCaptchaId, captchaKey);
				}
            }
            else if ('show' === toggle.val() && captchaKey.length === 0 && hCaptcha.length > 0) {
                hCaptcha.parent().remove();
            }
            else if ('hide' === toggle.val() && hCaptcha.length > 0) {
                hCaptcha.parent().hide();
            }
		},

		/**
		 * Render Google reCAPTCHA
		 *
		 * @param  string nodeId  		The current node ID
		 * @param  string reCaptchaId  	The element ID to render reCAPTCHA
		 * @param  string reCaptchaKey  The reCAPTCHA Key
		 * @param  string reCaptType  	Checkbox or invisible
		 * @param  string theme         Light or dark
		 * @since 1.9.5
		 */
        _renderReCaptcha: function (nodeId, reCaptchaId, reCaptchaKey, reCaptType, theme) {
            var captchaField = $('<div class="pp-input-group pp-recaptcha">'),
                captchaElement = $('<div id="' + reCaptchaId + '" class="pp-grecaptcha">'),
                widgetID;

            captchaElement.attr('data-sitekey', reCaptchaKey);
            captchaElement.attr('data-validate', reCaptType);
            captchaElement.attr('data-theme', theme);

            // Append recaptcha element to an appended element
            captchaField
                .html(captchaElement)
                .appendTo($('.fl-node-' + nodeId).find('.pp-contact-form-inner'));

            widgetID = grecaptcha.render(reCaptchaId, {
                sitekey: reCaptchaKey,
                size: reCaptType,
                theme: theme
            });
            captchaElement.attr('data-widgetid', widgetID);
        },

		/**
		 * Render hCaptcha
		 *
		 * @param  string nodeId  		The current node ID
		 * @param  string hCaptchaId  	The element ID to render hCaptcha
		 * @param  string hCaptchaKey  The hCaptcha Key
		 * @since 2.x
		 */
		 _renderHCaptcha: function (nodeId, hCaptchaId, hCaptchaKey) {
            var captchaField = $('<div class="pp-input-group pp-hcaptcha">'),
                captchaElement = $('<div id="' + hCaptchaId + '" class="h-captcha">'),
                widgetID;

            captchaElement.attr('data-sitekey', hCaptchaKey);

            // Append hCaptcha element to an appended element
            captchaField
                .html(captchaElement)
                .appendTo($('.fl-node-' + nodeId).find('.pp-contact-form-inner'));

            widgetID = hcaptcha.render(hCaptchaId, {
                sitekey: hCaptchaKey
            });
            captchaElement.attr('data-hcaptcha-widget-id', widgetID);
        }
	});

})(jQuery);
