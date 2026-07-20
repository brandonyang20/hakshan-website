<?php
/**
 * Template Name: Link Hub
 * Template Post Type: page
 *
 * A standalone, Linktree-style landing page: brand mark, a short tagline
 * and a stack of tappable action buttons. Deliberately skips the site
 * nav/footer for a clean, mobile-first "link in bio" feel, but keeps the
 * theme's fonts, colours and EN/中 language system.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

$lh_logo     = 'https://hakshan.com/wp-content/uploads/2026/06/HAKSHAN_Secondary_H_Solid_Black-scaled.png';
$lh_home     = home_url( '/' );
$lh_menu     = hakshan_nav_url( 'menu' );
$lh_reserve  = hakshan_nav_url( 'contact' ) . '#reserve';
$lh_whatsapp = 'https://wa.me/60162462970?text=' . rawurlencode( 'Hi Hakshan, I would like to enquire.' );

// Build the reservation list from the Outlet CPT — only outlets that have a
// booking link set. Add a new outlet with a booking URL in the admin and it
// appears here automatically; no code change needed.
$lh_reserve_outlets = array();
if ( function_exists( 'hakshan_get_outlets' ) && function_exists( 'hakshan_get_outlet_data' ) ) {
	foreach ( hakshan_get_outlets() as $lh_outlet_post ) {
		$lh_od = hakshan_get_outlet_data( $lh_outlet_post->ID );
		if ( empty( $lh_od['booking_url'] ) ) {
			continue;
		}
		$lh_reserve_outlets[] = array(
			'name' => $lh_od['name'],
			'city' => ! empty( $lh_od['city'] ) ? ucwords( strtolower( $lh_od['city'] ) ) : '',
			'url'  => $lh_od['booking_url'],
		);
	}
}
$lh_has_reserve_outlets = ! empty( $lh_reserve_outlets );

// Each link: url, external flag, EN/ZH label and sublabel, plus an inline icon key.
$lh_links = array(
	array(
		'url'      => $lh_reserve,
		'external' => false,
		'en'       => 'Reserve a Table',
		'zh'       => '预订座位',
		'sub_en'   => 'Book your seat at any outlet',
		'sub_zh'   => '任选门店，即刻预订',
		'icon'     => 'calendar',
		'action'   => 'reserve', // opens the outlet picker slider when links exist
	),
	array(
		'url'      => $lh_menu,
		'external' => false,
		'en'       => 'View Menu',
		'zh'       => '查看菜单',
		'sub_en'   => 'Everything we cook, since 1928',
		'sub_zh'   => '我们的菜，1928 年至今',
		'icon'     => 'menu',
	),
	array(
		'url'      => $lh_whatsapp,
		'external' => true,
		'en'       => 'WhatsApp Us',
		'zh'       => 'WhatsApp 联系',
		'sub_en'   => 'Questions, catering, group bookings',
		'sub_zh'   => '询问、宴席、团体预订',
		'icon'     => 'whatsapp',
	),
	array(
		'url'      => $lh_home,
		'external' => false,
		'en'       => 'Visit Our Website',
		'zh'       => '浏览官网',
		'sub_en'   => 'Menu, story and all outlets',
		'sub_zh'   => '菜单、故事与所有门店',
		'icon'     => 'globe',
	),
);

// Small inline-SVG icon set, keyed to the links above.
$lh_icons = array(
	'calendar' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="16" rx="2"/><path d="M3 9h18M8 2.5v4M16 2.5v4"/></svg>',
	'whatsapp' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.02 2C6.6 2 2.2 6.4 2.2 11.82c0 1.9.5 3.68 1.38 5.22L2 22l5.1-1.53a9.8 9.8 0 0 0 4.92 1.32h.01c5.42 0 9.82-4.4 9.82-9.82C21.85 6.4 17.45 2 12.02 2Zm0 17.98h-.01a8.1 8.1 0 0 1-4.13-1.13l-.3-.18-3.03.91.92-2.95-.2-.31a8.13 8.13 0 0 1-1.25-4.34c0-4.5 3.66-8.16 8.17-8.16 2.18 0 4.23.85 5.77 2.4a8.1 8.1 0 0 1 2.39 5.77c0 4.5-3.66 8.16-8.16 8.16Zm4.48-6.11c-.25-.12-1.45-.72-1.68-.8-.22-.08-.39-.12-.55.12-.16.25-.63.8-.78.97-.14.16-.29.18-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.71-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.55-1.33-.76-1.82-.2-.48-.4-.41-.55-.42l-.47-.01c-.16 0-.43.06-.66.31-.22.25-.86.85-.86 2.07 0 1.22.89 2.4 1.01 2.56.12.16 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.45-.59 1.66-1.16.2-.57.2-1.06.14-1.16-.06-.11-.22-.17-.47-.29Z"/></svg>',
	'globe'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9.2"/><path d="M3 12h18M12 2.8a15 15 0 0 1 0 18.4M12 2.8a15 15 0 0 0 0 18.4"/></svg>',
	'menu'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 3.5h11a3 3 0 0 1 3 3v14l-4-2.2-4 2.2V6.5a3 3 0 0 0-3-3H5Z"/><path d="M5 3.5a3 3 0 0 0-3 3v11a3 3 0 0 0 3 3"/><path d="M8.5 8.5h6M8.5 12h6"/></svg>',
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<style>
		body.linkhub-page {
			min-height: 100vh;
			margin: 0;
			background:
				radial-gradient(120% 90% at 50% -10%, #5c6a54 0%, var(--forest) 46%, #3c473789 100%),
				var(--forest);
			color: var(--cream);
			display: flex;
			justify-content: center;
			-webkit-font-smoothing: antialiased;
		}
		.lh {
			width: 100%;
			max-width: 460px;
			padding: clamp(40px, 9vw, 72px) clamp(20px, 6vw, 32px) 56px;
			display: flex;
			flex-direction: column;
			align-items: center;
			text-align: center;
		}
		.lh__lang {
			align-self: flex-end;
			display: inline-flex;
			gap: 2px;
			border: 1px solid rgba(235, 223, 196, 0.35);
			border-radius: 999px;
			padding: 3px;
			margin-bottom: clamp(24px, 6vw, 44px);
		}
		.lh__lang button {
			appearance: none;
			border: 0;
			background: transparent;
			color: rgba(235, 223, 196, 0.7);
			font-family: var(--mono);
			font-size: 12px;
			letter-spacing: 0.06em;
			padding: 5px 12px;
			border-radius: 999px;
			cursor: pointer;
			transition: background 0.2s ease, color 0.2s ease;
		}
		.lh__lang button.is-on { background: var(--cream); color: var(--forest); }
		.lh__logo {
			height: clamp(44px, 12vw, 58px);
			width: auto;
			filter: invert(1) brightness(1.9);
			margin-bottom: 22px;
		}
		.lh__tag {
			font-family: var(--serif);
			font-style: italic;
			font-size: clamp(18px, 5vw, 22px);
			line-height: 1.35;
			color: var(--cream);
			opacity: 0.92;
			margin: 0 0 4px;
		}
		.lh__sub {
			font-family: var(--mono);
			font-size: 11px;
			letter-spacing: 0.22em;
			text-transform: uppercase;
			color: rgba(235, 223, 196, 0.6);
			margin: 0 0 clamp(30px, 8vw, 44px);
		}
		/* Two-pane slider: the links pane and the outlet-picker pane are
		   stacked absolutely; opening slides pane 1 out to the left and
		   pane 2 in from the right. Container height animates to the active
		   pane (set in JS) so the main view never leaves a tall gap. */
		.lh__slider {
			position: relative;
			width: 100%;
			overflow: hidden;
			transition: height 0.5s cubic-bezier(0.22, 1, 0.36, 1);
		}
		.lh__pane {
			transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), visibility 0s linear 0s;
		}
		/* Pane 1 stays in flow so the closed state works with no JS. */
		.lh__pane.lh__links { position: relative; z-index: 1; }
		/* Pane 2 overlays, parked off to the right until opened. */
		.lh__pane.lh__outlets {
			position: absolute;
			top: 0; left: 0;
			width: 100%;
			transform: translateX(100%);
			visibility: hidden;
		}
		.lh__slider.is-outlets .lh__links { transform: translateX(-100%); visibility: hidden; transition-delay: 0s, 0.5s; }
		.lh__slider.is-outlets .lh__outlets { transform: translateX(0); visibility: visible; }

		.lh__links {
			display: flex;
			flex-direction: column;
			gap: 14px;
		}
		.lh__btn {
			display: flex;
			align-items: center;
			gap: 16px;
			width: 100%;
			padding: 16px 20px;
			background: var(--cream);
			color: var(--forest);
			border: 0;
			border-radius: 16px;
			text-decoration: none;
			text-align: left;
			font: inherit;
			cursor: pointer;
			box-shadow: 0 10px 30px -18px rgba(0, 0, 0, 0.7);
			transition: transform 0.22s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.22s ease, background 0.2s ease;
			/* Load-in animation */
			opacity: 0;
			transform: translateY(16px);
			animation: lhIn 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
		}
		.lh__links > :nth-child(1) { animation-delay: 0.06s; }
		.lh__links > :nth-child(2) { animation-delay: 0.14s; }
		.lh__links > :nth-child(3) { animation-delay: 0.22s; }
		.lh__links > :nth-child(4) { animation-delay: 0.30s; }
		.lh__btn:hover {
			transform: translateY(-3px);
			box-shadow: 0 18px 36px -18px rgba(0, 0, 0, 0.8);
			background: #fff;
		}
		.lh__ic {
			flex: 0 0 auto;
			width: 40px;
			height: 40px;
			display: grid;
			place-items: center;
			border-radius: 11px;
			background: var(--forest);
			color: var(--cream);
		}
		.lh__ic svg { width: 21px; height: 21px; display: block; }
		.lh__txt { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
		.lh__label {
			font-family: var(--sans);
			font-weight: 600;
			font-size: 16px;
			line-height: 1.2;
			letter-spacing: 0.01em;
		}
		.lh__slabel {
			font-size: 12.5px;
			line-height: 1.3;
			color: rgba(79, 93, 72, 0.75);
		}
		.lh__arrow {
			margin-left: auto;
			flex: 0 0 auto;
			font-family: var(--serif);
			font-size: 18px;
			color: rgba(79, 93, 72, 0.55);
			transition: transform 0.22s ease;
		}
		.lh__btn:hover .lh__arrow { transform: translateX(4px); color: var(--forest); }

		/* ---- Outlet picker pane ---- */
		.lh__outlets { display: flex; flex-direction: column; gap: 10px; }
		.lh__back {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			align-self: flex-start;
			background: transparent;
			border: 0;
			color: var(--cream);
			font-family: var(--sans);
			font-weight: 600;
			font-size: 15px;
			padding: 4px 0;
			margin-bottom: 4px;
			cursor: pointer;
			opacity: 0.9;
			transition: gap 0.2s ease, opacity 0.2s ease;
		}
		.lh__back:hover { gap: 14px; opacity: 1; }
		.lh__outlets-hint {
			font-family: var(--mono);
			font-size: 10.5px;
			letter-spacing: 0.2em;
			text-transform: uppercase;
			color: rgba(235, 223, 196, 0.55);
			margin: 0 0 6px;
		}
		.lh__outlets-list { display: flex; flex-direction: column; gap: 10px; }
		.lh__outlet {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 15px 18px;
			background: var(--cream);
			color: var(--forest);
			border-radius: 14px;
			text-decoration: none;
			box-shadow: 0 8px 24px -18px rgba(0, 0, 0, 0.7);
			transition: transform 0.2s cubic-bezier(0.22, 1, 0.36, 1), background 0.2s ease;
		}
		.lh__outlet:hover { transform: translateY(-2px); background: #fff; }
		.lh__outlet-name {
			font-family: var(--sans);
			font-weight: 600;
			font-size: 15.5px;
			line-height: 1.2;
		}
		.lh__outlet-city {
			font-family: var(--mono);
			font-size: 10.5px;
			letter-spacing: 0.16em;
			text-transform: uppercase;
			color: rgba(79, 93, 72, 0.7);
			padding-left: 10px;
			margin-left: 2px;
			border-left: 1px solid rgba(79, 93, 72, 0.25);
		}
		.lh__foot {
			margin-top: clamp(36px, 9vw, 52px);
			font-family: var(--mono);
			font-size: 10.5px;
			letter-spacing: 0.14em;
			text-transform: uppercase;
			color: rgba(235, 223, 196, 0.45);
		}
		@keyframes lhIn { to { opacity: 1; transform: translateY(0); } }
		@media (prefers-reduced-motion: reduce) {
			.lh__btn { animation: none; opacity: 1; transform: none; }
		}
	</style>
</head>
<body <?php body_class( 'linkhub-page' ); ?>>

	<main class="lh">
		<div class="lh__lang" role="group" aria-label="Language">
			<button data-lang-btn="en"><span>EN</span></button>
			<button data-lang-btn="zh"><span>中</span></button>
		</div>

		<a href="<?php echo esc_url( $lh_home ); ?>" aria-label="Hakshan home">
			<img class="lh__logo" src="<?php echo esc_url( $lh_logo ); ?>" alt="Hakshan 客善" />
		</a>

		<p class="lh__tag">
			<span data-en>Hakka cuisine, three generations on.</span>
			<span data-zh>客家味道，三代传承。</span>
		</p>
		<p class="lh__sub">
			<span data-en>Since 1928</span>
			<span data-zh>始于 1928</span>
		</p>

		<div class="lh__slider" data-slider>
			<!-- Pane 1: the main link stack -->
			<nav class="lh__pane lh__links" aria-label="Quick links">
				<?php
				foreach ( $lh_links as $lh ) :
					$lh_is_reserve = ( isset( $lh['action'] ) && 'reserve' === $lh['action'] && $lh_has_reserve_outlets );
					if ( $lh_is_reserve ) :
						// Opens the outlet picker pane instead of navigating.
						?>
						<button type="button" class="lh__btn" data-open-outlets aria-expanded="false">
							<span class="lh__ic"><?php echo $lh_icons[ $lh['icon'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG ?></span>
							<span class="lh__txt">
								<span class="lh__label"><span data-en><?php echo esc_html( $lh['en'] ); ?></span><span data-zh><?php echo esc_html( $lh['zh'] ); ?></span></span>
								<span class="lh__slabel"><span data-en>Choose your outlet</span><span data-zh>选择门店</span></span>
							</span>
							<span class="lh__arrow" aria-hidden="true">→</span>
						</button>
					<?php else : ?>
						<a
							class="lh__btn"
							href="<?php echo esc_url( $lh['url'] ); ?>"
							<?php echo $lh['external'] ? 'target="_blank" rel="noopener"' : ''; ?>
						>
							<span class="lh__ic"><?php echo $lh_icons[ $lh['icon'] ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG ?></span>
							<span class="lh__txt">
								<span class="lh__label"><span data-en><?php echo esc_html( $lh['en'] ); ?></span><span data-zh><?php echo esc_html( $lh['zh'] ); ?></span></span>
								<span class="lh__slabel"><span data-en><?php echo esc_html( $lh['sub_en'] ); ?></span><span data-zh><?php echo esc_html( $lh['sub_zh'] ); ?></span></span>
							</span>
							<span class="lh__arrow" aria-hidden="true">→</span>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</nav>

			<?php if ( $lh_has_reserve_outlets ) : ?>
			<!-- Pane 2: outlet picker — each links to that outlet's booking URL -->
			<div class="lh__pane lh__outlets" aria-hidden="true">
				<button type="button" class="lh__back" data-close-outlets>
					<span aria-hidden="true">←</span>
					<span data-en>Reserve a Table</span><span data-zh>预订座位</span>
				</button>
				<p class="lh__outlets-hint">
					<span data-en>Pick an outlet to book</span><span data-zh>选择门店预订</span>
				</p>
				<div class="lh__outlets-list">
					<?php foreach ( $lh_reserve_outlets as $lh_o ) : ?>
						<a class="lh__outlet" href="<?php echo esc_url( $lh_o['url'] ); ?>" target="_blank" rel="noopener">
							<span class="lh__outlet-name"><?php echo esc_html( $lh_o['name'] ); ?></span>
							<?php if ( $lh_o['city'] ) : ?>
								<span class="lh__outlet-city"><?php echo esc_html( $lh_o['city'] ); ?></span>
							<?php endif; ?>
							<span class="lh__arrow" aria-hidden="true">→</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<p class="lh__foot">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> Hakshan · 客善</p>
	</main>

	<?php if ( $lh_has_reserve_outlets ) : ?>
	<script>
	(function () {
		var slider = document.querySelector('[data-slider]');
		if (!slider) return;
		var openBtn = document.querySelector('[data-open-outlets]');
		var backBtn = document.querySelector('[data-close-outlets]');
		var mainPane = slider.querySelector('.lh__links');
		var outletsPane = slider.querySelector('.lh__outlets');

		// Pane 1 sits in normal flow, so its height is natural. Pane 2
		// overlays; when it's open we pin the container height to it so the
		// list isn't clipped and the height eases between the two panes.
		function syncHeight() {
			if (slider.classList.contains('is-outlets')) {
				if (mainPane) slider.style.height = mainPane.offsetHeight + 'px';
				// Next frame: grow to the outlet list's height.
				requestAnimationFrame(function () {
					if (outletsPane) slider.style.height = outletsPane.offsetHeight + 'px';
				});
			} else {
				slider.style.height = ''; // back to pane 1's natural flow height
			}
		}

		function open() {
			// Freeze current height first so the transition has a start value.
			if (mainPane) slider.style.height = mainPane.offsetHeight + 'px';
			slider.classList.add('is-outlets');
			if (openBtn) openBtn.setAttribute('aria-expanded', 'true');
			if (outletsPane) outletsPane.setAttribute('aria-hidden', 'false');
			requestAnimationFrame(function () {
				if (outletsPane) slider.style.height = outletsPane.offsetHeight + 'px';
			});
			if (backBtn) backBtn.focus();
		}
		function close() {
			// Set an explicit height so the collapse can animate, then clear.
			if (outletsPane) slider.style.height = outletsPane.offsetHeight + 'px';
			requestAnimationFrame(function () {
				if (mainPane) slider.style.height = mainPane.offsetHeight + 'px';
			});
			slider.classList.remove('is-outlets');
			if (openBtn) { openBtn.setAttribute('aria-expanded', 'false'); openBtn.focus(); }
			if (outletsPane) outletsPane.setAttribute('aria-hidden', 'true');
			// After the ease, hand height back to natural flow.
			setTimeout(function () {
				if (!slider.classList.contains('is-outlets')) slider.style.height = '';
			}, 520);
		}
		if (openBtn) openBtn.addEventListener('click', open);
		if (backBtn) backBtn.addEventListener('click', close);
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && slider.classList.contains('is-outlets')) close();
		});

		// Recompute when open on resize / language switch (labels reflow).
		window.addEventListener('resize', syncHeight);
		document.querySelectorAll('[data-lang-btn]').forEach(function (b) {
			b.addEventListener('click', function () { setTimeout(syncHeight, 20); });
		});
	})();
	</script>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
