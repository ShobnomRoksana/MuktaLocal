<style type="text/css">
/* progress bar */
#stepProgressBar  {
	display:  flex;
	justify-content:  space-between;
	align-items:  flex-end;
	width:  900px;
	margin:  0  auto;
	margin-bottom:  40px;
	align-content: space-around;

}
.step  {
text-align:  center;
}

.step-text  {
margin-bottom:  20px;
color:  black;
font-family: 'Raleway';
font-weight: bold;
}


.bullet {
	border: 1px solid black;
	height: 40px;
	width: 40px;
	border-radius: 100%;
	color: white;
	display: inline-block;
	position: relative;
	transition: background-color 500ms;
    line-height:40px;
    background-color: black;
}


.bullet.completed  {
	color:  white;
	border: 1px solid #FED2C7;
	background-color:  #FED2C7;
}


.bullet-line.completed {
	content: '';
	position: absolute;
	right: -220px;
	bottom: 16px;
	height: 5px;
	width: 220px;
	background-color: #FED2C7;
}

/* Base styles and helper stuff */
.hidden  {
	display:  none;
}

/* progress bar */


 /* JS button */
button  {
	padding:  5px  10px;
	border:  1px  solid  black;
	transition:  250ms background-color;
}

button:hover  {
	cursor:  pointer;
	background-color:  black;
	color:  white;
}

button:disabled:hover  {
	opacity:  0.6;
	cursor:  not-allowed;
}
/* JS button */


.text-center  {
	text-align:  center;
}

.container  {
	max-width:  850px;
	margin:  0  auto;
	margin-top:  20px;
	padding:  20px;
}

/* First table */
.table_child {
	margin: 0 auto;
	width:  500px;
	border:  6px  solid  #FED2C7;
  }
  /* First table */


/* second table */
  .Start_table_child {
	margin: 0 auto;
	width:  500px;
	padding-bottom: 60px;
  }
  /* second table */

  .head-text{
	  padding-top: 15px;
	  text-align: center;
	  font-size: 18px;
	  font-weight: bold;
	  font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
  }


.Shipping_add{
	border-radius: 25px 25px;
}
.Shipping_add_end{
	border-radius: 0px 0px 25px 25px ;
	color: #FED2C7;
}

.Top-Head-text{
	padding-bottom: 25px;
	font-family: "Playfair Display","Helvetica Neue",Arial,sans-serif;
	font-style: italic;
	font-weight: bolder;
}

.Sub-top-head-text{
	font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
	font-style: normal;
	text-align: center;
}

.table-cell {
	font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
	font-weight: bold;
}

.DELIVERY-table-head {
	font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
	font-weight: bold;
	padding: 5px;
}

.table-cell-delivery{
	font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
	padding: 5px;
	font-weight: 600;
	font-size: small;
}
.shipping {
	font-family: "Raleway","Helvetica Neue",Arial,sans-serif;
}



		/* Create two equal columns that floats next to each other */
        .column {
	  float: left;
	  width: 50%;
	  padding-left: 100px;
	  padding-right: 100px;
	}

	/* Clear floats after the columns */
	.row:after {
	  content: "";
	  display: table;
	  clear: both;

	}

</style>
<?php

defined( 'ABSPATH' ) || exit;
if($order){
    $items = $order->get_items();
    $item_totals = $order->get_order_item_totals();
    $address    = $order->get_formatted_billing_address();
	$shipping   = $order->get_formatted_shipping_address();
	$status = $order->get_status();
}


?>

<?php if($order) : ?>
<div class="container">

<!-- Head section -->
<div class="Top-Head-text"><h1 class="text-center">Track Order</h1>
<p class="Sub-top-head-text" class="text-center">Follow the whereabouts of your order in this space</p>
</div>
<!-- Head section Ends-->



<!-- Starting table section -->
<div class="Start_table">
    <div class="Start_table_child">
<table border=1 cellspacing="0" bordercolor=" #FED2C7">

    <tr>

     <td class="table-cell" style="width:300px; height: 25px;text-align: center;"> ORDER NO. : <?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </td>
     <td class="table-cell" style="width:300px; height: 25px;text-align: center;"> ORDER DATE :  <?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>

    </tr>
    </table>
    </div>
</div>
<!-- Starting table section Ends -->


<!-- Progess Bar section-->
<div id="stepProgressBar">
<div class="step">

    <div class="bullet">

    1

    <div class = "bullet-line">
   </div>


</div>
<p class="step-text">ORDER PROCESSED</p>
<img src= <?php echo site_url()."/wp-content/uploads/myorder/Asset1B.png"?>>
</div>
<div class="step">

    <div class="bullet">2

    <div class = "bullet-line">
   </div>
    </div>
