<?php
/**
 * Wishlist custom page template
 *
**/

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
}
?>

<!-- Custom WISHLIST Grid -->
<div	class="custom_wishlist_view"	data-pagination="<?php echo esc_attr( $pagination ); ?>" data-per-page="<?php echo esc_attr( $per_page ); ?>"
	data-page="<?php echo esc_attr( $current_page ); ?>" data-id="<?php echo esc_attr( $wishlist_id ); ?>"
	data-token="<?php echo esc_attr( $wishlist_token ); ?>">
	<?php $column_count = 2; ?>
	<div class="row">
		<?php
		if ( $wishlist && $wishlist->has_items() ) :
			foreach ( $wishlist_items as $item ) :
				global $product;

				$product = $item->get_product();
				$product_short_description = $product->get_short_description();
				$availability = $product->get_availability();
				$stock_status = isset( $availability['class'] ) ? $availability['class'] : false;

				if ( $product && $product->exists() ) :
					?>
		<div class="col-lg-6 col-md-6 cwl_product_col">
			<div class="cwl_product_image">
				<?php
					$image_id  = $product->get_image_id();
					$product_image_url = wp_get_attachment_image_url( $image_id, 'full' );
					echo '<div class ="cwl_thumb_img_wrap" style="background-image: url('.$product_image_url.');">
							<img src="'.$product_image_url.'" class ="cwl_thumb_img"/></div>';
				?>
			</div>
			<div class="cwl_product-name text-center">
				<a class="product_title" href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>"><?php echo esc_html( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?></a>
				<p class="cwl_description">
					<?php echo $product_short_description; ?>
				</p>
				<p class="wl_price">
					<?php
					if ( $show_price ) {
						echo $item->get_formatted_product_price();
					}

					if ( $show_price_variations ) {
						echo $item->get_price_variation();
					}
					?>
				</p>

				<?php
				if ( $show_variation && $product->is_type( 'variation' ) ) {
					echo wc_get_formatted_variation( $product );
				}
				?>
			</div>
			<div class="cwl_product-add-to-cart text-center">
					<!-- Add to cart button -->
					<?php $show_add_to_cart = apply_filters( 'yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist ); ?>
					<?php if ( $show_add_to_cart && isset( $stock_status ) && 'out-of-stock' !== $stock_status ) : ?>
						<?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
					<?php endif ?>

					<!-- Remove from wishlist button -->
					<?php if ( $show_remove_product ) : ?>
							<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>">
								<i class="dl-icon-close"></i>
							</a>
					<?php endif; ?>
			</div>
		</div>
		<?php
		endif;
	endforeach;
	else :
	?>
	<div>
		<p class="wishlist-empty">
			<?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></p>
	</div>
	<?php endif; ?>
	</div>
</div>

<style>
	.hidden-title-form, .cwl_product-add-to-cart span, .cwl_thumb_img {
		display: none;
	}
	.custom_wishlist_view {
		padding: 35px 0;
	}
	.cwl_product_col {
		padding-bottom: 25px;
	}
	.cwl_product-name {
		padding: 15px 10px 0;
	}
	.cwl_product-name ins {
		text-decoration: none;
	}
	.product_title {
		color: black;
		text-transform: uppercase;
		font-family: "Raleway", sans-serif;
		font-weight: 600;
		font-size: 16px;
	}
	.cwl_description {
		color: black;
    text-transform: uppercase;
    font-family: "Raleway", sans-serif;
    font-weight: 400;
    font-size: 12px;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 0 !important;
    min-height: 22px;
	}
	.wl_price .woocommerce-Price-amount.amount {
		border: 1px solid black;
	  padding: 2px 10px;
	  border-radius: 15px;
	  color: black;
	  font-weight: 500;
	}
	.vat {
	  color: black;
	  font-weight: 500;
	}
	.cwl_product-add-to-cart .remove_from_wishlist .dl-icon-close {
		font-size: 28px;
	  vertical-align: text-top;
	  -webkit-text-stroke: 1px white;
	  margin: 0;
	  color: black;
	}
	.cwl_product-name .variation {
		display: none;
		/* display: flex; */
	  justify-content: center;
	  margin: 0;
	}
	.cwl_product-name .variation dt, .cwl_product-name .variation dd {
		padding-right: 5px;
	}
	.wl_price {
		margin-bottom: 0 !important;
	}
	.cwl_thumb_img_wrap {
		width: 100%;
		height: 362px;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	@media (max-width: 991px) {
		.cwl_thumb_img_wrap {
			background-image: none !important;
			height: auto;
		}
		.cwl_thumb_img {
			display: block;
	    margin: auto;
	    width: 50%;
		}
	}
</style>
