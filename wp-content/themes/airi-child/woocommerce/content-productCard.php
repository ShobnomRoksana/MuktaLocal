<?php
/**
 * The template for displaying product content within loops
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$class = array('product_item', 'grid-item', 'product');


$loop_index 	= airi_get_wc_loop_prop('loop', 0);
$item_sizes     = airi_get_wc_loop_prop('item_sizes', array());
$item_w         = 1;
$item_h         = 1;
$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');

if($loop_index >= count($item_sizes)){
	$loop_index2 = $loop_index - count($item_sizes);
}
else{
	$loop_index2 = $loop_index;
}

if(!empty($item_sizes[$loop_index2]['w']) && ( $_tmp_size = $item_sizes[$loop_index2]['w'] )){
    $item_w = $_tmp_size;
}
if(!empty($item_sizes[$loop_index2]['h']) && ( $_tmp_size = $item_sizes[$loop_index2]['h'] )){
    $item_h = $_tmp_size;
}
?>
<li <?php wc_product_class( $class, get_the_ID() ) ?> data-width="<?php echo esc_attr($item_w);?>" data-height="<?php echo esc_attr($item_h);?>">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<div class="">
		<div class="product_item--inner product_cat_wrap">
			<div class="product_item--thumbnail product_hover">
				<div class="product_item--thumbnail-holder">
					<?php
						$attachment_ids = $product->get_gallery_image_ids();
						$image_link = wp_get_attachment_url( $attachment_ids[0]);

						echo '<div class="product_img" style="background-image: url('.$url.');">
							</div>
							<div class="wp_alt_image" style="background-image: url('.$image_link.');">
							</div>';
					?>
				</div>
				<div class="text-center product_on_hover">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark"
						title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>
					</a></h3>
					<p><?php the_excerpt(); ?></p>
					<span class="price">
						<span class="woocommerce-Price-amount amount">
							<span class="woocommerce-Price-currencySymbol">
								 <?php echo $product->get_price_html(); ?>
							</span>
						</span>
					</span>

					<div class="product_cat_wl_btn">
						<a class="quick_view" href="<?php the_permalink() ?>">
							<img src="/mukta/wp-content/uploads/2020/10/eye-icon.png"/>
							<span>View Product</span>
						</a>
						<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>
