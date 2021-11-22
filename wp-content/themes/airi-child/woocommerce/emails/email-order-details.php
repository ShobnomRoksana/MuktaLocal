<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
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

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

 ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
        <title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
        <link rel="stylesheet" id="airi-google_fonts-css" href="//fonts.googleapis.com/css?family=Raleway:regular,500,600,800,900%7CPlayfair+Display:regular,700italic,900italic" media="all">
        <style amp-custom>
a[x-apple-data-detectors] {
	color:inherit;
	text-decoration:none;
	font-size:inherit;
	font-family:inherit;
	font-weight:inherit;
	line-height:inherit;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
}
s {
	text-decoration:line-through;
}
body {
	width:100%;
	font-family:  "Raleway", sans-serif;
}
table {
	border-collapse:separate;
	border-spacing:0px;
}
table td, html, body, .es-wrapper {
	padding:0;
	Margin:0;
}
.es-content, .es-header, .es-footer {
	table-layout:fixed;
	width:100%;
}
p, hr {
	Margin:0;
}
h1, h2, h3, h4, h5 {
	Margin:0;
	line-height:120%;
	font-family:  "Raleway", sans-serif;
}
.es-left {
	float:left;
}
.es-right {
	float:right;
}
.es-p5 {
	padding:5px;
}
.es-p5t {
	padding-top:5px;
}
.es-p5b {
	padding-bottom:5px;
}
.es-p5l {
	padding-left:5px;
}
.es-p5r {
	padding-right:5px;
}
.es-p10 {
	padding:10px;
}
.es-p10t {
	padding-top:10px;
}
.es-p10b {
	padding-bottom:10px;
}
.es-p10l {
	padding-left:10px;
}
.es-p10r {
	padding-right:10px;
}
.es-p15 {
	padding:15px;
}
.es-p15t {
	padding-top:15px;
}
.es-p15b {
	padding-bottom:15px;
}
.es-p15l {
	padding-left:15px;
}
.es-p15r {
	padding-right:15px;
}
.es-p20 {
	padding:20px;
}
.es-p20t {
	padding-top:20px;
}
.es-p20b {
	padding-bottom:20px;
}
.es-p20l {
	padding-left:20px;
}
.es-p20r {
	padding-right:20px;
}
.es-p25 {
	padding:25px;
}
.es-p25t {
	padding-top:25px;
}
.es-p25b {
	padding-bottom:25px;
}
.es-p25l {
	padding-left:25px;
}
.es-p25r {
	padding-right:25px;
}
.es-p30 {
	padding:30px;
}
.es-p30t {
	padding-top:30px;
}
.es-p30b {
	padding-bottom:30px;
}
.es-p30l {
	padding-left:30px;
}
.es-p30r {
	padding-right:30px;
}
.es-p35 {
	padding:35px;
}
.es-p35t {
	padding-top:35px;
}
.es-p35b {
	padding-bottom:35px;
}
.es-p35l {
	padding-left:35px;
}
.es-p35r {
	padding-right:35px;
}
.es-p40 {
	padding:40px;
}
.es-p40t {
	padding-top:40px;
}
.es-p40b {
	padding-bottom:40px;
}
.es-p40l {
	padding-left:40px;
}
.es-p40r {
	padding-right:40px;
}
.es-menu td {
	border:0;
}
a {
	font-family:  "Raleway", sans-serif;
	font-size:14px;
	text-decoration:underline;
}
h1 {
	font-size:30px;
	font-style:normal;
	font-weight:normal;
	color:#333333;
}
h1 a {
	font-size:30px;
}
h2 {
	font-size:24px;
	font-style:normal;
	font-weight:normal;
	color:#333333;
}
h2 a {
	font-size:24px;
}
h3 {
	font-size:20px;
	font-style:normal;
	font-weight:normal;
	color:#333333;
}
h3 a {
	font-size:20px;
}
p, ul li, ol li {
	font-size:14px;
	font-family:  "Raleway", sans-serif;
	line-height:150%;
}
ul li, ol li {
	Margin-bottom:15px;
}
.es-menu td a {
	text-decoration:none;
	display:block;
}
.es-menu amp-img, .es-button amp-img {
	vertical-align:middle;
}
.es-wrapper {
	width:100%;
	height:100%;
}
.es-wrapper-color {
	background-color:#F6F6F6;
}
.es-content-body {
	background-color:#FFFFFF;
}
.es-content-body p, .es-content-body ul li, .es-content-body ol li {
	color:#333333;
}
.es-content-body a {
	color:#2CB543;
}
.es-header {
	background-color:transparent;
}
.es-header-body {
	background-color:#FFFFFF;
}
.es-header-body p, .es-header-body ul li, .es-header-body ol li {
	color:#333333;
	font-size:14px;
}
.es-header-body a {
	color:#1376C8;
	font-size:14px;
}
.es-footer {
	background-color:transparent;
}
.es-footer-body {
	background-color:#FFFFFF;
}
.es-footer-body p, .es-footer-body ul li, .es-footer-body ol li {
	color:#333333;
	font-size:14px;
}
.es-footer-body a {
	color:#FFFFFF;
	font-size:14px;
}
.es-infoblock, .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li {
	line-height:120%;
	font-size:12px;
	color:#CCCCCC;
}
.es-infoblock a {
	font-size:12px;
	color:#CCCCCC;
}
.es-button-border {
	border-style:solid solid solid solid;
	border-color:#2CB543 #2CB543 #2CB543 #2CB543;
	background:#2CB543;
	border-width:0px 0px 2px 0px;
	display:inline-block;
	border-radius:30px;
	width:auto;
}
a.es-button, button.es-button {
	border-style:solid;
	border-color:#31CB4B;
	border-width:10px 20px 10px 20px;
	display:inline-block;
	background:#31CB4B;
	border-radius:30px;
	font-size:18px;
	font-family: "Raleway", sans-serif;
	font-weight:normal;
	font-style:normal;
	line-height:120%;
	color:#FFFFFF;
	text-decoration:none;
	width:auto;
	text-align:center;
}
.es-p-default {
	padding-top:0px;
	padding-right:0px;
	padding-bottom:0px;
	padding-left:0px;
}
.es-p-all-default {
	padding:0px;
}
.numberCircle {
    border-radius: 50%;
    width: 14px;
    height: 14px;
    padding: 5px;
    margin-bottom: 5px;
    background: #fff;
    border: 2px solid #fed2c7;
    color: #666;
    text-align: center;
    font-size: 16px;
    line-height: 100%;

}

