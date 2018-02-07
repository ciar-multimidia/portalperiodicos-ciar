<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
<title><?php titulo_pagina(); ?></title>
<?php get_template_part('inc/metatags'); ?>
</head>
<body <?php body_class(); ?>>

<div class="canvas">
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
	</ul>
</div>

<main>

<?php get_template_part('inc/cabecalho'); ?>

<?php if(! is_home() && ! is_front_page()): ?>
<section class="container" id="conteudo-interno">
<?php endif; ?>