<?php

/**
 * The Template for displaying sidebar primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$get_sidebar_columns = get_theme_mod( 'tokoo_sidebar_footer_columns', 2 );
switch ( $get_sidebar_columns ) {
	case '3':
		$holder_class = 'col-md-4';
		break;

	case '4':
		$holder_class = 'col-md-3';
		break;
	
	default:
		$holder_class = 'col-md-6';
		break;
}
?>

<div class="widget-holder">
	<div class="container">
		<div class="row">
			<?php $counter = 1; ?>
			<?php while ( $counter <= $get_sidebar_columns ) : ?>
				<?php if ( is_active_sidebar( "footer-{$counter}" ) ) : ?>
					<div class="<?php echo esc_attr( $holder_class ); ?>">
						<?php dynamic_sidebar( "footer-{$counter}" ); ?>
					</div><!-- footer-<?php echo esc_attr( $counter ); ?> -->
				<?php endif; ?>

			<?php $counter++; endwhile; ?>
		</div>
	</div>
</div>

