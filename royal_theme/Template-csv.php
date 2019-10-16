<?php
/**
 * Template Name: CSV
 * 
 * Page template file on Twenty Fifteen theme
 */
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
			
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">

				<?php
				if( isset($_POST['csv_submit'] ) ) {
				    if( $_FILES['csv']['size'] > 0 ) {
				      
				        // get the csv file
				        $file = $_FILES['csv']['tmp_name'];
				        
				        // read the file
				        $handle = fopen( $file, 'r' );
				        
				        // a simple counter
				        $find_header = 0;
				        
				        while( $data = fgetcsv( $handle ) ) {
				          
				          // update counter
				          $find_header++;
				          
				          // skipping the header line from CSV
				          if( $find_header > 1 ) {
				          	global $current_user;
				          	$user_id = $current_user->ID;
				          	//as post type data (CPT: 'employees')
				            $post_id = wp_insert_post( array(
				            		'post_status'	=> 'publish',
				            		'post_type'		=> 'post', //assumed we've a CPT
				            		'post_author'	=> $user_id,
				            		'post_title'	=> $data[1] //name field
				            	) );
				            //as custom field
				            if( !is_wp_error( $post_id ) ) {
				            	update_post_meta( $post_id, 'emp_id', $data[0] ); //id
				            	update_post_meta( $post_id, 'emp_desig', $data[2] ); //designation
				            	update_post_meta( $post_id, 'emp_age', $data[3] ); //age
				            }
				          }
				        }
				    }
				}
				?>

				<form method="post" enctype="multipart/form-data">
					<p>Choose a <code>.csv</code> file and hit the <kbd>submit</kbd> button to upload:</p>
					<input type="file" name="csv"><br>
					<input type="submit" name="csv_submit" value="Submit">
				</form>

			</div><!-- .entry-content -->
		</article><!-- #post -->

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>