<?php
/**
 * Google Analytics 4 — site-wide gtag.js base tag.
 *
 * Loads GA4 in <head> on every page (including the standalone Link Hub
 * template, which calls wp_head()). Page views are collected automatically;
 * the Link Hub's button handler fires a `link_hub_click` event that lands
 * here via gtag(), broken down by `link_label` / `link_id`.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HAKSHAN_GA4_ID' ) ) {
	define( 'HAKSHAN_GA4_ID', 'G-4X9ZNK9LFM' );
}

/**
 * Emit the GA4 base tag as early as possible in <head>.
 */
function hakshan_ga4_head() {
	$id = HAKSHAN_GA4_ID;
	if ( ! $id ) {
		return;
	}
	// Don't track logged-in admins/editors so your own clicks don't skew data.
	if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
		return;
	}
	?>
<!-- Google tag (gtag.js) — GA4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $id ); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo esc_js( $id ); ?>');
</script>
<!-- End Google tag -->
	<?php
}
add_action( 'wp_head', 'hakshan_ga4_head', 1 );
