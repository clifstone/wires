<div class="searchform">
    <form action="<?php echo home_url(); ?>" method="get">
        <label for="search" style="display:none">Search <?php echo get_bloginfo(); ?></label>
        <input type="text" class="searchinput" name="s" value="Search <?php echo get_bloginfo(); ?>" onblur="if(this.value=='')this.value='Search <?php echo get_bloginfo(); ?>'"
        onfocus="if(this.value=='Search <?php echo get_bloginfo(); ?>')this.value=''" />
        <button class="searchsubmit" type="submit" value="Search"><i class="i-search"></i></button>
    </form>
</div>