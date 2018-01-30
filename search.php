<?php get_header(); ?>

<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	 <h1>Resultados sobre "<?php echo get_search_query(); ?>"</h1>
</header>

<div class="lista-artigos">
	<?php if (have_posts()) : while (have_posts()) : the_post();

	get_template_part('content','grid');

	endwhile; endif; paginacao(); ?>
</div>

<?php get_footer(); ?>