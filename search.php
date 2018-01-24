<?php get_header(); ?>

<h1 style="width: 100%; text-align: center">Resultados de busca</h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('post-fechado'); ?>>
		<?php get_template_part('layout/loop-fechado'); ?>
	</div>

<?php endwhile; else : endif; afc_paginacao(); get_footer(); ?>