<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
<title><?php titulo_pagina(); ?></title>
<?php get_template_part('inc/metatags'); ?>
</head>
<body <?php body_class(); ?>>

<main>

<header id="cabecalho">
	<div class="barra-superior">
		<div class="container">
			<a href="http://www.ufg.br" target="_blank">Portal da Universidade Federal de Goiás</a>

			<div class="redes">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Facebook</span></a>
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> <span>Instagram</span></a>
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Twitter</span></a>
				<a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span>ResearchGate</span></a>
			</div>
		</div>
	</div>
	
	<a href="<?php echo get_bloginfo('url'); ?>" class="marca">
		<span class="hidden"><?php echo get_bloginfo('name'); ?></span>
	</a>
</header>

<nav id="navegacao" class="container">
	<ul>
	 <?php wp_nav_menu ( array( 
		'theme_location' => 'menu-topo', 
		'menu' => 'menu-topo', 
		'container' => '', 
		'container_class' => '', 
		'container_id' => '', 
		'menu_class' => '', 
		'menu_id' => '', 
		'echo' => true, 
		'fallback_cb' => 'wp_page_menu', 
		'before' => '', 
		'after' => '', 
		'items_wrap' => '%3$s', 
		'depth' => 0, 
		'walker' => ''
	)); ?>	
	<li><div class="buscaportal"><?php echo get_search_form(); ?><i class="fa fa-search" aria-hidden="true"></i></a></div></li>
	</ul>
</nav>
