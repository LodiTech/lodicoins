<?php if ( 'box' === $item->link_type ) { ?>
	<a class="pp-more-link" href="<?php echo $item->link; ?>" target="<?php echo $item->link_target; ?>">
<?php } ?>
<div class="pp-icon-wrapper animated <?php echo $classes; ?>">
	<div class="pp-infolist-icon">
		<div class="pp-infolist-icon-inner">
			<?php if ( $item->icon_type == 'icon' ) { ?>
				<span class="pp-icon <?php echo $item->icon_select; ?>"></span>
			<?php } else { ?>
				<?php if ( isset( $item->image_select_src ) && ! empty( $item->image_select_src ) ) { ?>
				<img src="<?php echo $item->image_select_src; ?>" alt="<?php echo get_the_title( absint( $item->image_select ) ); ?>" />
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<div class="pp-heading-wrapper">
	<div class="pp-infolist-title">
		<?php if ( $item->link_type == 'title' ) { ?>
			<a class="pp-more-link" href="<?php echo $item->link; ?>" target="<?php echo $item->link_target; ?>">
		<?php } ?>
		<<?php echo $title_tag; ?> class="pp-infolist-title-text"><?php echo $item->title; ?></<?php echo $title_tag; ?>>
		<?php if ( $item->link_type == 'title' ) { ?>
			</a>
		<?php } ?>
	</div>
	<div class="pp-infolist-description">
		<?php echo $item->description; ?>
		<?php if ( $item->link_type == 'read_more' ) { ?>
			<a class="pp-more-link" href="<?php echo $item->link; ?>" target="<?php echo $item->link_target; ?>"><?php echo $item->read_more_text; ?></a>
		<?php } ?>
	</div>
</div>

<div class="pp-list-connector"></div>
<?php if ( 'box' === $item->link_type ) { ?>
	</a>
<?php } ?>