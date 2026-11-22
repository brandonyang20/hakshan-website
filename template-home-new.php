<?php
/**
 * Template Name: Home (new design)
 *
 * The redesigned homepage. Attached to a private preview page first, so it
 * can be checked on the live site before it replaces front-page.php.
 * Dishes and outlets come from the Dish and Outlet post types.
 *
 * @package Hakshan
 */

if ( ! function_exists( 'hn_t' ) ) {
	/**
	 * Echo a bilingual pair of spans (the EN/中 toggle shows one of them).
	 *
	 * @param string $en English text.
	 * @param string $zh Chinese text.
	 */
	function hn_t( $en, $zh ) {
		echo '<span data-en>' . esc_html( $en ) . '</span><span data-zh>' . esc_html( $zh ) . '</span>';
	}
}

$hn_up    = trailingslashit( wp_get_upload_dir()['baseurl'] );
$hn_menu  = hakshan_nav_url( 'menu' );
$hn_story = hakshan_nav_url( 'social' );

// Signature dishes (same source as the current homepage carousel).
$hn_dishes = function_exists( 'hakshan_get_signature_dishes' ) ? hakshan_get_signature_dishes( 6 ) : array();

// Outlets: open ones first in their set order, "Coming Soon" ones last.
$hn_open = array();
$hn_soon = array();
foreach ( hakshan_get_outlets() as $hn_post ) {
	$o    = hakshan_get_outlet_data( $hn_post->ID );
	$name = trim( preg_replace( '/^HAKSHAN\s+/i', '', $o['name'] ) );
	$soon = false !== stripos( $name, 'coming soon' );
	$name = trim( preg_replace( '/\(\s*coming soon\s*\)/i', '', $name ) );
	$o['short'] = $name;
	$o['cn_tight'] = str_replace( array( ' ', '　' ), '', (string) $o['cn'] );
	$o['area']  = ucwords( strtolower( (string) $o['city'] ) );
	if ( $soon ) {
		$hn_soon[] = $o;
	} else {
		$hn_open[] = $o;
	}
}
$hn_outlets = array_merge( $hn_open, $hn_soon );

get_header();
?>
<main class="hn" id="hn">

<section class="hn-hero">
	<h1 class="sr-only"><?php hn_t( 'Hakshan · Hakka cooking, three generations, seventeen kitchens in Malaysia.', '客善 · 三代人的客家菜，十七家厨房，遍布马来西亚。' ); ?></h1>
	<img src="<?php echo esc_url( get_theme_file_uri( 'assets/brand/hakshan-logo-ground.png' ) ); ?>" alt="Hakshan 客善 · 三代人的传承" data-no-lazy="1">
	<div class="hn-hero__scroll" aria-hidden="true"><?php hn_t( 'SCROLL', '下滑' ); ?></div>
</section>

<section class="hn-win">
	<h2 aria-label="客家 Hakka" style="background-image:url('<?php echo esc_url( $hn_up . '2026/06/Braised-Sliced-Pork-Belly-With-Preserved-Mustard-Vegetables.jpeg' ); ?>')">客家</h2>
	<div class="hn-win__cap">
		<h3><?php hn_t( 'Hakka food since 1928', '客家菜，始于1928' ); ?></h3>
		<p><?php hn_t( 'Salted, braised and slow. Our mui choy pork belly is still steamed the way the first kitchen did it, in all 17 of our kitchens across KL, Selangor and Ipoh, every day from 11 am.', '盐渍、焖煮、慢火。我们的梅菜扣肉，至今仍按第一间厨房的做法蒸制。十七间厨房，遍布吉隆坡、雪兰莪与怡保，每天上午11点开门。' ); ?></p>
		<a class="hn-link" href="<?php echo esc_url( $hn_menu ); ?>"><?php hn_t( 'See the menu', '查看菜单' ); ?></a>
	</div>
</section>

