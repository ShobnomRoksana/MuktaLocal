<?php

/**
 * Child Theme Function
 *
 */

get_header();
?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
$description = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$cssclass_left = 'col-xs-12 col-sm-7 col-md-7 p-left product-main-image custom-product-left';
$cssclass_right = 'col-xs-12 col-sm-5 col-md-5 p-right product--summary';

?>

<div id="product-<?php the_ID(); ?>" class="container">
    <div class="row custom_spw">
			<div class="col-xs-12">
				<?php
					echo '<div class="sp_breadcrumb">';
						woocommerce_breadcrumb();
					echo '</div>';
				?>
			</div>
    </div>
    <div class="row custom_spw">
			<div class="<?php echo esc_attr($cssclass_left) ?>">
				<div id="custom_product_gallery" class="custom_gallery_slider">
					<?php
					 global $product;
						$image_id  = $product->get_image_id();
						$product_image_url = wp_get_attachment_image_url( $image_id, 'full' );
						echo '	<a href="'.$product_image_url.'" target="_blank" data-gallery="my-gallery" data-size="1600x900">
								<img src="'.$product_image_url.'"/></a>';

					 $product_image_ids = $product->get_gallery_attachment_ids();

					 foreach( $product_image_ids as $product_image_id )
					{
					  $image_url = wp_get_attachment_url( $product_image_id );
					  echo '	<a href="'.$image_url.'" target="_blank" data-gallery="my-gallery" data-size="1600x1068">
								<img src="'.$image_url.'"/></a>';

					}
					?>
				</div>
				<div class="custom_thumbnail_slider_wrap">
					<div class="custom_thumbnail_slider">
						<?php
						 global $product;
							$image_id  = $product->get_image_id();
							$product_image_url = wp_get_attachment_image_url( $image_id, 'full' );
							echo '	<div class ="thumb_img_wrap" style="background-image: url('.$product_image_url.');">
									<img src="'.$product_image_url.'" class ="thumb_img"/></div>';

						 $product_image_ids = $product->get_gallery_attachment_ids();

						 foreach( $product_image_ids as $product_image_id )
						{
							$image_url = wp_get_attachment_url( $product_image_id );
							echo '	<div class ="thumb_img_wrap" style="background-image: url('.$image_url.');">
									<img src="'.$image_url.'" class ="thumb_img"/></div>';

						}
						?>
					</div>
				</div>
			</div>

			<div class="<?php echo esc_attr($cssclass_right) ?>">
					<div class="row">
						<div class="col-md-3 col-sm-1">
						</div>
						<div class="hidden_col col-md-9 col-sm-11 <?php if (has_term( 'coming-soon', 'product_cat' )) echo 'coming_soon_cat'; ?>">
							<?php
								woocommerce_template_single_title();
								woocommerce_template_single_excerpt();
								woocommerce_template_single_price();
								if (has_term( 'coming-soon', 'product_cat' )) {
									echo '<p class="future_products">Coming Soon</p>';
								}
								woocommerce_template_single_add_to_cart();
							?>

							<div class="accordion_row">
								<div class="col">
									<div class="accordions">
										<div class="accordion">
											<input type="checkbox" id="description">
											<label class="accordion-label" for="description">DESCRIPTION</label>
											<div class="accordion-content">
												<?php the_content(); ?>
											</div>
										</div>
										<div class="accordion">
											<input type="checkbox" id="details">
											<label class="accordion-label" for="details">DETAILS</label>
											<div class="accordion-content">
												<?php
												global $product;
												echo '<pre class="detail_content">'.$product->get_meta( 'details' ).'</pre>';
												?>
											</div>
										</div>
										<div class="accordion">
											<input type="checkbox" id="shipping">
											<label class="accordion-label" for="shipping">SIZE and FIT</label>
											<div class="accordion-content">
												<?php
												global $product;
												echo '<pre class="size_fit_content">'.$product->get_meta( 'size_fit' ).'</pre>';
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div><!-- .product-summary -->
		</div>
    <div class="row custom_spw single-tab-section">
			<div class="col-xs-12">
				<div class="single-tab-title">
					<h2 class="tab-main-title">YOUR MATCHES</h2>
				</div>
				<div class="col-xs-12 custom_spw single-tab-section desktop_tab">
					<ul class="nav_buttons nav-tabs">
						<li class="visible"><a href="#tab1">MATCH IT WITH</a></li>
						<li><a href="#tab2">YOU MIGHT LIKE</a></li>
						<li><a href="#tab3">RECENTLY VIEWED</a></li>
					</ul>
					<div id="tab1" class="tab-content visible">
						<?php woocommerce_cross_sell_display(); ?>
					</div>
					<div id="tab2" class="tab-content not_visible">
						<?php woocommerce_upsell_display(); ?>
					</div>
					<div id="tab3" class="tab-content not_visible">
						<?php echo do_shortcode("[woocommerce_recently_viewed_products]"); ?>
					</div>
				</div>
			</div>
		</div>
