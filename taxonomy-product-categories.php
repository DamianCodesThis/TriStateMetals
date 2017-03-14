<?php
/**
 * Single product template
 *
 */

get_header();
$format = get_post_format();
	$format = empty($format)? 'standard' : $format;


?>

		<div class="row page-wrapper">
		<?php WpvTemplates::left_sidebar() ?>
<?php
if(get_query_var('term') == 'products-profiles') {
	$terms =  get_terms( 'product-categories', array(
    	'hide_empty' => false,
    	'orderby'=> 'term_id',
    	'order' => 'ASC'
	) );
	foreach($terms as $term) {

		$args = array(
		    'post_type' => 'product',
		    'posts_per_page' => -1,
		    'tax_query' => array(
		        array (
		            'taxonomy' => 'product-categories',
		            'field' => 'slug',
		            'terms' => $term->slug,
		        )
		    ),
		);

		$query = new Wp_Query( $args );
		$link = get_term_link($term);
		?>
		<div class="grid-1-1">
			<h2><?php echo $term->name; ?> - <a href="<?php echo $link; ?>">See More</a></h2>
		</div>
		<?php
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post(); ?>
				<a href="<?php the_permalink(); ?>">
					<div class="product grid-1-4">
						<img class="product-img" src="<?php echo get_field('sidebar_image', $post->id); ?>">
						<span class="product-title"><?php get_the_title($post->id); ?></span>
						<p class="listing-description"><?php echo get_field('listing_description', $post->id); ?></p>
						<a class="more" href="<?php get_permalink($post->id); ?>">MORE</a>
					</div>
				</a> 
		<?php endwhile;
		endif; 
wp_reset_query();
		?>
		

<?php

	}
} else {
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

			
								<a href="<?php the_permalink(); ?>">
									<div class="product grid-1-4">
										<img class="product-img" src="<?php the_field('sidebar_image'); ?>">
										<span class="product-title"><?php the_title(); ?></span>
										<p class="listing-description"><?php echo the_field('listing_description'); ?></p>
										<a class="more" href="<?php the_permalink(); ?>">MORE</a>
									</div>
								</a>
	



			<?php if ( wpv_get_optionb( 'show-related-posts' ) && is_singular( 'post' ) ) : ?>
				<?php
					$terms = array();
					$cats  = get_the_category();
					foreach ( $cats as $cat ) {
						$terms[] = $cat->term_id;
					}
				?>
				<div class="related-posts">
					<div class="clearfix">
						<div class="grid-1-1">
							<?php echo apply_filters( 'wpv_related_posts_title', '<h2 class="related-content-title">'.wpv_get_option( 'related-posts-title' ).'</h3>' ) // xss ok ?>
							<?php
								echo WPV_Blog::shortcode( array(
									'count' => 8,
									'column' => 4,
									'cat' => $terms,
									'layout' => 'scroll-x',
									'show_content' => true,
									'post__not_in' => get_the_ID(),
								) ); // xss ok
							?>
						</div>
					</div>
				</div>
			<?php endif ?>
		
	<?php endwhile;
endif; 

}?>

</div>
<?php get_footer();
