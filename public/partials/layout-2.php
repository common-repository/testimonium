<?php		
		// Step 1 - Query published testimonials
		$args = array(
			'post_type' => 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => $numOfTestimonials,
			'orderby' => $orderOfTestimonials
		);

ob_start(); ?>
<div class="testimonium layout-2">
	<div class="testimonial-row">
		<ul>
			<?php 
			$query = new WP_Query ( $args );
			if( $query->have_posts() ){
				while( $query->have_posts() ){
					$query->the_post();?>
					<li>
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
<script>
	jQuery(document).ready(function($) {
		$('.testimonium.layout-2 > .testimonial-row').unslider({
			arrows: {
				//  Unslider default behaviour
				prev: '<a class="unslider-arrow prev"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>',
				next: '<a class="unslider-arrow next"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>',
			}
		});
	});
</script>

<?php
	/* Get the buffered content into a var */
	$testimonialHTML = ob_get_contents();

	/* Clean buffer */
	ob_end_clean();