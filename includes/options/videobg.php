<?php
function videobg_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Video Background</h3>';
}

function render_videobg($args){
    $vidstr = implode($args);
    switch($vidstr){
        case 'vidbgURL': ?>
            
            <input type="text" name="videobg_url" id="videobg_url" value="<?php echo get_option('videobg_url'); ?>" />
            <input type="file" name="vidbgfile" id="vidbgfile">
            <input type="submit" id="uploadvid" name="uploadvid" onclick="uploadvid();return false;" value="UPLOAD">
            <script>

                function uploadvid(){
                    var formData = new FormData();
                    formData.append("action", "upload-attachment");

                    var fileInputElement = document.getElementById("vidbgfile");

                    formData.append("async-upload", fileInputElement.files[0]);
                    formData.append("name", fileInputElement.files[0].name);

                    <?php $my_nonce = wp_create_nonce('media-form'); ?>
                    formData.append("_wpnonce", "<?php echo $my_nonce; ?>");

                    var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange=function(){
                            if (xhr.readyState==4 && xhr.status==200){
                                var mcDerples = JSON.parse(xhr.responseText),
                                    mcFartles = mcDerples.data.url;
                                document.getElementById('videobg_url').value = mcFartles;
                            }
                        }

                    xhr.open("POST","<?php echo admin_url(); ?>async-upload.php",true);
                    xhr.send(formData);
                }

            </script>
        <?php break;
    }
}

function add_videobg_setting(){
    add_settings_section( 'videobg_section', '', 'videobg_section_description', 'videobg-options');
    add_settings_field('videobg_url', 'Video Background URL', 'render_videobg', 'videobg-options', 'videobg_section', $args = array('vidbgURL'));
    register_setting( 'videobg_option', 'videobg_url');
}
add_action('admin_init','add_videobg_setting');