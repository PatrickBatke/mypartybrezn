<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Highlight Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$image_size 		= explode( 'x', $image_size );
$image_width 		= isset( $image_size[0] ) && ! empty( $image_size[0] ) ? $image_size[0] : '540';
$image_height 		= isset( $image_size[1] ) && ! empty( $image_size[1] ) ? $image_size[1] : '321';
$img_position 		= ( 'left' == $image_position ) ? 'image-left' : 'image-right';
$set_title_color 	= ! empty( $title_color ) ? 'style="color:{$title_color}"' : '';
$set_content_color 	= ! empty( $content_color ) ? 'style="color:{$content_color}"' : '';
?>

<div class="highlight-section <?php echo esc_attr( $img_position ); ?>">

	<div class="highlight-text"> 
		<?php if ( ! empty( $title ) ) : ?>
			<h2 <?php echo ''.$set_title_color; ?>><?php echo esc_attr( $title ); ?></h2>
		<?php endif; ?>
		<?php if ( ! empty( $content ) ) : ?>
			<div <?php echo ''.$set_content_color; ?>><?php echo ''.$content; ?></div>
		<?php endif; ?>
	</div>

	<?php if ( ! empty( $image ) ) : ?>
		<div class="highlight-image">
			<div class="image-wrap">
				<?php $url = wp_get_attachment_image_src( $image, 'full', false ); ?>
				<img src="<?php echo tokoo_resize( $url[0], $image_width, $image_height ); ?>" alt="<?php echo esc_attr( $title ); ?>">
			</div>
		</div>
	<?php endif; ?>

</div>