<?php
/**
 * Generic fallback template.
 *
 * The theme is page-driven; this just renders the requested content with the
 * shared shell so nothing 404s on misrouted URLs.
 *
 * @package Hakshan
 */

get_header();
?>

<main class="section">
	<div class="container" style="max-width: 760px;">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h1 class="h-display" style="font-size: clamp(40px, 6vw, 80px); margin: 0 0 24px;">
						<?php the_title(); ?>
					</h1>
					<div class="h-body" style="max-width: none;">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			endwhile;
		else :
			?>
			<h1 class="h-display" style="font-size: clamp(40px, 6vw, 80px);">
				<span data-en>Nothing here.</span>
				<span data-zh>无此页面。</span>
			</h1>
			<p class="h-body">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span data-en>← Back to home</span>
					<span data-zh>← 返 回 首 页</span>
				</a>
			</p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
