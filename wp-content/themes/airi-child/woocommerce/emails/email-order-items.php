<style>

</style>
       <table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" > 
             <tbody><tr> 
              <td align="left"> 
               <!--[if mso]><table width="556" cellpadding="0" cellspacing="0"><tr><td width="268" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"  style="border:2px solid #fed2c7; border-radius: 20px;padding: 5px; background:#fed2c7 ;"> 
                 <tbody><tr> 
                  <td width="268" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left"><p style = "font-weight: 600; font-size: 16px; text-align: center; color: white" >
                      
                      <a 
                      style= "  font-weight: 600;    font-size: 16px;    text-decoration: none;    color: white;    cursor: pointer;"

                      target="_blank" href = <?php echo site_url()."/my-account/view-order/".$order->id."/"?>>Cancel Order</a>
                      </p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="268" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"  style="border:2px solid #fed2c7; border-radius: 20px; padding: 5px;  background:#fed2c7; "> 
                 <tbody><tr> 
                  <td width="268" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="right" ><p style = "text-align: center ;color: white"><a 
                       style= "  font-weight: 600;    font-size: 16px;    text-decoration: none;    color: white;    cursor: pointer;"
                      
                       target="_blank" href = <?php echo site_url()."/my-account/my-tracking-order/".$order->id."/"?>>Track Order</a></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody>
       </table>
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
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border:2px solid #fed2c7;"> 
             <tbody><tr> 
              <td class="es-p10" align="left"> 
               <!--[if mso]><table width="556" cellpadding="0" cellspacing="0"><tr><td width="268" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="268" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left"><p style = "font-weight: 600; font-size: 16px;">ORDER SUMMARY</p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="268" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="268" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="right" ><p>You have <?php echo count($items)?> items in your in this order</p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody>
       </table>
<?php
$margin_side = is_rtl() ? 'left' : 'right';

/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align  = is_rtl() ? 'right' : 'left';


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
        $image         = $product->get_image(array(150,150));
        $colour        = $product->get_attributes()["pa_colour"];
        $size          = $product->get_attributes()["pa_size"];
        $short_description =  $product->short_description?$product->short_description: "N/A" ;
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

           <table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
          <?php if ($item_id === array_key_last($items)){ ?>
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-left:2px solid #fed2c7;border-right:2px solid #fed2c7;border-bottom:2px solid #fed2c7"> 
          <?php } else {?>
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-left:2px solid #fed2c7;border-right:2px solid #fed2c7;"> 

          <?php } ?>
           <tbody><tr> 
              <td class="es-p20" align="left"> 
               <!--[if mso]><table width="556" cellpadding="0" cellspacing="0"><tr><td width="189" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="169" class="es-m-p0r es-m-p20b" align="center"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" style="font-size: 0px">
                        <?php  echo $image ?>
                      </td> 
                     </tr> 
                   </tbody></table></td> 
                  <td class="es-hidden" width="20"></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="208" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style = "padding-top: 10px;"> 
                 <tbody><tr> 
                  <td width="208" class="es-m-p20b" align="center"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left">
                          <p style = "font-weight: 600"><?php echo $name ?></p>
                          <div><?php echo $short_description ?></div>

                          <p><?php echo $colour ?></p>
                          <p class = "numberCircle"><?php echo $size ?></p>

                          
                      <div style = "margin-top: 10px;"><span class = "quantity" style = "font-size: 12px;">QUANTITY <span style = "font-size: 16px; margin-left: 5px"><?php  echo wp_kses_post( apply_filters( 'woocommerce_email_order_item_quantity', $qty_display, $item ) ); ?></span><span></div></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="139" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="139" align="right"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr>
                      <td align='right' style ="padding: 40px 0px 40px 0px"><p style = "font-weight: 600; font-size: 16px;"><?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 

             <tbody>

        </tbody>
        <?php if ($item_id != array_key_last($items)){ ?>

             <tr> 
              <td align="left"> 
               <table cellpadding="0" cellspacing="0" width="100%"> 
                 <tbody><tr> 
                  <td width="596" align="center" valign="top"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p5" style="font-size:0"> 
                       <table border="0" width="80%" cellpadding="0" cellspacing="0" role="presentation"> 
                         <tbody><tr> 
                          <td style="border-bottom: 3px solid #fed2c7;background: none;height: 1px;width: 100%;margin: 0px"></td> 
                         </tr> 
                       </tbody></table></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 

             <?php } ?>
    
       </tbody></table>

	<?php

	if ( $show_purchase_note && $purchase_note ) {
		?>
		<tr>
			<td colspan="3" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
				<?php
				echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) );
				?>
			</td>
		</tr>
		<?php
	}
	?>

<?php endforeach; ?>