<section class="hn-years">
	<?php
	$hn_years = array(
		array( 'a', '1928', 'gen-1928.png', '祖屋 · 家中厨房', 'A home kitchen in the ancestral village. No restaurant, no staff. A stove, a wok and family.', '祖屋里的家常厨房。没有餐馆，没有员工，只有一个灶、一口锅和一家人。', 'The first generation cooking at home, 1928' ),
		array( 'b', '1972', 'gen-1972.png', '食谱南下', 'The recipes come to the Klang Valley and are written down for the first time, in pencil on kuih paper.', '食谱随第二代南下巴生谷，第一次被写下来，用铅笔写在糕点纸上。', 'The second generation in the kitchen, 1972' ),
		array( 'c', '2024', 'gen-2024.png', '客善开业 · USJ', 'The third generation opens Hakshan. Seventeen kitchens now cook from the same pencil notes.', '第三代开设客善。如今十七间厨房，依旧照着同一份铅笔笔记做菜。', 'Hakshan USJ Taipan, opened 2024' ),
	);
	foreach ( $hn_years as $y ) :
		?>
	<div class="hn-yr hn-yr--<?php echo esc_attr( $y[0] ); ?>">
		<svg class="hn-yr__big" viewBox="0 0 1000 300" role="img" aria-label="<?php echo esc_attr( $y[1] ); ?>"><text x="0" y="250"><?php echo esc_html( $y[1] ); ?></text></svg>
		<img src="<?php echo esc_url( $hn_up . '2026/06/' . $y[2] ); ?>" alt="<?php echo esc_attr( $y[6] ); ?>" loading="lazy">
		<div class="hn-yr__txt"><b><?php echo esc_html( $y[3] ); ?></b><?php hn_t( $y[4], $y[5] ); ?></div>
	</div>
	<?php endforeach; ?>
</section>

<?php if ( ! empty( $hn_dishes ) ) : ?>
<section class="hn-dishes hn-reveal">
	<div class="hn-dishes__head">
		<div class="hn-sig"><h2>招牌</h2><span><?php hn_t( 'House favourites', '招牌菜' ); ?></span></div>
		<p><?php hn_t( 'From 114 dishes, the ones regulars order without looking. Member prices shown.', '一百多道菜里，熟客不看菜单也会点的几道。所示为会员价。' ); ?></p>
	</div>
	<div class="hn-sigs">
		<div class="hn-sigs__viewport" id="hnSigView">
			<div class="hn-sigs__track" id="hnSigTrack">
				<?php
				foreach ( $hn_dishes as $hn_dish ) :
					$d     = hakshan_get_dish_data( $hn_dish->ID );
					$price = $d['price_member'] ? $d['price_member'] : $d['price_normal'];
					?>
				<a class="hn-card" href="<?php echo esc_url( $hn_menu . '#signatures' ); ?>" draggable="false">
					<?php
					if ( $d['image_id'] ) {
						echo wp_get_attachment_image( $d['image_id'], 'large', false, array( 'alt' => $d['en'], 'draggable' => 'false', 'data-no-lazy' => '1' ) );
					} else {
						echo '<div class="hn-card__ph"></div>';
					}
					?>
					<div class="hn-card__body">
						<span class="hn-card__zh"><?php echo esc_html( $d['zh'] ); ?></span>
						<h3><?php echo esc_html( $d['en'] ); ?></h3>
						<?php if ( $price ) : ?><span class="hn-card__pr"><?php echo esc_html( $price ); ?></span><?php endif; ?>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
		<button class="hn-sigs__btn hn-sigs__btn--prev" id="hnSigPrev" type="button" aria-label="Previous dish"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></button>
		<button class="hn-sigs__btn hn-sigs__btn--next" id="hnSigNext" type="button" aria-label="Next dish"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
	</div>
	<a class="hn-link" href="<?php echo esc_url( $hn_menu ); ?>"><?php hn_t( 'See the full menu', '查看完整菜单' ); ?></a>
</section>
<?php endif; ?>

<section class="hn-rooms hn-reveal">
	<div class="hn-sig"><h2>店里</h2><span><?php hn_t( 'Inside our restaurants', '走进门店' ); ?></span></div>
	<p class="hn-rooms__lede"><?php hn_t( 'Seventeen dining rooms with the same timber tables, cord chairs and warm light. No booking needed for small groups, any day from 11 am.', '十七间餐厅，同样的木桌、绳编椅与暖光。小组用餐无需预订，每天上午11点起。' ); ?></p>
	<div class="hn-collage">
		<img class="c1" src="<?php echo esc_url( $hn_up . '2026/06/hf_20260614_163317_1f8b7b31-da36-4b26-baf9-ab98396f6d1b-scaled.png' ); ?>" alt="A Hakshan dining room with timber tables" loading="lazy">
		<img class="c2" src="<?php echo esc_url( $hn_up . '2026/06/SaveClip.App_476383046_122213662124196129_8518853883524923681_n.jpg' ); ?>" alt="A table set for dinner" loading="lazy">
		<img class="c3" src="<?php echo esc_url( $hn_up . '2026/06/SaveClip.App_473719755_122209079966196129_8098557174058037329_n.jpg' ); ?>" alt="A guest eating" loading="lazy">
		<img class="c4" src="<?php echo esc_url( $hn_up . '2026/06/SaveClip.App_476275457_122213662208196129_979495312290091736_n.jpg' ); ?>" alt="A guest reading the menu" loading="lazy">
	</div>
