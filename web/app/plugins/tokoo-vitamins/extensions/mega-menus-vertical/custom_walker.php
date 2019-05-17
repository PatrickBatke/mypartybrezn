<?php

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class Tokoo_Megamenus_Walker extends Walker_Nav_Menu {
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {		   
	   
		global $wp_query;

		$indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names 	= $value = '';
		$classes 		= empty( $item->classes ) ? array() : (array) $item->classes;

		if ( $item->mega_menu == "on" ) {
			array_push( $classes, "mega-menu" );
		}

		if( $item->background_url != "" || $item->mm_pb != "" || $item-> mm_pr != "" ){
			$mm_bg = ' data-bg="'.$item->background_url .'"';
			$mm_pb = ' data-pb="'.$item->mm_pb .'"';
			$mm_pr = ' data-pr="'.$item->mm_pr .'"';
			$mm_attr = $mm_bg . $mm_pb . $mm_pr;
		} else {
			$mm_attr = "";
		}
	
		$class_names 	 = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names 	 = ' class="'. esc_attr( $class_names ) . '"';
		$output 		.= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names . $mm_attr . '>';
		$attributes  	 = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes 	.= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes 	.= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
		$prepend     	 = ! empty( $item->icon_code) ? '<i class="'. esc_attr($item->icon_code) .'"></i>': '';
		$append 		 = '';
	    $description      = ! empty( $item->description ) ? '<span class="menu-desc">'.esc_attr( $item->description ).'</span>' : '';
	
	   // if($depth != 0)
	   // {
		  //  $description = $append = $prepend = "";
	   // }
	
		$item_output  = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.'<span class="menu-label">'.apply_filters( 'the_title', $item->title, $item->ID ).'</span>'.$append;
		$item_output .= $description.$args->link_after;
		//$item_output .= ' '.$item->background_url.'</a>';
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->background_url = $item->background_url, $args->mm_pb = $item->mm_pb, $args->mm_pr = $item->mm_pr );
	 }
	 
	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu level-".$depth."\" >\n";
	}
}