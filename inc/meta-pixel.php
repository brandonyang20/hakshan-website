<?php
/**
 * Meta Pixel — base code + PageView event.
 *
 * Installed directly in the theme since GTM detection is failing.
 * Once GTM is connected, this module can be removed and the pixel
 * managed from the GTM container instead.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HAKSHAN_META_PIXEL_ID' ) ) {
	define( 'HAKSHAN_META_PIXEL_ID', '2423586654746689' );
}

add_action( 'wp_head', 'hakshan_meta_pixel_head', 2 );
function hakshan_meta_pixel_head() {
	$id = HAKSHAN_META_PIXEL_ID;
	?>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?php echo esc_js( $id ); ?>');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?php echo esc_attr( $id ); ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
	<?php
}