</div>



<style>
  	.product-share-box label, .coming_soon_cat .single_add_to_cart_button, .coming_soon_cat .qib-container {
		    display: none !important;
		}
		.coming_soon_cat .share_section {
			  margin: 0 0;
		}
		.coming_soon_cat .product-share-box {
			position: absolute;
	    right: 35%;
		}
		.product-share-box {
			display: block;
			opacity: 0;
			visibility: hidden;
			transition: opacity 500ms;
		}
		.product-share-box.on {
		    opacity: 1;
				visibility: visible;
		}
		.social--sharing {
			border: 1px solid #fed2c7;
			border-radius: 8px;
			background-color: #fed2c7a3;
		}

		.size_fit_content, .detail_content {
			font-family: "Raleway", sans-serif;
			font-weight: 400;
			color: #000000;
			background: white;
			font-size: 14px;
			line-height: 24px;
			border: none;
			padding: 0;
			white-space: pre-wrap;
			word-break: break-word;
		}

		/* product price */
		.product--summary .single-price-wrapper .price .vat {
			font-size: 16px;
			color: #352828;
		}
		.future_products {
			color: black;
			font-weight: 500;
			line-height: 1.2;
			text-transform: uppercase;
			margin: 0;
		}
		.single-tab-section .vat {
			color: white !important;
			font-weight: 500;
		}

		/* Accordion CSS */
		input {
			position: absolute;
			opacity: 0;
			z-index: -1;
		}
		.accordion_row {
			display: inline-block;
			padding-top: 25px;
		}
		.accordion_row .col {
			flex: 1;
		}

		.accordions {
			overflow: hidden;
		}
		.accordion {
			width: 100%;
			color: black;
			overflow: hidden;
		}
		.accordion-label {
		  display: flex;
		  justify-content: flex-start;
		  letter-spacing: 1.1px;
		  padding: 14px 0;
		  background: #ffffff;
			font-size: 15px;
		  font-weight: 600;
		  cursor: pointer;
		  border-top: 1px solid #fce7e4;
		}
		.accordion:last-child .accordion-label {
			border-bottom: 1px solid #fce7e4;
		}
		.accordion-label:hover {
			color: #cf987e;
		}
		.accordion-label::after {
			content: "\002B";
			width: 20px;
			height: 24px;
			text-align: center;
			font-size: 22px;
			transition: all 0.35s;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.accordion-content {
			max-height: 0;
			padding: 0 1em;
			color: #000000;
			background: white;
			transition: all 0.35s;
			overflow: auto;
		}
		.accordion-close {
			display: flex;
			justify-content: flex-end;
			padding: 1em;
			font-size: 0.75em;
			background: #ffffff;
			cursor: pointer;
		}
		.accordion-close:hover {
			color: #cf987e;
		}
		input:checked + .accordion-label {
			border-bottom: 1px solid #fce7e4;
		}
		input:checked + .accordion-label::after {
			content: "\002D";
			width: 20px;
			height: 24px;
			text-align: center;
			font-size: 22px;
			transition: all 0.35s;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		input:checked ~ .accordion-content {
			max-height: 320px;
			padding: 1em;
		}

		/* Tab CSS */
		.custom_spw .upsells .block_heading {
			display: none;
		}
		.tab-main-title {
			position: relative;
			text-align: center;
			font-style: italic;
			font-size: 35px;
			font-weight: 600;
			z-index: 1;
			overflow: hidden;
		}
		.tab-main-title:before, .tab-main-title:after {
		    position: absolute;
		    top: 51%;
		    overflow: hidden;
		    width: 50%;
		    height: 2px;
		    content: '\a0';
		    background-color: black;
		}
		.tab-main-title:before {
		    margin-left: -51%;
		}
		.tab-main-title:after {
				margin-left: 1.5%;
		}

		.custom_spw.single-tab-section .woocommerce-Tabs-panel .grid-items .grid-item {
		    padding-left: 10px;
		    padding-right: 10px;
		}

		/* .custom_spw.single-tab-section .wc-tabs {
		    margin: 0 0 30px;
		    width: 100%;
		} */
		.custom_spw.single-tab-section .grid-items {
			transition: all 0.4s ease-out;
			margin: 0 -10px;
		}
		.custom_spw.single-tab-section .wc-tabs li {
		    display: table-cell;
		    width: 1%;
				color: #fed2c7;
				letter-spacing: 1.2px;
				border: 1px solid #fed2c7;
				transition: all 0.4s ease;
		}
		.custom_spw.single-tab-section .recently_viewed_img {
				background-position: top;
				background-size: cover;
				background-repeat: no-repeat;
				height: 272.5px;
		}
		.custom_spw.single-tab-section .recently_viewed_img .yith-wcwl-add-to-wishlist {
				text-align: right;
				padding: 10px;
		}
		.recently_viewed_on_hover {
			  display: none;
				position: absolute !important;
		    right: 0;
		    left: 0;
		    top: 0px;
		    bottom: 0;
		    height: 100%;
		    padding: 50% 15px 0 !important;
		    background-color: rgba(0, 0, 0, 0.3);
		}
		.recently_viewed_on_hover h3,
		.recently_viewed_on_hover p,
		.recently_viewed_on_hover .price .amount{
				color: white !important;
		}
		.recently_viewed_on_hover p {
				font-size: 10px;
				padding-bottom: 5px;
		}
		.recently_viewed_on_hover .price {
				border: none !important;
				font-size: 1.4rem;
				font-weight: 500;
		}
		.recently_viewed_hover:hover .recently_viewed_on_hover {
		  	display: block;
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
		.product_item--thumbnail:hover .wp_alt_image::before, .recently_viewed_hove:hover .wp_alt_image::before {
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
		.recently_viewed_on_hover .yith-wcwl-wishlistaddedbrowse,
		.recently_viewed_on_hover .yith-wcwl-wishlistexistsbrowse {
				color: white;
				font-weight: 600;
		}
		/* .recently_viewed_on_hover .yith-wcwl-wishlistaddedbrowse a.custom-browse-icon {
				background-image: url(/wp-content/uploads/2020/07/shell-icon.png);
				margin: auto;
		} */
		/* .custom_spw.single-tab-section .wc-tabs .upsell_tab.active,
		.custom_spw.single-tab-section .wc-tabs .cross_sell_tab.active,
		.custom_spw.single-tab-section .wc-tabs .recently_viewed_tab.active {
				background-color: #fed2c7;
		}
		.custom_spw.single-tab-section .wc-tabs .upsell_tab:hover,
		.custom_spw.single-tab-section .wc-tabs .cross_sell_tab:hover,
		.custom_spw.single-tab-section .wc-tabs .recently_viewed_tab:hover {
				background-color: #fed2c78c;
		}
		.custom_spw.single-tab-section .wc-tabs .upsell_tab.active a,
		.custom_spw.single-tab-section .wc-tabs .cross_sell_tab.active a,
		.custom_spw.single-tab-section .wc-tabs .recently_viewed_tab.active a,
		.custom_spw.single-tab-section .wc-tabs .upsell_tab:hover a,
		.custom_spw.single-tab-section .wc-tabs .cross_sell_tab:hover a,
		.custom_spw.single-tab-section .wc-tabs .recently_viewed_tab:hover a {
				color: white !important;
		} */
		.custom_spw.single-tab-section .product_item p,
		.recently_viewed_products_wrap .custom-product-short-description {
				font-family: "Raleway", sans-serif;
		    line-height: 1.2;
		    font-size: 13px;
		    font-weight: 500;
		    white-space: nowrap;
		    overflow: hidden;
		    text-overflow: ellipsis;
		    text-transform: uppercase;
				color: white;
				margin: 0;
		}
		.custom_spw.single-tab-section .product_item .product_item--title {
		    font-family: "Raleway", sans-serif;
		    margin: 0;
		    text-transform: uppercase;
				font-size: 24px;
		}
		.custom_spw.single-tab-section .products-grid .product_item--info .price {
				border: 1px solid black;
		    border-radius: 8px;
		    padding: 0 10px;
		    margin-top: 8px;
		}

		/* CART Button CSS */
		.custom_spw .product--summary .quantity_wrap {
			display: flex;
		  flex-direction: column;
			padding-top: 15px;
		}
		.custom_spw .product--summary .quantity_wrap .product_code {
		    margin-left: 0 !important;
		}

		.custom_spw .product--summary .qib-container {
			width: max-content;
			margin-right: 0;
			border: 1px solid #9E9E9E;
			border-radius: 20px;
		}
		.custom_spw .product--summary .qib-container .qib-button {
			border: 1px solid transparent !important;
			background-color: transparent !important;
		}
		.custom_spw .product--summary .quantity .qty {
			left: 0;
			border: 1px solid transparent !important;
			opacity: 1;
		}
		.custom_spw .single_add_to_cart_button {
			background-color: #fed2c7;
			color: white;
			width: 50%;
			padding: 6px;
			border-radius: 20px;
			font-family: 'Raleway', sans-serif;
			font-size: 14px;
			font-weight: 500;
			letter-spacing: 1.2px;
		}

		/* Share section CSS */
			.share_section {
				display: flex;
		    height: 35px;
		    width: 40%;
		    margin: -11% 0 0 auto;
		    justify-content: center;
		    font-size: 18px;
		    color: #8b8b8b;
		    align-items: center;
				position: relative;
			}
			.share_section  .yith-wcwl-add-to-wishlist, .share_section .share_wrap {
				width: 50%;
			}
			.custom_spw .yith-wcwl-add-button span, .custom_spw .product--summary .screen-reader-text,
			.custom_spw.single-tab-section .products-grid .product_item--info .star-rating {
				display: none;
			}
			.custom_spw .yith-wcwl-icon.fa.fa-heart-o {
				background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/07/shell-icon.png);
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
				width: 30px;
		    height: 30px;
			}
			.custom_spw .fa-heart-o:before {
				content: "";
			}
			.custom_spw .custom_sharing i {
				font-size: 25px;
				line-height: 30px;
			}

		/* Variations CSS */
		.custom_spw .variations .select-option a {
		  width: 20px !important;
		  height: 20px !important;
		  min-width: 20px !important;
		  min-height: 20px !important;
		  line-height: 20px !important;
		}
		.custom_spw .swatch-wrapper {
			border-color: #fed2c7;
			font-size: smaller;
		}
		.sp_breadcrumb {
			margin: 22px 0 20px;
			color: black;
		}
		.sp_breadcrumb .sep {
			margin: 0 10px;
	    height: 8px;
	    width: 8px;
	    background-color: #fed2c7;
	    border-radius: 50%;
	    display: inline-block;
		}
		.woocommerce-breadcrumb .sep:last-child {
		  display: none;
		}

		/* Main Image and slider CSS */
    .custom_spw .slick-list {
        width: 90%;
        margin: auto;
    }
		.custom_spw .slick-slider .slick-arrow {
			width: 30px;
			height: 90px;
		}
		.custom_spw .custom_thumbnail_slider  .slick-slider .slick-arrow {
			width: 20px;
			height: 50px;
		}
		.custom_spw .slick-slider .slick-next,
		.custom_spw .slick-slider .slick-prev {
			opacity: 1;
		}
		.custom_spw .slick-slider .slick-prev ,
		.custom_spw .slick-slider .slick-next {
			background-position: center center;
			background-repeat: no-repeat;
			background-size: contain;
			width: 30px;
			height: 90px;
			color: transparent;
		}
		.custom_spw .slick-slider .slick-next {
			background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/NAMESAKE-right-icon.png);
		}
		.custom_spw .slick-slider .slick-prev {
			background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/NAMESAKE-left-icon.png);
		}

    body:not(.rtl) .custom_spw .la-custom-badge {
        left: 50px;
    }
    .custom_spw .woocommerce-product-gallery__actions {
				display: none;
        right: 50px;
				top: 15px;
    }
    /* .custom_spw .custom-product-left .dl-icon-right:before,
    .custom_spw .custom-product-left .dl-icon-left:before {
			display: none;
    } */
    .custom_spw .custom-product-left .custom_thumbnail_slider  .slick-prev ,
    .custom_spw .custom-product-left .custom_thumbnail_slider  .slick-next  {
			width: 20px;
			height: 50px;
    }
		.custom_spw .custom-product-left .custom_thumbnail_slider  .slick-prev  {
			background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/NAMESAKE-left-icon.png);
		}
		.custom_spw .custom-product-left .custom_thumbnail_slider  .slick-next  {
			background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/NAMESAKE-right-icon.png);
		}
    .custom-attributes {
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }
    .custom_spw .product--summary .product-share-box {
        margin-top: 0;
    }
		.custom_thumbnail_slider_wrap {
			margin: 35px -5px 0 -5px;
		}
		.thumb_img {
			display: none !important;
		}

		.thumb_img_wrap {
			border: 3px solid #CCCCCC;
	    margin: 5px;
	    height: 140px;
	    background-repeat: no-repeat;
	    background-size: cover;
	    background-position: center;
			cursor: pointer;
		}
		.custom_thumbnail_slider .slick-slide.slick-active.is-active {
			border: 3px solid #23282d;
		}
		.custom_gallery_slider .slick-track {
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}
		.custom_gallery_slider .slick-slide {
			padding: 0 5px;
		}
		.custom_gallery_slider .slick-slide.slick-current.slick-active {
			cursor: -moz-zoom-in;
			cursor: -webkit-zoom-in;
			cursor: zoom-in;
			position: relative;
		}
		/* .custom_gallery_slider .slick-list {
			display: flex;
	    justify-content: center;
	    max-height: 600px;
		} */
		.custom_gallery_slider .slick-slide.slick-current.slick-active:after {
			content: 'View Fullscreen';
	    position: absolute;
	    bottom: 0px;
	    left: 0px;
	    padding: 5px 15px;
	    background-color: #eeee;
	    border: 1px solid black;
	    color: black;
	    font-size: smaller;
	    line-height: 1.2;
			text-transform: uppercase;
		}

		/* 	Product Zoom Pop-up CSS */
		body.logged-in.admin-bar .pswp {
	    	top: 32px;
		}
		.pswp__bg {
			background: #ffffff;
		}
		.pswp__button--arrow--right:before,
		.pswp__button--arrow--left:before {
			font-family: FontAwesome;
			color: black;
			background: none;
			font-size: 60px;
		}
		.pswp__button--arrow--left:before {
			content: "\f104";
		}
		.pswp__button--arrow--right:before {
			content: "\f105";
		}

		.custom_spw .product--summary .product_title {
			margin: 0;
			font-size: 24px;
			font-weight: 600;
			font-family: 'Raleway', sans-serif;
		}
		.custom_spw .recently_viewed_products_wrap .woocommerce-Price-amount.amount,
		.recently_viewed_on_hover .price .amount {
			color: black;
	    font-weight: 600;
	    font-family: 'Raleway', sans-serif;
		}
		.custom_spw .product--summary .woocommerce-product-details__short-description {
			padding-top: 0;
			color: black;
			font-weight: 500;
			text-transform: uppercase;
			margin-bottom: 8px;
		}
		.custom_spw .product--summary .single-price-wrapper {
			margin-top: 0;
			/* Shobnom: 23-10-2020 start */
			font-weight: 700;
			/* Shobnom: 23-10-2020 end */
		}
		.custom_spw .product--summary .variations_button {
			margin-top: 0;
		}
		.custom_spw .product_code {
			padding: 10px 0 !important;
			float: left !important;
			text-align: left !important;
			color: black;
			font-weight: 600;
		}
		.yith-wcwl-wishlistaddedbrowse .feedback {
		    display: block;
		}
		.share_section .yith-wcwl-wishlistaddedbrowse, .share_section .yith-wcwl-wishlistaddedbrowse .feedback {
			font-size: 13px;
			line-height: 1.2;
		}
		.share_section .yith-wcwl-wishlistaddedbrowse .feedback {
	    position: absolute;
	    top: -15px;
	    left: -15px;
	    right: 0;
		}

		/* New wishlist & quick_view CSS */
		.product_wl_qv_btn .yith-wcwl-icon {
			display: block;
			visibility: hidden;
		}
		.product_wl_qv_btn {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 20%;
		}
		.product_wl_qv_btn .quick_view {
			height: 22px;
			width: 40px;
			margin-right: 15px;
		}
		.product_wl_qv_btn .yith-wcwl-add-button a {
			height: 30px;
			width: 30px;
			display: block;
			background-image: url(/mukta/wp-content/uploads/2020/10/shell-icon-white.png);
			background-position: center;
			background-size: contain;
			background-repeat: no-repeat;
		}
		.product_wl_qv_btn .yith-wcwl-wishlistaddedbrowse a.custom-browse-icon {
				background-image: url(/mukta/wp-content/uploads/2020/10/shell-icon-white.png);
				margin: auto;
		}
		.product_wl_qv_btn .yith-wcwl-wishlistaddedbrowse .feedback, .product_wl_qv_btn .yith-wcwl-wishlistaddedbrowse a {
			display: block;
			color: white;
		}

		/* Size guide Modal CSS */
		.modal_btn {
			text-transform: uppercase;
	    font-family: "Raleway", sans-serif;
	    font-weight: 700;
	    font-size: 10px;
	    line-height: 1.2;
	    cursor: pointer;
	    color: black;
		}
		.modal_close_btn {
			color: black;
	    position: absolute;
	    top: 5px;
	    right: 10px;
	    cursor: pointer;
		}
		.popup-wrap {
			position: relative;
		}
		.size_content {
			margin: 20px 0 0;
	    padding: 5px;
	    border: 1px solid #a4a4a4;
		}
		.modal {
		  display: none;
		  position: fixed;
		  z-index: 1;
		  padding-top: 100px;
		  left: 0;
		  top: 0;
		  width: 100%;
		  height: 100%;
		  overflow: auto;
		  background-color: rgb(0,0,0);
		  background-color: rgba(0,0,0,0.4);
		}

		/* Modal Content */
		.popup-overlay {
			position: fixed;
	    top: 0;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    background: rgba(0, 0, 0, 0.7);
	    transition: opacity 500ms;
	    visibility: hidden;
	    opacity: 0;
	    width: 100%;
			z-index: 30;
			transition: all 0.5s ease-in-out;
		}
		.popup-content {
		  visibility: hidden;
			margin: 20px auto;
			padding: 20px;
			background: #fff;
			border-radius: 5px;
			width: 60%;
			position: relative;
			transition: all 0.5s ease-in-out;
		}
		.popup-content.active, .popup-overlay.active {
		  visibility: visible;
			opacity: 1;
		}

		button {
		  display: inline-block;
		  vertical-align: middle;
		  border-radius: 30px;
		  margin: .20rem;
		  font-size: 1rem;
		  color: #666666;
		  background: #ffffff;
		  border: 1px solid #666666;
		}

		button:hover {
		  border: 1px solid #666666;
		  background: #666666;
		  color: #ffffff;
		}

		#picker_pa_size .select-option.selected {
			background-color: #fed2c7;
			color: white;
		}
		#picker_pa_colour .swatch-wrapper.la-swatch-item-style-default:not(.swatch-only-label).selected {
		    border-color: #fed4ca;
		    border-width: 2px;
		}
		.pswp__previews {
			position: absolute;
	    top: 0;
	    right: 0;
	    left: 0;
	    width: 8%;
	    height: 80vh;
	    margin: 5% 15px;
	    display: flex;
	    flex-flow: column;
	    justify-content: center;
	    align-items: center;
	    background-color: transparent;
	    overflow: auto;
		}
		.pswp__previews img {
		    --size: 4em;
				margin: 5px 0;
		}
