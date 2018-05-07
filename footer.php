
</div>
<footer class="footer">
    <div class="container">
        <nav class="footer-menu">
            <a class="navbar-brand" href="javascript:void(0);">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yottos-logo.svg" alt="yottos">
            </a>
        </nav>
        <div class="social-buttons">
            <?php if ( get_the_author_meta('linkedin') ) : ?>
            <a href="<?php the_author_meta('linkedin'); ?>" target="_blank" class="social-button in" title="LinkedIn"><span>LinkedIn</span></a>
            <?php endif; ?>
            <?php if ( get_the_author_meta('vkontakte') ) : ?>
            <a href="<?php the_author_meta('vkontakte'); ?>" target="_blank" class="social-button vk" title="VKontakte"><span>VKontakte</span></a>
            <?php endif; ?>
            <?php if ( get_the_author_meta('facebook') ) : ?>
            <a href="<?php the_author_meta('facebook'); ?>" target="_blank" class="social-button fb" title="Facebook"><span>Facebook</span></a>
            <?php endif; ?>
        </div>
    </div>
    <small>&copy;&nbsp;2006&nbsp;&ndash;&nbsp;2017&nbsp;YOTTOS</small>
</footer>
<?php wp_footer(); ?>
</body>

</html>
