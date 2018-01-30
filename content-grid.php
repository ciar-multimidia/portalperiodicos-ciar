<div class="item">
	<?php if(has_post_thumbnail($post->ID)): ?><div <?php post_class('thumb'); ?> style="background-image: url('<?php thumb_url('medium'); ?>');"></div><?php endif; ?>
	<h2><?php the_title(); ?></h2>
	<time>Em <?php echo get_the_date(); ?></time>
	<?php if(! has_post_thumbnail($post->ID)): ?>
		<article><?php the_excerpt(); ?></article>
	<?php endif; ?>
	<a href="<?php the_permalink(); ?>"></a>
</div>