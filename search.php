<?php get_header(); ?>

<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	 <h1>Resultados sobre "<?php echo get_search_query(); ?>"</h1>
</header>

<article>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<a  href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_excerpt(); ?></a>
	<?php endwhile; endif; ?>
</article>

<?php paginacao(); ?>

<?php get_footer(); ?>