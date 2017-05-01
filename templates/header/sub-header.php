<?php

/**

 * Site sub-header. Includes a slider, page title, etc.

 *

 * @package  wpv

 */



global $wpv_title;

if ( !is_404() ) {

	if ( wpv_has_woocommerce() ) {

		if ( is_woocommerce() && ! is_single() ) {

			if ( is_product_category() ) {

				$wpv_title = single_cat_title( '', false );

			} elseif ( is_product_tag() ) {

				$wpv_title = single_tag_title( '', false );

			} else {

				$wpv_title = woocommerce_get_page_id( 'shop' ) ? get_the_title( woocommerce_get_page_id( 'shop' ) ) : '';

			}

		} elseif ( is_cart() || is_checkout() ) {

			$cart_title     = get_the_title( wc_get_page_id( 'cart' ) );

			$checkout_title = get_the_title( wc_get_page_id( 'checkout' ) );

			$complete_title = __( 'Order Complete', 'construction' );



			$cart_state     = is_cart() ? 'active' : 'inactive';

			$checkout_state = is_checkout() && ! is_order_received_page() ? 'active' : 'inactive';

			$complete_state = is_order_received_page() ? 'active' : 'inactive';



			$wpv_title = "

				<span class='checkout-breadcrumb'>

					<span class='title-part-{$cart_state}'>$cart_title</span>" .

					wpv_shortcode_icon( array( 'name' => 'arrow-right1' ) ) .

					"<span class='title-part-{$checkout_state}'>$checkout_title</span>" .

					wpv_shortcode_icon( array( 'name' => 'arrow-right1' ) ) .

					"<span class='title-part-{$complete_state}'>$complete_title</span>

				</span>

			";

		}

	}

}



$page_header_bg = WpvTemplates::page_header_background();

$global_page_header_bg = wpv_get_option( 'page-title-background-image' ) . wpv_get_option( 'page-title-background-color' );



if ( ( ! WpvTemplates::has_breadcrumbs() && ! WpvTemplates::has_page_header() && ! WpvTemplates::has_post_siblings_buttons() ) || is_404() ) return;

if ( is_page_template( 'page-blank.php' ) ) return;





?>

<div id="sub-header" class="layout-<?php echo esc_attr( WpvTemplates::get_layout() ) ?> <?php if ( ! empty( $page_header_bg ) || ! empty( $global_page_header_bg ) ) echo 'has-background' // xss ok ?>">

	<div class="meta-header" style="<?php echo esc_attr( $page_header_bg ) ?>">

		<div class="limit-wrapper">

			<div class="meta-header-inside">

				<?php

					WpvTemplates::breadcrumbs();
					
					global $post;
					
					$terms = get_the_terms($post,'product-categories');


					if(count($terms) < 1 && $post->post_type != 'product' && $terms[0]->taxonomy != 'product-categories') {
						WpvTemplates::page_header( false, $wpv_title );
					} else { ?>
						<style>
							/*STYLES*/

							#warranty_box {
								display:none;
							}

							h1.product-title{
								margin-top: 50px;
							}


							.product.grid-1-4{
								margin-bottom: 30px;

							}

							.product-list-title{
								margin-top: 50px;
							}

							.sidebar-btn{
							  font-family: "Montserrat", Arial, Serif;
							  background-color: #643c21;
							  color: #ffffff;
							  padding: 10px;
							  font-weight: bold;
							  text-transform: uppercase;
							  border: none;
							  display: block;
   							  text-align: center;
   							  margin: 10px 0px !important; 
							}

							.btn{
							  font-family: "Montserrat", Arial, Serif;
							    background-color: #643c21;
							    color: #ffffff;
							    padding: 10px;
							    font-weight: bold;
							    text-transform: uppercase;
							    border: none;
							    display: block;
							    text-align: center;
							    margin-right: 10px;
							    width: 100px;
							    float:left;

							}

							.box {
								clear: both;
							}




						</style>
						<div id="sub-header" class="layout-full has-background">

							<div class="meta-header" style="">

								<div class="limit-wrapper">

									<div class="meta-header-inside">

										<header class="page-header ">
											<div class="page-header-content">
							
												<?php if($post->post_type == 'product' && is_single($post))	: ?>	
													<h1 class="product-title"><?php the_title();?></h1>

												<?php else:?>			
													<h1 class="product-list-title"><?php echo single_term_title();?></h1>
												<?php endif;?>
											</div>
										</header>
									</div>

								</div>

							</div>

						</div>

					<?php } ?>



			</div>

		</div>

	</div>

</div>