.quantity{
    padding: 5px 20px 5px 20px;

    margin-top: 10px;
    border: 1px solid #fed2c7; 
    font-weight: 600; 

}
</style> 
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<div id="template_header_image">
							<?php
							if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
								echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" /></p>';
							}
							?>
                        </div>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#fed2c7" align="center" style="background-color: #fed2c7;border-radius:20px"> 
             <tbody><tr> 
              <td class="es-p20t es-p20r es-p20l" align="left"> 
               <table width="100%" cellspacing="0" cellpadding="0"> 
                 <tbody><tr> 
                  <td width="560" valign="top" align="center"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation"> 
                     <tbody><tr> 
                      <td align="center"><div><h1 style='padding-bottom: 10px;text-align: center;font-family: "Playfair Display", serif, helvetica, sans-serif;color: white; font-style: italic; text-shadow: unset;'>Order Confirmation</h1></div><p style = "padding-bottom: 10px;font-weight: 500;"><?php echo $order->get_user()->user_login?>,Thank you for your order!</p><p style = "font-weight: 500;padding-bottom: 10px;">CHECK THE DETAILS BELOW.</p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr> 
              <td class="es-p10" align="left"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="290" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p5" bgcolor="#0c0b0b" style="border: 1px solid white"><p style="color: #fef3f2; font-weight: 600; font-size: 16px;">ORDER NO:&nbsp; <?php echo $order->id; ?></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="290" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p5" bgcolor="#1b1414" style="border: 1px solid white"><p style="color: #feebeb; font-weight: 600;font-size: 16px;">ORDER DATE: <?php echo $order->date_created? strtoupper(date_format($order->date_created, 'd M Y')): "N/A"; ?></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody></table>

									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
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

             <?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),

				)
            );

            ?>
            
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
       

			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
                

            ?>

<table cellpadding="0" cellspacing="0" class="es-content" align="center"> 
         <tbody><tr> 
          <td align="center"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600"> 
             <tbody><tr> 
              <td class="es-p20t es-p5b es-p20r es-p20l" align="left" bgcolor="#fed2c7" style="background-color: #fed2c7"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="270" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left">
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

                    
                    </td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="270" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="right">
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

                        </td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
             <tr> 
              <td align="left" bgcolor="#fed2c7" style="background-color: #fed2c7"> 
               <table cellpadding="0" cellspacing="0" width="100%"> 
                 <tbody><tr> 
                  <td width="600" align="center" valign="top"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="center" class="es-p5" style="font-size:0" bgcolor="#fed2c7"> 
                       <table border="0" width="100%" cellpadding="0" cellspacing="0" role="presentation"> 
                         <tbody><tr> 
                          <td style="border-bottom: 2px solid #ffffff;background: none;height: 1px;width: 100%;margin: 0px"></td> 
                         </tr> 
                       </tbody></table></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr> 
              <td align="left" bgcolor="#fed2c7" style="background-color: #fed2c7"> 
               <!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><tr><td width="290" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left"> 
                 <tbody><tr> 
                  <td width="290" class="es-m-p20b" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody><tr> 
                      <td align="left" class="es-p10t es-p20b es-p20r es-p20l"><p style = "font-size: 16px; font-weight: 600;">TOTAL</p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td><td width="20"></td><td width="290" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right"> 
                 <tbody><tr> 
                  <td width="290" align="left"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation"> 
                     <tbody>
                         
                     <tr> 

                     <?php
				$i = 0;
				foreach ( $item_totals as $total ) {
                    $i++;
                    
                    if(wp_kses_post( $total['label'] )==="Total:"  ){
                    
                    ?>
                    
                    <td align="right" class="es-p10t es-p20b es-p20r es-p20l">
                        <p  style = "font-size: 16px; font-weight: 600;"><?php echo wp_kses_post( $total['value'] ); ?>
</p>
                    </td> 


                      <?php
                }
            }
                      ?>
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody></table>

<?php

            }
?>
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

