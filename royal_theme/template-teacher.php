<?php
/*
Template Name: Template Teacher Page
*/

get_header(); ?>
<?php get_sidebar(left); ?>

<div class="single_mainbody">
<h2 class="custom-page-title">
<?php if(have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>        
<?php the_title(); ?>
<?php endwhile; ?>    
<?php endif; ?>
</h2>


<?php 
$department_name = get_post_meta( $post->ID, 'Department', true ); 
query_posts(array('post_type' => 'teacher', 'Department' => $department_name, 'showposts' =>1, 'orderby' => 'date', 'order' => 'ASC'));
?>
<?php while (have_posts()) : the_post();?>    

<!--your code here for single columns-->
<div class="single_teacher">
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
			<a class="detail" href="<?php the_permalink(); ?>">Detail</a>
			
			

</div>			
<?php endwhile;?>


<?php wp_reset_query(); ?>
<?php 
$department_name = get_post_meta( $post->ID, 'Department', true ); 
query_posts(array('post_type' => 'teacher','Department' => $department_name, 'offset'=>1, 'orderby' => 'date', 'order' => 'ASC')); 
?>
<?php while (have_posts()) : the_post(); ?>

<!--your code here for double column/rest of the post-->
 <div class="double_teacher">

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
			<a class="detail" href="<?php the_permalink(); ?>">Detail</a>
			
</div>
<?php endwhile; ?>



</div>



<?php get_footer(); ?>