</section>

<section class="hn-shan hn-reveal">
	<div class="hn-slogan"><span class="hn-slogan__cn" aria-hidden="true">善</span><h2><?php hn_t( 'Pay it Forward', '一菜一善' ); ?></h2></div>
	<div class="hn-why">
		<div>
			<h3><?php hn_t( '善 is the second half of our name', '善，是我们名字的后半部分' ); ?></h3>
			<p><?php hn_t( '客善 means "guest" and "kindness". Since the day we opened in February 2024, part of every bill at every outlet has gone to the community: children\'s education, elderly care and animal welfare. It isn\'t a campaign. It\'s how the restaurant is set up, and it has been for every one of the million-plus meals since.', '客善，意为“客人”与“善意”。自2024年2月开业以来，每一家门店的每一笔营业额，都有一部分回馈社区：儿童教育、长者关怀与动物福利。这不是一次活动，而是餐厅本来的运作方式，一百多万份餐点以来从未改变。' ); ?></p>
		</div>
		<img src="<?php echo esc_url( $hn_up . '2026/06/horvard-charity.jpeg' ); ?>" alt="Hakshan's founder delivering supplies" loading="lazy">
	</div>
	<div class="hn-causes">
		<div class="hn-cause hn-cause--1"><img src="<?php echo esc_url( $hn_up . '2024/04/batch_ss汇聚力量.携手同心.jpg' ); ?>" alt="Children at a supported school programme" loading="lazy"><div class="hn-cause__t"><b><i>教育</i><?php hn_t( 'Education', '教育' ); ?></b><?php hn_t( 'School programmes and learning materials for children near our outlets.', '为门店附近的孩子提供学校活动与学习用品。' ); ?></div></div>
		<div class="hn-cause hn-cause--2"><img src="<?php echo esc_url( $hn_up . '2024/07/Compress_DSC5350.jpg' ); ?>" alt="Lunch at an elderly care home" loading="lazy"><div class="hn-cause__t"><b><i>长者</i><?php hn_t( 'Elderly care', '长者关怀' ); ?></b><?php hn_t( 'Meals and visits for elderly residents in care homes.', '为安老院的长者送餐与探访。' ); ?></div></div>
		<div class="hn-cause hn-cause--3"><img src="<?php echo esc_url( $hn_up . '2026/06/DSC_5201.jpg' ); ?>" alt="Volunteer at an animal shelter" loading="lazy"><div class="hn-cause__t"><b><i>动物</i><?php hn_t( 'Animal welfare', '动物福利' ); ?></b><?php hn_t( 'Support for shelters and rescue work for strays in the Klang Valley.', '支持巴生谷的动物收容所与流浪动物救援。' ); ?></div></div>
	</div>
	<a class="hn-link" href="<?php echo esc_url( $hn_story ); ?>"><?php hn_t( 'Read the stories from the kitchens', '阅读来自厨房的故事' ); ?></a>
</section>

