<div class="related related-categories">
    <?php
        
        $thecats = wp_get_post_categories(get_queried_object_id());

        foreach($thecats as $category){
            $mcCategory = get_term( $category );
            $mcSlug = $mcCategory->slug;
            echo do_shortcode('[instalist category_name='.$mcSlug.' numofmobile=4 numofdesktop=4 gridclass="ws sm-1 md-2 lg2-4" loadmoreonclick="true" mw="true"]');
        }
    ?>
</div><!-- RELATED CATEGORIES -->