<?php
/**
 * Single post template — editorial article view for blog posts.
 *
 * Used primarily for the migrated "Social Responsibility" stories
 * (orphanages, animal shelters, disability centres, nursing homes,
 * etc.), but applies to any single WP post.
 *
 * @package Hakshan
 */

get_header();

if ( ! have_posts() ) {
	get_footer();
	return;
}
the_post();

$post_id   = get_the_ID();
$categories = get_the_category( $post_id );
$primary_cat = null;
foreach ( $categories as $cat ) {
	if ( 'uncategorized' !== $cat->slug ) {
		$primary_cat = $cat;
		break;
	}
}
if ( ! $primary_cat && ! empty( $categories ) ) {
	$primary_cat = $categories[0];
}

// Whether this post is in the Social Responsibility tree (parent or child).
$social_root  = get_category_by_slug( 'social-responsibility' );
$is_social    = false;
if ( $social_root && $primary_cat ) {
	$is_social = ( (int) $primary_cat->term_id === (int) $social_root->term_id )
		|| ( (int) $primary_cat->parent === (int) $social_root->term_id );
}
$back_label_en = $is_social ? 'All Pay it Forward stories' : 'All stories';
$back_label_zh = $is_social ? '所有行善故事' : '所有故事';
$back_href     = $is_social && $social_root
	? hakshan_nav_url( 'social' )
	: home_url( '/' );
?>

<style>
  /* Single-post article view */
  .sp-hero {
    padding: clamp(60px, 9vw, 120px) var(--rail) clamp(32px, 5vw, 56px);
    max-width: var(--maxw);
    margin: 0 auto;
  }
  .sp-hero__crumb {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--forest);
    margin-bottom: 18px;
    display: inline-flex;
    gap: 10px;
    align-items: center;
  }
  .sp-hero__crumb a { color: var(--forest); text-decoration: none; }
  .sp-hero__crumb a:hover { text-decoration: underline; text-underline-offset: 4px; }
  .sp-hero__cats {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
    opacity: 0.85;
    margin-bottom: 16px;
  }
  .sp-hero h1 {
    font-family: var(--italic);
    font-style: italic;
    font-weight: 400;
    font-size: clamp(40px, 6vw, 76px);
    line-height: 1.05;
    margin: 0 0 24px;
    letter-spacing: -0.025em;
    text-wrap: balance;
  }
  .sp-hero h1 em { color: var(--forest); }
  .sp-hero__meta {
    display: flex;
    align-items: center;
    gap: 18px;
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
    padding-top: 20px;
    border-top: 1px solid var(--line);
  }
  .sp-hero__meta .sep { opacity: 0.5; }

  /* Featured image, full bleed within the page rail */
  .sp-feature {
    max-width: var(--maxw);
    margin: 0 auto clamp(40px, 6vw, 80px);
    padding: 0 var(--rail);
  }
  .sp-feature__inner {
    aspect-ratio: 16 / 9;
    overflow: hidden;
    border: 1px solid var(--line);
    background: var(--cream);
  }
  .sp-feature__inner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Article body — scoped editorial typography that overrides any
     legacy Elementor inline styles from the imported content. */
  .sp-body {
    max-width: 720px;
    margin: 0 auto;
    padding: 0 var(--rail);
    font-size: 17px;
    line-height: 1.75;
    color: var(--ink);
  }
  .sp-body > * { max-width: 100%; }
  .sp-body p {
    margin: 0 0 24px;
    color: var(--ink);
  }
  .sp-body h1, .sp-body h2, .sp-body h3, .sp-body h4 {
    font-family: var(--serif);
    font-style: italic;
    color: var(--ink);
    letter-spacing: -0.015em;
    line-height: 1.2;
    margin: 48px 0 16px;
  }
  .sp-body h1 { font-size: 36px; }
  .sp-body h2 { font-size: 32px; }
  .sp-body h2 em { color: var(--forest); }
  .sp-body h3 { font-size: 26px; }
  .sp-body h4 { font-size: 22px; }
  .sp-body a {
    color: var(--forest);
    text-decoration: underline;
    text-underline-offset: 3px;
    text-decoration-thickness: 1px;
  }
  .sp-body a:hover { text-decoration-thickness: 2px; }
  .sp-body strong { font-weight: 700; color: var(--ink); }
  .sp-body em { font-style: italic; }
  .sp-body ul, .sp-body ol { margin: 0 0 24px 1.5em; padding: 0; }
  .sp-body li { margin-bottom: 8px; }
  .sp-body blockquote {
    margin: 32px 0;
    padding: 16px 24px;
    border-left: 3px solid var(--forest);
    background: var(--paper);
    font-family: var(--serif);
    font-style: italic;
    font-size: 20px;
    line-height: 1.5;
    color: var(--ink);
  }
  .sp-body blockquote p:last-child { margin-bottom: 0; }
  .sp-body img,
  .sp-body figure img {
    display: block;
    max-width: 100%;
    height: auto;
    margin: 32px auto;
    border: 1px solid var(--line);
  }
  .sp-body figure { margin: 32px 0; }
  .sp-body figcaption {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--mute);
    text-align: center;
    margin-top: 12px;
  }
  .sp-body hr {
    border: 0;
    height: 1px;
    background: var(--line);
    margin: 48px 0;
  }
  /* Tame Elementor-generated wrappers that came in with the imported
     posts so they don't break the column. */
  .sp-body .elementor-section,
  .sp-body .elementor-container,
  .sp-body .elementor-column,
  .sp-body .elementor-widget-wrap,
  .sp-body .elementor-widget {
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
    background: transparent !important;
  }
  .sp-body [style*="width"] { max-width: 100% !important; }

  /* Footer / sign-off + back link */
  .sp-foot {
    max-width: 720px;
    margin: clamp(60px, 8vw, 100px) auto 0;
    padding: 32px var(--rail) 0;
    border-top: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
  }
  .sp-foot__share {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--mute);
  }

  /* Related stories */
  .sp-related {
    margin: clamp(80px, 12vw, 140px) auto 0;
    padding: clamp(60px, 8vw, 100px) var(--rail);
    max-width: var(--maxw);
    border-top: 1px solid var(--line);
  }
  .sp-related__head {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin-bottom: 48px;
    gap: 24px;
    flex-wrap: wrap;
  }
  .sp-related__head h2 {
    font-family: var(--serif);
    font-style: italic;
    font-size: clamp(32px, 4.5vw, 52px);
    line-height: 1;
    margin: 12px 0 0;
    letter-spacing: -0.02em;
  }
  .sp-related__head h2 em { color: var(--forest); }
  .sp-related__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  .sp-related__card {
    background: var(--paper);
    border: 1px solid var(--line);
    display: grid;
    text-decoration: none;
    color: inherit;
    transition: background 0.3s ease, transform 0.3s ease;
  }
  .sp-related__card:hover { background: var(--cream); transform: translateY(-4px); }
  .sp-related__visual {
    aspect-ratio: 4 / 3;
    position: relative;
    overflow: hidden;
    background: var(--cream);
  }
  .sp-related__visual img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .sp-related__body { padding: 20px 22px 24px; display: grid; gap: 10px; }
  .sp-related__date {
    font-family: var(--mono);
    font-size: 12px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--forest);
  }
  .sp-related__title {
    font-family: var(--serif);
    font-style: italic;
    font-size: 20px;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.01em;
  }

  @media (max-width: 760px) {
    .sp-related__grid { grid-template-columns: 1fr; }
    .sp-feature__inner { aspect-ratio: 4 / 3; }
  }
