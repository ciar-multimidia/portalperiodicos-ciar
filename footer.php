<?php if(! is_home() && ! is_front_page()): ?>
	</section>
	<?php if(get_field('busca_ojs_pginternas', 'option') == 1): get_template_part('inc/buscaojs'); endif; ?>
<?php endif; ?>

<footer id="rodapesite"<?php if(! is_home() && ! is_front_page()): ?> class="paginternas"<?php endif; ?>>
	<?php if( have_rows('rodape','option') ): ?>
	<div class="container">
		<div class="info">
			<?php while( have_rows('rodape','option') ): the_row(); ?>
			<h3><?php echo get_sub_field('chamada'); ?></h3>
			<p><?php echo get_sub_field('descricao'); ?></p>
			<?php endwhile; ?>
		</div>
		<div class="marcaufg">
			<img src="<?php echo get_bloginfo('template_url'); ?>/img/marcaufg.svg" alt="">
		</div>
	</div>
	<?php endif; ?>
	<div class="creditos">
		Design e desenvolvimento por <a href="http://www.ciar.ufg.br/">Ciar UFG</a>
	</div>
</footer>
	
<?php wp_footer(); ?>
</main>

</body>
</html>