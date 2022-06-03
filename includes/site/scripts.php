<?php
function deregisterstuff(){
    wp_dequeue_script( 'jquery');
    wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'deregisterstuff');

function headerscripts(){
    $template_directory = get_template_directory_uri();
    echo '<link rel="preload" href="'.$template_directory.'/js/lozad.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/js/inview.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/js/postscribe.js" as="script">';
    echo '<script async src="'.$template_directory.'/js/lozad.js"></script>';
}
add_action( 'wp_head', 'headerscripts', 99);

function footerScripts(){
    $template_directory = get_template_directory_uri();
    echo '<script>!function(e){"function"==typeof define&&define.amd?define(e):e()}(function(){var e,t=["scroll","wheel","touchstart","touchmove","touchenter","touchend","touchleave","mouseout","mouseleave","mouseup","mousedown","mousemove","mouseenter","mousewheel","mouseover"];if(function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("test",null,t),window.removeEventListener("test",null,t)}catch(e){}return e}()){var n=EventTarget.prototype.addEventListener;e=n,EventTarget.prototype.addEventListener=function(n,o,r){var i,s="object"==typeof r&&null!==r,u=s?r.capture:r;(r=s?function(e){var t=Object.getOwnPropertyDescriptor(e,"passive");return t&&!0!==t.writable&&void 0===t.set?Object.assign({},e):e}(r):{}).passive=void 0!==(i=r.passive)?i:-1!==t.indexOf(n)&&!0,r.capture=void 0!==u&&u,e.call(this,n,o,r)},EventTarget.prototype.addEventListener._original=e}});</script>';
    echo '<script async src="'.$template_directory.'/js/inview.js"></script>';
    echo '<script async src="'.$template_directory.'/js/postscribe.js"></script>';
    echo '<script src="'.$template_directory.'/js/base.js"></script>';
    ?>
    <script>
        
        const lmbtns = document.querySelectorAll('.lmbtn');

        let page = 1;

        const getStuff = (id, page, catname, tagname, numof, hasexcerpt) => {

            let mcList = document.querySelector('#mclist-'+id+''),
                mcElem = document.querySelector('#mcgrid-'+id+'');

            data = {
                'action': 'load_posts_by_ajax',
                'page': page,
                'category_name': catname,
                'tag_name': tagname,
                'numof': numof,
                'hasexcerpt': hasexcerpt
            };

            request = new XMLHttpRequest();
            request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

            request = new XMLHttpRequest();
            request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = this.responseText;
                    mcList.classList.add('loaded');
                    mcElem.insertAdjacentHTML('beforeend', response);
                };
            }
            request.send('action=' + '' + data.action + '' + '&nonce=' + '' + '<?php echo wp_create_nonce( 'load_posts_by_ajax_' ) ?>' + '' + '&category_name=' + '' + data.category_name + '' + '&tag_name=' + '' + data.tag_name + '' + '&numof=' + '' + data.numof + '' + '&page=' + '' + data.page + '' + '&hasexcerpt=' + '' + <?php echo $hasexcerpt; ?> + '');
        }

        const instalist = (e) => {

            let lmbtn = e.currentTarget;

            let mcCatName = lmbtn.getAttribute('data-catname'),
                mcTagName = lmbtn.getAttribute('data-tagname'),
                mcNumOf = lmbtn.getAttribute('data-numof'),
                mcRand = lmbtn.getAttribute('data-id'),
                mcTotal = lmbtn.getAttribute('data-totalnum'),
                mcExcerpt = lmbtn.getAttribute('data-excerpt'),
                mcList = document.querySelector('#mclist-'+mcRand);

                page++;

                let totalLoaded = page * mcNumOf;
                totalLoaded >= mcTotal ? mcList.classList.add('nomore') : null;

                getStuff(mcRand, page, mcCatName, mcTagName, mcNumOf, mcExcerpt);
        }

        lmbtns.forEach(lmbtn => {
            lmbtn.addEventListener('click', instalist.bind(this), true);
        });
   
</script>
<?php }
add_action( 'wp_footer', 'footerScripts', 99);