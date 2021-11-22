<style type="text/css">

	.site-main .container{
		width: 800px
	}

	.row{
		margin: 0px;
	}
	.order-received{
		font-family: "Raleway", sans-serif;
	}
	.order-received img{
		/* width: 100%; */
		height: 100%;
	}

	.confirmation-panel,.amount-block,.shipping-block,.payment-method{
		background-color: #fed2c7;
	}

	.confirmation-panel,.amount-block,.shipping-block,.loop, .shipping-table{

		margin-top: 20px;
		padding: 20px;
	}
	.payment-block, .action{
		margin-top: 20px;
	}
	.shipping-block{
		border: 1px solid black;
	}

	.confirmation-panel h1, .confirmation-panel .order{
		color: white;
	}
	.confirmation-panel .order{
		background-color: black;
		margin: 0px;
	}
	.confirmation-panel .order div{
		border: 1px solid white;
	}
	.confirmation-panel,.shipping-block, .action .col-sm-6{

		border-radius: 20px;
	}

	.action .col-sm-6{
		background-color: #fed2c7;
		padding: 10px;
		text-align: center;
		color: white;
		font-weight: 500;
		cursor: pointer;

	}

	.action .col-sm-6:hover{
		background-color: grey;
		color: black;
	}

	.loop hr{

		border-top: 1px solid #fed2c7;
	}
	.amount-in-taka p {
		float:right;
		clear:both;

	}
	.summary-item div{
		float: right;
	}

	.summary{
		border-bottom: 1px solid #fed2c7;
		margin: 0px;
		padding:  10px 0px 10px 0px;
	}
	.payment-credit,.loop{

		border: 1px solid  #fed2c7;

	}

	.order-block{
		padding: 20px;
	}
	.confirmation-panel h1{
		margin: 0;
		line-height: 120%;
		font-size: 30px;
		font-weight: normal;
		text-align: center;
		font-family: "Playfair Display", serif, helvetica, sans-serif;
		color: white;
		font-style: italic;
		text-shadow: unset;
	}

	.order,.total-amount,.shipping-title,.payment-block p,.order-amount p,.total-amount-in-taka, .DELIVERY-table-head{
		margin: 0;
		line-height: 150%;
		font-weight: 600;
		font-size: 16px;
	}
	.order{

		color: #fef3f2;

	}

	.confirmation-panel h1, .email-thanks,.detail{
		padding-bottom: 10px;

	}

	.order-title{
		margin: 0;
		line-height: 150%;
		color: #333333;
		font-weight: 600;
		font-size: 16px;
	}

	.payment-method{
		color: #ffffff;

	}
	.payment-method,.payment-credit{
		padding: 10px;
		text-align: center;
	}
	.order div{
		padding: 5px;
	}
	.numberCircle{
		margin: 0;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    padding: 5px;
    margin-bottom: 5px;
    background: #fff;
    border: 2px solid #FED2C7;
    text-align: center;
    font-size: 16px;
    line-height: 1.1;
    color: #333;
	}

	.order-description{
		padding-top: 10px;
	}

	.order-amount{
		padding: 40px 0px 40px 0px;
	}

	.order-amount p{
		float: right;
		font-weight: 600;
	}

	.shipping-description{
		padding-top: 20px;

	}

	.shipping-table {
		border: 1px solid black;
		outline-color: #fed2c7;
		outline-style: solid;
	}

	.table_child{
		padding: 10px;
	}

	.table_child .row{
		border: 1px solid #fed2c7;
	}

	.table_child .row .col-sm-6{
		padding: 10px;
		border-right: 0.5px solid  #fed2c7;
	}
	.product_colour {
		display: none;
	}

</style>
<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
$items = $order->get_items();
$item_totals = $order->get_order_item_totals();
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();


$actions = wc_get_account_orders_actions( $order );
$url = "";
if ( ! empty( $actions ) ) {
    foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
    	if($action['name'] =="Show Track"){
    		$url= esc_url( $action['url']) ;
    	}
    }
}

