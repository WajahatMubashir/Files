<?php

/**
* Template Name: Post Template
*/

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'post_loop');

function post_loop(){
	
	$postInfo = array(
		'post_type' => 'post'
	);
	
	$customQuery = new WP_Query($postInfo);
	
	?>

<header class="entry-header"><h1 class="entry-title" itemprop="headline"><?php the_title() ?></h1></header>

	<div class="parent-container">
		
	<?php
	while($customQuery->have_posts()){
		$customQuery->the_post();		
		?>
		
		<div class="customContainer alignfull">
			<div class="template-wrap">
				
				
				<div class="col1">
					<?php  the_post_thumbnail(); ?>
				</div>
				<div class="col2">
					<h2><?php the_title(); ?></h2>
					<div class="postContent"><?php the_content(); ?></div>
					<a class="button" href="<?php the_permalink(); ?>">More</a>
				</div>
			</div>
		</div>

<?php
	}
	wp_reset_query();
	?>
		
</div>
 
	
<div class="pop-up-overlay">
	<div class="popup-container">
		  <div class="close-btn">
			  <span>Close</span>
		  </div>
		  <h2>Pop Up Heading</h2>
		  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem cupiditate laboriosam assumenda perspiciatis dolorum autem minus aliquam quibusdam esse eveniet?</p>
	 </div>	
</div>


<?php

	//Testimonial loop
	
	$testInfo = array(
		'post_type' => 'testimonial'
	);
	
	$testQuery = new WP_Query($testInfo);
	
	?>
	<div class='test-parent owl-carousel owl-theme alignfull'>
		
		<?php
	while($testQuery->have_posts()) {
		$testQuery->the_post();
		?>
		
		<div class='customTest item alignfull'>
			<div class='test-wrap'>
				<div class='test-col1'>
					<?php the_post_thumbnail(); ?>
				</div>
				<div class='text-col2'>
					<div class='test-content'>
						<?php the_content(); ?>
					</div>
					<p class="test-say">
						<?php the_title();?>
					</p>
				</div>
			</div>
		</div>
	<?php	
	} ?>
	
		
</div>
	
<?php
} 
genesis();

?>