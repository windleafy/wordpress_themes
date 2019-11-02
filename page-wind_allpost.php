<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css" >
    <script type="text/javascript"  rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.min.js" ></script>
    <script type="text/javascript"  rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/jquery/jquery-3.4.1.min.js" ></script>

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php //comments_popup_script(); // off by default ?>
    <?php wp_head(); ?>

    <style type="text/css">
    .container-fluid{
        padding-left: 0px;
        padding-right: 0px;
    }
    .outer {
        margin: auto;
    }

    .single_item {
        /*height: 100px;*/
        padding-left: 0px;
        padding-right: 0px;
        text-align: center;
        /*background-color: lavender;*/
    }

    .myimg{
        /*width: 220px;*/
        margin-top: 5px;
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 5px
    }
    .des{
        text-align: left;
        overflow:hidden; 
        text-overflow:ellipsis;
        display:-webkit-box; 
        -webkit-box-orient:vertical;
        -webkit-line-clamp:3; 
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 5px;

    }
@media screen and (max-width: 576px){
    .single_item{
        text-align: left;
        height: 120px; 
        border-bottom-style: dotted; 
        border-width: 1px; 
        border-color: grey;
    }

    .myimg{
        float: left;
    }
    .des{
        float: left;
        font-size: 16px
    }
}

@media screen and (min-width: 992px){
    .myimg{
        width: 325px;
    }
}

.tag{
    background: #eb6f70;
    color: white;
    display: inline-block;
    border-radius: 2px;
    line-height: 1.0;
    padding: 5px 10px 5px 10px;
    margin-right: 5px;
    font-size: 12px
}


button.accordion {
    background-color: pink;
    color: #444;
    cursor: pointer;
    padding: 10px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    margin-bottom: 10px;
    }

button.accordion.active, button.accordion:hover {
    background-color: pink;
    }

#plusdiv{
    float: left;
    width: 10px;
    }

#cktip{
    float: left;
    }
div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    }
.panel .row{
    text-align: center;
    }
.panel .tag{
    margin-bottom: 15px;
}
.panel .col-3{
    padding: 0px;
}

</style>
</head>

<body>
    <div class="container-fluid">
        <div class="outer col-md-8 col-lg-6">
            <div>
                <button class="accordion">
                    <div id="plusdiv"><span id="plus">+</span></div>
                    <span id="cktip">请选择查看的星座</span>
                </button>
                <div class="panel container">
                        <div class="row">
                            <div class="col-3"><small class="tag" id="sign-01">♈白羊</small></div>
                            <div class="col-3"><small class="tag" id="sign-02">♉金牛</small></div>
                            <div class="col-3"><small class="tag" id="sign-03">♊双子</small></div>
                            <div class="col-3"><small class="tag" id="sign-04">♋巨蟹</small></div>
                            <div class="col-3"><small class="tag" id="sign-05">♌狮子</small></div>
                            <div class="col-3"><small class="tag" id="sign-06">♍处女</small></div>
                            <div class="col-3"><small class="tag" id="sign-07">♎天秤</small></div>
                            <div class="col-3"><small class="tag" id="sign-08">♏天蝎</small></div> 
                            <div class="col-3"><small class="tag" id="sign-09">♐射手</small></div>
                            <div class="col-3"><small class="tag" id="sign-10">♑摩羯</small></div>
                            <div class="col-3"><small class="tag" id="sign-11">♒水瓶</small></div>
                            <div class="col-3"><small class="tag" id="sign-12">♓双鱼</small></div>                         
                        </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    query_posts( 'posts_per_page=-1' );
                    while ( have_posts() ) : the_post();
                ?>
                <a class="col-12 col-sm-6 col-md-4" href="<?php the_permalink(); ?>">
                    <div class="single_item">
                        <img class="myimg col-5 col-sm-12" src=<?php post_thumbnail_url(); ?>>
                        <p class="des col-7 col-sm-12">
                            <?php
                                if (get_1st_tag())
                                {
                                    echo "<tag class=\"tag\">";
                                    echo get_1st_tag();
                                    echo "</tag>";
                                }
                            ?>
                            <?php the_title(); ?>
                        </p>
                    </div>
                </a>
                <?php 
                    endwhile; 
                    wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</body>

<!--手风琴效果-->
<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
      document.getElementById("plus").innerText='+';
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      document.getElementById("plus").innerText='-';
    } 
  }
}
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery/jquery-2.1.1.min.js" ></script>

<script type="text/javascript">
//测试按钮传值
$("small").click(function() {
    //var fired_button = $(this).val();
    //alert($(this).html());
    var cat_slug = $(this).attr('id');
    //location.href = '?page_id=351?cat_slug='+cat_slug;
    location.href = '?page_id=486';
});
</script>

</html>





<?php 
//$count_posts = wp_count_posts(); 
//$published_posts = $count_posts->publish;

/*
query_posts( 'posts_per_page=-1' );
while ( have_posts() ) : the_post();
    the_permalink();
    echo "<br>";
    
    post_thumbnail_url();
    echo "<br>";

    echo get_the_title();
    echo "<br><br>";
endwhile;
*/

/*
while ( have_posts() ) : the_post();
    echo '<a href="';
    the_permalink();
    echo '" title="'.esc_attr( get_the_title() ).'">';
    the_title();
    echo '</a><br>';
endwhile;
*/

//wp_reset_query(); 
?>