?>


<div class="container order-received">
	<div class="row ">

		<div class="row text-center confirmation-panel">
			<div>
				<h1>Order Confirmation</h1>
			</div>
			<div class ="email-thanks">
				<?php echo $order->get_user()->user_login?>, thank you for your order!

			</div>
			<div class = "detail">
				CHECK THE DETAILS BELOW

			</div>
			<div class = "row order">
				<div class = "col-sm-6">
					ORDER NO: <?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<div class = "col-sm-6">
					ORDER DATE: <?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>

		</div>

		<div class = "row action">
			<div class = "col-sm-6 my_button">
				CANCEL ORDER
			</div>
			<div class = "col-sm-6">
				<a href = <?php echo $url ?>>TRACK ORDER</a>
			</div>
		</div>

		<div class = "loop">


			<div class="row">
				<div class="row summary">

					<div class = "col-sm-6">
						<div class = "order-title">Order Summary</div>
					</div>
					<div class = "col-sm-6 summary-item">
						<div>You have <?php echo count($items)?> item in this order</div>
					</div>
				</div>
				<?php
				foreach ( $items as $item_id => $item ) :

					$product       = $item->get_product();
					$sku           = '';
					$purchase_note = '';
					$image         = '';

					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						continue;
					}

					if ( is_object( $product ) ) {
						$sku           = $product->get_sku();
						$name          = $product->get_title();
						$purchase_note = $product->get_purchase_note();
						$image         = $product->get_image(array(200,200));
						$colour        = $product->get_attributes()["pa_colour"];
						$size          = $product->get_attributes()["pa_size"];
						// $short_description = $product->get_short_description();
					}



					?>

					<?php
					$qty          = $item->get_quantity();
					$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

					if ( $refunded_qty ) {
						$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
					} else {
						$qty_display = esc_html( $qty );
					}

					?>
					<div class = "row order-block">
						<div class = "col-sm-4">
							<?php  echo $image ?>
						</div>
						<div class = "col-sm-4 order-description">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product->get_name(), $item, true )); ?>

							<p class="product_colour" style="margin: 0; font-size: 14px; font-family: &quot;Raleway&quot;, sans-serif; line-height: 150%; color: #333333;"><?php echo $colour?></p>
							<p class="numberCircle" ><?php echo $size?></p>


							<div style="margin-top: 10px;"><span class="quantity" style="padding: 5px 20px 5px 20px; margin-top: 10px; border: 1px solid #fed2c7; font-weight: 600; font-size: 12px;">QUANTITY <span style="font-size: 16px; margin-left: 5px;"><?php echo $qty_display?></span><span></span></span></div>
						</div>
						<div class = "col-sm-4 order-amount">
							<p><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></p>
						</div>
					</div>



					<?php if ($item_id != array_key_last($items)){ ?>


						<hr>
					<?php } ?>


				<?php endforeach; ?>
			</div>

		</div>
		<div class="row amount-block">

			<div class="row">
				<div class ="col-sm-6">
					<?php
					$i = 0;
					foreach ( $item_totals as $total ) {
						$i++;

						if(wp_kses_post( $total['label'] )!="Total:" && wp_kses_post( $total['label'] )!="Payment method:"){

							?>
							<p><?php echo wp_kses_post( $total['label'] ); ?></p>

							<?php
						}
					}
					?>
				</div>

				<div class ="col-sm-6 amount-in-taka ">
					<?php
					$i = 0;
					foreach ( $item_totals as $total ) {
						$i++;

						if(wp_kses_post( $total['label'] )!="Total:" && wp_kses_post( $total['label'] )!="Payment method:"){

							?>
							<p style="line-height: 150%">
								<?php echo wp_kses_post( $total['value'] ); ?>

							</p>
							<?php
						}
					}
					?>

				</div>


			</div>
			<hr>

			<div class="row ">
				<div class ="col-sm-6 total-amount">
					<p>TOTAL</p>

				</div>

				<div class ="col-sm-6  amount-in-taka total-amount-in-taka">
					<p><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

				</div>


			</div>
		</div>


		<div class="row  shipping-block">
			<p class = "shipping-title">Billing Address</p>
			<div class=" row shipping-description">
				<p>The order will be billed to:</p>

				<div class ="col-sm-6">
					<p>ADDRESS</p>
					<p>
						<?php echo wp_kses_post( $address ); ?>
					</p>
				</div>

				<div class ="col-sm-6">
					<p>CONTACT</p>
					<p>
						<?php if ( $order->get_billing_email() ) : ?>
							<?php echo esc_html( $order->get_billing_email() ); ?>
						<?php endif; ?>
					</p>
					<?php if ( $order->get_billing_phone() ) : ?>
						<p><?php echo esc_html( $order->get_billing_phone() ); ?> </p>
					<?php endif; ?>
				</div>

			</div>


		</div>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>


		<div class="row  shipping-block">
			<p class = "shipping-title">Shipping Address</p>
			<div class=" row shipping-description">
				<p>The order will be shipped to:</p>

				<div class ="col-sm-6">
					<p>ADDRESS</p>
					<p>
						<?php echo wp_kses_post( $shipping ); ?>
					</p>
				</div>

				<div class ="col-sm-6">
					<p>CONTACT</p>
					<p>
						<?php if ( $order->get_billing_email() ) : ?>
							<?php echo esc_html( $order->get_billing_email() ); ?>
						<?php endif; ?>
					</p>
					<?php if ( $order->get_billing_phone() ) : ?>
						<p><?php echo esc_html( $order->get_billing_phone() ); ?> </p>
					<?php endif; ?>
				</div>

			</div>


		</div>

	<?php endif; ?>

	<div class="shipping-table">
		<div class="DELIVERY-table-head" colspan="6"> DELIVERY DETAIL </div>

		<div class="table_child">


			<div class = "row ">

				<div class = "col-sm-6" > ESTIMATED DELIVERY DATE </div>
				<div class = "col-sm-6" > Delivery 5 to 7 working days  </div>

			</div>


			<div class = "row">

				<div class = "col-sm-6" >  DELIVERY METHOD </div>
				<div class = "col-sm-6" > STANDARD DELIVERY </div>

			</div>


		</div>
	</div>

	<div class="row payment-block">
		<div class ="col-sm-6 payment-method">
			<p>PAYMENT METHOD </p>

		</div>

		<div class ="col-sm-6 payment-credit">
			<p><?php echo strtoupper(wp_kses_post( $order->get_payment_method_title())); ?></p>

		</div>




	</div>
</div>
</div>

<script>
  var status = <?php echo json_encode($order->get_status()) ?>;
  if(status === "cancelled"||status === "cancellationreq" ){
	jQuery(".my_button").html("CANCELLED");
			jQuery(".my_button").removeClass('my_button').addClass('not-clickable').off('click');

  }

  if(status === "completed"||status === "pos-completed" ){
	jQuery(".my_button").html("COMPLETED");
			jQuery(".my_button").removeClass('my_button').addClass('not-clickable').off('click');

  }

	jQuery(".my_button").on("click",(function(){
		if (confirm('Are you sure you want to cancel the order?')) {
  // Save it!

  jQuery(".my_button").html("CANCELLING...");

  jQuery.get('/wp-admin/admin-ajax.php',{'action': 'sayhello', order_id: <?php echo $order->get_order_number()?> },
  	function (msg) {
  		alert(msg);
		  if(msg ==="Your order cancellation request has been sent"){
			jQuery(".my_button").html("CANCELLED");
			jQuery(".my_button").removeClass('my_button').addClass('not-clickable').off('click');
		  }
		  else
		  {
			jQuery(".my_button").html("CANCEL ORDER");

		  }

  	});}
}));

</script>
