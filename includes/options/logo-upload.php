<?php
function logo_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Site Logo</h3>';
}

function render_logo($args){
    $str = implode($args);
    switch($str){
        case 'logURL': ?>
            <div class="img-box">
                <?php if(get_option('logo_url')){ ?>
                    <img id="logo_img" src="<?php echo get_option('logo_url'); ?>" alt="" />
                <?php }else{ ?>
                    <img id="logo_img" src="<?php echo get_template_directory_uri(); ?>/images/upload-placeholder.png" alt="" />
                <?php } ?>
            </div>
            
            <input type="text" name="logo_url" id="logo_url" value="<?php echo get_option('logo_url'); ?>" />
            <input type="file" name="file" id="file">
            <input type="submit" id="uploadimg" name="Upload" onclick="upload();return false;" value="UPLOAD">
            <script>

                function upload(){
                    var formData = new FormData();
                    formData.append("action", "upload-attachment");

                    var fileInputElement = document.getElementById("file");

                    formData.append("async-upload", fileInputElement.files[0]);
                    formData.append("name", fileInputElement.files[0].name);

                    <?php $my_nonce = wp_create_nonce('media-form'); ?>
                    formData.append("_wpnonce", "<?php echo $my_nonce; ?>");

                    var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange=function(){
                            if (xhr.readyState==4 && xhr.status==200){
                                var mcDerples = JSON.parse(xhr.responseText),
                                    mcFartles = mcDerples.data.url;
                                document.getElementById('logo_url').value = mcFartles;
                                document.getElementById('logo_img').src = mcFartles;
                            }
                        }

                    xhr.open("POST","<?php echo admin_url(); ?>async-upload.php",true);
                    xhr.send(formData);
                }

            </script>
        <?php break;
    }
}

function add_logo_setting(){
    add_settings_section( 'logo_section', '', 'logo_section_description', 'logo-options');
    add_settings_field('logo_url', 'Image URL', 'render_logo', 'logo-options', 'logo_section', $args = array('logURL'));
    register_setting( 'logo_option', 'logo_url');
}
add_action('admin_init','add_logo_setting');