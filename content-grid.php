<div class="item">
	<div <?php post_class('thumb'); ?> <?php if(has_post_thumbnail($post->ID)): ?>style="background-image: url('<?php thumb_url('medium'); ?>');"<?php endif; ?>></div>
	<h2><?php the_title(); ?></h2>
	<time>Em <?php echo get_the_date(); ?></time>
	<a href="<?php the_permalink(); ?>"></a>
</div>