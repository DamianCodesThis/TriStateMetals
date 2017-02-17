<?php
/**
 * Single product template
 *
 */

get_header();
$format = get_post_format();
	$format = empty($format)? 'standard' : $format;
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<div class="row page-wrapper">
			<article <?php post_class( 'single-post-wrapper '.WpvTemplates::get_layout() )?>>
				<?php
					global $wpv_has_header_sidebars;
					if ( $wpv_has_header_sidebars ) {
						WpvTemplates::header_sidebars();
					}
				?>
				<div class="page-content loop-wrapper clearfix full">
					<div class="post-article <?php echo esc_attr( $has_media ) ?>-wrapper <?php echo esc_attr( is_single() ? 'single' : '' ) ?>">
						<div class="<?php echo esc_attr( $format ) ?>-post-format clearfix <?php echo esc_attr( isset( $post_data['act_as_image'] ) ? 'as-image' : 'as-normal' ) ?> <?php echo esc_attr( isset($post_data['act_as_standard']) ? 'as-standard-post-format' : '' ) ?>">
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
						</div>
					</div>
					
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
