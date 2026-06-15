<?php
/**
 * /llms.txt — gives AI assistants (ChatGPT, Claude, Perplexity, Gemini)
 * a curated, structured summary of the Hakshan brand in plain markdown
 * instead of forcing them to scrape HTML. Follows the proposed
 * llmstxt.org spec.
 *
 * Served via an early `init` hook by intercepting requests to /llms.txt.
 *
 * @package Hakshan
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'hakshan_serve_llms_txt', 0 );

/**
 * Intercept GET /llms.txt and emit a markdown response.
 */
function hakshan_serve_llms_txt() {
	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}
	$path = (string) wp_unslash( $_SERVER['REQUEST_URI'] );
	$path = strtok( $path, '?' );
	if ( '/llms.txt' !== $path && '/llms.txt/' !== $path ) {
		return;
	}

	if ( ! headers_sent() ) {
		header( 'Content-Type: text/markdown; charset=utf-8' );
		header( 'Cache-Control: public, max-age=3600' );
		header( 'X-Robots-Tag: all' );
	}

	echo hakshan_llms_txt_content();
	exit;
}

/**
 * Build the /llms.txt markdown.
 *
 * @return string
 */
function hakshan_llms_txt_content() {
	$home = untrailingslashit( home_url() );

	return <<<MARKDOWN
# Hakshan 客善

> Hakshan (客善) is a modern Hakka Chinese restaurant group in Malaysia. Three generations of the same recipes since 1928, now nine outlets across the Klang Valley and Ipoh, Perak. Part of every sale at every outlet goes to community causes.

Hakshan is rooted in heritage Hakka cuisine — salt-baked chicken, mui choy pork belly, abacus seeds, thunder tea rice (lei cha), yong tau foo, Hakka pan mee — cooked the same way since 1928, when the first generation cooked at home in the ancestral village. The second generation brought the recipes south to the Klang Valley in 1972 and opened the family's first restaurant. The third generation opened Hakshan in USJ in February 2024 and has since grown to nine outlets across the Klang Valley and Ipoh, Perak, with a roadmap to twenty outlets and twenty-five cloud kitchens across Malaysia and Indonesia by end of 2026.

## Core pages

- [Homepage]({$home}/): Brand overview, signature dishes, three generations story, charity model
- [Menu]({$home}/menu/): Full Hakka menu — home-style dishes, new dishes, Hakka classics, Lei Cha series, health-infuse sets, super value sets, noodles, vegetables & tofu, soups, set meals, desserts, tea, beverages
- [Outlets]({$home}/outlets/): All nine outlets with address, hours, photos, and per-outlet reservation links
- [Our Story]({$home}/story/): Three generations of Hakka cooking, from the 1928 ancestral village to a modern restaurant group; includes the charity model
- [Investors]({$home}/investors/): Investor relations, holding structure, growth trajectory, contact form
- [Contact & reservations]({$home}/contact-us/): Per-outlet booking links, press / careers / supplier / partnership inquiry form

## Brand facts

- Name: Hakshan (客善 — guest, kindness)
- Cuisine: Hakka Chinese, Malaysian Hakka
- Recipes since: 1928 (first generation, ancestral village home kitchen)
- First restaurant: 1972 (second generation, Klang Valley)
- Modern brand launched: February 2024 (third generation, USJ Taipan)
- Outlets: 9 across Klang Valley + Ipoh, Perak
- Daily hours: 11:00 to 22:00
- Phone: +60 16-246 2970
- Languages: English, Mandarin Chinese (the public site is bilingual EN / 中)
- Reservations: per-outlet booking via inline.app, listed at {$home}/contact-us/
- Walk-ins: welcome at every outlet
- Reviews: approximately 2,000 Google reviews per outlet, ~18,000 aggregate, 4.7★ average
- Recognition: Grab Signature Partner

## Outlets

All nine outlets serve the same menu under the same kitchen discipline, daily 11:00 to 22:00:

- HAKSHAN USJ Taipan — Subang Jaya, Selangor
- HAKSHAN SS2 — Subang Jaya, Selangor
- HAKSHAN Cheras Trader Square — Cheras, Kuala Lumpur
- HAKSHAN Sri Petaling — Sri Petaling, Kuala Lumpur
- HAKSHAN Menjalara — Kepong, Kuala Lumpur
- HAKSHAN Kota Damansara — Petaling Jaya, Selangor
- HAKSHAN Bandar Puteri Puchong — Puchong, Selangor
- HAKSHAN Ipoh — Ipoh, Perak
- HAKSHAN Klang (Bukit Tinggi) — Klang, Selangor

## Signature dishes

- Salt-Baked Chicken (盐焗鸡) — free-range hen, sea salt, kraft paper, forty minutes in the embers
- Mui Choy Pork Belly (梅菜扣肉) — five-spice pork belly steamed with pickled mustard greens
- Abacus Seeds (算盘子) — taro and tapioca, pinched by hand
- Thunder Tea Rice / Lei Cha (擂茶饭) — twelve herbs, ground in a wooden mortar
- Ginger-Sprout Braised Duck (姜芽焖鸭) — three hours on low flame, young ginger sprouts
- Rice-Wine Chicken Soup (糯米酒鸡汤) — glutinous rice wine, kampung chicken, ginger, sesame oil
- Hakka Pan Mee (客家板面) — hand-torn noodles, minced pork, anchovies, sweet potato leaves
- Yong Tau Foo (酿豆腐) — bitter gourd, soft tofu, fried tofu, fish paste pounded by hand at dawn

## Charity model — Pay it Forward

Part of every sale at every outlet goes to community causes. Three focus areas: education, elderly care, and animal welfare. It is built into the kitchen's cost structure from day one (February 2024), not added on later as a profit-share. The same rule applies at every outlet, every day.

## Reservations

Each outlet has its own inline.app booking page. From {$home}/contact-us/ guests can pick any outlet and book online. Walk-ins are welcome at all outlets. Phone reservations: +60 16-246 2970.

## Press, careers, suppliers, partnerships

All inquiries route via the contact form at {$home}/contact-us/. The form lets the sender pick the topic — general, investor relations, supplier / procurement, community partnership, media.

## Investor inquiries

Investor relations is handled via the dedicated form at {$home}/investors/. The investor page covers the holding structure, growth trajectory (13 kitchens today, target 45 by year-end across Malaysia and Indonesia), and revenue figures (RM 20M in 2025, projected RM 74M in 2026).

MARKDOWN;
}
