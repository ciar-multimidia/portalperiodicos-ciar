<?php get_header(); ?>

<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	<?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif;?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	 <h1><em><?php echo single_cat_title(); ?></em></h1>
	<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
	<h1><em><?php echo single_tag_title(); ?></em></h1>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	 <h1>Publicações de <?php the_time('j \d\e F \d\e Y'); ?></h1>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	 <h1>Publicações de <?php the_time('F \d\e Y'); ?></h1>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	 <h1>Publicações do ano <?php the_time('Y'); ?></h1>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	 <h1>Publicações de <?php echo $curauth->display_name; ?></h1>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	 <h1>Arquivos do site</h1>
	<?php } ?>
</header>

<div class="lista-artigos">
	<?php if (have_posts()) : while (have_posts()) : the_post();

	get_template_part('content','grid');

	endwhile; endif; paginacao(); ?>
</div>

<?php get_footer(); ?>