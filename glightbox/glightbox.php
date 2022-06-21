<?php

/**
 * Plugin Name: WP Glightbox
 * Plugin URI:  http://github.com/zares/wp-glightbox
 * Description: Glightbox For Wordpress Image Gallery
 * Version:     1.0
 * Author:      S.Zares
 * Author URI:  http://github.com/zares
 * Text Domain: glightbox
 * License:     MIT
 */

if (! defined('ABSPATH')) exit;

add_action('wp', function () {
    global $post;
    $content = $post->post_content;
    if (strpos($content, 'wp-block-gallery')) {
        add_action('wp_head', 'glightbox_enqueue_styles', 1);
        add_action('wp_footer', 'glightbox_enqueue_scripts', 1);
        add_action('wp_footer', 'glightbox_init_js', 20);
    }
});

function glightbox_enqueue_styles () {
    wp_enqueue_style('glightbox-styles', plugin_dir_url( __FILE__ ) .'assets/css/glightbox.css' );
}

function glightbox_enqueue_scripts () {
    wp_enqueue_script('glightbox-core', plugin_dir_url( __FILE__ ) .'assets/js/glightbox.js', '', '', true );
}

function glightbox_init_js () {
    ?><script>
        if (galleries = document.querySelectorAll('.wp-block-gallery')) {
            galleries.forEach((gallery, index) => {
                const selector = 'glightbox_' + (index + 1);
                if (imageLinks = gallery.querySelectorAll('a')) {
                    imageLinks.forEach(link => {
                        link.classList.add(selector);
                        if (captionElement = link.nextSibling) {
                            if (captionElement.nodeName == 'FIGCAPTION') {
                                let description = captionElement.innerText;
                                link.dataset.description = description;
                                captionElement.style.display = 'none';
                            }
                        }
                    });
                    GLightbox({
                        selector: '.' + selector,
                        touchNavigation: true,
                        autoplayVideos: true,
                        loop: true
                    });
                }
            });
        }
    </script><?php
}




