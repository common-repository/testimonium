<?php		
		// Step 1 - Query published testimonials
		$args = array(
			'post_type' => 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => $numOfTestimonials,
			'orderby' => $orderOfTestimonials
		);

ob_start(); ?>
<div class="testimonium layout-1">
	<div class="testimonial-row">
		<ul>
			<?php 
			$query = new WP_Query ( $args );
			if( $query->have_posts() ){
				while( $query->have_posts() ){
					$query->the_post();?>
					<li>
						<div class="testimonial-thumbnail"><?php the_post_thumbnail(array('150', '150')); ?></div>
						<div class="testimonial-content"><?php the_excerpt();?></div>
						<div class="testimonial-user"> - <?php the_title(); ?></div>
					</li>
				<?php 
					}
				}
			?>
		</ul>
	</div>
</div>

<?php
	/* Get the buffered content into a var */
	$testimonialHTML = ob_get_contents();

	/* Clean buffer */
	ob_end_clean();