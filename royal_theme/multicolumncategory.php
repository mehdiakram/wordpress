<?php
/************************************************************
* Custom Category Format                                    *
* Developed by: Sufi                                        *
* Authour URI: http://www.thedct.com                        *
*************************************************************
*/ ?>
<style type="text/css">
	.full{
		float:left;
		width:100%;
	}
	.leftside{
		float:left;
	}
	.rightside{
		float:left;
		margin-left:20px;
	}
</style>
<div class="full">
	<h2 class="title">Categories</h2>
	<div class="leftside">
		<?php
		$leftCat[1] = "";
  		$rightCat[1] = "";
		function reduce_helper($xx, $yy){
			return $xx . $yy;
		}
		
		$categories = get_categories();
		$divider = ceil( wp_count_terms('category') / 2 ) ;
		$categoriesArrayLeft = array();
		$categoriesArrayRight = array();
		$counter = 0;
		foreach ((array) $categories as $category){
			if($counter < $divider){
				array_push($categoriesArrayLeft, '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>');
				$counter++;
			}
			else 
			{
				array_push($categoriesArrayRight, '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>');
			}
		}
		$leftCat[1] = '<li><ul>';

		$finalCategoriesLeft = array_reduce($categoriesArrayLeft, "reduce_helper");
		$leftCat[1] .= $finalCategoriesLeft;
		$leftCat[1] .= '</ul></li>';
		?>
		<ul>
			<?php echo $leftCat[1]; ?>
		</ul>
	</div><!--end of leftside-->
	<div class="rightside">
		<?php
		$rightCat[1] = '<li><ul>';
		$finalCategoriesRight = array_reduce($categoriesArrayRight, "reduce_helper");
		$rightCat[1] .= $finalCategoriesRight;
		$rightCat[1] .= '</ul></li>';
		?>
		<ul>
			<?php echo $rightCat[1]; ?>
		</ul>
	</div><!--end of rightside-->
</div><!--end of full-->