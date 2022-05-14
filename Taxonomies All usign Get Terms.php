 <?php 
$terms = get_terms( 'product_cat' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    echo '<ul>';
    foreach ( $terms as $term ) {
        echo '<li>' . $term->name . '</li>';
    }
    echo '</ul>';
}
 ?>