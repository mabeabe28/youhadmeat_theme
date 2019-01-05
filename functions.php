<?php
/**
 * youhadmeat_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package youhadmeat_theme
 */

if ( ! function_exists( 'youhadmeat_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function youhadmeat_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on youhadmeat_theme, use a find and replace
		 * to change 'youhadmeat_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'youhadmeat_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main' => esc_html__( 'Primary', 'youhadmeat_theme' ),
		) );

		register_nav_menus( array(
			'sidenav' => esc_html__( 'Side Navigation', 'youhadmeat_theme' ),
		) );

		register_nav_menus( array(
			'footer' => esc_html__( 'Footer', 'youhadmeat_theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'youhadmeat_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'youhadmeat_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function youhadmeat_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'youhadmeat_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'youhadmeat_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function youhadmeat_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'youhadmeat_theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'youhadmeat_theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'youhadmeat_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function youhadmeat_theme_scripts() {
	//wp_enqueue_style( 'youhadmeat_theme-style', get_stylesheet_uri() );
	//wp_enqueue_style( 'navigation-styles', get_template_directory_uri() . '/css/navigation-styles.css');
	//wp_enqueue_style( 'homepage-styles', get_template_directory_uri() . '/css/homepage-styles.css');
	//wp_enqueue_style( 'card-styles', get_template_directory_uri() . '/css/card-styles.css');
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/styles.css');


	wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/includes/icons/fontawesome/css/fontawesome-all.css');;

	wp_enqueue_script( 'youhadmeat_theme-navigation', get_template_directory_uri() . '/js/front-hero.js', array(), '20151215', true );

	wp_enqueue_script( 'youhadmeat_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'youhadmeat_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//wp_enqueue_script( 'youhadmeat_theme-cards', get_template_directory_uri() . '/js/cards.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'youhadmeat_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

	function wpb_image_editor_default_to_gd( $editors ) {
	    $gd_editor = 'WP_Image_Editor_GD';
	    $editors = array_diff( $editors, array( $gd_editor ) );
	    array_unshift( $editors, $gd_editor );
	    return $editors;
	}
	add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );

	/*create category colour settings*/
	function theme_customize_register( $wp_customize ) {

		$catargs = array(
			'parent' => 0
		);
		$categories=get_categories($catargs);
		//for each category
		foreach($categories as $curcat) {
			$wp_customize->add_setting( ''.$curcat->slug.'_colour', array(
					'default'   => '',
					'transport' => 'refresh',
				) );

			$wp_customize->add_setting( ''.$curcat->slug.'_icon', array(
					'default'   => '',
					'transport' => 'refresh',
				) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, ''.$curcat->slug.'_colour', array(
					'section' => 'colors',
					'label'   => esc_html__( ''.$curcat->name.' Colour', 'theme' ),
				) ) );

				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, ''.$curcat->slug.'_icon', array(
						'section' => 'colors',
						'label'   => esc_html__( ''.$curcat->name.' Icon', 'theme' ),
					) ) );
		}

	}
	add_action( 'customize_register', 'theme_customize_register' );

	/*create css to output cateory colour*/
	function theme_get_customizer_css() {
    ob_start();
		$catargs = array(
			'parent' => 0
		);
		//get top level categories
		$categories=get_categories($catargs);
		//loop through each category
		foreach($categories as $curcat) {
			//get the category colour setting
			$cat_colour = get_theme_mod( ''.$curcat->slug.'_colour', '' );
			$cat_icon = get_theme_mod( ''.$curcat->slug.'_icon', '' );

	    if ( ! empty( $cat_colour ) ) {

				//create css for that category--target
				echo '
				a.category--'.$curcat->slug.':hover{
					color:'.$cat_colour.';
					border-color:'.$cat_colour.';
				}

				.category--'.$curcat->slug.' .card-deck-header{
					background-color:'.$cat_colour.';
					color:white;
				}

				.card-header-category.category--'.$curcat->slug.'{
					/*background-color:'.$cat_colour.';*/
				}

				.card-wrapper.category--'.$curcat->slug.':after{
				    background-color:'.$cat_colour.';
				}
				.card-wrapper.category--'.$curcat->slug.':hover:after{
				   background-color:'.$cat_colour.';
				}

				a:hover{
					color:'.$cat_colour.';
				}


				#logo-item.category--'.$curcat->slug.' a:hover,
				#logo-item.page--'.$curcat->slug.' a:hover{
					color:'.$cat_colour.';
				}

				#divider.category--'.$curcat->slug.' #divider-content{
					border-color: '.$cat_colour.';
					border-right-color: transparent;
				}


				#divider.category--'.$curcat->slug.':after{
				    border-color: '.$cat_colour.';
				}

				/*#divider.category--'.$curcat->slug.' #divider-content .text:before{
					display: inline-block;
					font-family: FontAwesomeRegular,FontAwesomeSolid;
			    content: "'.$cat_icon.'";
				}*/


				.category--'.$curcat->slug.' .category-icon:after{
					font-family: FontAwesomeRegular,FontAwesomeSolid;
			    content: "'.$cat_icon.'";
					background-color: '.$cat_colour.';
				}

				.category--'.$curcat->slug.' .category-title{
					background-color: '.$cat_colour.';
				}

				.category--'.$curcat->slug.' .card-content-title:after{
				}

				';
			}
    }

    $css = ob_get_clean();
    return $css;
  }

	/*output category colour css*/
	function theme_enqueue_styles() {
		//wp_enqueue_style( 'card-styles', get_template_directory_uri() . '/css/card-styles.css');
	  $custom_css = theme_get_customizer_css();
	  wp_add_inline_style( 'styles', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


	/*custom field metaboxes*/
	function general_post_options() {
		add_meta_box(
			'general_post_options', // $id
			'General Options', // $title
			'show_general_post_options', // $callback
			'post', // $screen
			'normal', // $context
			'high' // $priority
		);
	}
	add_action( 'add_meta_boxes', 'general_post_options' );

	function show_general_post_options() {
		wp_nonce_field( basename( __FILE__ ), 'yhma_nonce' );
		global $post;
		$meta = get_post_meta( $post->ID );
		?>

		<section>
			<span class="title">General:</span>
			<br/><div class="hint">General Post Options</div>
			<br>
			<div class="input-wrapper">
				<label for="hideTitle">Hide Title</label>
				<br/><span class="hint">Choose whether to display the title or not.</span>
				<input type="checkbox" name="hideTitle" id="hideTitle" value="true" <?php if ( isset ( $meta['hideTitle'] ) && $meta['hideTitle'][0] == 1  ) echo 'checked="true"'; ?> />
			</div>
			<div class="input-wrapper">
				<label for="hideExcerpt">Hide Excerpt</label>
				<br/><span class="hint">Choose whether to display the excerpt or not.</span>
				<input type="checkbox" name="hideExcerpt" id="hideExcerpt" value="true" <?php if ( isset ( $meta['hideExcerpt'] ) && $meta['hideExcerpt'][0] == 1  ) echo 'checked="true"'; ?> />
			</div>
			<div class="input-wrapper">
				<label for="hideMeta">Hide Post Meta</label>
				<br/><span class="hint">Choose whether to display the post published date and author.</span>
				<input type="checkbox" name="hideMeta" id="hideMeta" value="true" <?php if ( isset ( $meta['hideMeta'] ) && $meta['hideMeta'][0] == 1  ) echo 'checked="true"'; ?> />
			</div>
			<div class="input-wrapper">
				<label for="comingsoon">Coming Soon</label>
				<br/><span class="hint">Selecting this, ensures any link to the post in Featured Sliders and cards are non-linkable, and show the words 'Coming Soon'</span>
				<input type="checkbox" name="comingsoon" id="comingsoon" value="true" <?php if ( isset ( $meta['comingsoon'] ) && $meta['comingsoon'][0] == 1  ) echo 'checked="true"'; ?> />
			</div>
		</section>

		<br>

		<style>
			section {
				margin: 20px;
			}

			.input-wrapper{
				margin-left: 10px;
				margin-right: 10px;

			}
			.input-wrapper label{
				width: 300px;
				display: inline-block;
				font-weight: bold;
			}
			.title{
				font-size: 1.2em;
				font-weight:bold;
				margin-top: 30px;
			}
			.hint{
				font-size: 0.9em;
				font-style: italic;
				width: 300px;
			}
			.input-wrapper .hint{
				width: 300px;
				display: inline-block;
				margin-top: 10px;
				margin-bottom: 10px;
			}
		</style>

		<?php }

		function general_post_options_save( $post_id ) {

				// Checks save status
				$is_autosave = wp_is_post_autosave( $post_id );
				$is_revision = wp_is_post_revision( $post_id );
				$is_valid_nonce = ( isset( $_POST[ 'yhma_nonce' ] ) && wp_verify_nonce( $_POST[ 'yhma_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

				// Exits script depending on save status
				if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
						return;
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'comingsoon' ] ) && $_POST[ 'comingsoon' ] == true ) {
						update_post_meta( $post_id, 'comingsoon', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'comingsoon', sanitize_text_field( false ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'hideTitle' ] ) && $_POST[ 'hideTitle' ] == true ) {
						update_post_meta( $post_id, 'hideTitle', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'hideTitle', sanitize_text_field( false ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'hideExcerpt' ] ) && $_POST[ 'hideExcerpt' ] == true ) {
						update_post_meta( $post_id, 'hideExcerpt', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'hideExcerpt', sanitize_text_field( false ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'hideMeta' ] ) && $_POST[ 'hideMeta' ] == true ) {
						update_post_meta( $post_id, 'hideMeta', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'hideMeta', sanitize_text_field( false ) );
				}



		}
		add_action( 'save_post', 'general_post_options_save' );

		/*General Page Options*/
		/*custom field metaboxes*/
		function general_page_options() {
			add_meta_box(
				'general_page_options', // $id
				'General Options', // $title
				'show_general_page_options', // $callback
				'page', // $screen
				'normal', // $context
				'high' // $priority
			);
		}
		add_action( 'add_meta_boxes', 'general_page_options' );

		function show_general_page_options() {
			wp_nonce_field( basename( __FILE__ ), 'yhma_nonce' );
			global $post;
			$meta = get_post_meta( $post->ID );
			?>

			<section>
				<span class="title">General:</span>
				<br/><div class="hint">General Page Options</div>
				<br>
				<div class="input-wrapper">

					<label for="page-type">Page Type</label>
					<br/><span class="hint">Choose what type of Page This is, Choosing Category/Author will add the Recent Posts cards according to the Category/Author.</span>
					<select name="page-type">
						<option value="normal" <?php if ( isset ( $meta['page-type'] ) && $meta['page-type'][0] == 'normal') echo 'selected'; ?> >Normal</option>
						<option value="category" <?php if ( isset ( $meta['page-type'] ) && $meta['page-type'][0] == 'category') echo 'selected'; ?> >Category</option>
						<option value="author" <?php if ( isset ( $meta['page-type'] ) && $meta['page-type'][0] == 'author') echo 'selected'; ?>>Author</option>
					</select>
					<br>

					<label for="post-display">Hide Title and Excerpt?</label>
					<br/><span class="hint">Choose wether to display the title and excerpt or not.</span>
					<input type="checkbox" name="hideTitle" id="hideTitle" value="true" <?php if ( isset ( $meta['hideTitle'] ) && $meta['hideTitle'][0] == 1  ) echo 'checked="true"'; ?> />

					<br>
					<label for="post-display">Recent Posts Display Type</label>
					<br/><span class="hint">Choose whether to show the recent posts section as cards, or as post previews.</span>
					<select name="post-display">
						<option value="cards" <?php if ( isset ( $meta['post-display'] ) && $meta['post-display'][0] == 'cards') echo 'selected'; ?> >Cards</option>
						<option value="previews" <?php if ( isset ( $meta['post-display'] ) && $meta['post-display'][0] == 'previews') echo 'selected'; ?> >Post Preview</option>
					</select>
				</div>
			</section>

			<br>

			<style>
				section {
					margin: 20px;
				}

				.input-wrapper{
					margin-left: 10px;
					margin-right: 10px;

				}
				.input-wrapper label{
					width: 300px;
					display: inline-block;
					font-weight: bold;
				}
				.title{
					font-size: 1.2em;
					font-weight:bold;
					margin-top: 30px;
				}
				.hint{
					font-size: 0.9em;
					font-style: italic;
					width: 300px;
				}
				.input-wrapper .hint{
					width: 300px;
					display: inline-block;
					margin-top: 10px;
					margin-bottom: 10px;
				}
			</style>

			<?php }

			function general_page_options_save( $post_id ) {

					// Checks save status
					$is_autosave = wp_is_post_autosave( $post_id );
					$is_revision = wp_is_post_revision( $post_id );
					$is_valid_nonce = ( isset( $_POST[ 'yhma_nonce' ] ) && wp_verify_nonce( $_POST[ 'yhma_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

					// Exits script depending on save status
					if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
							return;
					}

					// Checks for input and sanitizes/saves if needed
					if( isset( $_POST[ 'page-type' ] ) ) {
							update_post_meta( $post_id, 'page-type', sanitize_text_field( $_POST[ 'page-type' ] ) );
					}

					if( isset( $_POST[ 'post-display' ] ) ) {
							update_post_meta( $post_id, 'post-display', sanitize_text_field( $_POST[ 'post-display' ] ) );
					}

					// Checks for input and sanitizes/saves if needed
					if( isset( $_POST[ 'hideTitle' ] ) && $_POST[ 'hideTitle' ] == true ) {
							update_post_meta( $post_id, 'hideTitle', sanitize_text_field( true ) );
					}else{
							update_post_meta( $post_id, 'hideTitle', sanitize_text_field( false ) );
					}

			}
			add_action( 'save_post', 'general_page_options_save' );


	/*custom field metaboxes*/
	function custom_template_options() {
		add_meta_box(
			'custom_template_options', // $id
			'Template Options', // $title
			'show_custom_template_options', // $callback
			'', // $screen
			'normal', // $context
			'high' // $priority
		);
	}
	add_action( 'add_meta_boxes', 'custom_template_options' );

	function show_custom_template_options() {
		wp_nonce_field( basename( __FILE__ ), 'yhma_nonce' );
		global $post;
		$meta = get_post_meta( $post->ID );
		?>


		<section>
			<span class="title">Full Screen/Default Featured Image Options:</span>
			<br/><div class="hint">Theme Options if using the Default Template</div>
			<br>
			<div class="input-wrapper">
				<label for="text-on-image">Text on Image?</label>
				<br/><span class="hint">Determines whether the Title and Excerpt will be shown on top of the image, or under the Featured Image.</span>
				<input type="checkbox" name="text-on-image" id="text-on-image" value="true"  <?php if ( isset ( $meta['text-on-image'] ) && $meta['text-on-image'][0] == 1  ) echo 'checked="true"'; ?> />
			</div>
		</section>
		<br>
		<section>
			<span class="title">Portrait Featured Image Options:</span>
			<br/><div class="hint">Theme Options if using the Portrait Template</div>
			<br>
			<div class="input-wrapper">
				<label for="featured-is-fixed">Featured Image Fixed Position</label>
				<br/><span class="hint">If selected, the Featured Image will stay in position as you scroll. You will then have to position the content to the corresponding side in the editor</span>
				<input type="checkbox" name="featured-is-fixed" id="featured-is-fixed" value="true" <?php if ( isset ( $meta['featured-is-fixed'] ) && $meta['featured-is-fixed'][0] == 1  ) echo 'checked="true"'; ?> />
				<br>
				<label for="featured-position">Featured Image Position</label>
				<br/><span class="hint">Determines which side the Featured Image would be on.</span>
				<select name="featured-position">
					<option value="left" <?php if ( isset ( $meta['featured-position'] ) && $meta['featured-position'][0] == 'left') echo 'selected'; ?> >Left</option>
					<option value="right" <?php if ( isset ( $meta['featured-position'] ) && $meta['featured-position'][0] == 'right') echo 'selected'; ?>>Right</option>
				</select>
				<br>
				<label for="featured-theme">Featured Image Theme</label>
				<br/><span class="hint">Determines wether the Excerpt section is in a Light or Dark theme.</span>
				<select name="featured-theme">
				  <option value="light" <?php if ( isset ( $meta['featured-theme'] ) && $meta['featured-theme'][0] == 'light') echo 'selected'; ?>>Light</option>
					<option value="dark" <?php if ( isset ( $meta['featured-theme'] ) && $meta['featured-theme'][0] == 'dark') echo 'selected'; ?> >Dark</option>
				</select>
			</div>
		</section>
		<br>

		<style>
			section {
				margin: 20px;
			}

			.input-wrapper{
				margin-left: 10px;
				margin-right: 10px;

			}
			.input-wrapper label{
				width: 300px;
				display: inline-block;
				font-weight: bold;
			}
			.title{
				font-size: 1.2em;
				font-weight:bold;
				margin-top: 30px;
			}
			.hint{
				font-size: 0.9em;
				font-style: italic;
				width: 300px;
			}
			.input-wrapper .hint{
				width: 300px;
				display: inline-block;
				margin-top: 10px;
				margin-bottom: 10px;
			}
		</style>

		<?php }

		function custom_template_options_save( $post_id ) {

		    // Checks save status
		    $is_autosave = wp_is_post_autosave( $post_id );
		    $is_revision = wp_is_post_revision( $post_id );
		    $is_valid_nonce = ( isset( $_POST[ 'yhma_nonce' ] ) && wp_verify_nonce( $_POST[ 'yhma_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		    // Exits script depending on save status
		    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		        return;
		    }


				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'text-on-image' ] ) && $_POST[ 'text-on-image' ] == true ) {
						update_post_meta( $post_id, 'text-on-image', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'text-on-image', sanitize_text_field( false ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'featured-is-fixed' ] ) && $_POST[ 'featured-is-fixed' ] == true ) {
						update_post_meta( $post_id, 'featured-is-fixed', sanitize_text_field( true ) );
				}else{
						update_post_meta( $post_id, 'featured-is-fixed', sanitize_text_field( false ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'featured-position' ] ) ) {
						update_post_meta( $post_id, 'featured-position', sanitize_text_field( $_POST[ 'featured-position' ] ) );
				}

				// Checks for input and sanitizes/saves if needed
				if( isset( $_POST[ 'featured-theme' ] ) ) {
						update_post_meta( $post_id, 'featured-theme', sanitize_text_field( $_POST[ 'featured-theme' ] ) );
				}

		}
		add_action( 'save_post', 'custom_template_options_save' );

add_action( 'show_user_profile', 'social_profile_fields' );
add_action( 'edit_user_profile', 'social_profile_fields' );


function social_profile_fields( $user ) { ?>
    <h3><?php _e("Social Profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="social_instagram"><?php _e("Instagram"); ?></label></th>
        <td>
            <input type="text" name="social_instagram" id="social_instagram" value="<?php echo esc_attr( get_the_author_meta( 'social_instagram', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your instagram url."); ?></span>
        </td>
    </tr>
		<tr>
				<th><label for="social_twitter"><?php _e("Twitter"); ?></label></th>
				<td>
						<input type="text" name="social_twitter" id="social_twitter" value="<?php echo esc_attr( get_the_author_meta( 'social_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
						<span class="description"><?php _e("Please enter your twitter url."); ?></span>
				</td>
		</tr>
		<tr>
				<th><label for="social_facebook"><?php _e("Facebook"); ?></label></th>
				<td>
						<input type="text" name="social_facebook" id="social_facebook" value="<?php echo esc_attr( get_the_author_meta( 'social_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
						<span class="description"><?php _e("Please enter your facebook url."); ?></span>
				</td>
		</tr>


    </table>
<?php }

add_action( 'personal_options_update', 'save_social_profile_fields' );
add_action( 'edit_user_profile_update', 'save_social_profile_fields' );

function save_social_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'social_twitter', $_POST['social_twitter'] );
		update_user_meta( $user_id, 'social_facebook', $_POST['social_facebook'] );
		update_user_meta( $user_id, 'social_instagram', $_POST['social_instagram'] );
}
