<?php if( have_rows('slider', 'option') ): ?>
<section id="slider">
	<div class="container">
		<div class="items-slider">
		<?php while( have_rows('slider', 'option') ): the_row(); ?>
			<?php if(get_sub_field('link')): ?><a href="<?php echo esc_url(get_sub_field('link')); ?>"><?php endif; ?>
			<img src="<?php echo esc_url(get_sub_field('banner')); ?>" alt="<?php echo get_sub_field('nome') ?>">
			<?php if(get_sub_field('link')): ?></a><?php endif; ?>
		<?php endwhile;  ?>
		</div>
	</div>
</section>
<?php endif; ?>