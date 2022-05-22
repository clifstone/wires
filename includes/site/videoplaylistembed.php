<?php

function vid_playlist_metabox(){
    add_meta_box('vid_playlist_urls', 'VIDEO PLAYLIST URLS:', 'makePlaylist', 'post', 'normal', 'high' );
}

function makePlaylist(){
    global $post;
    echo '
    <div class="plist-wrapper">
        <button class="plist-addbtn" style="padding:1rem; background-color:#069; color:white;"><span>+</span></button>
        <div class="plist-inputs"></div>
    </div>
    <input id="theplist" name="theplist" type="text" style="width:100%" value="'.get_post_meta($post->ID, 'vid_playlist_urls', true).'">
    ';
    ?>

    <script>

        const plistURLs = "<?php global $post; echo get_post_meta($post->ID, 'vid_playlist_urls', true); ?>",
            plistArr = plistURLs.split(', ');

        const addbtn = document.querySelector('.plist-addbtn'),
            inputswrap = document.querySelector('.plist-inputs'),
            mcInputs = document.querySelectorAll('.plist-input');

        const isUrl = (url) => {
            try { return Boolean(new URL(url)); }
            catch(e){ return false; }
        }

        const getInputVals = () => {
            let inputs = document.querySelectorAll('.plist-input-wrap > input'),
                theplistfield = document.querySelector('#theplist'),
                newlistArr = new Array,
                newlist = new String;
            
            inputs.forEach(input =>{
                if(isUrl(input.value) === true){
                    input.setAttribute('readonly', 'true');
                    newlistArr.push( input.value.toString() );
                    newlist = newlistArr.join(', ');
                }else{
                    input.value = '';
                    input.setAttribute('placeholder', 'please enter a valid URL');
                    input.setAttribute('class', 'invalid');
                }
            });

            theplistfield.setAttribute('value', newlist);
        }

        const createInput = (val) => {
            let mcInputWrap = document.createElement('div'),
                mcInput = document.createElement('input');

            mcInputWrap.setAttribute('class', 'plist-input-wrap');
            mcInput.setAttribute('type', 'text');
            mcInput.setAttribute('class', 'plist-input');
            mcInput.setAttribute('value', val);
            mcInput.setAttribute('onchange', 'getInputVals()');
            mcInput.setAttribute('placeholder', 'Enter a post url');
            mcInput.style.width = '100%';
            mcInputWrap.appendChild(mcInput);
            inputswrap.appendChild(mcInputWrap);
        }

        const createInputsFromField = () => {
            plistArr.forEach(plURL => {
                createInput(plURL);
            });
        }

        plistURLs.length > 0 ? createInputsFromField() : null;

        addbtn.addEventListener('click', createInput.bind(null, ''), false);
    </script>

<?php }


function save_vid_playlist_metabox(){
    global $post;
    if(isset($_POST["theplist"])){
        update_post_meta($post->ID, 'vid_playlist_urls', $_POST["theplist"]);
    }
}

add_action('add_meta_boxes', 'vid_playlist_metabox');
add_action('save_post', 'save_vid_playlist_metabox');