<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
<title><?php titulo_pagina(); ?></title>
<?php get_template_part('inc/metatags'); ?>
</head>
<body <?php body_class(); ?>>

<main>

<?php get_template_part('inc/cabecalho'); ?>

<?php if(! is_home() && ! is_front_page()): ?>
<section class="container" id="conteudo-interno">
<?php endif; ?>