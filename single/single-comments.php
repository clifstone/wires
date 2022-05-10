<div class="comments">
    <div class="wrapper">
        <div class="the-comments">
            <?php
                $args = array(
                    'post__in' => array(get_the_ID())
                );
                $comments_query = new WP_Comment_Query;
                $comments = $comments_query->query( $args );
                // The comment loop
                if ( !empty( $comments ) ) {
                    echo '<h3><span>Subscriber Comments</span></h3>';
                    foreach ( $comments as $comment ) {
                        $split = explode('@', get_comment_author($comment));
                        $user = $split[0];                       
                    ?>

                        <div class="the-comment">
                            <div class="mcavatar the-comment-avatar">
                                <div class="wrapper">
                                    <?php echo get_avatar( $comment, 32 ); ?>
                                </div>
                            </div>
                            <div class="the-comment-author">
                                <h6>Comment by: </h6>
                                <span class="bold"><?php echo $user; ?></span>
                            </div>
                            <div class="the-comment-body">
                                <?php echo '<p>' . nl2br($comment->comment_content) . '</p>'; ?>
                            </div>
                        </div>

                    <?php } //foreach
                } else {
                } //ifempty
            ?>
        </div>

        <?php
            $comment_send = 'Send';
            $comment_reply = 'Comment On This Post';
            $comment_reply_to = 'Reply';
            
            $comment_author = 'Name';
            $comment_email = 'E-Mail';
            $comment_body = 'Comment';
            $comment_url = 'Website';
            $comment_cookies_1 = ' By commenting you accept the';
            $comment_cookies_2 = ' Privacy Policy';
            
            $comment_before = 'Registration isn\'t required.';
            
            $comment_cancel = 'Cancel Reply';
            
            //Array
            $comments_args = array(
                //Define Fields
                'fields' => array(
                    //Author field
                    'author' => '<p class="comment-form-author"><br /><input id="author" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></p>',
                    //Email Field
                    'email' => '<p class="comment-form-email"><br /><input id="email" name="email" placeholder="' . $comment_email .'"></input></p>',
                    //URL Field
                    'url' => '<p class="comment-form-url"><br /><input id="url" name="url" placeholder="' . $comment_url .'"></input></p>',
                    //Cookies
                    'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>',
                ),
                // Change the title of send button
                'label_submit' => __( $comment_send ),
                // Change the title of the reply section
                'title_reply' => __( $comment_reply ),
                // Change the title of the reply section
                'title_reply_to' => __( $comment_reply_to ),
                //Cancel Reply Text
                'cancel_reply_link' => __( $comment_cancel ),
                // Redefine your own textarea (the comment body).
                'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea></p>',
                //Message Before Comment
                'comment_notes_before' => __( $comment_before),
                // Remove "Text or HTML to be displayed after the set of comment fields".
                'comment_notes_after' => '',
                //Submit Button ID
                'id_submit' => __( 'comment-submit' ),
            );
            comment_form( $comments_args );
        ?>
    </div>
</div>