<?php
/**
 * The single file.
 */

get_header(); ?>

<div class="maincontent">  <!-- Main content Start -->
<div class="mainbody teacherpage">  <!-- Main content Start -->
					<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
			<h2 class="custom-page-title">Bio of <?php the_title(); ?></h2>
			<?php
			if ( has_post_thumbnail() ) {
			the_post_thumbnail('teacher-photo', array('class' => 'teacherphoto', 'alt' => ''));
			} else {
			echo "<img src='" . get_bloginfo('template_directory') .
			"/images/no_photo.png' alt='' title='' class='teacherphoto' />"; }
			?>

			<p class="teacher_name">Name</p>: <?php the_title(); ?><br/>
			<p class="teacher_name">Mobile</p>: <?php echo get_post_meta($post->ID, "_teacher_mobile_number", true); ?><br/>
			<p class="teacher_name">Email</p>: <?php echo get_post_meta($post->ID, "_teacher_email", true); ?><br/>
			<p class="teacher_name">Publishers</p>: <?php echo get_post_meta($post->ID, "_teacher_publishers", true); ?><br/>	
			<p class="teacher_name">Position</p>: <?php echo strip_tags (get_the_term_list( get_the_ID(), 'Position', "" )); ?><br/>		
			<p class="teacher_name">Department</p>: <?php echo get_the_term_list( get_the_ID(), 'Department', '', ', ', '', '' ) ?><br/>	
			<?php the_content(); ?>
		
					<?php endwhile; ?>				 
					<?php else : ?>
					<h3><?php _e('404 Error&#58; Not Found'); ?></h3>
					<?php endif; ?>
</div><!-- Body Text-->
</div><!-- Main Body Close-->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>