<header id="cabecalho">
	<div class="barra-superior">
		<div class="container">
			<?php if( have_rows('cabecalho', 'option') ): while( have_rows('cabecalho', 'option') ): the_row(); ?>
				<?php if(get_sub_field('portal_ufg') == 1 ): ?><a href="http://www.ufg.br" target="_blank">Portal da <span class="desk">Universidade Federal de Goiás</span><span class="mob">UFG</span></a><?php endif; ?>

				<?php if( have_rows('social') ): ?>
				<div class="redes">
					<?php while( have_rows('social') ): the_row(); ?>
					<a href="<?php echo get_sub_field('link'); ?>"><i class="fa <?php echo get_sub_field('icone'); ?>" aria-hidden="true"></i><span> <?php echo get_sub_field('nome'); ?></span></a>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
	
	<a href="<?php echo get_bloginfo('url'); ?>" class="marca">
		<span class="hidden"><?php echo get_bloginfo('name'); ?></span>
	</a>
</header>


<nav id="navegacao" class="container">
	<ul>
	<li class="menu-mobile"><span><i class="fa fa-bars" aria-hidden="true"></i> Menu</span></li>
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
	<li class="menu-busca"><div class="buscaportal"><?php echo get_search_form(); ?><i class="fa fa-search" aria-hidden="true"></i></a></div></li>
	</ul>
</nav>