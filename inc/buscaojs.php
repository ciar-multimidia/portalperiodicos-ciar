<div id="buscaojs"<?php if(! is_home() && ! is_front_page()): ?> class="paginternas"<?php endif; ?>>
	<div class="container">
		<?php if( have_rows('busca_ojs', 'option') ): while( have_rows('busca_ojs', 'option') ): the_row(); ?>
		<h1><?php echo get_sub_field('titulo'); ?></h1>
		<?php endwhile; endif; ?>
		<div class="formulario">
			<form action="https://www.revistas.ufg.br/index/search/search" method="get" target="_blank">
				<input type="text" name="query" size="40" maxlength="255" value="" placeholder="Busca por palavra-chave">
				<input type="submit" value="Pesquisar">
			</form>
			<a href="https://www.revistas.ufg.br/index/search" target="blank" class="avancada">
				<?php if( have_rows('busca_ojs', 'option') ): while( have_rows('busca_ojs', 'option') ): the_row(); ?>
					<?php echo get_sub_field('descricao'); ?>
				<?php endwhile; endif; ?>
			</a>
		</div>
	</div>
</div>