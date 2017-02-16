<?php
/**
 * Single product template
 *
 */

get_header();

?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<div class="row page-wrapper">
			<article <?php post_class( 'single-post-wrapper '.WpvTemplates::get_layout() )?>>
	          
	            <h1 class="entry-title"><?php the_title(); ?></h1>
	            <?php $img_src = get_field('featured_image', $post->id); ?>
	            <img src="<?php echo $img_src; ?>">
	            <div>
	            	<strong>Poduct Features</strong>
	            	<?php the_field('product_features'); ?>
	            </div>
	            <div>
	            	<strong>Materials</strong>
	            	<?php the_field('materials'); ?>
	            </div>
	            <div>
	            	<strong>Product Specs</strong>
	            	<?php the_field('product_specs'); ?>
	            </div>

	        </article>

			<?php WpvTemplates::right_sidebar() ?>

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
		</div>
	<?php endwhile;
endif;

get_footer();
