<?php //the_content(); ?>

<!doctype html>
<html>
<head>
<meta charset='UTF-8' />
<title>标签功能</title>
<style type="text/css">
    .new{
        background: #eb6f70;
        color: white;
        display: inline-block;
        border-radius: 2px;
        line-height: 1.0;
        padding: 3px 5px 2px 5px;
        margin-right: 5px;
        font-size: 12px
    }
}    
</style>
</head>


<!--取全部文章列表-->
<div id="page-allpost">
     <table>
         <!--strong>All Post</strong-->
         <tr>
             <td><strong>S.No</strong></td>
             <td><strong>Published Date</strong></td>
             <td><strong>Post Header</strong></td>
         </tr>
    <?php $count_posts = wp_count_posts(); $published_posts = $count_posts->publish;
     query_posts( 'posts_per_page=-1' );
     while ( have_posts() ) : the_post();
         echo '<tr>';
         echo '<td>'.$published_posts.'</td>';
         echo '<td width="120">';
         the_time(get_option( 'date_format' ));
         echo '</td><td><a href="';
         the_permalink();
         echo '" title="'.esc_attr( get_the_title() ).'">';
         the_title();
         echo '</a></td></tr>';
         $published_posts--;
     endwhile;
     wp_reset_query(); ?>
     </table>
</div>


<!--取指定标签文章列表-->
<?php
    $tag = '星座'; //标签名
    $args=array(
        'tag' => $tag,
        //'showposts'=>1,
        'caller_get_posts'=>1,
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
        echo '<br>指定'.$tag.'标签，文章输出：';
        while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <p>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </p>



        <!--取文章的第一个标签--不带链接-->
        <?php
            $posttags = get_the_tags();
            if ($posttags) {
                echo $posttags[0]->name;
            }
            echo "<br>";
        ?>
        
        <!--取文章的标签--带链接\全部-->
        <?php the_tags( 'Tags: ', '~ ', '' ); echo "<br>";?>

        <!--取文章的标签--不带链接\全部-->
        <?php 
            $keywords = "";
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag ) {
                $keywords = $keywords . $tag->name . "~";
            }
            echo $keywords;
            echo "<br>";
        ?>

        <?php
        endwhile;
    }    
wp_reset_query(); 
?>


<!--标签与标题排版-->
<?php
    $tag = '星座'; //标签名
    $args=array(
        'tag' => $tag,
        //'showposts'=>1,
        'caller_get_posts'=>1,
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
        echo '<br>指定'.$tag.'标签，文章输出：';
        while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <p>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                <small class="new"><?php echo get_1st_tag(); ?></small>
                <?php the_title(); ?>
            </a>
        </p>

        <?php
        endwhile;
    }    
wp_reset_query(); 
?>

