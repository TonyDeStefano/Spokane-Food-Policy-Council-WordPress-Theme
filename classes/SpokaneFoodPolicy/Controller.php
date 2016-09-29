<?php

namespace SpokaneFoodPolicy;

class Controller {

	const VERSION = '1.0.0';
	const VERSION_CSS = '1.0.0';
	const VERSION_JS = '1.0.0';

	const MENU_MAIN = 'main_menu';
	const OPTION_NAME = 'spf_theme_options_spokane_food_policy';
	const OPTION_VERSION = 'spokane_food_policy_version';

	private $attributes;
	private $errors;

	/**
	 * @return mixed
	 */
	public function getErrors()
	{
		return ( $this->errors === NULL ) ? array() : $this->errors;
	}

	/**
	 * @param $error
	 *
	 * @return $this
	 */
	public function addError( $error )
	{
		if( $this->errors === NULL )
		{
			$this->errors = array();
		}

		$this->errors[] = $error;
		return $this;
	}

	public function theme_setup()
	{
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		register_nav_menus( array(
			self::MENU_MAIN => __( 'Main Menu', 'spokane-food-policy' )
		) );

		$this->checkForUpdates();
	}

	public function checkForUpdates()
	{
		$version = get_option( self::OPTION_VERSION, '' );

		if ( $version != self::VERSION )
		{
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
			global $wpdb;

			$charset_collate = '';
			if ( ! empty( $wpdb->charset ) )
			{
				$charset_collate .= " DEFAULT CHARACTER SET " . $wpdb->charset;
			}
			if ( ! empty( $wpdb->collate ) )
			{
				$charset_collate .= " COLLATE " . $wpdb->collate;
			}

			update_option( self::OPTION_VERSION, self::VERSION );
		}
	}

