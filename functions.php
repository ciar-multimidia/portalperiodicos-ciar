<?php

// ========================================//
// SETUP THEME
// ========================================// 

add_action( 'after_setup_theme', 'setup_theme' );
function setup_theme() {

    // thumbnails
    add_theme_support( 'post-thumbnails' );

    // suporte
    add_theme_support( 'html5' );

    // post formats
    add_theme_support( 'post-formats', array('aside', 'link', 'gallery', 'image') );
    add_post_type_support( 'page', 'post-formats' );

    // menus
    register_nav_menus( array(
      'menu-topo' => __( 'Menu global' )
    ));

    // scripts
    add_action( 'wp_enqueue_scripts', 'estilos_scripts', 1 );
   

    // configs do layout
    if ( ! isset( $content_width ) ) { $content_width = 800; }
    add_filter('embed_oembed_html', 'envolve_embed', 99, 4);
    add_filter( 'excerpt_more', 'reticencias' );
    add_filter( 'excerpt_length', 'num_palavras_resumo' );
    require_once(get_template_directory().'/func/breadcrumb.php' );

    // seguranca
    add_filter( 'the_generator', 'remove_versao_wp' );
    add_filter( 'style_loader_src', 'remove_versao_wp_arquivos', 9999 );
    add_filter( 'script_loader_src', 'remove_versao_wp_arquivos', 9999 );
    add_filter( 'style_loader_src', 'remove_query_string_scriptscss', 10, 2 );
    add_filter( 'script_loader_src', 'remove_query_string_scriptscss', 10, 2 );

}


// ========================================//
// CUSTOM DASHBOARD ITENS
// ========================================// 
function custom_menus(){
  global $menu;
  global $submenu;

  $menu[2][0] = 'Início';
  $menu[5][0] = 'Publicações';
  $menu[10][0] = 'Biblioteca mídia';
  $menu[20][0] = 'Páginas internas';

  unset($submenu['themes.php'][6]); // remove customize
  unset($submenu['themes.php'][8]); // remove editor

  remove_menu_page('tools.php');
  remove_submenu_page('themes.php','theme-editor.php');
  remove_submenu_page('edit.php?post_type=ciarpainel','post-new.php?post_type=ciarpainel');
  
  // remove_menu_page( 'edit.php?post_type=acf-field-group' );  // Advance custom fields 
}
add_action( 'admin_menu', 'custom_menus', 999 );


function remover_personalizar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remover_personalizar' );


// ========================================//
// OPCOES ADMIN
// ========================================// 
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Gestão de informações gerais do site',
    'menu_title'  => 'Painel do Site',
    'menu_slug'   => 'opcoes-site',
    'capability'  => 'upload_plugins',
    'position'    => 3,
    'redirect'    => false
  ));
  
}


// ========================================//
// FORMATOS DE LAYOUT
// ========================================// 
function formatos_layout($translation, $text, $context, $domain) {
    $names = array(
        'Standard'  => 'Texto',
        'Aside'  => 'Downloads',
        'Gallery'  => 'Menu categorização',
        'Link'  => 'Listagem de links',
        'Image'  => 'Listagem de revistas',
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'formatos_layout', 10, 4);

function admin_css() { ?>
    <style>
      @import url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
      #adminmenu .dashicons-admin-post:before {content: "\f464";}

      .post-format-icon.post-format-standard:before, .post-state-format.post-format-standard:before, 
      a.post-state-format.format-standard:before { font-family: 'FontAwesome'; content: "\f036"; top: 2px !important; }

      .post-format-icon.post-format-aside:before, .post-state-format.post-format-aside:before, 
      a.post-state-format.format-aside:before { font-family: 'FontAwesome'; content: "\f019"; top: 2px !important;}

      .post-format-icon.post-format-link:before, .post-state-format.post-format-link:before, 
      a.post-state-format.format-link:before { font-family: 'FontAwesome'; content: "\f0c1"; top: 2px !important;}

      .post-format-icon.post-format-gallery:before, .post-state-format.post-format-gallery:before, 
      a.post-state-format.format-gallery:before { font-family: 'FontAwesome'; content: "\f009"; top: 2px !important;}

      .post-format-icon.post-format-image:before, .post-state-format.post-format-image:before, 
      a.post-state-format.format-image:before { font-family: 'FontAwesome'; content: "\f03a"; top: 2px !important;}

      body.post-type-post #formatdiv {display: none;} /*ocultar post-formats para publciacoes blog*/


      /*colunas*/
      #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {width: 175px;}
      #wpcontent, #wpfooter {margin-left: 175px;}

      /*painel do site*/
      .dashicons-dashboard:before { font-family: 'FontAwesome'; content: "\f015"; }
      #toplevel_page_opcoes-site .dashicons-admin-generic:before { content: "\f226"; }
    </style>
<?php }
add_action( 'admin_head', 'admin_css' );


// ========================================//
// ESTILOS E SCRIPTS
// ========================================// 
function estilos_scripts() {  
  wp_enqueue_style('googlefonts', '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i|Yanone+Kaffeesatz:400,700', array(), '' , 'screen', false);
  wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '' , 'screen', false);
  wp_enqueue_style('layout', get_template_directory_uri() . '/css/layout.css', array(), '', 'all', null);
} 


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
// RESUMO
// ========================================// 
function reticencias( $more ) { return '...'; }
function num_palavras_resumo( $length ) { return 52; }


