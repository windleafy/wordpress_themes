<?php the_content(); ?>
<div id="page-allpost">
     <table>
         <strong>All Post</strong>
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