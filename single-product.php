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
		<?php WpvTemplates::left_sidebar() ?>
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
								<div class="row">
					            	<?php the_field('product_overview'); ?>
					            </div>
				            	<div class="row">
				            		<a class="btn" id="specs-btn">Profile</a>
				            		<a class="btn" id="warranty-btn">Warranty</a>
				            		<div class="specs-box box">
				            			<?php the_field('product_specs'); ?>
				            		</div>
				            		<div class="warranty-box">
									  
								      <strong>Finishes and product warranty:</strong>
								      <p>Drexel Metals standard colors are produced by AkzoNobel and contain a minimum of 70% PVDF (Kynar500/Hylar5000) base resin with ceramic pigments. All colors are formulated to ensure consistent appearance, quality and long-term appearance.</p>

								      <strong>Our Family of Product Warranties</strong>
								      <ul>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/GOLD%20STANDARD%2035-Year%20Kynar%20Warranty.pdf">Drexel Metals Gold Standard 35 Year Non-Prorated Paint and System Warranty</a>
								         </li>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/35-Year%20PVDF%20Standard%20Warranty.pdf">Drexel Metals PVDF 35 Year Paint Warranty</a>
								         </li>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/Drexel%20Metals%2025-Year%20SMP%20Warranty.pdf">Drexel Metals SMP 25 Year Paint Warranty</a>
								         </li>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/35-Year%20PVDF%20and%20Aluminum%20Warranty.pdf">Drexel Metals PVDF 35 Year Paint and Aluminum Substrate Warranty</a>
								         </li>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/international%20paint%20warranty.pdf">Drexel Metals International Paint Warranty</a>
								         </li>
								      </ul>
								      <ul>
								         <li>
								            <a href="/sites/drexmet.2mdev.com/files/spec_sheets/2_Drexlume.pdf">Drexlume Mill Finished Galvalume Warranty</a>
								         </li>
								      </ul>
								      <p>Why so many warranties?&nbsp; The answer is simple....there is not a “one size fits all” warranty.&nbsp;</p>
								      <p>The Gold Standard Warranty covers the entire Drexel Metals system from the roof deck up and is offer exclusively through our network of fabricators and certified installers.&nbsp; Here are the benefits; If our product fails during the warranty period,&nbsp; Drexel Metals will replace your roof at no cost to you and since your Drexel Metals metal roof is a sensible investment, if you ever decide to sell your property we will transfer the warranty to the next owner(s) for the life of the warranty.&nbsp; For homeowners, its importnat to note that according to Remodeler Magazine you will recoup 85% of your initial investment upon the sale of your property.&nbsp;</p>
								      <h3>
								         <strong>Galvalume® Substrate:</strong>
								      </h3>
								      <p>Our steel products are painted over prime, made in the USA, Galvalume, AZ50 and is all Tension Leveled for superior flatness.&nbsp; Galvalume is an aluminum/zinc coated carbon steel product that was designed specifically for building products and contains approximately 80% aluminum in the coating by volume.&nbsp; Galvalume offers much better cut edge protection than traditional hot dipped galvanized products.&nbsp; It carries a 25 year warranty against perforation.</p>
								      <h3>
								         <strong>Aluminum Substrate:</strong>
								      </h3>
								      <p>Our aluminum products are painted over prime, made in the USA, aluminum. We use multiple alloys and tempers to ensure that the products supplied will meet and/or exceed your requirements.&nbsp; We are big fans of using our painted aluminum products for coastal applications and have invested a lot of R&amp;D funds to ensure our aluminum roof systems meet and/or exceed the high wind requirements.&nbsp; Our painted aluminum in salt environments does carry a 25-year warranty, however there are annual maintenance requirements.</p>
								      <h3>
								         <strong>Drexlume® Substrate:</strong>
								      </h3>
								      <p>Drexlume is our version of mill finished Galvalume® with a two-sided, clear acrylic finish that is installed as a unpainted product.&nbsp; The clear acrylic is there to aid with roll forming and will weather away over time (no impact to the performance).&nbsp;&nbsp; Drexlume carries a 25-Year Non Pro-rated Drexlume Warranty (Acrylic Coated Galvalume)</p>
									</div>
				            	</div>

						</div>
					</div>
				</div>
			</article>

			<aside class="right">
				<img class="sidebar-img" src="<?php the_field('sidebar_image'); ?>">
								<a class="btn" href="<?php the_field('spec_sheet'); ?>">Download Spec Sheet</a>
								<a class="btn" href="/wp-content/uploads/2017/03/Drexel-Standard-Chart_0.pdf">Download Color Chart</a>
			</aside>

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
