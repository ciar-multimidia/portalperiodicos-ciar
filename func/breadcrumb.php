<?php 

function breadcrumbs() {
    // credict: https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
    // Settings
    $separator          = '&rsaquo;';
    $breadcrums_id      = 'breadcrumb';
    $breadcrums_class   = 'breadcrumb';
    $home_title         = 'Início';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'category';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<div class="' . $breadcrums_class . '" itemscope itemtype="http://schema.org/BreadcrumbList">';
           
        // Home page
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-home"><a class="bread-link bread-home" itemprop="item" href="' . get_home_url() . '" title="' . $home_title . '"><span itemprop="name">' . $home_title . '</span></a><meta itemprop="position" content="1" /></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
        if (is_home()) {
            
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-custom-post-type-post"><strong itemprop="name">Publicações</strong><meta itemprop="position" content="2" /></li>';
           
        } elseif ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-archive"><strong class="bread-current bread-archive" itemprop="name">' . post_type_archive_title($prefix, false) . '</strong><meta itemprop="position" content="2" /></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-custom-post-type-' . $post_type . '"><a itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '" itemprop="name"><span>' . $post_type_object->labels->name . '</span></a><meta itemprop="position" content="2" /></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            } 
            $custom_tax_name = get_queried_object()->name;
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-archive"><strong class="bread-current bread-archive" itemprop="name">' . $custom_tax_name . '</strong><meta itemprop="position" content="2" /></li>';
            
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-custom-post-type-' . $post_type . '"><a itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $post_type_object->labels->name . '</a></a><meta itemprop="position" content="2" /></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            } else {
                // dicas
                global $post;
                $terms = wp_get_post_terms($post->ID,$custom_taxonomy);
  
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-custom-post-type-post">'; 
                if ($terms) { $out = array(); foreach ($terms as $term) { $out[] = '<a itemprop="item" class="bread-cat bread-custom-post-type-post cat-' .$term->slug .'" href="' .get_term_link( $term->slug,$custom_taxonomy) .'" itemprop="name"><span>' .$term->name .'</a></span>'; } echo join( ' e ', $out ); }

                echo '<meta itemprop="position" content="2" /></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }
              
            // Get post category info
            /* $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat"><span itemprop="name">'.$parents.'</span><meta itemprop="position" content="3" /></li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '" itemprop="name">' . get_the_title() . '</strong><meta itemprop="position" content="3" /></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a itemprop="item" class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '"><span itemprop="name">' . $cat_name . '</span></a><meta itemprop="position" content="2" /></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '" itemprop="name">' . get_the_title() . '</strong><meta itemprop="position" content="3" /></li>';
              
            } else {*/
                  
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '" itemprop="name">' . get_the_title() . '</strong><meta itemprop="position" content="3" /></li>';
                  
            // }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-cat"><strong class="bread-current bread-cat" itemprop="name">' . single_cat_title('', false) . '</strong><meta itemprop="position" content="2" /></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-parent item-parent-' . $ancestor . '"><a itemprop="item" class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '"><span itemprop="name">' . get_the_title($ancestor) . '</span></a><meta itemprop="position" content="2" /></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '" itemprop="name"> ' . get_the_title() . '</strong><meta itemprop="position" content="3" /></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" itemprop="name"> ' . get_the_title() . '</strong><meta itemprop="position" content="2" /></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '" itemprop="name">' . $get_term_name . '</strong><meta itemprop="position" content="2" /></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-year item-year-' . get_the_time('Y') . '"><a itemprop="item" class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '"><span itemprop="name">Arquivos de ' . get_the_time('Y') . '</span></a><meta itemprop="position" content="2" /></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-month item-month-' . get_the_time('m') . '"><a itemprop="item" class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '"><span itemprop="name">Arquivos de ' . get_the_time('M') . '</span></a><meta itemprop="position" content="3" /></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '" itemprop="name"> ' . get_the_time('jS') . ' Arquivos de ' . get_the_time('M') . '</strong><meta itemprop="position" content="4" /></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-year item-year-' . get_the_time('Y') . '"><a itemprop="item" class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '"><span itemprop="name">Arquivos de ' . get_the_time('Y') . '</span></a><meta itemprop="position" content="2" /></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '" itemprop="name">Arquivos de ' . get_the_time('M') . '</strong><meta itemprop="position" content="3" /></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_the_time('Y') . '"><strong itemprop="name" class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">Arquivos de ' . get_the_time('Y') . '</strong><meta itemprop="position" content="2" /></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . $userdata->user_nicename . '"><strong itemprop="name" class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Autor: ' . $userdata->display_name . '</strong><meta itemprop="position" content="2" /></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_query_var('paged') . '"><strong itemprop="name" class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Página') . ' ' . get_query_var('paged') . '</strong><meta itemprop="position" content="2" /></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_search_query() . '"><strong itemprop="name" class="bread-current bread-current-' . get_search_query() . '" title="Resultados de busca de: ' . get_search_query() . '">Resultados de busca pelo termo: ' . get_search_query() . '</strong><meta itemprop="position" content="2" /></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Erro 404 - Página não encontrada' . '</li>';
        }
       
        echo '</div>';
    }
} 