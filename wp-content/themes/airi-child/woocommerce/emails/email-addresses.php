<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?>

<table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border:1.5px solid #333333;border-radius: 20px;background-color: #fed2c7"> 
             <tbody><tr> 
              <td align="left"> 
               <table cellpadding="0" cellspacing="0" width="100%"> 
                 <tbody><tr> 
                  <td width="596" align="center" valign="top"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20"><p><span  style = "font-size: 16px; font-weight: 600;">BILLING ADDRESS</span><p>
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr> 
              <td align="left"> 
               <!--[if mso]><table width="596" cellpadding="0" cellspacing="0"><tr><td width="288" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="288" class="es-m-p20b" align="left"> 
                  <p style="padding-left: 20px; font-weight: 600; font-size:16px;">The order will be billed to:</p>

                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20b es-p20r es-p20l"><p>ADDRESS</p>
                      <p>
                      <?php echo wp_kses_post( $address ? $address : esc_html__( 'N/A', 'woocommerce' ) ); ?>
                    </p>

                     
                    </td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="288" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right" style = "margin-top: 24px;"> 
                 <tbody><tr> 
                  <td width="288" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20b es-p20r es-p20l">
                          <p>CONTACT</p>
                          <p>
                          <?php if ( $order->get_billing_email() ) : ?>
					<?php echo esc_html( $order->get_billing_email() ); ?>
				<?php endif; ?>
                          </p>
                          <?php if ( $order->get_billing_phone() ) : ?>
				      <p><?php echo esc_html( $order->get_billing_phone() ); ?> </p>
				<?php endif; ?>
                    </td> 
                    
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
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
           </tbody></table></td> 
         </tr> 
       </tbody></table>
       <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>

       <table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border: 1.5px solid #333333;border-radius: 20px;background-color: #fed2c7"> 
             <tbody><tr> 
              <td align="left"> 
               <table cellpadding="0" cellspacing="0" width="100%"> 
                 <tbody><tr> 
                  <td width="596" align="center" valign="top"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20"><p ><span  style = "font-size: 16px; font-weight: 600;" >SHIPPING ADDRESS</span></p>
                     
                    </td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr> 
              <td align="left"> 
               <!--[if mso]><table width="596" cellpadding="0" cellspacing="0"><tr><td width="288" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="288" class="es-m-p20b" align="left"> 
                  <p style="padding-left: 20px; font-weight: 600; font-size:16px;">The order will be shipped to:</p>

                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20b es-p20r es-p20l"><p  style = "font-size: 16px;">ADDRESS</p>
                      <p>
                       <?php echo wp_kses_post( $shipping ); ?>   
                  </p>

                     
                    </td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 

               
               <!--[if mso]></td><td width="20"></td><td width="288" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="288" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style = "margin-top: 24px;"> 
                     <tbody><tr> 
                      <td align="left" class="es-p20b es-p20r es-p20l">
                          <p>CONTACT</p>
                          <p>
                          <?php if ( $order->get_billing_email() ) : ?>
					     <?php echo esc_html( $order->get_billing_email() ); ?>
				<?php endif; ?>
                          </p>
                          <?php if ( $order->get_billing_phone() ) : ?>
				      <p><?php echo esc_html( $order->get_billing_phone() ); ?> </p>
				<?php endif; ?>
                    </td> 
                    
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody></table>
       <?php endif; ?>
