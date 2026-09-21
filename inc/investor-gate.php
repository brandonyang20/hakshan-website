<?php
/**
 * Investor page disclaimer gate.
 *
 * A modal shown before the Investor Relations page can be read: four legal
 * tabs (Terms of Use, Risk Warning, Guidelines & Eligibility, Privacy
 * Policy) and a single "I agree to all of the above" checkbox that unlocks
 * the page.
 *
 * Each tab's body is pulled from a WordPress Page chosen in
 * Appearance → Customize → Investor Gate, so compliance/legal can edit the
 * wording in the normal editor without touching the theme. Built-in draft
 * copy is used for any tab that has no page assigned yet.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

/**
 * The four tabs, in display order.
 *
 * @return array
 */
function hakshan_gate_tabs() {
	return array(
		'terms'      => array(
			'en' => 'Terms of Use',
			'zh' => '使用条款',
		),
		'risk'       => array(
			'en' => 'Risk Warning',
			'zh' => '风险提示',
		),
		'guidelines' => array(
			'en' => 'Guidelines & Eligibility',
			'zh' => '投资准则与资格',
		),
		'privacy'    => array(
			'en' => 'Privacy Policy',
			'zh' => '隐私政策',
		),
	);
}

/**
 * How long an acceptance is remembered.
 *
 * @return array
 */
function hakshan_gate_remember_choices() {
	return array(
		'session' => __( 'For the current browsing session', 'hakshan' ),
		'30'      => __( '30 days', 'hakshan' ),
		'90'      => __( '90 days', 'hakshan' ),
		'always'  => __( 'Ask on every visit', 'hakshan' ),
	);
}

/* ---------------------------------------------------------------------------
 * Customizer
 * ------------------------------------------------------------------------- */

