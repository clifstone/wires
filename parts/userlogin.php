<?php
    if(!is_user_logged_in()){
        echo '<div class="logreg"><button id="headerlogin" class="headerlogin" aria-label="login button"><a href="'.home_url().'/log-in">Login</a></button><button id="headerregister" class="headerregister" aria-label="register button"><a href="'.home_url().'/register">Register</a></button></div>';
    }else{
        global $current_user;
        get_currentuserinfo();
        $mcavatar = get_avatar( $current_user->ID, 64 );
        if($mcavatar){
            $useravatar = $mcavatar;
        }else{
            $useravatar = '<i class="i-user"></i>';
        }

        echo
        '<div class="useravatar">
            <div class="avatarwrap"><a href="'.home_url().'/account">'.$useravatar.'</a></div>
            <div class="opts">
                <div class="wrapper">
                    <ul>
                        <li><a href="'.home_url().'/logout"><i class="i-cancel-circle"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>';
    }
?>