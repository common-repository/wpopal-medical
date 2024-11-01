<?php

add_action( 'widgets_init', 'opalmedical_widgets_init' );

if ( ! function_exists( 'opalmedical_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function opalmedical_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar Medical', 'wpopalbootstrap' ),
			'id'            =>  'right-sidebar-medical',
			'description'   => esc_html__( 'Right sidebar medical widget area', 'wpopalbootstrap' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar Medical', 'wpopalbootstrap' ),
			'id'            => 'left-sidebar-medical',
			'description'   => esc_html__( 'Left sidebar medical widget area', 'wpopalbootstrap' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
} // endif function_exists( 'opalmedical_widgets_init' ).