add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section(
			'hakshan_investor_gate',
			array(
				'title'       => __( 'Investor Gate', 'hakshan' ),
				'priority'    => 37,
				'description' => __( 'The disclaimer visitors must accept before reading the Investor Relations page. Write each document as a normal WordPress Page, then pick it below. Any tab left as "— Select —" falls back to the theme\'s built-in draft text.', 'hakshan' ),
			)
		);

		$wp_customize->add_setting(
			'hakshan_gate_enabled',
			array(
				'default'           => true,
				'transport'         => 'refresh',
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
		$wp_customize->add_control(
			'hakshan_gate_enabled',
			array(
				'label'   => __( 'Require acceptance before the Investor page', 'hakshan' ),
				'section' => 'hakshan_investor_gate',
				'type'    => 'checkbox',
			)
		);

		foreach ( hakshan_gate_tabs() as $key => $labels ) {
			$wp_customize->add_setting(
				'hakshan_gate_page_' . $key,
				array(
					'default'           => 0,
					'transport'         => 'refresh',
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				'hakshan_gate_page_' . $key,
				array(
					/* translators: %s: tab name. */
					'label'   => sprintf( __( '%s — page', 'hakshan' ), $labels['en'] ),
					'section' => 'hakshan_investor_gate',
					'type'    => 'dropdown-pages',
				)
			);
		}

		$wp_customize->add_setting(
			'hakshan_gate_remember',
			array(
				'default'           => '30',
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_key',
			)
		);
		$wp_customize->add_control(
			'hakshan_gate_remember',
			array(
				'label'   => __( 'Remember acceptance', 'hakshan' ),
				'section' => 'hakshan_investor_gate',
				'type'    => 'select',
				'choices' => hakshan_gate_remember_choices(),
			)
		);
	}
);

/* ---------------------------------------------------------------------------
 * Content
 * ------------------------------------------------------------------------- */

/**
 * Built-in draft copy, used when no page has been assigned to a tab.
 *
 * Placeholder wording written for Hakshan — review by legal/compliance
 * before relying on it.
 *
 * @param string $key Tab key.
 * @return string
 */
function hakshan_gate_default_content( $key ) {
	$defaults = array(
		'terms'      => '
<h3>Terms of Use</h3>
<p>The Investor Relations section of this website is provided by Horvy Holding Sdn Bhd ("Hakshan") for general information only. By continuing you confirm that you have read, understood and accept these terms.</p>
<h4>No offer or invitation</h4>
<p>Nothing on these pages is an offer to sell, or a solicitation of an offer to buy, any security or interest in Hakshan. No part of this material forms the basis of, and should not be relied upon in connection with, any contract or commitment.</p>
<h4>Not financial advice</h4>
<p>The information does not take account of your objectives, financial situation or needs, and is not a recommendation. You should obtain independent financial, legal and tax advice before making any investment decision.</p>
<h4>Accuracy and forward-looking statements</h4>
<p>Figures, projections and targets are based on assumptions current at the time of publication and may change without notice. Forward-looking statements are not guarantees of future performance. Hakshan gives no warranty as to the accuracy or completeness of the information and accepts no liability for any loss arising from its use.</p>
<h4>Jurisdiction</h4>
<p>These pages are directed at persons in Malaysia. They are governed by the laws of Malaysia.</p>',

		'risk'       => '
<h3>Risk Warning</h3>
<p>Investing in an early-stage or unlisted company is high risk. You should read the following carefully.</p>
<h4>You may lose your entire investment</h4>
<p>Private companies can and do fail. If that happens you are likely to lose all of the money you invested. Never invest more than you can afford to lose.</p>
<h4>Illiquidity</h4>
<p>Shares in an unlisted company cannot easily be sold. There is no public market for them, and there may be no opportunity to exit your investment for many years — or at all.</p>
<h4>Dilution</h4>
<p>If the company raises further capital, your shareholding is likely to be diluted, reducing your percentage ownership and any associated rights.</p>
<h4>No dividends</h4>
<p>Early-stage companies typically reinvest earnings rather than pay dividends. You should not expect income from this type of investment.</p>
<h4>Past performance</h4>
<p>Historical results, including outlet or revenue growth, are not a reliable indicator of future performance.</p>
<h4>Diversify</h4>
<p>Investments of this kind should form only a small part of a diversified portfolio.</p>',

		'guidelines' => '
<h3>Guidelines &amp; Eligibility</h3>
<h4>For investors</h4>
<p>Where an investment is made through a registered equity crowdfunding (ECF) platform, the Securities Commission Malaysia applies investment limits according to investor type:</p>
<h4>Retail Investors</h4>
<p>Investors that do not fall under the categories of either Sophisticated Investor or Angel Investor. Maximum investment limit: RM10,000 per offering.</p>
<h4>Angel Investors</h4>
<p>Tax residents in Malaysia whose total net personal assets exceed RM3 million, or gross total annual income is not less than RM180,000, or jointly with spouse has a gross total annual income exceeding RM250,000. Maximum investment limit: RM50,000 per offering.</p>
<h4>Sophisticated Investors</h4>
<p>Investors who fall within the categories of accredited investor, high-net-worth entity or high-net-worth individual as set out in the Capital Markets and Services Act 2007. No investment limit applies.</p>
<h4>Please note</h4>
<p>Additional annual limits may apply under the Securities Commission\'s guidelines. Eligibility and limits are determined by the relevant platform or issuer at the point of investment, and you may be asked to provide evidence of your investor status. Hakshan is not a registered ECF operator; any offering is conducted through the relevant licensed party.</p>',

		'privacy'    => '
<h3>Privacy Policy</h3>
<p>This notice explains how Horvy Holding Sdn Bhd ("Hakshan") handles personal data collected through the Investor Relations section of this website.</p>
<h4>What we collect</h4>
<p>Contact details you submit to us (such as name, email address, telephone number and company), together with technical data such as IP address, browser type and pages viewed.</p>
<h4>Why we use it</h4>
<p>To respond to your enquiry, to provide investor materials you have requested, to maintain our records, and to improve the website. We do not sell your personal data.</p>
<h4>Sharing</h4>
<p>We may share data with our professional advisers and service providers where necessary, and with authorities where required by law.</p>
<h4>Retention</h4>
<p>We keep personal data only for as long as necessary for the purposes above, or as required by law.</p>
<h4>Your rights</h4>
<p>Under the Personal Data Protection Act 2010 you may request access to, or correction of, your personal data, and may withdraw consent to its processing.</p>
<h4>Contact</h4>
<p>For any privacy request, contact us through the details on our Contact page.</p>',
	);

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Resolve a tab's body HTML — the assigned page, or the built-in draft.
 *
 * @param string $key Tab key.
 * @return string
 */
function hakshan_gate_tab_content( $key ) {
	$page_id = (int) get_theme_mod( 'hakshan_gate_page_' . $key, 0 );
	if ( $page_id ) {
		$page = get_post( $page_id );
		if ( $page && 'publish' === $page->post_status && '' !== trim( $page->post_content ) ) {
			return apply_filters( 'the_content', $page->post_content );
		}
	}
	return hakshan_gate_default_content( $key );
}

/* ---------------------------------------------------------------------------
 * Should it run?
 * ------------------------------------------------------------------------- */

/**
 * Only on the Investor Relations page, and only while enabled.
 *
 * @return bool
 */
function hakshan_gate_active() {
	if ( ! get_theme_mod( 'hakshan_gate_enabled', true ) ) {
		return false;
	}
	if ( is_customize_preview() ) {
		return false;
	}
	return is_page_template( 'page-investors.php' );
}

/* ---------------------------------------------------------------------------
 * Render
 * ------------------------------------------------------------------------- */

/**
 * Hide the page before first paint if the visitor hasn't accepted yet, so
 * the investor content never flashes behind the modal.
 */
function hakshan_gate_head() {
	if ( ! hakshan_gate_active() ) {
		return;
	}
	$remember = (string) get_theme_mod( 'hakshan_gate_remember', '30' );
	?>
<style id="hk-gate-guard">
html.hk-gate-pending body > *:not(.hk-gate){visibility:hidden !important}
html.hk-gate-pending{overflow:hidden}
html.hk-gate-pending body{overflow:hidden}
</style>
<script>
(function(){
	var R = <?php echo wp_json_encode( $remember ); ?>;
	var KEY = 'hakshan_investor_gate';
	function accepted(){
		if (R === 'always') return false;
		try {
			var s = (R === 'session') ? sessionStorage : localStorage;
			var raw = s.getItem(KEY);
			if (!raw) return false;
			if (R === 'session') return true;
			var days = parseInt(R, 10);
			if (isNaN(days)) return true;
			return (Date.now() - parseInt(raw, 10)) < days * 864e5;
		} catch (e) { return false; }
	}
	if (!accepted()) document.documentElement.classList.add('hk-gate-pending');
	window.__hkGate = { key: KEY, remember: R, accepted: accepted };
})();
</script>
	<?php
}
add_action( 'wp_head', 'hakshan_gate_head', 1 );

/**
 * The gate modal itself.
 */
function hakshan_gate_render() {
	if ( ! hakshan_gate_active() ) {
		return;
	}
	$tabs      = hakshan_gate_tabs();
	$tab_keys  = array_keys( $tabs );
	$first     = isset( $tab_keys[0] ) ? $tab_keys[0] : '';
	?>
<div class="hk-gate" id="hkGate" role="dialog" aria-modal="true" aria-labelledby="hkGateHeading">
	<div class="hk-gate__box">
		<div class="hk-gate__head">
			<h2 class="hk-gate__heading" id="hkGateHeading">
				<span data-en>Before you continue</span><span data-zh>请先阅读</span>
			</h2>
			<p class="hk-gate__intro">
				<span data-en>Please read the following and confirm your agreement to view Hakshan Investor Relations.</span>
				<span data-zh>请阅读以下内容并确认同意，方可浏览客善投资者关系页面。</span>
			</p>
		</div>

		<div class="hk-gate__tabs" role="tablist">
			<?php foreach ( $tabs as $key => $labels ) : ?>
				<button type="button"
					class="hk-gate__tab<?php echo $key === $first ? ' is-on' : ''; ?>"
					role="tab"
					id="hkGateTab-<?php echo esc_attr( $key ); ?>"
					aria-controls="hkGatePanel-<?php echo esc_attr( $key ); ?>"
					aria-selected="<?php echo $key === $first ? 'true' : 'false'; ?>"
					data-hk-tab="<?php echo esc_attr( $key ); ?>">
					<span data-en><?php echo esc_html( $labels['en'] ); ?></span>
					<span data-zh><?php echo esc_html( $labels['zh'] ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="hk-gate__scroll">
			<?php foreach ( $tabs as $key => $labels ) : ?>
				<div class="hk-gate__panel<?php echo $key === $first ? ' is-on' : ''; ?>"
					id="hkGatePanel-<?php echo esc_attr( $key ); ?>"
					role="tabpanel"
					aria-labelledby="hkGateTab-<?php echo esc_attr( $key ); ?>"
					data-hk-panel="<?php echo esc_attr( $key ); ?>">
					<?php echo wp_kses_post( hakshan_gate_tab_content( $key ) ); ?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="hk-gate__foot">
			<label class="hk-gate__agree">
				<input type="checkbox" id="hkGateAgree" />
				<span>
					<span data-en>I have read and agree to the Terms of Use, Risk Warning, Guidelines &amp; Eligibility and Privacy Policy above.</span>
					<span data-zh>本人已阅读并同意以上使用条款、风险提示、投资准则与资格及隐私政策。</span>
				</span>
			</label>
			<div class="hk-gate__actions">
				<a class="hk-gate__leave" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span data-en>Leave</span><span data-zh>离开</span>
				</a>
				<button type="button" class="hk-gate__go" id="hkGateGo" disabled>
					<span data-en>Agree &amp; Continue</span><span data-zh>同意并继续</span>
					<span class="hk-gate__arrow" aria-hidden="true">&rarr;</span>
				</button>
			</div>
		</div>
	</div>
</div>

<style>
.hk-gate{position:fixed;inset:0;z-index:9500;display:none;align-items:center;justify-content:center;padding:16px;background:#1b140d;background:radial-gradient(120% 90% at 50% 0%,#2D2219 0%,#1b140d 70%)}
html.hk-gate-pending .hk-gate{display:flex;visibility:visible !important}
.hk-gate__box{width:100%;max-width:760px;max-height:calc(100vh - 32px);display:flex;flex-direction:column;background:#231A12;border:1px solid rgba(243,234,217,.18);border-radius:14px;overflow:hidden;box-shadow:0 40px 90px -30px rgba(0,0,0,.8)}
.hk-gate__head{padding:26px 26px 16px;border-bottom:1px solid rgba(243,234,217,.12)}
.hk-gate__heading{margin:0 0 6px;font-family:var(--serif,serif);font-size:clamp(22px,4vw,28px);line-height:1.2;color:#F3EAD9}
.hk-gate__intro{margin:0;font-size:14px;line-height:1.55;color:rgba(243,234,217,.66)}
.hk-gate__tabs{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;padding:16px 26px 0}
@media(min-width:760px){.hk-gate__tabs{grid-template-columns:repeat(4,1fr)}}
.hk-gate__tab{appearance:none;border:1px solid rgba(243,234,217,.18);background:rgba(243,234,217,.04);color:rgba(243,234,217,.7);font:inherit;font-size:13px;line-height:1.25;padding:11px 10px;border-radius:9px;cursor:pointer;transition:background .2s ease,color .2s ease,border-color .2s ease}
.hk-gate__tab:hover{color:#F3EAD9;border-color:rgba(196,155,102,.5)}
.hk-gate__tab.is-on{background:#C49B66;border-color:#C49B66;color:#231A12;font-weight:600}
.hk-gate__scroll{flex:1 1 auto;overflow-y:auto;padding:20px 26px;margin:4px 0;-webkit-overflow-scrolling:touch}
.hk-gate__panel{display:none;color:rgba(243,234,217,.78);font-size:14.5px;line-height:1.7}
.hk-gate__panel.is-on{display:block}
.hk-gate__panel h3{margin:0 0 14px;font-family:var(--serif,serif);font-size:20px;color:#F3EAD9}
.hk-gate__panel h4{margin:20px 0 6px;font-size:14px;letter-spacing:.02em;color:#C49B66;font-weight:600}
.hk-gate__panel p{margin:0 0 12px}
.hk-gate__panel ul,.hk-gate__panel ol{margin:0 0 12px;padding-inline-start:18px}
.hk-gate__panel a{color:#C49B66;text-decoration:underline}
.hk-gate__foot{padding:16px 26px 22px;border-top:1px solid rgba(243,234,217,.12);background:rgba(0,0,0,.18)}
.hk-gate__agree{display:flex;align-items:flex-start;gap:11px;font-size:13.5px;line-height:1.5;color:rgba(243,234,217,.8);cursor:pointer}
.hk-gate__agree input{flex:0 0 auto;width:18px;height:18px;margin-top:1px;accent-color:#C49B66;cursor:pointer}
.hk-gate__actions{display:flex;align-items:center;justify-content:flex-end;gap:16px;margin-top:16px}
.hk-gate__leave{font-family:var(--mono,monospace);font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:rgba(243,234,217,.45);text-decoration:none}
.hk-gate__leave:hover{color:rgba(243,234,217,.8)}
.hk-gate__go{display:inline-flex;align-items:center;gap:9px;appearance:none;border:0;font:inherit;font-size:15px;font-weight:600;padding:13px 26px;border-radius:999px;background:#C49B66;color:#231A12;cursor:pointer;transition:opacity .2s ease,transform .2s ease,background .2s ease}
.hk-gate__go[disabled]{opacity:.38;cursor:not-allowed}
.hk-gate__go:not([disabled]):hover{background:#d4ab76;transform:translateY(-1px)}
.hk-gate__arrow{transition:transform .2s ease}
.hk-gate__go:not([disabled]):hover .hk-gate__arrow{transform:translateX(3px)}
@media(max-width:520px){.hk-gate__head,.hk-gate__tabs,.hk-gate__scroll,.hk-gate__foot{padding-left:18px;padding-right:18px}.hk-gate__actions{justify-content:space-between}}
</style>

<script>
(function(){
	var gate = document.getElementById('hkGate');
	if (!gate) return;
	var cfg = window.__hkGate || { key: 'hakshan_investor_gate', remember: '30' };

	// Tabs
	gate.querySelectorAll('[data-hk-tab]').forEach(function(btn){
		btn.addEventListener('click', function(){
			var k = btn.getAttribute('data-hk-tab');
			gate.querySelectorAll('[data-hk-tab]').forEach(function(b){
				var on = b === btn;
				b.classList.toggle('is-on', on);
				b.setAttribute('aria-selected', on ? 'true' : 'false');
			});
			gate.querySelectorAll('[data-hk-panel]').forEach(function(p){
				p.classList.toggle('is-on', p.getAttribute('data-hk-panel') === k);
			});
			var sc = gate.querySelector('.hk-gate__scroll');
			if (sc) sc.scrollTop = 0;
		});
	});

	// Checkbox unlocks the button
	var agree = document.getElementById('hkGateAgree');
	var go    = document.getElementById('hkGateGo');
	if (agree && go) {
		agree.addEventListener('change', function(){ go.disabled = !agree.checked; });
	}

	function accept(){
		if (cfg.remember !== 'always') {
			try {
				var s = (cfg.remember === 'session') ? sessionStorage : localStorage;
				s.setItem(cfg.key, String(Date.now()));
			} catch (e) {}
		}
		document.documentElement.classList.remove('hk-gate-pending');
		gate.style.display = 'none';
		if (window.dataLayer) window.dataLayer.push({ event: 'investor_gate_accept' });
		if (typeof window.gtag === 'function') window.gtag('event', 'investor_gate_accept');
	}

	if (go) go.addEventListener('click', function(){ if (!go.disabled) accept(); });

	// If the visitor already accepted, the guard class was never added —
	// make sure the modal stays out of the way in that case.
	if (!document.documentElement.classList.contains('hk-gate-pending')) {
		gate.style.display = 'none';
	}
})();
</script>
	<?php
}
add_action( 'wp_footer', 'hakshan_gate_render', 5 );
