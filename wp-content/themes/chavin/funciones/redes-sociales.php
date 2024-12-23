<?php

function chavin_share_buttons( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $post_url   = get_permalink($post_id);
    $post_title = get_the_title($post_id);
    $theme_uri  = get_template_directory_uri();

    // URLs de compartir
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($post_url);
    $twitter_url  = 'https://twitter.com/intent/tweet?url=' . urlencode($post_url) . '&text=' . urlencode($post_title);
    $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($post_url) . '&title=' . urlencode($post_title);

    ob_start();
    ?>
    <div class="flex gap-4">
        <!-- Compartir en Facebook -->
        <a aria-label="Compartir en Facebook" href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/fb.svg" alt="Facebook" class="w-[35px] h-[35px]">
        </a>
        
        <!-- Compartir en Twitter -->
        <a aria-label="Compartir en Twitter" href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/twitter.svg" alt="Twitter" class="w-[35px] h-[35px]">
        </a>
        
        <!-- Compartir en LinkedIn -->
        <a aria-label="Compartir en LinkedIn" href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/linkedin.svg" alt="LinkedIn" class="w-[35px] h-[35px]">
        </a>
        
        <!-- Copiar enlace -->
        <a aria-label="Copiar enlace" href="#" onclick="navigator.clipboard.writeText('<?php echo esc_url($post_url); ?>'); alert('¡Enlace copiado al portapapeles!'); return false;">
            <img src="<?php echo esc_url($theme_uri); ?>/img/link.svg" alt="Enlace" class="w-[35px] h-[35px]">
        </a>
    </div>
    <?php
    return ob_get_clean();
}

function chavin_share_buttons2( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $post_url   = get_permalink($post_id);
    $post_title = get_the_title($post_id);
    $theme_uri  = get_template_directory_uri();

    // URLs de compartir
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($post_url);
    $twitter_url  = 'https://twitter.com/intent/tweet?url=' . urlencode($post_url) . '&text=' . urlencode($post_title);
    $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($post_url) . '&title=' . urlencode($post_title);

    ob_start();
    ?>
    <div class="flex gap-4">
        <!-- Compartir en Facebook -->
        <a aria-label="Compartir en Facebook" href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/fb.svg" alt="Facebook">
        </a>
        
        <!-- Compartir en Twitter -->
        <a aria-label="Compartir en Twitter" href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/twitter.svg" alt="Twitter">
        </a>
        
        <!-- Compartir en LinkedIn -->
        <a aria-label="Compartir en LinkedIn" href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo esc_url($theme_uri); ?>/img/linkedin.svg" alt="LinkedIn">
        </a>
        
        <!-- Copiar enlace -->
        <a aria-label="Copiar enlace" href="#" onclick="navigator.clipboard.writeText('<?php echo esc_url($post_url); ?>'); alert('¡Enlace copiado al portapapeles!'); return false;">
            <img src="<?php echo esc_url($theme_uri); ?>/img/link.svg" alt="Enlace">
        </a>
    </div>
    <?php
    return ob_get_clean();
}