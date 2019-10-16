add_action( 'wp_enqueue_scripts' 'tutsresponsive_enqueue' );  
function tutsresponsive_enqueue() {  
    wp_enqueue_script( 'responsive-images', get_theme_directory_uri() . '/responsive-images.js', array( 'jquery' ) );  
}