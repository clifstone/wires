<?php
function instalistscript(){
    if(function_exists('instalist_func')){ ?>
    <script>
        
        window.addEventListener('load', () => {
            const lmbtns = document.querySelectorAll('.lmbtn');
            const lmblock = document.querySelector('.lmblock');

            let page = 1;

            const getStuff = (id, page, catname, tagname, numof, hasexcerpt, exclude) => {

                let mcList = document.querySelector('#mclist-'+id+''),
                    mcElem = document.querySelector('#mcgrid-'+id+'');

                let lmbtn = document.querySelector('#mclist-'+id+' .lmbtn'),
                    theloader = '<?php echo getLoader('dots'); ?>';

                try {
                    mcList.classList.add('instalist-loading');
                    lmbtn.insertAdjacentHTML('beforeend', theloader);
                } catch (error) {}

                data = {
                    'action': 'load_posts_by_ajax',
                    'page': page,
                    'category_name': catname,
                    'tag_name': tagname,
                    'numof': numof,
                    'hasexcerpt': hasexcerpt,
                    'exclude' : exclude
                };

                request = new XMLHttpRequest();
                request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = this.responseText;
                        mcList.classList.add('loaded');
                        mcElem.insertAdjacentHTML('beforeend', response);
                       try {
                         document.querySelector('.loader').remove();
                         mcList.classList.remove('instalist-loading');
                       } catch (error) {}
                    };
                }

                request.send('action='+data.action+'&category_name='+data.category_name+'&tag_name='+data.tag_name+'&numof='+data.numof+'&page='+data.page+'&hasexcerpt='+data.hasexcerpt+'&excludecat='+data.exclude+'');

            }

            const instalist = (e) => {

                let lm = e.currentTarget;

                lm === undefined ? lm = e : null;

                let mcCatName = lm.getAttribute('data-catname'),
                    mcTagName = lm.getAttribute('data-tagname'),
                    mcNumOf = lm.getAttribute('data-numof'),
                    mcRand = lm.getAttribute('data-id'),
                    mcTotal = lm.getAttribute('data-totalnum'),
                    mcExcerpt = lm.getAttribute('data-excerpt'),
                    mcExclude = lm.getAttribute('data-exclude'),
                    mcList = document.querySelector('#mclist-'+mcRand);

                    page++;

                    let totalLoaded = page * mcNumOf;
                    totalLoaded >= mcTotal ? lm.parentNode.remove() : null;

                    getStuff(mcRand, page, mcCatName, mcTagName, mcNumOf, mcExcerpt, mcExclude);
            }

            lmbtns.forEach(lmbtn => {
                lmbtn.addEventListener('click', instalist.bind(this), true);
            });

            inView('.lmblock').on('enter', () =>{
                page++;
                instalist(lmblock);
            });
        });
   
    </script>
    <?php }
}
add_action( 'wp_footer', 'instalistscript', 111);