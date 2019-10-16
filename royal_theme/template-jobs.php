<?php
/*
Template Name: Jobs
*/
get_header(); ?>
<?php
if ( has_post_thumbnail() ) {
     the_post_thumbnail('inner_top', array('class' => 'inner_top', 'alt' => ''));
     } else {
     echo "<img src='" . get_bloginfo('template_directory')."/images/inner_top.jpg' class='inner_top' />"; }
?>
<?php get_sidebar(); ?>

<div class="right_cont">  	
	<div class="single_post"><h1 class="archives-title">Jobs at  N. Biswas Group</h1></div>
	<div class="content">
	<?php
		// WP_Query arguments
		$args = array (
			'post_type'              => 'jobs',
			'posts_per_page'         => '-1',
		);
		// The Query
		$query = new WP_Query( $args );
		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
			<div class="archives_post">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>				
			<?php }
		} else {
			?>
			<h1 style="text-align:center">No Vacancy Available now</h1>	
			<?php
		}

		// Restore original Post Data
		wp_reset_postdata();
	 ?>
	</div>
</div>

<?php get_footer(); ?>