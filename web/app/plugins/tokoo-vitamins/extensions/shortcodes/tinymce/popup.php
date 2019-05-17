<?php

// loads the shortcodes class, wordpress is loaded with it
include( 'shortcodes.class.php' );

// get popup type
$popup 		= trim( $_GET['popup'] );
$shortcode 	= new koo_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="koo-popup">

	<div id="koo-shortcode-wrap">
		
		<div id="koo-sc-form-wrap">
		
			<div id="koo-sc-form-head">
			
				<?php printf( $shortcode->popup_title ); ?>
			
			</div>
			<!-- /#koo-sc-form-head -->
			
			<form method="post" id="koo-sc-form">
			
				<table id="koo-sc-form-table">
				
					<?php printf( $shortcode->output ); ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary koo-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#koo-sc-form-table -->
				
			</form>
			<!-- /#koo-sc-form -->
		
		</div>
		<!-- /#koo-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#koo-shortcode-wrap -->

</div>
<!-- /#koo-popup -->

</body>
</html>