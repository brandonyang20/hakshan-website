<?php
/**
 * Default page template — used when a page has no dedicated template.
 *
 * @package Hakshan
 */

get_header();
?>

<main class="section">
	<article class="container" style="max-width: 760px;">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1 class="h-display" style="font-size: clamp(48px, 8vw, 120px); margin: 0 0 40px;">
				<?php the_title(); ?>
			</h1>
			<div class="h-body" style="max-width: none;">
				<?php the_content(); ?>
			</div>
			<?php
		endwhile;
		?>
	</article>
</main>

<?php
get_footer();
