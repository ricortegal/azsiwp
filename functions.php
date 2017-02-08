<?php
/**
 * azsiwp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package azsiwp
 */
if ( ! function_exists( 'azsiwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function azsiwp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on azsiwp, use a find and replace
	 * to change 'azsiwp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'azsiwp', get_template_directory() . '/languages' );
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
		'menu-1' => esc_html__( 'Primary', 'azsiwp' ),
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
	add_theme_support( 'custom-background', apply_filters( 'azsiwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'azsiwp_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function azsiwp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'azsiwp_content_width', 640 );
}
add_action( 'after_setup_theme', 'azsiwp_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function azsiwp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'azsiwp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'azsiwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'azsiwp_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function azsiwp_scripts() {
	wp_enqueue_style( 'azsiwp-style', get_stylesheet_uri() );
	wp_enqueue_script( 'azsiwp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'azsiwp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'azsiwp_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//Pruebas
add_action('wp_enqueue_scripts','tipografia_google_css');
function tipografia_google_css() {
	wp_enqueue_style( 'tipografias-google-font', 'https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto:400,400i,700,700i', false ); 
}


// //Últimos post submenu
// // Front end only, don't hack on the settings page
// if ( ! is_admin() ) {
// // Hook in early to modify the menu
// // This is before the CSS "selected" classes are calculated
// add_filter( 'wp_get_nav_menu_items', 'display_lasts_ten_posts_for_categories_menu_item', 10, 3 );
// }

// // Add the ten last posts of af categroy menu item in a sub menu
// function display_lasts_ten_posts_for_categories_menu_item( $items, $menu, $args ) {


// $menu_order = count($items); /* Offset menu order */
// $child_items = array();

// // Loop through the menu items looking category menu object
// foreach ( $items as $item ) {

//     // Test if menu item is a categroy and has no sub-category
//     if ( 'category' != $item->object || ('category' == $item->object && get_category_children($item->object_id)) )
//         continue;

//     // Query the lasts ten category posts
//     $category_ten_last_posts = array(
//             'numberposts' => 10,
//             'cat' => $item->object_id,
//             'orderby' => 'date',
//             'order' => 'DESC'
//     );

//     foreach ( get_posts( $category_ten_last_posts ) as $post ) {
//         // Add sub menu item
//         $post->menu_item_parent = $item->ID;
//         $post->post_type = 'nav_menu_item';
//         $post->object = 'custom';
//         $post->type = 'custom';
//         $post->menu_order = ++$menu_order;
//         $post->title = $post->post_title;
//         $post->url = get_permalink( $post->ID );
//         /* add children */
//         $child_items[]= $post;
//     }
// }
// return array_merge( $items, $child_items );
// }


//Añadir metabox curso

// Añade el metabox para los artículos en el lateral de la pantalla
function add_curso_metaboxes()
{
   // ID metabox, título metabox, función que muestra los atributos, tipo de post, zona metabox, prioridad
   add_meta_box('curso_meta', 'Datos del curso', 'curso_atributos', 'curso', 'side', 'default');
}

// Acción que llama a la función que añade el metabox para los artículos
add_action( 'add_meta_boxes', 'add_curso_metaboxes' );

// Función que muestra los atributos del artículo
function curso_atributos()
{
   global $post;

   // Noncename necesario para verificar de dónde vienen los datos
   echo '<input type="hidden" name="articulometa_noncename" id="articulometa_noncename" value="' .
   wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

   // Obtenemos los atributos del artículo si estuvieran guardados, con get_post_meta y el nombre del atributo
   $marca = get_post_meta($post->ID, '_marca', true);
   $precio = get_post_meta($post->ID, '_precio', true);
   $talla = get_post_meta($post->ID, '_talla', true);

   // Mostramos los campos de texto donde introduciremos los atributos
   echo '<p>Marca</p>';
   echo '<input type="text" name="_marca" value="' . $marca . '" class="widefat" />';
   echo '<p>Precio</p>';
   echo '<input type="text" name="_precio" value="' . $precio . '" class="widefat" />';
   echo '<p>Talla</p>';
   echo '<input type="text" name="_talla" value="' . $talla . '" class="widefat" />';
}

// Guarda los campos personalizados
function save_curso_meta($post_id, $post)
{
   // Comprobación de seguridad para que no se acceda desde otros sitios
   if ( !wp_verify_nonce( $_POST['articulometa_noncename'], plugin_basename(__FILE__) )) {
      return $post->ID;
   }

   // Comprobación de que el usuario actual puede editar
   if ( !current_user_can( 'edit_post', $post->ID ))
      return $post->ID;

   // Obtenemos los atributos guardados en POST cuando guardamos nuestra página de artículo
   $articulos_meta['_marca'] = $_POST['_marca'];
   $articulos_meta['_precio'] = $_POST['_precio'];
   $articulos_meta['_talla'] = $_POST['_talla'];

   // Guardamos los valores de los atributos como campos personalizados
   foreach ($articulos_meta as $key => $value)
   {
      if( $post->post_type == 'revision' ) return; // No guardamos si el post es una revisión
      if(get_post_meta($post->ID, $key, FALSE))
      {
         // Si el atributo ya existía, lo actualizamos
         update_post_meta($post->ID, $key, $value);
      }
      else
      {
         // Si no existía, lo añadimos nuevo
         add_post_meta($post->ID, $key, $value);
      }

      // Si el valor está en blanco, eliminamos el atributo
      if(!$value) delete_post_meta($post->ID, $key);
   }
}

// Llamamos a guardar los atributos cuando guardemos el artículo
add_action('save_post', 'save_curso_meta', 1, 2);