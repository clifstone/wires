<div class="related related-categories">
    <?php
        extract( $args );

        $post_categories = get_post_primary_category($pID, 'category'); 
        $primary_category = $post_categories['primary_category']->slug;

        echo do_shortcode('[instalist category_name='.$primary_category.' numofmobile=4 numofdesktop=4 gridclass="ws sm-1 md-2 lg2-4" loadmoreonclick="true" mw="true"]');
        echo do_shortcode('[instalist numofmobile=4 numofdesktop=4 gridclass="ws sm-1 md-2" listlabel="Most Recent" loadmoreonclick="true" mw="true"]');
    ?>
</div><!-- RELATED CATEGORIES -->