<p class="step-text">ORDER PICKED AND PACKED</p>
<img src= <?php echo  site_url()."/wp-content/uploads/myorder/Asset2B.png"?>>
</div>
<div class="step">

    <div class="bullet">3
    <div class = "bullet-line">
   </div>
    </div>
<p class="step-text">ORDER SHIPPED</p>
<img src= <?php echo  site_url()."/wp-content/uploads/myorder/Asset3B.png"?>>
</div>
<div class="step">

    <div class="bullet ">4
    <div class = "bullet-line">
   </div>
    </div>
<p class="step-text">ORDER DELIVERED</p>
<img src= <?php echo  site_url()."/wp-content/uploads/myorder/Asset4B.png"?>>
</div>
</div>
<!-- Progess Bar section Ends -->



<!-- Order table section-->
<div class="table">
<div class="table_child">
<table border=1 cellspacing="0">

<tr>
 <th class="DELIVERY-table-head" colspan="6"> DELIVERY DETAIL </th>
</tr>

<tr>

 <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> ESTIMATED DELIVERY DATE </td>
 <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> Delivery 5 to 7 working days  </td>

</tr>

<tr>
 <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> DELIVERY METHOD </td>
 <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> STANDARD DELIVERY</td>

</tr>

<tr>
    <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> ORDER STATUS </td>
    <td class="table-cell-delivery" style="width:300px; height: 25px;text-align: center;"> <?php echo wc_get_order_status_name($order->get_status())?> </td>

   </tr>

</table>
</div>
</div>
<!-- Order table section ends-->



<!-- Shipping Address section-->
<div style="background-color: #FED2C7; margin-top: 20px;"class="Shipping_add">
<p class="head-text">SHIPPING ADDRESS <br>The Order will be delivered to :</p>

<div class="row">
    <div class="column" >
      <h3 class="shipping">ADDRESS</h3>
      <?php echo wp_kses_post( $shipping ); ?>

    </div>
    <div class="column">
      <h3 class="shipping">CONTACT</h3>
      <?php if ( $order->get_billing_email() ) : ?>
					<?php echo esc_html( $order->get_billing_email() ); ?>
				<?php endif; ?>
                          </p>
                          <?php if ( $order->get_billing_phone() ) : ?>
				      <p><?php echo esc_html( $order->get_billing_phone() ); ?> </p>
				<?php endif; ?>

    </div>
  </div>
  <div style="background-color: #FED2C7;"class="Shipping_add_end">
    <p> &nbsp dfgdfg</p>
</div>
</div>
<!-- Shipping Address section ends-->




<!-- JS function button-->
<!-- <div id="main">
<p id="content"  class="text-center">Step Number 1</p>
<button id="previousBtn" >Previous</button>
<button id="nextBtn">Next</button>
<button id="finishBtn" >Finish</button>
</div>
</div> -->


 <?php else : ?>

  Sorry,you are not allowed to view this page
  <?php endif; ?>

<script>
const  previousBtn  =  document.getElementById('previousBtn');
const  nextBtn  =  document.getElementById('nextBtn');
const  finishBtn  =  document.getElementById('finishBtn');
const  content  =  document.getElementById('content');
const  bullets  =  [...document.querySelectorAll('.bullet')];
const  bulletline  =  [...document.querySelectorAll('.bullet-line')];

 const status =  <?php echo  json_encode($status) ?>;



var list = {
    "processing": [],
    "packed": [0],
    "shipped": [0,1],
    "completed": [0,1,2],
    "pos-sale": [],

}

var index = {
    "processing": [0],
    "pos-sale": [0],
    "packed": [0,1],
    "shipped": [0,1,2],
    "completed": [0,1,2,3]
}

const MAX_STEPS = 4;
let currentStep = 1;

    index[status].forEach(element => bullets[element].classList.add('completed'));
    list[status].forEach(element => bulletline[element].classList.add('completed'));


    // bulletline[].classList.add('completed');

	currentStep  +=  1;
	previousBtn.disabled  =  false;
	if  (currentStep  ===  MAX_STEPS)  {
		nextBtn.disabled  =  true;
		finishBtn.disabled  =  false;
	}
	content.innerText  =  `Step Number ${currentStep}`;



previousBtn.addEventListener('click',  ()  =>  {
	bullets[currentStep  -  2].classList.remove('completed');
	currentStep  -=  1;
	nextBtn.disabled  =  false;
	finishBtn.disabled  =  true;
	if  (currentStep  ===  1)  {
		previousBtn.disabled  =  true;
	}
	content.innerText  =  `Step Number ${currentStep}`;
});

finishBtn.addEventListener('click',  ()  =>  {
	location.reload();
});
</script>
