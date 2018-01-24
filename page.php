<?php get_header(); if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('post-aberto'); ?>>
		<?php get_template_part('layout/loop-aberto'); ?>
	</div>

<?php endwhile; else : endif; get_footer(); ?>