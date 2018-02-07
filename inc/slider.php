<?php if( have_rows('slider', 'option') ): ?>
<section id="slider">
	<div class="container">
		<div class="items-slider">
		<?php while( have_rows('slider', 'option') ): the_row(); ?>
			<img src="<?php echo esc_url(get_sub_field('banner')); ?>" alt="<?php echo get_sub_field('nome') ?>">
		<?php endwhile;  ?>
		</div>
	</div>
</section>
<?php endif; ?>