// ========================================//
// SEGURANCA
// ========================================// 
// removendo versao do wordpress
function remove_versao_wp() { return ''; }


// remover versão do wp nos scripts 
function remove_versao_wp_arquivos( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// retirar query strings de scripts e css
function remove_query_string_scriptscss( $src ) {
   if( strpos( $src, '?ver=' ) )
   $src = remove_query_arg( 'ver', $src );
   return $src;
}



// ========================================//
// VIDEOS - credito: https://wordpress.stackexchange.com/a/195135
// ========================================// 
function envolve_embed($html, $url, $attr, $post_id) {
    return '<div class="video">' . $html . '</div>';
}


// ========================================//
// THUMB
// ========================================// 
function thumb_url($size) {
    // $attachment = get_children(
    //     array(
    //         'post_parent'    => get_the_ID(),
    //         'post_type'      => 'attachment',
    //         'post_mime_type' => 'image',
    //         'order'          => 'DESC',
    //         'numberposts'    => 1,
    //     )
    // );
    // if ( ! is_array( $attachment ) || empty( $attachment ) ) {
    //     return;
    // }
    // $attachment = current( $attachment );

    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size); 
    $url = $thumb['0'];

    // if (has_post_thumbnail($post->ID)) { echo $url; } else { echo wp_get_attachment_url( $attachment->ID,$size); }    
    echo $url;
}


// ========================================//
// BOXES DE MENU
// ========================================// 
function menu_boxes($id) { if( have_rows('menus_em_destaque',$id) ): ?>
<section class="container boxes<?php if(get_field('numcol_menus', $id) == '2 colunas'): echo ' col2'; elseif(get_field('numcol_menus', $id) == '3 colunas'): echo ' col3'; elseif(get_field('numcol_menus', $id) == '4 colunas'): echo ' col4'; elseif(get_field('numcol_menus', $id) == '5 colunas'): echo ' col5'; endif; if(get_field('ocultar_icones', $id) == 1 ): echo ' semicon'; endif; ?>">
  <?php while( have_rows('menus_em_destaque', $id) ): the_row(); ?>
  <div class="box">
    <div class="icone"><i class="fa <?php echo get_sub_field('icone'); ?>" aria-hidden="true"></i></div>
    <h2><?php echo get_sub_field('titulo'); ?></h2>
    <p><?php echo get_sub_field('descricao'); ?></p>
    <a href="<?php echo esc_url(get_sub_field('link')); ?>"></a>
  </div>
  <?php endwhile; ?>
</section>
<?php endif; }


// ========================================//
// PAGINACAO
// ========================================// 
function paginacao($pages = '', $range = 4) {  
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
// RELACIONADOS - POR PALAVRAS-CHAVE
// ========================================// 
function publicacoes_relacionadas() { 
  $limitpost = 3;
  global $post;
  
  $tags = wp_get_post_tags($post->ID);
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
  $args_tags = array( 'tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'order' => 'RAND', 'posts_per_page'=> $limitpost, 'ignore_sticky_posts'=> 1 );
  $my_query_tags = new WP_Query($args_tags);
  
  
  if ($my_query_tags->have_posts()) {
    $i = 1;
    while($my_query_tags->have_posts()) {
    $my_query_tags->the_post();
  ?>
  
      <div class="item" style="background-image: url('<?php thumb_url(); ?>');">
        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
      </div>  


  <?php $i++; }
  }
  
  else {}
  wp_reset_query();
}


