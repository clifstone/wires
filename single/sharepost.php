<div class="social-share">
    <div class="wrapper">
        <div class="shbtn lab">
            <i class="i-share2"></i>
        </div>
        <div class="shbtn fb">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url( $wp->request ); ?>&title=<?php echo the_title(); ?>" target="_blank" rel="noopener" name="share this article on facebook">
                <i class="i-facebook"></i>
            </a>
        </div>
        <div class="shbtn tw">
            <a href="https://twitter.com/intent/tweet?status=<?php echo the_title(); ?>+<?php echo home_url( $wp->request ); ?>" target="_blank" name="share this article on twitter" rel="noopener">
                <i class="i-twitter"></i>
            </a>
        </div>
    </div>
</div>