<?php
class RCPW extends WP_Widget {

function RCPW() {
	parent::WP_Widget(false, $name='Royal Category Posts');
}

/* Displays category posts widget on blog.*/
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	echo '<div class="cat_news_box fix">';
	
	// Widget title
	echo '<h4 class="headbar">';
		echo '<a href="' . get_category_link($instance["cat"]) . '">' . get_cat_name($instance["cat"]) . '</a>';
	echo '</h4>';

	// First of Post list START
  $first_cat_posts = new WP_Query( array('post_type' => 'post', 'showposts' =>1, 'cat' => $instance["cat"], 'orderby' => 'date', 'order' => 'DESC' ) ); 
	
	echo '<div class="cat_main">';
	while ( $first_cat_posts->have_posts() )
	{
		$first_cat_posts->the_post();
	?>
		<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title=""><?php the_title(); ?></a></h2>
		<div class="additional_info"><?php the_time('F j, Y, g:i A') ?> </span></div>
		<div class="content fix">
			<?php
			if ( has_post_thumbnail() ) {
			the_post_thumbnail('post-thumb', array('class' => 'sidebar_cat_image', 'alt' => ''));
			}
			?>	
			<a href="<?php the_permalink(); ?>" class="content_right"><?php echo excerpt(40); ?></a>
		</div>
		<div class="bottom">
			<a class="comment" href="<?php comments_link(); ?>" title="comment"><i class="fa fa-comment"></i><span><?php comments_number( '০', '১', '%' ); ?></span></a>
			<div class="holder"><a href="<?php the_permalink(); ?>" class="more_link">বিস্তারিত</a></div>
		</div>		
	<?php
	}	
	echo '</div>';	
	// First of Post list END		
	

	// Rest of Post list START
  $more_cat_posts = new WP_Query( array('post_type' => 'post', 'showposts' =>$instance["num"], 'cat' => $instance["cat"], 'offset'=>1, 'orderby' => 'date', 'order' => 'DESC' ) ); 

	echo '<div class="cat_more">';
	echo "<ul>\n";
	while ( $more_cat_posts->have_posts() )
	{
		$more_cat_posts->the_post();
	?>
		<li>
			<?php
			if ( has_post_thumbnail() ) {
			the_post_thumbnail('post-thumb', array('class' => 'cat_more_image', 'alt' => ''));
			}
			?>	
			<a href="<?php the_permalink(); ?>" rel="bookmark" title=""><?php the_title(); ?></a>
		</li>
	<?php
	}
	echo "</ul>\n";
	echo '</div>';
	// Rest of Post list END
	?>	
	<div class="footbar"><a class="more_link" href="<?php echo get_category_link($instance["cat"]) ?>">আরও</a></div>	
	<?php
	echo '</div>';
	$post = $post_old; // Restore the post object.
}


/**
 * The configuration form.
 */
function form($instance) {
$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : '';	
$num = ( !empty( $instance['num'] ) ) ? $instance['num'] : 5;	
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>		
		<p>
			<label>
				<?php _e( 'Category' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
			</label>
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of rest of posts to show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo esc_attr( $num ); ?>" size='3' />
			</label>
		</p>
		
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("RCPW");') );

?>
