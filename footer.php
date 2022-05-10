<footer class="site-footer">
    <div class="wrapper">
        <?php if(is_active_sidebar('infootertop')){ dynamic_sidebar('infootertop'); } ?>
        <?php get_template_part( 'parts/social'); ?>
        <?php if(is_active_sidebar('infooterbottom')){ dynamic_sidebar('infooterbottom'); } ?>
    </div>
</footer>
    </div> <!-- site-wrapper -->
    
    <div class="searchoverlay">
    <button id="searchoverlayclose" class="searchoverlayclose" aria-label="Close Search Overlay">
        <svg viewBox="0 0 48 48">
            <g>
                <path d="M24,0C10.7,0,0,10.7,0,24s10.7,24,24,24s24-10.7,24-24S37.3,0,24,0z M38.1,32.5l-5.7,5.7L24,29.7l-8.5,8.5l-5.7-5.7
                    l8.5-8.5l-8.5-8.5l5.7-5.7l8.5,8.5l8.5-8.5l5.7,5.7L29.7,24L38.1,32.5z"/>
            </g>
        </svg>
        </button>
        <?php get_template_part( 'parts/searchform' ); ?>
    </div>

    <?php wp_footer(); ?>

</body>

</html>