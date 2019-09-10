<?php

namespace NikolayS93\WPAdminPage;

class Section {
	static private $tab_exists;
	static private $pane_exists;

	private $handle;
	private $title;
	private $callback;

	function __construct( $handle, $title, $callback ) {
		self::$tab_exists  = false;
		self::$pane_exists = false;

		$this->handle = $handle;
		$this->title  = $title;

		if ( $callback = Util::switch_to_callable( $callback ) ) {
			$this->callback = $callback;
		}
	}

	function tab_button() {
		if ( ! self::$tab_exists ) {
			echo '<style>#tabs.navs {padding-bottom: 0;margin: 0 0 8px;}</style>';
			echo '<h2 id="tabs" class="navs nav-tab-wrapper">';
		}

		$host = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://" .
		        $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		$get = array();
		foreach ( $_GET as $key => $value ) {
			if ( $key !== 'tab' ) {
				$get[] = $key . '=' . $value;
			}
		}

		$get[] = 'tab=' . $this->handle;

		$href  = $host . '?' . implode( '&', $get );
		$class = $this->handle == $this->get_current_tab() ? 'nav-tab nav-tab-active' : 'nav-tab';

		echo sprintf( '<a href="%s" class="%s" data-tab="%s">%s</a>',
			esc_url( $href ),
			$class,
			esc_attr( $this->handle ),
			esc_html( $this->title )
		);

		self::$tab_exists = true;
	}

	function tab_pane() {
		if ( ! self::$pane_exists ) {
			echo '</h2>';
		}

		if ( empty( $this->callback ) ) {
			return false;
		}

		if ( ! empty( $_GET['tab'] ) ) {
			$class = $this->handle !== $this->get_current_tab() ? 'hidden' : '';
		} else {
			$class = ( ! self::$pane_exists ) ? '' : 'hidden';
		}


		echo '<div id="' . esc_attr( $this->handle ) . '" class="' . $class . '">';
		call_user_func( $this->callback );
		echo '</div>';

		self::$pane_exists = true;
	}

	function get_current_tab() {
		$current = false;
		if ( ! empty( $_GET['tab'] ) ) {
			$current = sanitize_text_field( $_GET['tab'] );
		} else {
			if ( ! self::$tab_exists ) {
				$current = $this->handle;
			}
		}

		return $current;
	}
}
