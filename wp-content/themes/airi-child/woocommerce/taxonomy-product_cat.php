<style>
	.product-category-main-wrap {
		margin: 0 auto 60px;
	}
	.product-category-header {
    margin: 35px 0 35px;
	}
	.product-category-title {
		margin: 0;
    line-height: 1.4;
	}
	.product_cat_wrap .product_img {
		background-position: top center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 415px;
	}
	.product_hover {
		position: relative;
		margin-bottom: 25px;
	}
	.product_on_hover {
		position: relative;
		z-index: 2;
	}
	.product_on_hover {
		display: none;
		position: absolute !important;
		right: 0;
		left: 0;
		top: 13rem;
		padding: 15px;
	}
	.product_hover:hover .product_on_hover {
	  	display: block;
	}
	.product_on_hover h3,
	.product_on_hover p,
	.product_on_hover .price .amount{
			color: white !important;
			font-family: "Raleway",sans-serif;
	}
	.product_on_hover p, .product_on_hover h3 {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			font-weight: 600;
	    margin: 0;
	    line-height: 1.2;
	}
	.product_on_hover p {
		font-weight: 500;
		font-size: 13px;
	}
	.product_on_hover .price {
	    font-size: 20px;
	    font-weight: 600;
	}
	.product_on_hover .yith-wcwl-add-button {
		position: relative;
	}
	.product_on_hover .yith-wcwl-add-button span, .product_on_hover .quick_view span,
	.yith-wcwl-wishlistaddedbrowse a.custom-browse-icon > span {
			display: none;
			background: #eee;
			color: black;
			position: absolute;
			padding: 0.1em 0.3em;
			font-size: smaller !important;
			font-weight: 500;
			pointer-events: none;
			white-space: nowrap;
			top: 30px;
	}
	.product_on_hover .yith-wcwl-add-button:hover span, .product_on_hover .quick_view:hover span,
	.yith-wcwl-wishlistaddedbrowse a.custom-browse-icon:hover span {
		 display: block;
	}

	.product_cat_wl_btn .yith-wcwl-add-button img {
		display: block;
		visibility: hidden;
	}
	.product_cat_wl_btn {
		display: flex;
    justify-content: center;
    align-items: center;
		margin-top: 30%;
	}
	.product_cat_wl_btn .quick_view {
		height: 25px;
    width: 35px;
    margin-right: 15px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
	}
	.product_cat_wrap .vat {
		color: white !important;
		font-weight: 500;
	}
	.product_cat_wl_btn .yith-wcwl-add-button a {
		height: 25px;
    width: 35px;
		display: block;
    background-image: url(/mukta/wp-content/uploads/2020/10/shell-icon-white.png);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
	}
	.product_cat_wl_btn .yith-wcwl-wishlistaddedbrowse a.custom-browse-icon {
			background-image: url(/mukta/wp-content/uploads/2020/10/shell-icon-white.png);
			background-position: center center;
			background-repeat: no-repeat;
			background-size: contain;
			height: 25px;
			display: flex!important;
			width: 35px;
			margin: auto;
			position: relative;
	}
	.product_cat_wl_btn .yith-wcwl-wishlistaddedbrowse .feedback, .product_cat_wl_btn .yith-wcwl-wishlistaddedbrowse a {
		display: block;
		color: white;
	}
	.product-category-des {
			color: black;
			line-height: 1.2;
			font-size: 13px;
			font-weight: 500;
	}
	.product_item--thumbnail .wp_alt_image {
	    position: absolute;
	    left: 0;
	    top: 0;
	    z-index: 2;
	    transition: opacity 0.5s ease, transform 2s cubic-bezier(0, 0, 0.44, 1.18);
	    opacity: 0;
	    width: 100%;
			background-position: top center;
			background-size: cover;
			height: 100%;
	}
	.product_item--thumbnail:hover .wp_alt_image {
	    opacity: 1;
	}
	.product_item--thumbnail:hover .wp_alt_image::before, .product_hover:hover .wp_alt_image::before {
			content: "";
	    background-color: #565656;
	    opacity: 0.5;
	    position: absolute;
	    width: 100%;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    top: 0;
	}

	/* Pagination CSS */
		.pagination {
			display: flex;
			justify-content: flex-end;
			margin: 0 !important;
		}

		.pagination span, .pagination a {
			display: flex;
	    justify-content: center;
	    align-items: center;
	    float: left;
	    margin: 2px 8px 2px 0;
	    text-decoration: none;
	    border: 1px solid black;
	    color: black;
	    border-radius: 50%;
	    font-size: 12px;
	    line-height: 1.2;
	    width: 22px;
	    height: 22px;
		}

		.pagination .prev, .pagination .next {
			border: none;
		}
 		.pagination a:not(.prev):not(.next):hover{
			background-color: #000000;
	    color: #fed2c7;
	    font-weight: 600;
		}
		.pagination .current{
			background-color: #000000;
	    color: #fed2c7;
	    font-weight: 600;
		}

		/* Sorting option css */
		.custom_sorting_wrap {
			display: flex;
			justify-content: flex-end;
			align-items: center;
			text-align: right;
		}
		.custom_sorting_wrap .btn-advanced-shop-filter, .custom_sorting_wrap .wc-view-count, .custom_sorting_wrap .woocommerce-result-count {
			display: none !important;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering p {
		    border: none;
				padding: 15px 15px 0;
		}
		.custom_sorting_wrap .wc-toolbar-container {
		    margin-bottom: 0;
		}
		.custom_sorting_wrap .wc-toolbar-top {
		    padding-top: 0;
		    margin-bottom: 0;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering:hover ul {
				opacity: 1 !important;
		    visibility: visible !important;
		    margin-top: 7px !important;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering ul {
	    background-color: #ededed;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering ul  {
	    font-weight: 500;
	    font-size: smaller;
	    transition: 0.3s all;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering ul li a {
		    padding: 0px 10px;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering ul li.active a, .custom_sorting_wrap .wc-toolbar .wc-ordering ul li:hover a{
			background-color: #282828;
			color: #fed2c7;
			font-weight: 600;
		}
		.custom_sorting_wrap .wc-toolbar .wc-ordering {
		    margin-left: 10px;
				font-size: 12px;
		}
		.category_options_wrap {
			color: black;
			text-transform: uppercase;
			font-weight: 500;
			font-size: 12px;
			margin: 0 -15px 6%;
		}
		.category_options_wrap	.woocommerce-breadcrumb {
			margin: 5px 0;
		}
		.category_options_wrap .sep {
			margin: 0 10px;
	    height: 8px;
	    width: 8px;
	    background-color: #fed2c7;
	    border-radius: 50%;
	    display: inline-block;
		}
		.product_hover:hover .product_item--thumbnail-holder::before {
		    content: "";
		    background-color: #565656;
		    opacity: 0.5;
		    position: absolute;
		    width: 100%;
		    left: 0;
		    right: 0;
		    bottom: 0;
		    top: 0;
		}
		.product_item--thumbnail {
		    overflow: hidden;
				position: relative;
				z-index: 2;
		}
		.product_item--thumbnail:hover .wp-alt-image {
		    opacity: 1;
		}
		.product_item--thumbnail .wp-alt-image {
		    position: absolute;
		    left: 0;
		    top: 0;
		    z-index: 2;
		    transition: opacity 0.5s ease, transform 2s cubic-bezier(0, 0, 0.44, 1.18);
		    opacity: 0;
		    width: 100%;
				background-position: center center;
				background-size: cover;
				height: 100%;
		}
	@media (max-width: 991px) and (min-width: 601px) {
		.category_options_wrap {
			  margin-bottom: 15%;
		}
	}
	@media (min-width: 768px) {
		.product-category-header .col-md-10 {
				padding: 0;
		}
	}
	@media (max-width: 767px) {
		.custom_sorting_wrap, .custom_breadcrumb_wrap {
			  width: 100%!important;
		}
		.custom_sorting_wrap {
			  justify-content: center;
		}
		.custom_sorting_wrap .navigation.pagination {
    	padding-top: 15px;
		}
		.custom_breadcrumb_wrap {
			text-align: center;
	    padding-right: 15px;
		}
		.product_cat_wrap {
			width: auto;
			max-width: 300px;
			margin: auto;
			margin-bottom: 35px;
		}
		.product_cat_wrap .product_img {
				height: 445px;
		}
	}
  @media (max-width: 600px) {
		.category_options_wrap {
				margin: 0 -15px 0%;
				height: 75px;
		}
  }

</style>
<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	get_header();
?>

<section id="primary" class="site-content container product-category-main-wrap">
  <div id="content" role="main">
		<div class="product-category-header text-center row">
			<h2 class="product-category-title"><em><?php single_term_title( '' ); ?></em></h2>
			<div class="col-md-1"></div>
			<div class="col-md-10 product-category-des">
				<?php
					the_archive_description();
				?>
			</div>
			<div class="col-md-1"></div>
		</div>
<?php

$item_gap = Airi()->settings()->get('shop_item_space', 'default');

if($item_gap == 'zero'){
	$item_gap = 0;
}
$catalog_column = Airi()->settings()->get('woocommerce_catalog_columns', Airi()->settings()->get('woocommerce_shop_page_columns'));
$catalog_column = shortcode_atts(
	array(
		'xlg'	=> 2,
		'lg' 	=> 2,
		'md' 	=> 2,
		'sm' 	=> 1,
		'xs' 	=> 1,
		'mb' 	=> 1
	),
	$catalog_column
);
$catalog_class = array('catalog-grid-1 products grid-items');
$catalog_class[] = 'grid-space-' . $item_gap;
$catalog_class[] = airi_render_grid_css_class_from_columns($catalog_column);

if ( airi_wc_product_loop() ) {

	?>
	<div class="category_options_wrap">
		<div class="col-xs-6 custom_breadcrumb_wrap">
			<?php woocommerce_breadcrumb(); ?>
		</div>
		<div class="col-xs-6 custom_sorting_wrap">
			<?php
				do_action( 'woocommerce_before_shop_loop' );
			?>
		</div>
</div>
	<div id="la_shop_products" class="la-shop-products">
		<div class="la-ajax-shop-loading"><div class="la-ajax-loading-outer"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div><div class="cube1"></div><div class="cube2"></div><div class="cube3"></div><div class="cube4"></div></div></div></div>
		<div class="product-categories-wrapper"><ul class="<?php echo esc_attr(implode(' ', $catalog_class)); ?>"><?php echo woocommerce_maybe_show_product_subcategories(''); ?></ul></div>
	<?php

	wc_set_loop_prop( 'is_main_loop', true );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'productCard' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	?>
	</div>
	<?php
}
else {

	?>
	<div class="wc-toolbar-container"><div class="hidden wc-toolbar wc-toolbar-top clearfix"></div></div>
	<div id="la_shop_products" class="la-shop-products no-products-found">
		<div class="la-ajax-shop-loading"><div class="la-ajax-loading-outer"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div><div class="cube1"></div><div class="cube2"></div><div class="cube3"></div><div class="cube4"></div></div></div></div>

		<div class="product-categories-wrapper"><ul class="<?php echo esc_attr(implode(' ', $catalog_class)); ?>"><?php echo woocommerce_maybe_show_product_subcategories(''); ?></ul></div>
	<?php

	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
	?>
	</div>
	<?php
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' ); ?>

</section>

<?php get_footer(); ?>
