<?php get_header();?>

<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	<h1>Revistas UFG</h1>
</header>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>	
  <?php if( have_rows('revista_informacoes') ): while( have_rows('revista_informacoes') ): the_row();
    loop_revista(); 
  endwhile; endif; ?>
</article>

<?php endwhile; else : endif;
get_footer(); ?>