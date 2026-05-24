<?php get_header(); ?>
<main>
  <?php while (have_posts()) : the_post(); ?>
    <article class="section container">
      <h1 class="h-display" style="font-size: clamp(48px,8vw,120px); margin-bottom: 40px;">
        <?php the_title(); ?>
      </h1>
      <div class="h-body" style="max-width: 72ch; margin: 0 auto;">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
