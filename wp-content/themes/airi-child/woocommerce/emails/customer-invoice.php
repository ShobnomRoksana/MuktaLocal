<?php
/**
 * Customer invoice email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-invoice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Executes the e-mail header.
 *
 * @hooked WC_Emails::email_header() Output the email header
 */
//do_action( 'woocommerce_email_header', $order, $email ); ?>


	<?php


/**
 * Hook for the woocommerce_email_order_details.
 *
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook for the woocommerce_email_order_meta.
 *
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook for woocommerce_email_customer_details.
 *
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

$item_totals = $order->get_order_item_totals();
$i = 0;
$payment = "N/A";
foreach ( $item_totals as $total ) {
    $i++;
    
    if(wp_kses_post( $total['label'] )==="Payment method:"){
        $payment =  strtoupper(wp_kses_post( $total['value'] ));
    }
}

?>

<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600"> 
             <tbody><tr> 
              <td align="left"> 
               <table cellpadding="0" cellspacing="0" width="100%"> 
                 <tbody><tr> 
                  <td width="600" align="center" valign="top"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p5" style="font-size:0"> 
                       <table border="0" width="100%" cellpadding="0" cellspacing="0" role="presentation"> 
                         <tbody><tr> 
                          <td style="border-bottom: 1px solid #ffffff;background: none;height: 1px;width: 100%;margin: 0px"></td> 
                         </tr> 
                       </tbody></table></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
           </tbody></table>
<table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600"> 
             <tbody><tr> 
              <td align="left"> 
               <!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><tr><td width="298" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="298" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#fed2c7" style="background-color: #fed2c7" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p10" style="border: 1px solid  #fed2c7"><p style="color: #ffffff; font-size: 16px; font-weight: 600;">PAYMENT METHOD</p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="0"></td><td width="302" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="302" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p10" style="border: 1px solid  #fed2c7"><p style="color: #200f0e; font-size: 16px; font-weight: 600;"><?php echo $payment?></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody></table>
