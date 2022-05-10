<?php
function aside_logo_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Sidebar Logo</h3>';
}

function render_aside_logo($args){
    $asidestr = implode($args);
    switch($asidestr){
        case 'asideLogURL': ?>
            <div class="aside-img-box">
                <?php if(get_option('aside_logo_url')){ ?>
                    <img id="aside_logo_img" src="<?php echo get_option('aside_logo_url'); ?>" alt="" />
                <?php }else{ ?>
                    <img id="aside_logo_img" src="<?php echo get_template_directory_uri(); ?>/images/upload-placeholder.png" alt="" />
                <?php } ?>
            </div>
            
            <input type="text" name="aside_logo_url" id="aside_logo_url" value="<?php echo get_option('aside_logo_url'); ?>" />
            <input type="file" name="aside_file" id="aside_file">
            <input type="submit" id="aside_uploadimg" name="aside_upload" onclick="uploadAside();return false;" value="UPLOAD">
            <script>

                function uploadAside(){
                    var formData = new FormData();
                    formData.append("action", "upload-attachment");

                    var asideFileInputElement = document.getElementById("aside_file");

                    formData.append("async-upload", asideFileInputElement.files[0]);
                    formData.append("name", asideFileInputElement.files[0].name);

                    <?php $aside_nonce = wp_create_nonce('media-form'); ?>
                    formData.append("_wpnonce", "<?php echo $aside_nonce; ?>");

                    var asidexhr = new XMLHttpRequest();
                        asidexhr.onreadystatechange=function(){
                            if (asidexhr.readyState==4 && asidexhr.status==200){
                                var asideDerples = JSON.parse(asidexhr.responseText),
                                    asideFartles = asideDerples.data.url;
                                document.getElementById('aside_logo_url').value = asideFartles;
                                document.getElementById('aside_logo_img').src = asideFartles;
                            }
                        }

                    asidexhr.open("POST","<?php echo admin_url(); ?>async-upload.php",true);
                    asidexhr.send(formData);
                }

            </script>
        <?php break;
    }
}

function add_aside_logo_setting(){
    add_settings_section( 'aside_logo_section', '', 'aside_logo_section_description', 'aside-logo-options');
    add_settings_field('aside_logo_url', '', 'render_aside_logo', 'aside-logo-options', 'aside_logo_section', $args = array('asideLogURL'));
    register_setting( 'aside_logo_option', 'aside_logo_url');
}
add_action('admin_init','add_aside_logo_setting');