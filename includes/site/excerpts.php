<?php
function readmore( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'readmore' );