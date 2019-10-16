<?php get_header(); ?>   
<?php get_sidebar(); ?>
           
<div class="right_cont">        
		<?php if(have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>        	
				<div class="single_post">
				<div class="pagetitle"><h1><?php the_title(); ?></h1></div>				
				<div class="content"><?php the_content(); ?></div>
				</div>
		<?php endwhile; ?>    
		<?php endif; ?>	
</div>

<?php get_footer(); ?>