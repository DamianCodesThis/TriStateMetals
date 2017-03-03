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
endif; ?>
</div>
<?php get_footer();
