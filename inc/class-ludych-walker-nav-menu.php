<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Ludych_Walker_Nav_Menu extends Walker_Nav_Menu {

	private $has_many_children = false;

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( isset( $children_elements[ $element->ID ] ) && count( $children_elements[ $element->ID ] ) > 10 ) {
			$this->has_many_children = true;
		} else {
			$this->has_many_children = false;
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );

		$classes = array( 'dropdown-menu shadow' );
		if ( $this->has_many_children ) {
			$classes[] = 'dropdown-menu-columns';
		}

		$class_names = implode( ' ', $classes );

		$output .= "\n$indent<ul class=\"$class_names\">\n";
	}

	/**
	 * @param string   $output
	 * @param object   $item
	 * @param int      $depth
	 * @param stdClass $args
	 * @param int      $id
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_child = in_array( 'menu-item-has-children', $classes, true );

		$li_classes = array( 'nav-item' );
		if ( $has_child ) {
			$li_classes[] = 'dropdown';
		}
		if ( $has_child && $depth >= 1 ) {
			$li_classes[] = 'dropdown-submenu';
		}

		$class_names = implode( ' ', array_map( 'esc_attr', array_filter( array_unique( array_merge( $li_classes, $classes ) ) ) ) );

		$output .= $indent . '<li class="' . $class_names . '">';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$link_classes = array( 0 === $depth ? 'nav-link' : 'dropdown-item' );

		if ( $has_child ) {
			$link_classes[]         = 'dropdown-toggle';
			$atts['role']           = 'button';
			$atts['data-bs-toggle'] = 'dropdown';
			$atts['aria-expanded']  = 'false';
		}

		$atts['class'] = implode( ' ', array_map( 'esc_attr', $link_classes ) );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( '' !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before ?? '';
		$item_output .= esc_html( $title );
		$item_output .= $args->link_after ?? '';
		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
