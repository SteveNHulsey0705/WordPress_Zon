<?php
function pagination($pages = '', $range = 2)
{ 
 $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination-blog'>
              <div class='pagination-blog-inner'>";
          echo "<a class='prevposts-link transition ajax ln' href='".get_pagenum_link(1)."'><i class='fa fa-chevron-left'></i></a>";
         

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a class='blog-page current-page transition ajax'>".$i."</a>":"<a class='blog-page ajax transition' href='".get_pagenum_link($i)."' class='' >".$i."</a>";
             }
         }

         
          echo "<a class='nextposts-link transition ajax rn' href='".get_pagenum_link($pages)."'><i class='fa fa-chevron-right'></i></a>";
         echo "</div></div>\n";
     }
}
?>