	public function enqueue_styles_and_scripts()
	{
		wp_enqueue_style( 'spokane-food-policy-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array() );
		wp_enqueue_style( 'spokane-food-policy-bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', array() );
		wp_enqueue_style( 'spokane-food-policy-styles', get_stylesheet_uri(), array(), ( WP_DEBUG ) ? time() : self::VERSION_CSS );

		wp_enqueue_script( 'spokane-food-policy-bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'spokane-food-policy-font-awesome', 'https://use.fontawesome.com/0753562cc9.js', array() );
	}

	public function enqueue_admin_styles_and_scripts()
	{
		//$this->enqueue_styles_and_scripts();
	}

	public function editor_styles()
	{
		add_editor_style( 'editor-style.css' );
	}

	public function widgets_init()
	{
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'spokane-food-policy' ),
			'id'            => 'sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'spokane-food-policy' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<p class="wtitle">',
			'after_title'   => '</p>',
		) );
	}

	/**
	 * @param \WP_Customize_Manager $wp_customize
	 */
	public function customizer( $wp_customize )
	{
		$wp_customize->get_section( 'header_image' )->title    = __( 'Header', 'spokane-food-policy' );
		$wp_customize->get_section( 'header_image' )->priority = 30;

		$wp_customize->add_control( 'layout_home_control',
			array(
				'settings'        => self::OPTION_NAME . '[layout_home]',
				'label'           => __( "Layout on Home", 'spokane-food-policy' ),
				'section'         => 'layout',
				'active_callback' => 'is_home',
				'type'            => 'select',
				'choices'         => array(
					'rightbar' => __( "Rightbar", 'spokane-food-policy' ),
					'leftbar'  => __( "Leftbar", 'spokane-food-policy' ),
					'full'     => __( "Fullwidth Content", 'spokane-food-policy' ),
					'center'   => __( "Centered Content", 'spokane-food-policy' ),
					'lala'   => __( "lala Content", 'spokane-food-policy' )
				),
			)
		);
	}

	public function page_layout_box()
	{
		add_meta_box( 'sfp-page-layout', __( 'Select Layout', 'spokane-food-policy' ), array( $this, 'sfp_page_layout' ), 'page', 'side', 'default' );
	}

	public function sfp_page_layout()
	{
		global $post;

		$page_layout = $this->get_default_page_layouts();

		wp_nonce_field( basename( __FILE__ ), 'sfp_meta_box_nonce' );

		foreach ( $page_layout as $field )
		{
			$layout_meta = get_post_meta( $post->ID, $field['id'], TRUE );

			if ( empty( $layout_meta ) )
			{
				$layout_meta = 'default';
			}

			echo '
				<label>
					<input type="radio" name="' . $field['id'] . '" value="' . $field['value'] . '" ' . checked( $field['value'], $layout_meta, FALSE ) . '>
					' . $field['label'] . '
				</label><br>';
		}
	}

	public function get_default_page_layouts()
	{
		return array(
			'default-layout' => array(
				'id'    => 'sfp_page_layout',
				'value' => 'default',
				'label' => __( 'Default', 'spokane-food-policy' )
			),
			'rightbar'       => array(
				'id'    => 'sfp_page_layout',
				'value' => 'rightbar',
				'label' => __( 'Rightbar', 'spokane-food-policy' )
			),
			'leftbar'        => array(
				'id'    => 'sfp_page_layout',
				'value' => 'leftbar',
				'label' => __( 'Leftbar', 'spokane-food-policy' )
			),
			'full'           => array(
				'id'    => 'sfp_page_layout',
				'value' => 'full',
				'label' => __( 'Fullwidth Content', 'spokane-food-policy' )
			)
		);
	}

	public function save_custom_page_meta( $post_id )
	{
		$page_layout = $this->get_default_page_layouts();

		// Verify the nonce before proceeding.
		if ( ! isset( $_POST['sfp_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['sfp_meta_box_nonce'], basename( __FILE__ ) ) )
		{
			return FALSE;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		{
			return FALSE;
		}

		if ( 'page' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
			{
				return $post_id;
			}
		}
		elseif ( ! current_user_can( 'edit_post', $post_id ) )
		{
			return $post_id;
		}

		foreach ( $page_layout as $field )
		{
			$old = get_post_meta( $post_id, $field['id'], TRUE );
			$new = isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : 'default';
			if ( $new && $new != $old )
			{
				update_post_meta( $post_id, $field['id'], $new );
			}
			elseif ( '' == $new && $old )
			{
				delete_post_meta( $post_id, $field['id'], $old );
			}
		}

		return TRUE;
	}

	public function get_theme_option( $key )
	{
		$cache = wp_cache_get( self::OPTION_NAME );
		if ( $cache )
		{
			return ( isset( $cache[ $key ] ) ) ? $cache[ $key ] : FALSE;
		}

		$opt = get_option( self::OPTION_NAME );

		wp_cache_add( self::OPTION_NAME, $opt );

		return ( isset( $opt[ $key ] ) ) ? $opt[ $key ] : FALSE;
	}

	public function has_left_side_bar()
	{
		/** @var \WP_Post $post */
		global $post;

		$layout = get_post_meta( $post->ID, 'sfp_page_layout', FALSE );

		if ( isset( $layout[0] ) && $layout[0] == 'leftbar' )
		{
			return TRUE;
		}

		return FALSE;
	}

	public function has_right_side_bar()
	{
		/** @var \WP_Post $post */
		global $post;

		$layout = get_post_meta( $post->ID, 'sfp_page_layout', FALSE );

		if ( isset( $layout[0] ) && $layout[0] == 'rightbar' )
		{
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * @param $menu
	 *
	 * @return MenuItem[]
	 */
	public function get_menu_items( $menu )
	{
		/** @var MenuItem[] $menu_items */
		$menu_items = array();

		$menu_locations = get_nav_menu_locations();
		$menu = $menu_locations[ $menu ];
		$menus = wp_get_nav_menu_items( $menu );

		if ( $menus !== FALSE )
		{
			/** @var \WP_Post $menu*/

			foreach ( $menus as $menu )
			{
				$menu_item = new MenuItem;
				$menu_item
					->setTitle( $menu->title )
					->setUrl( $menu->url );

				if ( $menu->menu_item_parent == 0 )
				{
					$menu_items[ $menu->ID ] = $menu_item;
				}
				elseif ( array_key_exists( $menu->menu_item_parent, $menu_items ) )
				{
					$menu_items[ $menu->menu_item_parent ]->addChild( $menu_item );
				}
			}
		}

		return $menu_items;
	}

	public function admin_menus()
	{
		add_menu_page( 'White Angus', 'White Angus', 'manage_options', 'sfp_white_angus', array( $this, 'print_settings_page' ), 'dashicons-awards' );
		add_submenu_page( 'sfp_white_angus', 'General Settings', 'General Settings', 'manage_options', 'sfp_white_angus' );
		add_submenu_page( 'sfp_white_angus', 'Homepage Boxes', 'Homepage Boxes', 'manage_options', 'sfp_white_angus_homepage_boxes', array( $this, 'print_homepage_boxes_page' ) );
		add_submenu_page( 'sfp_white_angus', 'Hover Cow', 'Hover Cow', 'manage_options', 'sfp_white_angus_hover_cow', array( $this, 'print_hover_cow_page' ) );
		add_submenu_page( 'sfp_white_angus', 'Members', 'Members', 'manage_options', 'sfp_white_angus_members', array( $this, 'print_members_page' ) );
	}

	public function print_settings_page()
	{
		include( dirname( dirname( __DIR__ ) ) . '/includes/settings.php' );
	}

	public function print_homepage_boxes_page()
	{
		include( dirname( dirname( __DIR__ ) ) . '/includes/homepage_boxes.php' );
	}

	public function print_hover_cow_page()
	{
		include( dirname( dirname( __DIR__ ) ) . '/includes/hover_cow.php' );
	}

	public function print_members_page()
	{
		include( dirname( dirname( __DIR__ ) ) . '/includes/members.php' );
	}

	public function register_settings()
	{

	}

	public static function addHttp( $link )
	{
		if ( strlen( $link ) > 0 && strtolower( substr( $link, 0 , 4 ) ) != 'http' )
		{
			$link = 'http://' . $link;
		}

		return $link;
	}

	public function short_code( $attributes )
	{
		$this->attributes = shortcode_atts( array(
			'page' => ''
		), $attributes );

		ob_start();
		include( dirname( dirname( __DIR__ ) ) . '/includes/shortcode.php' );
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public function getAttribute( $key )
	{
		if ( array_key_exists( $key, $this->attributes ) )
		{
			return $this->attributes[ $key ];
		}

		return '';
	}

	public function add_favicon()
	{
		echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/img/favicon.ico">';
	}

	public function add_to_querystring( array $args, $remove_old_query_string=FALSE )
	{
		$url = $_SERVER['REQUEST_URI'];
		$parts = explode( '?', $url );
		$url = $parts[0];
		$querystring = array();
		if ( count( $parts ) > 1 )
		{
			$parts = explode( '&', $parts[1] );
			foreach ( $parts as $part )
			{
				if ( ! $remove_old_query_string || substr( $part, 0, 3 ) == 'id=' )
				{
					$querystring[] = $part;
				}
			}
		}

		foreach ( $args as $key => $val )
		{
			$querystring[] = $key . '=' . $val;
		}

		return $url . ( ( count( $querystring ) > 0 ) ? '?' . implode( '&', $querystring ) : '' );
	}

	public function form_capture()
	{
		if ( isset( $_POST['sfp_white_angus_action'] ) )
		{
			if ( isset( $_POST['sfp_white_angus_nonce'] ) && wp_verify_nonce( $_POST['sfp_white_angus_nonce'], 'sfp_white_angus_' . $_POST['sfp_white_angus_action'] ) )
			{
				switch ( $_POST['sfp_white_angus_action'] )
				{
					case 'signup':

						$current_user = wp_get_current_user();

						if ( strlen( $_POST['email'] ) == 0 )
						{
							$this->addError( 'Please enter your email address.' );
						}
						elseif ( ! is_email( $_POST['email'] ) )
						{
							$this->addError( 'Please enter a valid email address.' );
						}
						elseif ( email_exists( $_POST['email'] ) )
						{
							if ( ! is_user_logged_in() || strtolower( $current_user->user_email ) != strtolower( $_POST['email'] ) )
							{
								$this->addError( 'The email address you entered already exists in our registry.' );
							}
						}

						if ( ! is_user_logged_in() )
						{
							if ( 4 > strlen( $_POST['username'] ) )
							{
								$this->addError( 'Username too short. At least 4 characters is required.' );
							}
							elseif ( username_exists( $_POST['username'] ) )
							{
								$this->addError( 'Sorry, that username already exists.' );
							}
							elseif ( ! validate_username( $_POST['username'] ) )
							{
								$this->addError( 'Sorry, the username you entered is not valid.' );
							}

							if ( 5 > strlen( $_POST['password'] ) )
							{
								$this->addError( 'Password length must be greater than 5.' );
							}
						}

						if ( strlen( $_POST['fname'] ) == 0 )
						{
							$this->addError( 'Please enter your first name.' );
						}

						if ( strlen( $_POST['lname'] ) == 0 )
						{
							$this->addError( 'Please enter your last name.' );
						}

						if ( strlen( $_POST['address'] ) == 0 )
						{
							$this->addError( 'Please enter your address.' );
						}

						if ( strlen( $_POST['city'] ) == 0 )
						{
							$this->addError( 'Please enter your city.' );
						}

						if ( strlen( $_POST['state'] ) == 0 )
						{
							$this->addError( 'Please enter your state.' );
						}

						if ( strlen( $_POST['zip'] ) == 0 )
						{
							$this->addError( 'Please enter your zip code.' );
						}

						if ( strlen( $_POST['phone'] ) == 0 )
						{
							$this->addError( 'Please enter your phone number.' );
						}

						if ( count( $this->getErrors() ) == 0 )
						{
							$member = new Member;
							$member
								->setFirstName( $_POST['fname'] )
								->setLastName( $_POST['lname'] )
								->setEmail( $_POST['email'] )
								->setFarmName( $_POST['farm_name'] )
								->setAddress( $_POST['address'] )
								->setCity( $_POST['city'] )
								->setState( $_POST['state'] )
								->setZip( $_POST['zip'] )
								->setPhone( $_POST['phone'] );


							if ( is_user_logged_in() )
							{
								$member->setWpUserId( get_current_user_id() );
							}
							else
							{
								$user_data = array(
									'user_login' => $_POST['username'],
									'user_email' => $_POST['email'],
									'user_pass'  => $_POST['password'],
									'first_name' => $_POST['fname'],
									'last_name'  => $_POST['lname']
								);
								$user_id = wp_insert_user( $user_data );
								$member->setWpUserId( $user_id );
							}

							$member->create();

							header( 'Location:' . $this->add_to_querystring( array( 'action' => 'signedup' ), TRUE ) );
							exit;
						}

						break;

				}
			}
			else
			{
				$this->addError( 'It appears you are submitting this form from a different website' );
			}
		}
	}
}