</style>

<article class="sp">
  <header class="sp-hero">
    <div class="sp-hero__crumb">
      <a href="<?php echo esc_url( $back_href ); ?>">
        <span data-en>← <?php echo esc_html( $back_label_en ); ?></span>
        <span data-zh>← <?php echo esc_html( $back_label_zh ); ?></span>
      </a>
    </div>

    <?php if ( $primary_cat ) : ?>
      <div class="sp-hero__cats"><?php echo esc_html( $primary_cat->name ); ?></div>
    <?php endif; ?>

    <h1><?php echo hakshan_post_title_bilingual(); ?></h1>

    <div class="sp-hero__meta">
      <span><?php echo esc_html( get_the_date() ); ?></span>
    </div>
  </header>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="sp-feature">
      <div class="sp-feature__inner">
        <?php the_post_thumbnail( 'large', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="sp-body">
    <?php the_content(); ?>
  </div>

  <footer class="sp-foot">
    <a class="btn btn--ghost" href="<?php echo esc_url( $back_href ); ?>">
      <span data-en>← <?php echo esc_html( $back_label_en ); ?></span>
      <span data-zh>← <?php echo esc_html( $back_label_zh ); ?></span>
    </a>
    <span class="sp-foot__share"><span data-en>Hakshan · Pay it Forward</span><span data-zh>客善 · 行善</span></span>
  </footer>
</article>

<?php
// Related stories — other posts in the same Social Responsibility tree.
if ( $is_social && $social_root ) {
	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'rand',
		'cat'            => $social_root->term_id,
		'no_found_rows'  => true,
	);
} else {
	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	);
}
$related = new WP_Query( $related_args );
if ( $related->have_posts() ) : ?>
<section class="sp-related">
  <div class="sp-related__head">
    <div>
      <span class="h-eyebrow"><span class="dot"></span>
        <span data-en>KEEP READING</span><span data-zh>继续阅读</span>
      </span>
      <h2>
        <span data-en>More <em>stories.</em></span>
        <span data-zh>更多 <em>故事。</em></span>
      </h2>
    </div>
    <a class="btn btn--ghost" href="<?php echo esc_url( $back_href ); ?>">
      <span data-en>All stories</span><span data-zh>全部故事</span><span class="arr">→</span>
    </a>
  </div>
  <div class="sp-related__grid">
    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
      <a class="sp-related__card" href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="sp-related__visual">
            <?php the_post_thumbnail( 'medium_large' ); ?>
          </div>
        <?php endif; ?>
        <div class="sp-related__body">
          <div class="sp-related__date"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></div>
          <h3 class="sp-related__title"><?php echo hakshan_post_title_bilingual(); ?></h3>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<?php
get_footer();
