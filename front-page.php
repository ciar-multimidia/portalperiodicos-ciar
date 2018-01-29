<?php get_header(); ?>

<section id="slider">
	<div class="container">

	</div>
</section>


<div id="buscaojs">
	<div class="container">
		<h1>Pesquisar artigos</h1>
		<div class="formulario">
			<form action="https://www.revistas.ufg.br/index/search/search" method="get" target="_blank">
				<input type="text" name="query" size="40" maxlength="255" value="" placeholder="Busca por palavra-chave">
				<input type="submit" value="Pesquisar">
			</form>
			<a href="https://www.revistas.ufg.br/index/search" target="blank" class="avancada">ou faça uma busca avançada pela plataforma</a>
		</div>
	</div>
</div>


<section class="container boxes col4">
	<div class="box">
		<div class="icone"><i class="fa fa-newspaper-o" aria-hidden="true"></i></div>
		<h2>Notícias</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, commodi.</p>
		<a href="<?php echo get_bloginfo('url'); ?>/publicacoes/noticias/"></a>
	</div>
	<div class="box">
		<div class="icone"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>
		<h2>Fique por dentro</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, commodi.</p>
		<a href="<?php echo get_bloginfo('url'); ?>/publicacoes/fique-por-dentro/"></a>
	</div>
	<div class="box">
		<div class="icone"><i class="fa fa-area-chart" aria-hidden="true"></i></div>
		<h2>Estatísticas do Portal</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, commodi.</p>
		<a href="<?php echo get_bloginfo('url'); ?>/estatisticas"></a>
	</div>
	<div class="box">
		<div class="icone"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
		<h2>Espaço do editor</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, commodi.</p>
		<a href="<?php echo get_bloginfo('url'); ?>/espaco-do-editor"></a>
	</div>
</section>

<?php get_footer(); ?>