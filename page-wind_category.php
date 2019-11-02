<?php //the_content(); ?>

<!doctype html>
<html>
<head>
<meta charset='UTF-8' />
<title>Category功能</title>
<style type="text/css">

</style>
</head>

<body>

<!--获取全部文章-->
<?php 
    query_posts( 'posts_per_page=-1' );
    while ( have_posts() ) : the_post();
?>
<p><?php the_title(); ?></p>

<!--向上一级获取父级分类名称-->
<?php
    /* 
    $category = get_the_category();
    $parent = get_cat_name($category[0]->category_parent);
    if (!empty($parent)) {
    echo $parent;
    } else {
    echo $category[0]->cat_name;
    }
    */
?>

<!--获取分类id-->
<?php
    $category = get_the_category();//默认获取当前所属分类
    //echo $category[0]->cat_ID; //输出分类 id
?>

<?php
    $category = get_the_category();//默认获取当前所属分类
        foreach ($category as $value) {
            echo $value->cat_name;
            echo $value->cat_ID;
            echo "<br>";
        }
?>

<?php 
    endwhile; 
    wp_reset_query();
?>



<!--获取指定分类的列表内容-->
<br>
<p style="color: green">获取指定分类的列表内容</p>
<?php 
    $category = 14;
    $display_link = false;
    $separator = '_';
    $nice_name = false;
    $cat_tree = get_category_parents($category, $display_link, $separator, $nice_name); 
    echo '$cat_tree:  '.$cat_tree;

    /*获取顶级父类名称*/
    $top_cat = explode('_',$cat_tree);
    echo '<br>';
    $tmp = explode("_",$cat_tree);
    print_r ($tmp);echo '<br>';
    print_r ($tmp[0]);
?>

<!--根据分类别名获取分类id-->
<br>
<p style="color: green">根据分类别名获取分类id</p>
<?php 
    //通过分类别名category-name获取分类数据对象
    $idObj = get_category_by_slug('sign-02'); 
    $id = $idObj->term_id;
    echo $id;
?>

<!--根据id获取指定分类的全部文章-->
<br>
<p style="color: green">根据id获取指定分类的全部文章</p>
<?php $posts = get_posts( "category=16" ); ?>
<?php if( $posts ) : ?>
<ul style="list-style: none;">
<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
    <li>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">    <?php the_title(); ?></a>
    </li>
<?php endforeach; ?>
</ul>
<?php 
    endif; 
    wp_reset_query();
?>

</body>
</html>