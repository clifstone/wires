<section class="site-sidebar">
    <div class="wrapper">
        
        <?php
            if(is_front_page()){
                if(is_active_sidebar('homepage_rail')){
                    dynamic_sidebar('homepage_rail');
                }
            }

            if(is_single()){
                echo '<div class="taglist"><div class="wrapper">'.get_the_tag_list().'</div></div>';
                if(is_active_sidebar('single_post_rail')){
                    dynamic_sidebar('single_post_rail');
                }
            }else if(is_archive() || is_search() || is_page_template('blank--hidden_nav.php')){
                if(is_active_sidebar('archives_rail')){
                    dynamic_sidebar('archives_rail');
                }
            }
        ?>
        
    </div>
</section>