.pswp__ui--idle .pswp__button--arrow--left, .pswp__ui--idle .pswp__button--arrow--right {
	visibility: hidden;
}
		/* .pswp__previews {
		    position: absolute;
		    top: 0;
		    right: 0;
		    left: 0;
		    width: 50%;
		    margin: auto;
		    display: flex;
		    flex-flow: row;
		    justify-content: center;
		    align-items: center;
		    background-color: transparent;
		    overflow: auto;
		    scrollbar-width: none;
		} */

		/* New slider for Your Matches Section */
		.custom_spw.single-tab-section .cross-sells .slick-prev, .custom_spw.single-tab-section .cross-sells .slick-next,
		.custom_spw.single-tab-section .upsells_products .slick-prev, .custom_spw.single-tab-section .upsells_products .slick-next,
		.lg-actions .lg-next, .lg-actions .lg-prev {
		    background-position: center center;
		    background-repeat: no-repeat;
		    background-size: contain;
		    opacity: 1;
		}
		.lg-actions .lg-next::before, .lg-actions .lg-prev:after {
			  display: none;
		}
		.custom_spw.single-tab-section .cross-sells .slick-prev,
		.custom_spw.single-tab-section .upsells_products .slick-prev, .lg-actions .lg-prev {
		    background-image: url(/mukta/wp-content/uploads/2020/09/NAMESAKE-left-icon.png);
		}
		.custom_spw.single-tab-section .cross-sells .slick-next,
		.custom_spw.single-tab-section .upsells_products .slick-next, .lg-actions .lg-next {
		    background-image: url(/mukta/wp-content/uploads/2020/09/NAMESAKE-right-icon.png);
		}
		.cross-sells-products .product_item, .upsells_products .product_item {
			padding: 0 15px;
		}
		.custom_spw.single-tab-section {
			margin-bottom: 20px;
		}

		/* New Zoom Feature */
		.lg-toolbar, .lg-outer .lg-thumb-outer, .lg-outer .lg-toogle-thumb {
		    background-color: rgba(0,0,0,.3);
		}
		.lg-outer .lg-toogle-thumb {
	    top: -41px;
		}
		.lg-outer {
			  background-color: white;
		}
		.lg-outer .lg-thumb {
				margin: auto;
		}
		.lg-outer .lg-toogle-thumb {
			left: 20px;
    	right: 0;
		}
		.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover {
				border-color: #fed2c7;
		}
		.lg-toolbar .lg-rotate-right, .lg-toolbar .lg-rotate-left, .lg-toolbar .lg-flip-hor,
		.lg-toolbar .lg-flip-ver, .lg-toolbar #lg-share, .lg-toolbar .lg-autoplay-button,
		.lg-toolbar .lg-download {
			  display: none;
		}
		.lg-actions .lg-next, .lg-actions .lg-prev {
			width: 30px;
			height: 60px;
			background-color: transparent;
		}
		@media (max-width: 800px) {
			.custom_spw	.product--summary .woocommerce-product-details__short-description {
				padding-bottom: 0;
			}
			.product--summary .social--sharing, .product--summary .product_meta {
			    margin-top: 0;
			}
		}
    @media (min-width: 1401px) {
			.custom_spw .slick-slider .slick-prev {
					right: calc( 100% - 35px);
			}
			.custom_spw .slick-slider .slick-next {
					left: calc( 100% - 35px);
			}
		}
    @media (max-width: 1400px) {
        .custom_spw .slick-slider .slick-prev {
            right: calc( 100% - 25px);
            cursor: pointer;
        }
        .custom_spw .slick-slider .slick-next {
            left: calc( 100% - 25px);
            cursor: pointer;
        }
    }
		@media (min-width: 1200px){
			.custom_spw.single-tab-section .products.products-grid.xl-block-grid-3 .grid-item,
			.custom_spw.single-tab-section .products_scenario_recent_products .xl-block-grid-1 .grid-item {
			    width: 20%;
			}
		}

		/* For responsive breaking points */
		/* Less that small devices */
		@media (max-width: 575px) {
			.custom_spw.single-tab-section .recently_viewed_img {
					height: 390px;
			}
		}

		/* Small devices (landscape phones, 576px and up) */
		@media (min-width: 540px) {
			.custom_spw.single-tab-section .recently_viewed_img {
					height: 390px;
			}
			.share_section {
				margin: -7% 0 0 auto;
			}
		}

		/* Medium devices (tablets, 768px and up) */
		@media (min-width: 768px) {
			.custom_spw.single-tab-section .recently_viewed_img {
					height: 450px;
			}
			.share_section {
				margin: -13% 0 0 auto;
			}
			.hidden_col {
				padding-left: 0;
    		margin-left: -10px;
			}
		}

		/* Large devices (desktops, 992px and up) */
		@media (min-width: 992px) {
			.custom_spw.single-tab-section .recently_viewed_img {
					height: 378px;
			}
			.share_section {
				margin: -10% 0 0 auto;
			}
		}

		/* Extra large devices (large desktops, 1200px and up) */
		@media (min-width: 1200px) {
			.custom_spw.single-tab-section .recently_viewed_img {
					height: 340px;
			}
		}
		@media (max-width: 767px) {
			.sp_breadcrumb {
				text-align: center;
			}
			.lg-hide-items .lg-toolbar {
				opacity: 1;
			}
			.lg-toolbar .lg-icon, #lg-counter {
				color: white;
			}
			.lg-toolbar .lg-icon {
				width: 40px;
			}
		}

		/* New Tabs CSS */
		.tab-content.visible {
			height: auto;
		  visibility: visible;
		  opacity: 1;
		  transition: opacity 1s linear;
		}
		.tab-content.not_visible {
			height: 0px;
			overflow: hidden;
		  visibility: hidden;
		  opacity: 0;
		  transition: visibility 0s 1s, opacity 1s linear;
		}
		.nav_buttons {
			margin: 0 0 30px;
			list-style: none;
			display: flex;
			flex-wrap: wrap;
			padding: 0;
		}
		.nav_buttons > li > a {
			display: block;
		 }
		.nav-tabs:before, .nav-tabs:after {
			display: table;
			content: "";
		 }
		.nav-tabs:after {
			clear: both;
		 }
		.nav-tabs > li {
			color: #fed2c7;
	    letter-spacing: 1.2px;
	    border: 1px solid #fed2c7;
	    transition: all 1s ease;
			-webkit-box-flex: 1;
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			text-align: center;
			width: 33.33%;
		 }
		.nav-tabs > li > a {
			position: relative;
	    display: block;
	    padding: 15px 30px;
	    line-height: 1.2;
	    font-size: 14px;
		}
		.nav-tabs > li:hover, .nav-tabs > li:focus {
			background-color: #fed2c78c;
		 }
		.nav-tabs li.visible {
    	background-color: #fed2c7;
		 }
		 .nav-tabs li.visible > a, .nav-tabs > li:hover > a {
			 color: #ffffff;
			}

			@media (max-width: 767px) {
				.nav-tabs > li > a {
						padding: 8px 5px;
				    line-height: 1.2;
				    font-size: 12px;
				}
			}


