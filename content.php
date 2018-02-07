<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	<h1><?php the_title(); ?></h1>
</header>

<?php echo navegacao_paginas_internas(); ?>

<article>
	<?php the_content(); ?>

	<?php if ( has_post_format('image') ) {  // listagem de revista

		echo '<p>&nbsp;</p>';

		if(get_field('revistas_sentido') == 1 ) { $sentido = ASC; } else { $sentido = DESC; } 

		if(get_field('revistas_ordem') == 'ordem alfabética' ) {
		    $args = array( 
		        'post_type' => 'revistasufg', 
		        'posts_per_page' => -1,
		        'order' => $sentido,
		        'orderby' => 'title'
		    );
		    $my_query = new  WP_Query( $args ); while ( $my_query->have_posts() ) : $my_query->the_post();
			    if( have_rows('revista_informacoes') ): while( have_rows('revista_informacoes') ): the_row();
				    loop_revista();
			    endwhile; endif;
		    endwhile; wp_reset_postdata();
		} 

		elseif(get_field('revistas_ordem') == 'unidade acadêmica' ) { mostra_taxonomia('revistasunidades',$sentido); }
		elseif(get_field('revistas_ordem') == 'área de conhecimento' ) { mostra_taxonomia('revistasareas',$sentido); }
		elseif(get_field('revistas_ordem') == 'ano de publicação' ) { mostra_taxonomia('revistasanos',$sentido); }
		elseif(get_field('revistas_ordem') == 'incubados') { 
		    $args = array( 
		        'post_type' => 'revistasufg', 
		        'posts_per_page' => -1,
		        'order' => $sentido,
		        'orderby' => 'title'
		    );
		    $my_query = new  WP_Query( $args ); while ( $my_query->have_posts() ) : $my_query->the_post();
			    if( have_rows('revista_informacoes') ): while( have_rows('revista_informacoes') ): the_row();
				    if(get_sub_field('incubado') == 1): loop_revista(); endif;
			    endwhile; endif;		    
		    endwhile; wp_reset_postdata(); 
		}

	} elseif ( has_post_format('link') ) { // listagem de links

		if( have_rows('links') ): ?> 
			<ul>
				<?php while( have_rows('links') ): the_row(); ?>
					<li><a href="<?php echo esc_url(get_sub_field('link')); ?>" title="<?php echo get_sub_field('descricao') ?>"  target="blank"><?php echo get_sub_field('nome') ?></a><?php if(get_sub_field('descricao')): ?> - <?php echo get_sub_field('descricao'); endif; ?></li>
				<?php endwhile; ?>
			</ul>
		<?php endif;

	} elseif ( has_post_format('aside') ) { // listagem de downloads de editais

		if( have_rows('grupo_download') ): while( have_rows('grupo_download') ): the_row(); ?>
			<h5><?php echo get_sub_field('titulo');  ?></h5>
			<?php if( have_rows('downloads') ): ?>
				<ul>
					<?php while( have_rows('downloads') ): the_row(); ?>
						<li><?php if (get_sub_field('arquivo')): ?><a href="<?php echo esc_url(get_sub_field('arquivo')); ?>" title="<?php echo get_sub_field('descricao') ?>" target="blank"><?php endif; ?><?php echo get_sub_field('nome'); if (get_sub_field('arquivo')): ?></a><?php endif; if(get_sub_field('descricao')): ?> - <?php echo get_sub_field('descricao'); endif; ?></li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		<?php endwhile; endif;

    } ?>

</article>

<?php if ( has_post_format('gallery') ) { // menu de boxes de navegação interna
	menu_boxes($post->ID); 
}  ?>