<?php if ( ! empty( $hn_outlets ) ) : ?>
<section class="hn-outlets hn-reveal">
	<div class="hn-outlets__h">
		<div class="hn-sig"><h2>到访</h2><span><?php hn_t( 'Visit us', '欢迎光临' ); ?></span></div>
		<span class="hn-outlets__note">
			<?php
			$hn_n_open = count( $hn_open );
			$hn_n_soon = count( $hn_soon );
			if ( $hn_n_soon ) {
				/* translators: 1: open outlets, 2: upcoming outlets */
				hn_t( sprintf( '%1$d kitchens, and %2$d more on the way', $hn_n_open, $hn_n_soon ), sprintf( '%1$d间厨房，另有%2$d间即将开业', $hn_n_open, $hn_n_soon ) );
			} else {
				hn_t( sprintf( '%d kitchens', $hn_n_open ), sprintf( '%d间厨房', $hn_n_open ) );
			}
			?>
		</span>
	</div>
	<div class="hn-track" id="hnOcTrack">
		<?php foreach ( $hn_open as $o ) : ?>
		<article class="hn-oc">
			<a href="<?php echo esc_url( get_permalink( $o['id'] ) ); ?>">
				<?php if ( $o['image_id'] ) : ?>
					<?php echo wp_get_attachment_image( $o['image_id'], 'large', false, array( 'alt' => 'Hakshan ' . $o['short'] . ' shopfront' ) ); ?>
				<?php else : ?><div class="hn-oc__ph"></div><?php endif; ?>
				<h4><span data-en><?php echo esc_html( $o['short'] ); ?></span><span data-zh><?php echo esc_html( $o['cn_tight'] ? $o['cn_tight'] : $o['short'] ); ?></span></h4>
			</a>
			<div class="hn-oc__meta">
				<span><?php echo esc_html( $o['area'] ); ?></span>
				<?php if ( $o['booking_url'] ) : ?>
					<a class="hn-link" href="<?php echo esc_url( $o['booking_url'] ); ?>" target="_blank" rel="noopener"><?php hn_t( 'Reserve', '订位' ); ?></a>
				<?php elseif ( $o['phone'] ) : ?>
					<a class="hn-link" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $o['phone'] ) ); ?>"><?php hn_t( 'Call', '致电' ); ?></a>
				<?php else : ?>
					<a class="hn-link" href="<?php echo esc_url( get_permalink( $o['id'] ) ); ?>"><?php hn_t( 'Details', '详情' ); ?></a>
				<?php endif; ?>
			</div>
		</article>
		<?php endforeach; ?>
		<?php foreach ( $hn_soon as $o ) : ?>
		<article class="hn-oc hn-oc--soon">
			<h4><span data-en><?php echo esc_html( $o['short'] ); ?></span><span data-zh><?php echo esc_html( $o['cn_tight'] ? $o['cn_tight'] : $o['short'] ); ?></span></h4>
			<p><?php hn_t( 'Opening soon', '即将开业' ); ?></p>
			<div class="hn-oc__meta"><span><?php echo esc_html( $o['area'] ); ?></span><a class="hn-link" href="<?php echo esc_url( get_permalink( $o['id'] ) ); ?>"><?php hn_t( 'Details', '详情' ); ?></a></div>
		</article>
		<?php endforeach; ?>
	</div>
	<div class="hn-ctl">
		<span class="hn-count" id="hnOcCount">1 / <?php echo (int) count( $hn_outlets ); ?></span>
		<div class="hn-progress"><span id="hnOcProg"></span></div>
		<div class="hn-arrows">
			<button id="hnOcPrev" type="button" aria-label="Previous outlets"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg></button>
			<button id="hnOcNext" type="button" aria-label="Next outlets"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
		</div>
	</div>
	<a class="hn-link" href="<?php echo esc_url( hakshan_nav_url( 'outlets' ) ); ?>"><?php hn_t( 'All outlets on the map', '在地图上查看所有门店' ); ?></a>
</section>
<?php endif; ?>

</main>

