<?php
/**
 * Popup banner — an admin-managed promotional modal.
 *
 * Everything (on/off, image, copy, button, timing, frequency) is edited in
 * Appearance → Customize → Popup Banner. Nothing here is hardcoded, so the
 * banner can be swapped for a new promo without touching the theme.
 *
 * The "seen" key is derived from a hash of the banner's own content, so
 * changing the banner automatically re-shows it to everyone who already
 * dismissed the previous one.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/**
 * The banner's editable fields and their defaults.
 *
 * @return array
 */
function hakshan_popup_defaults() {
	return array(
		'hakshan_popup_enabled'   => false,
		'hakshan_popup_image'     => 0,
		'hakshan_popup_title_en'  => '',
		'hakshan_popup_title_zh'  => '',
		'hakshan_popup_text_en'   => '',
		'hakshan_popup_text_zh'   => '',
		'hakshan_popup_btn_en'    => '',
		'hakshan_popup_btn_zh'    => '',
		'hakshan_popup_btn_url'   => '',
		'hakshan_popup_btn_blank' => true,
		'hakshan_popup_delay'     => 2,
		'hakshan_popup_frequency' => 'day',
		'hakshan_popup_display'   => 'all',
	);
}

/**
 * Read one popup setting, falling back to its default.
 *
 * @param string $key Setting id.
 * @return mixed
 */
