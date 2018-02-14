<?php get_header();?>

<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1>Revista: <?php the_title(); ?></h1>
</header>

<article>	
  <?php if( have_rows('revista_informacoes') ): while( have_rows('revista_informacoes') ): the_row();
    loop_revista(); 
  endwhile; endif; ?>
</article>

<?php endwhile; else : endif;
get_footer(); ?>