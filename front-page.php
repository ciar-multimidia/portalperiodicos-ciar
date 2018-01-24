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
			<a href="#" class="avancada">Busca avançada</a>
		</div>
	</div>
</div>


<?php get_footer(); ?>