<?php // Runs straight away (not delayed by LiteSpeed) so sections never wait for a tap to appear. ?>
<script data-no-optimize="1" data-no-defer="1" data-cfasync="false">
(function () {
	var root = document.getElementById('hn');
	if (!root) return;
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// Reveal each section once, the first time it scrolls into view.
	if ('IntersectionObserver' in window) {
		root.classList.add('hn-js');
		function reveal(sel, opts) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
			}, opts);
			root.querySelectorAll(sel).forEach(function (el) { io.observe(el); });
		}
		// Sections fade in as soon as they enter the screen.
		reveal('.hn-reveal', { threshold: 0.15 });
		// 客家 and the years wait until they are about a third of the way up the screen.
		reveal('.hn-win, .hn-yr', { threshold: 0.2, rootMargin: '0px 0px -35% 0px' });
	}

	// 招牌 cards: endless loop, drag or swipe, cards tilt along an arc.
	(function () {
		var vp = document.getElementById('hnSigView'), track = document.getElementById('hnSigTrack');
		if (!vp || !track || track.children.length < 2) return;
		var originals = Array.prototype.slice.call(track.children), N = originals.length;
		var MAX_ROT = reduce ? 0 : 7, MAX_DROP = reduce ? 0 : 22, EASE = 0.18;
		originals.forEach(function (c) { var k = c.cloneNode(true); k.setAttribute('aria-hidden', 'true'); k.tabIndex = -1; track.appendChild(k); });
		originals.slice().reverse().forEach(function (c) { var k = c.cloneNode(true); k.setAttribute('aria-hidden', 'true'); k.tabIndex = -1; track.insertBefore(k, track.firstChild); });
		var cards = Array.prototype.slice.call(track.children);
		var step = 0, setW = 0, base = 0, offset = 0, target = 0, raf = null;
		function measure() {
			cards.forEach(function (c) { c.style.transform = 'none'; });
			var cw = cards[0].getBoundingClientRect().width;
			step = cw + (parseFloat(getComputedStyle(track).columnGap) || 24);
			setW = step * N;
			base = -(vp.getBoundingClientRect().width - cw) / 2;
		}
		function snap(v) { return Math.round((v - base) / step) * step + base; }
		function curve() {
			var r = vp.getBoundingClientRect(), mid = r.left + r.width / 2, reach = r.width / 2;
			cards.forEach(function (c) {
				var b = c.getBoundingClientRect(), d = Math.max(-1, Math.min(1, (b.left + b.width / 2 - mid) / reach));
				c.style.transform = 'translateY(' + (Math.abs(d) * MAX_DROP) + 'px) rotate(' + (d * MAX_ROT) + 'deg)';
			});
		}
		function render() {
			var w = offset;
			while (w < setW) w += setW;
			while (w >= setW * 2) w -= setW;
			target += w - offset; offset = w;
			track.style.transform = 'translate3d(' + (-offset) + 'px,0,0)';
			curve();
		}
		function tick() {
			var d = target - offset;
			if (Math.abs(d) < 0.5) { offset = target; render(); raf = null; return; }
			offset += d * (reduce ? 1 : EASE); render(); raf = requestAnimationFrame(tick);
		}
		function go(t) { target = t; if (raf == null) raf = requestAnimationFrame(tick); }
		document.getElementById('hnSigPrev').addEventListener('click', function () { go(snap(target) - step); });
		document.getElementById('hnSigNext').addEventListener('click', function () { go(snap(target) + step); });
		var down = false, moved = false, startX = 0, startOff = 0, lastX = 0, lastT = 0, vel = 0;
		vp.addEventListener('pointerdown', function (e) {
			down = true; moved = false; startX = lastX = e.clientX; startOff = offset; lastT = performance.now(); vel = 0;
			if (raf) { cancelAnimationFrame(raf); raf = null; target = offset; }
		});
		window.addEventListener('pointermove', function (e) {
			if (!down) return;
			var dx = e.clientX - startX;
			if (!moved && Math.abs(dx) > 6) { moved = true; vp.classList.add('is-dragging'); }
			if (!moved) return;
			var now = performance.now(); vel = (e.clientX - lastX) / Math.max(1, now - lastT); lastX = e.clientX; lastT = now;
			offset = target = startOff - dx; render();
		});
		window.addEventListener('pointerup', function () {
			if (!down) return; down = false; vp.classList.remove('is-dragging');
			if (moved) go(snap(offset - vel * 220));
		});
		vp.addEventListener('click', function (e) { if (moved) { e.preventDefault(); e.stopPropagation(); } }, true);
		window.addEventListener('resize', function () { var i = Math.round((offset - base) / step); measure(); offset = target = i * step + base; render(); });
		measure(); offset = target = setW + base; render();
	})();

	// 到访 outlets: arrows, "n / total" counter and progress line.
	(function () {
		var t = document.getElementById('hnOcTrack');
		if (!t) return;
		var cards = t.querySelectorAll('.hn-oc');
		function step() { return cards[0].getBoundingClientRect().width + 24; }
		document.getElementById('hnOcPrev').addEventListener('click', function () { t.scrollBy({ left: -step() * 2, behavior: reduce ? 'auto' : 'smooth' }); });
		document.getElementById('hnOcNext').addEventListener('click', function () { t.scrollBy({ left: step() * 2, behavior: reduce ? 'auto' : 'smooth' }); });
		function upd() {
			var i = Math.min(Math.round(t.scrollLeft / step()) + 1, cards.length);
			document.getElementById('hnOcCount').textContent = i + ' / ' + cards.length;
			document.getElementById('hnOcProg').style.transform = 'scaleX(' + ((t.scrollLeft + t.clientWidth) / t.scrollWidth) + ')';
		}
		t.addEventListener('scroll', upd, { passive: true }); upd();
	})();
})();
</script>
<?php
get_footer();
