<?php if ( $settings->carousel_type == 'slideshow' ) : ?>
<div class="pp-thumbnails-swiper swiper-container pp-thumbs-ratio-<?php echo $settings->thumb_ratio; ?>">
	<div class="swiper-wrapper">
		<?php foreach($photos as $photo) : ?>
			<?php
				$photo_thumb_link = $photo->src;

				if ( isset( $photo->thumb_link ) && ! empty( $photo->thumb_link ) ) {
					$photo_thumb_link = $photo->thumb_link;
				}
			?>
			<div class="swiper-slide">
				<?php if ( ! $lazy_load ) { ?>
					<div class="pp-image-carousel-thumb" style="background-image:url(<?php echo $photo_thumb_link; ?>)"></div>
				<?php } else { ?>
					<div class="pp-image-carousel-thumb swiper-lazy" data-background="<?php echo $photo_thumb_link; ?>">
						<div class="swiper-lazy-preloader"></div>
					</div>
				<?php } ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>