function hakshan_popup_get( $key ) {
	$defaults = hakshan_popup_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

/**
 * How often a visitor should see the banner.
 *
 * @return array
 */
function hakshan_popup_frequency_choices() {
	return array(
		'always'  => __( 'Every page view', 'hakshan' ),
		'session' => __( 'Once per browsing session', 'hakshan' ),
		'day'     => __( 'Once a day', 'hakshan' ),
		'week'    => __( 'Once a week', 'hakshan' ),
		'once'    => __( 'Once only (until the banner is changed)', 'hakshan' ),
	);
}

/**
 * Where the banner may appear.
 *
 * @return array
 */
function hakshan_popup_display_choices() {
	return array(
		'all'  => __( 'All pages', 'hakshan' ),
		'home' => __( 'Homepage only', 'hakshan' ),
	);
}

/* ---------------------------------------------------------------------------
 * Customizer
 * ------------------------------------------------------------------------- */

add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section(
			'hakshan_popup_banner',
			array(
				'title'       => __( 'Popup Banner', 'hakshan' ),
				'priority'    => 36,
				'description' => __( 'A promotional popup shown to visitors. Tick "Enable" to switch it on. Leave a Chinese field blank to reuse the English text. Changing any of this automatically re-shows the banner to people who already dismissed the old one.', 'hakshan' ),
			)
		);

		$text_fields = array(
			'hakshan_popup_title_en' => array( __( 'Heading (English)', 'hakshan' ), 'text', '' ),
			'hakshan_popup_title_zh' => array( __( 'Heading (中文)', 'hakshan' ), 'text', '' ),
			'hakshan_popup_text_en'  => array( __( 'Body text (English)', 'hakshan' ), 'textarea', '' ),
			'hakshan_popup_text_zh'  => array( __( 'Body text (中文)', 'hakshan' ), 'textarea', '' ),
			'hakshan_popup_btn_en'   => array( __( 'Button label (English)', 'hakshan' ), 'text', __( 'Leave blank to hide the button.', 'hakshan' ) ),
			'hakshan_popup_btn_zh'   => array( __( 'Button label (中文)', 'hakshan' ), 'text', '' ),
		);

		// Enable toggle.
		$wp_customize->add_setting(
			'hakshan_popup_enabled',
			array(
				'default'           => false,
				'transport'         => 'refresh',
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_enabled',
			array(
				'label'   => __( 'Enable popup banner', 'hakshan' ),
				'section' => 'hakshan_popup_banner',
				'type'    => 'checkbox',
			)
		);

		// Banner image (media library).
		$wp_customize->add_setting(
			'hakshan_popup_image',
			array(
				'default'           => 0,
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'hakshan_popup_image',
				array(
					'label'       => __( 'Banner image', 'hakshan' ),
					'description' => __( 'Optional. Shown above the text. Landscape images around 1200×800 work best.', 'hakshan' ),
					'section'     => 'hakshan_popup_banner',
					'mime_type'   => 'image',
				)
			)
		);

		// Text fields.
		foreach ( $text_fields as $id => $meta ) {
			list( $label, $type, $description ) = $meta;
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => '',
					'transport'         => 'refresh',
					'sanitize_callback' => 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				$id,
				array(
					'label'       => $label,
					'description' => $description,
					'section'     => 'hakshan_popup_banner',
					'type'        => $type,
				)
			);
		}

		// Button URL.
		$wp_customize->add_setting(
			'hakshan_popup_btn_url',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_btn_url',
			array(
				'label'       => __( 'Button link', 'hakshan' ),
				'description' => __( 'Full URL, e.g. https://order.hakshan.com/', 'hakshan' ),
				'section'     => 'hakshan_popup_banner',
				'type'        => 'url',
			)
		);

		$wp_customize->add_setting(
			'hakshan_popup_btn_blank',
			array(
				'default'           => true,
				'transport'         => 'refresh',
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_btn_blank',
			array(
				'label'   => __( 'Open the button link in a new tab', 'hakshan' ),
				'section' => 'hakshan_popup_banner',
				'type'    => 'checkbox',
			)
		);

		// Delay.
		$wp_customize->add_setting(
			'hakshan_popup_delay',
			array(
				'default'           => 2,
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_delay',
			array(
				'label'       => __( 'Delay before showing (seconds)', 'hakshan' ),
				'description' => __( '0 shows it immediately. 2–4 seconds usually converts best.', 'hakshan' ),
				'section'     => 'hakshan_popup_banner',
				'type'        => 'number',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 60,
					'step' => 1,
				),
			)
		);

		// Frequency.
		$wp_customize->add_setting(
			'hakshan_popup_frequency',
			array(
				'default'           => 'day',
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_key',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_frequency',
			array(
				'label'   => __( 'Show each visitor', 'hakshan' ),
				'section' => 'hakshan_popup_banner',
				'type'    => 'select',
				'choices' => hakshan_popup_frequency_choices(),
			)
		);

		// Display scope.
		$wp_customize->add_setting(
			'hakshan_popup_display',
			array(
				'default'           => 'all',
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_key',
			)
		);
		$wp_customize->add_control(
			'hakshan_popup_display',
			array(
				'label'   => __( 'Show on', 'hakshan' ),
				'section' => 'hakshan_popup_banner',
				'type'    => 'select',
				'choices' => hakshan_popup_display_choices(),
			)
		);
	}
);

/* ---------------------------------------------------------------------------
 * Front-end render
 * ------------------------------------------------------------------------- */

/**
 * Should the banner render on this request?
 *
 * @return bool
 */
function hakshan_popup_should_render() {
	if ( ! hakshan_popup_get( 'hakshan_popup_enabled' ) ) {
		return false;
	}
	// Needs at least a heading, some body text or an image to be worth showing.
	$has_content = hakshan_popup_get( 'hakshan_popup_title_en' )
		|| hakshan_popup_get( 'hakshan_popup_text_en' )
		|| hakshan_popup_get( 'hakshan_popup_image' );
	if ( ! $has_content ) {
		return false;
	}
	// The Link Hub is a focused link-in-bio page — never interrupt it.
	if ( is_page_template( 'page-links.php' ) ) {
		return false;
	}
	// Never stack on top of the investor disclaimer gate.
	if ( function_exists( 'hakshan_gate_active' ) && hakshan_gate_active() ) {
		return false;
	}
	if ( 'home' === hakshan_popup_get( 'hakshan_popup_display' ) && ! is_front_page() ) {
		return false;
	}
	return true;
}

/**
 * Output an EN/ZH pair, falling back to the English string when the Chinese
 * one is empty so the banner never renders blank in Chinese mode.
 *
 * @param string $en    English copy.
 * @param string $zh    Chinese copy.
 * @param bool   $br    Convert newlines to <br />.
 * @return string
 */
function hakshan_popup_bilingual( $en, $zh, $br = false ) {
	$zh  = '' !== trim( (string) $zh ) ? $zh : $en;
	$fmt = static function ( $s ) use ( $br ) {
		$s = esc_html( $s );
		return $br ? nl2br( $s ) : $s;
	};
	return '<span data-en>' . $fmt( $en ) . '</span><span data-zh>' . $fmt( $zh ) . '</span>';
}

/**
 * Render the popup markup, styles and behaviour in the footer.
 */
function hakshan_popup_render() {
	if ( ! hakshan_popup_should_render() ) {
		return;
	}

	$title_en = (string) hakshan_popup_get( 'hakshan_popup_title_en' );
	$title_zh = (string) hakshan_popup_get( 'hakshan_popup_title_zh' );
	$text_en  = (string) hakshan_popup_get( 'hakshan_popup_text_en' );
	$text_zh  = (string) hakshan_popup_get( 'hakshan_popup_text_zh' );
	$btn_en   = (string) hakshan_popup_get( 'hakshan_popup_btn_en' );
	$btn_zh   = (string) hakshan_popup_get( 'hakshan_popup_btn_zh' );
	$btn_url  = (string) hakshan_popup_get( 'hakshan_popup_btn_url' );
	$blank    = (bool) hakshan_popup_get( 'hakshan_popup_btn_blank' );
	$delay    = (int) hakshan_popup_get( 'hakshan_popup_delay' );
	$freq     = (string) hakshan_popup_get( 'hakshan_popup_frequency' );
	$image_id = (int) hakshan_popup_get( 'hakshan_popup_image' );

	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'large' ) : '';
	$image_alt = $image_id ? (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';

	// Content hash → changing the banner re-shows it to everyone.
	$version = substr(
		md5( $title_en . $title_zh . $text_en . $text_zh . $btn_en . $btn_url . $image_id ),
		0,
		8
	);

	$has_button = ( '' !== trim( $btn_en ) && '' !== trim( $btn_url ) );
	?>
<div class="hk-popup" id="hkPopup" hidden
	data-delay="<?php echo esc_attr( $delay ); ?>"
	data-frequency="<?php echo esc_attr( $freq ); ?>"
	data-version="<?php echo esc_attr( $version ); ?>">
	<div class="hk-popup__backdrop" data-hk-close></div>
	<div class="hk-popup__box" role="dialog" aria-modal="true" aria-labelledby="hkPopupTitle">
		<button type="button" class="hk-popup__x" data-hk-close aria-label="<?php esc_attr_e( 'Close', 'hakshan' ); ?>">&times;</button>

		<?php if ( $image_url ) : ?>
			<div class="hk-popup__media">
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
			</div>
		<?php endif; ?>

		<div class="hk-popup__body">
			<?php if ( '' !== trim( $title_en ) ) : ?>
				<h2 class="hk-popup__title" id="hkPopupTitle"><?php echo wp_kses_post( hakshan_popup_bilingual( $title_en, $title_zh ) ); ?></h2>
			<?php endif; ?>

			<?php if ( '' !== trim( $text_en ) ) : ?>
				<p class="hk-popup__text"><?php echo wp_kses_post( hakshan_popup_bilingual( $text_en, $text_zh, true ) ); ?></p>
			<?php endif; ?>

			<?php if ( $has_button ) : ?>
				<a class="hk-popup__btn" href="<?php echo esc_url( $btn_url ); ?>"
					<?php echo $blank ? 'target="_blank" rel="noopener"' : ''; ?>
					data-hk-cta>
					<?php echo wp_kses_post( hakshan_popup_bilingual( $btn_en, $btn_zh ) ); ?>
					<span class="hk-popup__arrow" aria-hidden="true">&rarr;</span>
				</a>
			<?php endif; ?>

			<button type="button" class="hk-popup__dismiss" data-hk-close>
				<span data-en>No thanks</span><span data-zh>暂时不用</span>
			</button>
		</div>
	</div>
</div>

<style>
.hk-popup{position:fixed;inset:0;z-index:9000;display:none;align-items:center;justify-content:center;padding:20px}
.hk-popup.is-open{display:flex}
.hk-popup__backdrop{position:absolute;inset:0;background:rgba(28,34,26,.62);backdrop-filter:blur(3px);-webkit-backdrop-filter:blur(3px);opacity:0;transition:opacity .35s ease}
.hk-popup.is-in .hk-popup__backdrop{opacity:1}
.hk-popup__box{position:relative;width:100%;max-width:440px;max-height:calc(100vh - 40px);overflow-y:auto;background:var(--paper,#F9F7F2);border-radius:16px;box-shadow:0 40px 80px -30px rgba(0,0,0,.6);opacity:0;transform:translateY(18px) scale(.98);transition:opacity .45s cubic-bezier(.22,1,.36,1),transform .45s cubic-bezier(.22,1,.36,1)}
.hk-popup.is-in .hk-popup__box{opacity:1;transform:translateY(0) scale(1)}
.hk-popup__x{position:absolute;top:10px;right:10px;z-index:2;width:34px;height:34px;border:0;border-radius:50%;background:rgba(249,247,242,.9);color:var(--ink,#2A2E27);font-size:22px;line-height:1;cursor:pointer;display:grid;place-items:center;transition:background .2s ease}
.hk-popup__x:hover{background:#fff}
.hk-popup__media{margin:0;background:var(--cream,#EBDFC4)}
.hk-popup__media img{width:100%;height:auto;display:block;border-radius:16px 16px 0 0}
.hk-popup__body{padding:26px 26px 22px;text-align:center}
.hk-popup__title{font-family:var(--serif,serif);font-size:clamp(22px,4.5vw,28px);line-height:1.2;letter-spacing:-.01em;margin:0 0 10px;color:var(--ink,#2A2E27)}
.hk-popup__text{font-size:15px;line-height:1.6;color:var(--ink-soft,#4F5D48);margin:0 0 20px}
.hk-popup__btn{display:inline-flex;align-items:center;gap:9px;padding:13px 24px;background:var(--forest,#4F5D48);color:var(--cream,#EBDFC4);border-radius:999px;text-decoration:none;font-weight:600;font-size:15px;transition:background .2s ease,transform .2s ease}
.hk-popup__btn:hover{background:#3c4737;transform:translateY(-1px)}
.hk-popup__arrow{transition:transform .2s ease}
.hk-popup__btn:hover .hk-popup__arrow{transform:translateX(3px)}
.hk-popup__dismiss{display:block;margin:14px auto 0;background:none;border:0;color:var(--mute,#8A8775);font-family:var(--mono,monospace);font-size:11px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;padding:4px}
.hk-popup__dismiss:hover{color:var(--ink,#2A2E27)}
@media (max-width:420px){.hk-popup__body{padding:22px 20px 18px}}
@media (prefers-reduced-motion:reduce){.hk-popup__backdrop,.hk-popup__box{transition:none}}
</style>

<script>
(function(){
	var el = document.getElementById('hkPopup');
	if (!el) return;
	var freq = el.getAttribute('data-frequency') || 'day';
	var ver  = el.getAttribute('data-version') || '';
	var delay = parseInt(el.getAttribute('data-delay'), 10);
	if (isNaN(delay)) delay = 0;
	var KEY = 'hakshan_popup_' + ver;

	// Frequency window in milliseconds. 'always' never suppresses;
	// 'session' uses sessionStorage; 'once' never expires.
	var WINDOWS = { day: 864e5, week: 6048e5 };

	function store() {
		try { return freq === 'session' ? window.sessionStorage : window.localStorage; }
		catch (e) { return null; }
	}
	function seen() {
		if (freq === 'always') return false;
		var s = store();
		if (!s) return false;
		var raw;
		try { raw = s.getItem(KEY); } catch (e) { return false; }
		if (!raw) return false;
		if (freq === 'once' || freq === 'session') return true;
		var win = WINDOWS[freq];
		if (!win) return true;
		return (Date.now() - parseInt(raw, 10)) < win;
	}
	function remember() {
		var s = store();
		if (!s) return;
		try { s.setItem(KEY, String(Date.now())); } catch (e) {}
	}

	var lastFocus = null;
	function open() {
		lastFocus = document.activeElement;
		el.hidden = false;
		el.classList.add('is-open');
		// Next frame so the entrance transition actually runs.
		requestAnimationFrame(function(){ el.classList.add('is-in'); });
		var focusable = el.querySelector('.hk-popup__btn, .hk-popup__x');
		if (focusable) focusable.focus();
		if (window.dataLayer) {
			window.dataLayer.push({ event: 'popup_banner_view', popup_version: ver });
		}
	}
	function close(reason) {
		el.classList.remove('is-in');
		remember();
		setTimeout(function(){
			el.classList.remove('is-open');
			el.hidden = true;
			if (lastFocus && lastFocus.focus) lastFocus.focus();
		}, 350);
		if (window.dataLayer) {
			window.dataLayer.push({ event: 'popup_banner_close', popup_version: ver, popup_reason: reason || 'dismiss' });
		}
	}

	el.querySelectorAll('[data-hk-close]').forEach(function(b){
		b.addEventListener('click', function(){ close('dismiss'); });
	});
	document.addEventListener('keydown', function(e){
		if (e.key === 'Escape' && el.classList.contains('is-open')) close('escape');
	});
	var cta = el.querySelector('[data-hk-cta]');
	if (cta) {
		cta.addEventListener('click', function(){
			remember();
			if (window.dataLayer) {
				window.dataLayer.push({ event: 'popup_banner_click', popup_version: ver });
			}
			if (typeof window.gtag === 'function') {
				window.gtag('event', 'popup_banner_click', { popup_version: ver });
			}
			if (typeof window.fbq === 'function') {
				window.fbq('trackCustom', 'PopupBannerClick', { popup_version: ver });
			}
		});
	}

	if (seen()) return;
	if (delay > 0) { setTimeout(open, delay * 1000); } else { open(); }
})();
</script>
	<?php
}
add_action( 'wp_footer', 'hakshan_popup_render', 20 );
