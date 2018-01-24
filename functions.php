<?php

// ========================================//
// SETUP THEME
// ========================================// 

add_action( 'after_setup_theme', 'setup_theme' );
function setup_theme() {

    // thumbnails
    add_theme_support( 'post-thumbnails' );

    // menus
    register_nav_menus( array(
      'menu-topo' => __( 'Menu global' )
    ));

    // coluna
    if ( ! isset( $content_width ) ) { $content_width = 800; }
}


// ========================================//
// ESTILOS E SCRIPTS
// ========================================// 
function estilos_scripts() {  
  wp_enqueue_style('googlefonts', '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i|Yanone+Kaffeesatz:400,700', array(), '' , 'screen', false);

  wp_enqueue_style('layout', get_template_directory_uri() . '/css/layout.css', array(), '', 'all', null);

} 
add_action( 'wp_enqueue_scripts', 'estilos_scripts', 1 );


// ========================================//
// TITULO PAGINA
// ========================================// 
function titulo_pagina() {
    global $page, $paged; 
    $site_description = get_bloginfo( 'description', 'display' ); 
    wp_title( '|', true, 'right' ); bloginfo( 'name' ); 
    
    if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description"; 
    if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Página %s' ), max( $paged, $page ) );
}


// ========================================//
// CUSTOM DASHBOARD ITENS
// ========================================// 
function custom_menus(){
  global $menu;
  global $submenu;

  $menu[5][0] = 'Notícias';
  $menu[10][0] = 'Biblioteca mídia';

  unset($submenu['themes.php'][6]); // remove customize
  unset($submenu['themes.php'][8]); // remove editor

  remove_menu_page('tools.php');
  remove_submenu_page('themes.php','theme-editor.php');
  
  // remove_menu_page( 'edit.php?post_type=acf-field-group' );  // Advance custom fields 
}
add_action( 'admin_menu', 'custom_menus', 999 );


function remover_personalizar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remover_personalizar' );



// ========================================//
// RESUMO
// ========================================// 
function reticencias( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'reticencias' );



// ========================================//
// AJUSTANDO EMOJIS/EMOTICONS
// ========================================// 
function desabilitar_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );  
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'desabilitar_emojis_editor' );
}
add_action( 'init', 'desabilitar_emojis' );
function desabilitar_emojis_editor( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}




// ========================================//
// SEGURANCA
// ========================================// 
// removendo versao do wordpress
function remove_versao_wp() {
    return '';
}
add_filter ( 'the_generator', 'remove_versao_wp' );


// remover versão do wp nos scripts 
function remove_versao_wp_arquivos( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_versao_wp_arquivos', 9999 );
add_filter( 'script_loader_src', 'remove_versao_wp_arquivos', 9999 );


// retirar query strings de scripts e css
function remove_query_string_scriptscss( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_query_string_scriptscss', 10, 2 );
add_filter( 'script_loader_src', 'remove_query_string_scriptscss', 10, 2 );





// ========================================//
// VIDEOS - credito: https://wordpress.stackexchange.com/a/195135
// ========================================// 
function envolve_embed($html, $url, $attr, $post_id) {
    return '<div class="video">' . $html . '</div>';
}

add_filter('embed_oembed_html', 'envolve_embed', 99, 4);




// ========================================//
// THUMB
// ========================================// 
function thumb_url($size) {
    $attachment = get_children(
        array(
            'post_parent'    => get_the_ID(),
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'DESC',
            'numberposts'    => 1,
        )
    );
    if ( ! is_array( $attachment ) || empty( $attachment ) ) {
        return;
    }
    $attachment = current( $attachment );

    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size); 
    $url = $thumb['0'];

    if (has_post_thumbnail()) { echo $url; } else { echo wp_get_attachment_url( $attachment->ID,$size); }    
}


// ========================================//
// LOOP
// ========================================// 



// ========================================//
// PAGINACAO
// ========================================// 
function paginacao($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
   
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='paginacao'>\n";

         // echo "<div class='inicio'>Página ".$paged." de ".$pages."</div>\n";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class='fa fa-long-arrow-left' aria-hidden=true'></i></a>";
         if($paged > 3 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>1</a> <span class='dots'>...</span>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
             }
         }

         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<span class='dots'>...</span> <a href='".get_pagenum_link($pages)."'>$pages</a>";
         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><i class='fa fa-long-arrow-right' aria-hidden='true'></i></a>"; 

         echo "\n</div>";
     }
}




// ========================================//
// RELACIONADOS
// ========================================// 
function noticias_relacionadas() {
  $limitpost = 3;
  global $post;

  // categorias
  $categories = get_the_category($post->ID);
  $category_ids = array();
  foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
  $args_cat = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'order' => 'RAND', 'posts_per_page'=> $limitpost, 'ignore_sticky_posts'=> 1 );
  $my_query_cat = new WP_Query($args_cat);
  
  // por tags
  $tags = wp_get_post_tags($post->ID);
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
  $args_tags = array( 'tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'order' => 'RAND', 'posts_per_page'=> $limitpost, 'ignore_sticky_posts'=> 1 );
  $my_query_tags = new WP_Query($args_tags);
  
  // SE TEM CATEGORIA TAL
  if ($my_query_cat->have_posts()) {
    echo '<div class="posts-relacionados"><h3>Veja também...</h3>';
    $i = 1;
    while($my_query_cat->have_posts()) {
    $my_query_cat->the_post(); 

  ?>


      <div class="item" style="background-image: url('<?php thumb_url(); ?>');">
        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
      </div> 


  <?php
    $i++;
    }
    echo "</div>";
  }
  
  // SE NAO TEM CATEGORIA TAL, VAI POR TAG TAL
  elseif ($my_query_tags->have_posts()) {
    echo '<div class="posts-relacionados"><h3>Veja também...</h3>';
    $i = 1;
    while($my_query_tags->have_posts()) {
    $my_query_tags->the_post();
  ?>

  
      <div class="item" style="background-image: url('<?php thumb_url(); ?>');">
        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
      </div>  


  <?php
    $i++;
    }
    echo "</div>";
  }
  
  else {}
  wp_reset_query();
}


