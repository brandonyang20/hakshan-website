<?php
/**
 * Google Tag Manager — head snippet + noscript body iframe.
 *
 * Site Kit couldn't auto-detect the container, so the standard GTM
 * install snippets are hooked directly into wp_head (head script) and
 * wp_body_open (noscript iframe).
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HAKSHAN_GTM_ID' ) ) {
	define( 'HAKSHAN_GTM_ID', 'GTM-TTT7RBDV' );
}

add_action( 'wp_head', 'hakshan_gtm_head', 1 );
function hakshan_gtm_head() {
	$id = HAKSHAN_GTM_ID;
	?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( $id ); ?>');</script>
<!-- End Google Tag Manager -->
	<?php
}

add_action( 'wp_body_open', 'hakshan_gtm_body', 1 );
function hakshan_gtm_body() {
	$id = HAKSHAN_GTM_ID;
	?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $id ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php
}
