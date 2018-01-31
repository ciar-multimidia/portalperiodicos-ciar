<?php

add_action('init', 'posttype_revistas', 1);  

function posttype_revistas(){
  $labels = array(
    'name' => _x('Lista de revistas', 'post type general name', 'portalperiodicos'),
    'singular_name' => _x('Revista', 'post type singular name', 'portalperiodicos'),
    'add_new' => _x('Adicionar revista', 'projeto', 'portalperiodicos'),
    'add_new_item' => __('Adicionar nova revista', 'portalperiodicos'),
    'edit_item' => __('Editar revista', 'portalperiodicos'),
    'new_item' => __('Nova revista', 'portalperiodicos'),
    'view_item' => __('Ver revista', 'portalperiodicos'),
    'search_items' => __('Buscar', 'portalperiodicos'),
    'not_found' =>  __('Nenhum revista encontrado', 'portalperiodicos'),
    'not_found_in_trash' => __('Nenhum revista encontrado na lixeira', 'portalperiodicos'),
    'parent_item_colon' => '',
    'menu_name' => 'Revistas'
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'has_archive' => 'revistas',
    'hierarchical' => false,
    'menu_position' => 5,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-welcome-learn-more',
    'supports' => array('title'),
    'rewrite' => array('slug' => 'revistas')
  );
  
  register_post_type('revistasufg',$args);

  
  // ano
  $labelano = array(
    'name' => _x( 'Ano de criação', 'taxonomy general name', 'portalperiodicos' ),
    'singular_name' => _x( 'Ano', 'taxonomy singular name', 'portalperiodicos' ),
    'search_items' =>  __( 'Procurar', 'portalperiodicos' ),
    'edit_item' => __( 'Editar', 'portalperiodicos' ),
    'update_item' => __( 'Atualizar', 'portalperiodicos' ),
    'add_new_item' => __( 'Adicionar', 'portalperiodicos' ),
    'new_item_name' => __( 'Adicionar', 'portalperiodicos' ),
  );
  
      register_taxonomy('revistasanos',array('revistasufg'), array(
        'hierarchical' => true,
        'has_archive' => true,
        'labels' => $labelano,
        'show_ui' => true,
        'query_var' => true,
        'show_tagcloud' => true,
        'rewrite' => array( 'slug' => 'ano' )
      ));

  // área conhecimento
  $labelarea = array(
    'name' => _x( 'Áreas de conhecimento', 'taxonomy general name', 'portalperiodicos' ),
    'singular_name' => _x( 'Área de conhecimento', 'taxonomy singular name', 'portalperiodicos' ),
    'search_items' =>  __( 'Procurar', 'portalperiodicos' ),
    'edit_item' => __( 'Editar', 'portalperiodicos' ),
    'update_item' => __( 'Atualizar', 'portalperiodicos' ),
    'add_new_item' => __( 'Adicionar', 'portalperiodicos' ),
    'new_item_name' => __( 'Adicionar', 'portalperiodicos' ),
  );
  
      register_taxonomy('revistasareas',array('revistasufg'), array(
        'hierarchical' => true,
        'has_archive' => true,
        'labels' => $labelarea,
        'show_ui' => true,
        'query_var' => true,
        'show_tagcloud' => true,
        'rewrite' => array( 'slug' => 'area-conhecimento' )
      ));

  // unidades academicas
  $labelunidades = array(
    'name' => _x( 'Unidades Acadêmicas', 'taxonomy general name', 'portalperiodicos' ),
    'singular_name' => _x( 'Unidade', 'taxonomy singular name', 'portalperiodicos' ),
    'search_items' =>  __( 'Procurar', 'portalperiodicos' ),
    'edit_item' => __( 'Editar', 'portalperiodicos' ),
    'update_item' => __( 'Atualizar', 'portalperiodicos' ),
    'add_new_item' => __( 'Adicionar', 'portalperiodicos' ),
    'new_item_name' => __( 'Adicionar', 'portalperiodicos' ),
  );
  
      register_taxonomy('revistasunidades',array('revistasufg'), array(
        'hierarchical' => true,
        'has_archive' => true,
        'labels' => $labelunidades,
        'show_ui' => true,
        'query_var' => true,
        'show_tagcloud' => true,
        'rewrite' => array( 'slug' => 'unidades-academicas' )
      ));
  
}
