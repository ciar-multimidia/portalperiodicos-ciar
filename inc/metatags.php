<meta http-equiv="Content-Type" content="text/html; image/svg+xml; charset=<?php echo get_bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta name="geo.region" content="BR">
    <meta name="robots" content="index, follow">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">

    <meta itemprop="logo" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">

    <?php global $post; if(is_home() || is_front_page()) { ?>

            <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
            <meta property="og:type" content="website">
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>">
            <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">

            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">

            
            <meta name="twitter:domain" content="<?php echo get_bloginfo('url'); ?>">
            <meta name="twitter:card" content="<?php echo get_bloginfo('description'); ?>">
            <meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>">
            <meta name="twitter:url" content="<?php echo get_bloginfo('url'); ?>">
            <meta name="twitter:title" content="<?php echo get_bloginfo('name'); ?>">
    
            <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">

            <meta itemprop="url" content="<?php echo get_bloginfo('url'); ?>">
            <link rel="canonical" href="<?php echo get_bloginfo('url'); ?>">
            <meta property="og:url" content="<?php the_permalink(); ?>">
            

    <?php } else { ?>

            <meta property="og:title" content="<?php single_post_title(''); ?>">
            <meta name="twitter:title" content="<?php single_post_title(''); ?>">
            <meta itemprop="name" content="<?php single_post_title(''); ?>">
            
            <meta property="og:description" content='<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>' >
            <meta name="description" content="<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>">
            <meta itemprop="description" content='<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>' >     
            
            <meta property="article:published_time" content="<?php the_time('c') ?>">

            <meta name="keywords" content="<?php $terms = get_terms( 'post_tag' ); $out = array(); foreach ( $terms as $term ) { $term_link = get_term_link( $term ); if ( is_wp_error( $term_link ) ) { continue; } $out[] = $term->name;} echo join( ', ', $out ); ?>" />

            <meta name="twitter:card" content="<?php the_title(); ?>">
            <meta name="twitter:description" content='<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>' >
            
            <meta name="twitter:domain" content="<?php echo get_bloginfo('url'); ?>">
            <meta name="twitter:card" content="<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>">
            <meta name="twitter:description" content="<?php while(have_posts()):the_post(); $out_excerpt = str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()); echo apply_filters("the_excerpt_rss", $out_excerpt); endwhile;?>">
            <meta name="twitter:url" content="<?php the_permalink(); ?>">
            <meta name="twitter:title" content="<?php single_post_title(''); ?>">


            <meta property="og:url" content="<?php the_permalink(); ?>">
            <meta name="twitter:url" content="<?php the_permalink(); ?>">
            <meta itemprop="url" content="<?php the_permalink(); ?>">
            <link rel="canonical" href="<?php the_permalink(); ?>">

            <meta property="og:type" content="website">

          <?php if ( ! has_post_thumbnail( $post->ID ) ) : ?>
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">
            <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">
            <meta itemprop="image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">
            <?php else: ?>
            <meta property="og:image" content="<?php while(have_posts()):the_post(); echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); endwhile; ?>">
            <meta name="twitter:image" content="<?php while(have_posts()):the_post(); echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); endwhile; ?>">
            <meta itemprop="image" content="<?php while(have_posts()):the_post(); echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); endwhile; ?>">
          <?php endif; ?>
             
    <?php  } ?>

<?php wp_head(); ?>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_bloginfo('rss2_url'); ?>">
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php echo get_bloginfo('rss_url'); ?>">
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php echo get_bloginfo('atom_url'); ?>">
<link rel="pingback" href="<?php echo get_bloginfo('pingback_url'); ?>">
