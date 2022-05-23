<?php

function vid_playlist_metabox(){
    add_meta_box('vid_playlist_urls', 'VIDEO PLAYLIST URLS:', 'makePlaylist', 'post', 'normal', 'high' );
}

function makePlaylist(){
    global $post;
    echo '
    <div class="plist-wrapper">
        <div class="plist-inputs"></div>
    </div>
    <input id="theplist" name="theplist" type="hidden" style="width:100%" value="'.get_post_meta($post->ID, 'vid_playlist_urls', true).'">
    ';
    echo '<link rel="preload" href="'.get_template_directory_uri().'/fonts/baseicons/style.min.css" as="style"  onload="this.rel=\'stylesheet\'" >';
    ?>
    

    <script>

        const plistURLs = "<?php global $post; echo get_post_meta($post->ID, 'vid_playlist_urls', true); ?>",
            plistArr = plistURLs.split(', ');

        const inputsWrap = document.querySelector('.plist-inputs'),
            mcInputs = document.querySelectorAll('.plist-input');

        const isUrl = (url) => {
            try { return Boolean(new URL(url)); }
            catch(e){ return false; }
        }

        const getInputVals = () => {
            let inputs = document.querySelectorAll('.plist-input-wrap > .wrapper > input'),
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
            let rO = () => { if(val.length > 0){ return "readonly" } }
            let theInput = '<div class="plist-input-wrap"><h5>Playlist URL</h5><div class="wrapper"><input type="text" class="plist-input" '+rO()+' onchange="getInputVals()" placeholder="Enter a post URL" value="'+val+'"><button class="plist-editbtn plbtn" onclick="editInput(this)"><i class="i-pencil"></i></button><button class="plist-delete plbtn" onclick="deleteInput(this)"><i class="i-minus"></i></button><button class="plist-addbtn plbtn" onclick="createBlankInput()"><i class="i-plus"></i></button></div></div>';
            inputsWrap.insertAdjacentHTML('beforeend', theInput);
        }

        const howManyInputs = () =>{
            let x = 0,
                theInputs = document.querySelectorAll('.plist-input-wrap');
            theInputs.forEach(el => { x++ });
            return x;
        }

        const createInputsFromField = () => {
            plistArr.forEach(plURL => {
                createInput(plURL);
            });
        }

        const createBlankInput = () => {
            createInput('');
        }

        const deleteInput = (e) => {
            e.parentNode.parentNode.remove();
            getInputVals();
            howManyInputs() === 0 ? createBlankInput() : null;
        }

        const editInput = (e) => {
            e.parentNode.firstChild.removeAttribute('readonly');
        }

        plistURLs.length > 0 ? createInputsFromField() : createBlankInput();
    </script>

    <style>
        .plist-input-wrap *{
            box-sizing: border-box;
        }
        .plist-input-wrap{
            margin: 0 0 1.5rem 0;
        }
        .plist-input-wrap h5{
            margin:0 0 0.25rem 0;
        }
        .plist-input-wrap .plist-addbtn{
            display:none
        }
        .plist-input-wrap:last-child .plist-addbtn{
            display:block;
            margin:0 0 0 0.25rem;
        }
        .plist-input-wrap>.wrapper{
            font-size:1rem;
            display:flex;
        }
        .plist-input{
            width:100%;
            padding:0.5rem !important;
            margin:0 !important;
            border-radius: 0.5rem 0 0 0.5rem !important;
        }
        .plbtn{
            color:white;
            background-color:rgba(0,102,153,1);
            border:0;
            padding:1rem; 
            cursor: pointer;
        }
        .plbtn:hover{
            background-color:rgba(0,102,153,0.8); 
        }
        .plbtn.plist-delete:hover{
            background-color:#CC0000; 
        }
    </style>

<?php }


function save_vid_playlist_metabox(){
    global $post;
    if(isset($_POST["theplist"])){
        update_post_meta($post->ID, 'vid_playlist_urls', $_POST["theplist"]);
    }
}

add_action('add_meta_boxes', 'vid_playlist_metabox');
add_action('save_post', 'save_vid_playlist_metabox');