<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	<h1><?php the_title(); ?></h1>
</header>

<article>
	<?php the_content(); ?>
</article>

<?php if ( has_post_format('gallery') ) {
	menu_boxes($post->ID);
} ?>