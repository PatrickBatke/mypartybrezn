<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Speaker
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );
$the_url 	= wp_get_attachment_image_src( $atts['avatar'], 'full', false );
$the_avatar = ! empty( $the_url[0] ) ? tokoo_resize( $the_url[0], 120, 120 ) : '';

extract( $atts );

$background_color = '';
if ( ! empty( $bg_color ) ) {
	$background_color = 'background-color:'.$bg_color.';';
}

$background_image = '';
if ( ! empty( $bg_image ) ) {
	$url 				= wp_get_attachment_image_src( $bg_image, 'full' );
 	$background_image  .= 'color:'.$url[0].';';
}
$team_styles = 'style="'.$background_color.$background_image.'"';


$data_speaker  = array(
	'avatar' 		=> $the_avatar,
	'name' 			=> $name,
	'position' 		=> $position,
	'bio' 			=> $content,
	'facebook' 		=> $facebook,
	'twitter' 		=> $twitter,
	'url' 			=> $url,
);
$speaker_JSON  = json_encode( $data_speaker );
?>

<div class="speaker">
	<?php if ( ! empty( $avatar ) ) : ?>
		<figure class="speaker-avatar rounded">
			<img src="<?php echo tokoo_resize( $the_url[0], 170, 170 ); ?>" alt="<?php echo esc_attr( $name ); ?>">
		</figure>
	<?php endif; ?>
	<div class="speaker-detail">
		<?php if ( ! empty( $name ) ) : ?>
			<h2 class="speaker-name"><a href="#" class="speaker-popup-trigger"><?php echo esc_attr( $name ); ?></a></h2>
		<?php endif; ?>
		<?php if ( ! empty( $position ) ) : ?>
			<small class="speaker-position"><?php echo esc_attr( $position ); ?></small>
		<?php endif; ?>
		<hr class="tokoo-separator">
		<?php if ( ! empty( $content ) ) : ?>
			<div class="speaker-bio">
				<?php echo ''.$content; ?>
			</div>
		<?php endif; ?>
		<?php if( ! empty( $data_speaker["facebook"] ) ||  ! empty( $data_speaker["twitter"] ) || ! empty( $data_speaker["url"] ) ): ?>
			<div class="social-link">
				<?php if ( ! empty( $data_speaker["facebook"]) ): ?>
					<a href="<?php echo esc_url( $data_speaker["facebook"] ) ?>"><i class="fa fa-facebook"></i></a>
				<?php endif; ?>
				<?php if ( ! empty( $data_speaker["twitter"] ) ): ?>
					<a href="<?php echo esc_url( $data_speaker["twitter"] ) ?>"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
				<?php if ( ! empty( $data_speaker["url"] ) ): ?>
					<a href="<?php echo esc_url( $data_speaker["url"] ) ?>"><i class="fa fa-link"></i></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>