</style>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('.custom_sharing').on('click', function(event) {
		event.preventDefault();
		$('.product-share-box').toggleClass('on');
	});
});
jQuery(document).ready(function($){
	//appends an "active" class to .popup and .popup-content when the "Open" button is clicked
	$(".open").on("click", function() {
	  $(".popup-overlay, .popup-content").addClass("active");
	});

	//removes the "active" class to .popup and .popup-content when the "Close" button is clicked
	$(".close, .popup-overlay").on("click", function() {
	  $(".popup-overlay, .popup-content").removeClass("active");
	});
});

jQuery(document).ready(function($){
	$(document).ready(function() {
		$('.nav-tabs > li > a').click(function(event) {
			event.preventDefault(); //stop browser to take action for clicked anchor
			//get displaying tab content jQuery selector
			var active_tab_selector = $('.nav-tabs > li.visible > a').attr('href');
			//find actived navigation and remove 'active' css
			var actived_nav = $('.nav-tabs > li.visible');
			actived_nav.removeClass('visible');
			//add 'active' css into clicked navigation
			$(this).parents('li').addClass('visible');
			//hide displaying tab content
			$(active_tab_selector).removeClass('visible');
			$(active_tab_selector).addClass('not_visible');
			//show target tab content
			var target_tab_selector = $(this).attr('href');
			$(target_tab_selector).removeClass('not_visible');
			$(target_tab_selector).addClass('visible');
		});
	});
});
</script>

<?php get_footer(); ?>
