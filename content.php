<header>
	<div class="breadcrumb"><?php breadcrumbs(); ?></div>
	<h1><?php the_title(); ?></h1>
</header>

<?php echo navegacao_paginas_internas(); ?>

<article>
	<?php the_content(); ?>

	<?php if ( has_post_format('image') ) { 

			$terms = get_terms('job_type', 'orderby=slug&hide_empty=1'); 

			if(get_field('revistas_sentido') == 1 ) { $sentido = ASC; } else { $sentido = DESC; } 

			if(get_field('revistas_ordem') == 'ordem alfabética' ) {
			    $args = array( 
			        'post_type' => 'revistasufg', 
			        'posts_per_page' => -1,
			        'order' => $sentido,
			        'orderby' => 'title'
			    );
			    $my_query = new  WP_Query( $args ); while ( $my_query->have_posts() ) : $my_query->the_post();
				echo the_title(); echo '<br>';
				endwhile; wp_reset_postdata();
			} 
			

	 } ?>

</article>

<?php if ( has_post_format('gallery') ) { 
	menu_boxes($post->ID); 
}  ?>