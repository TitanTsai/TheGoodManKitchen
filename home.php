<?php get_header();?>

<div id="newsroom">
   <div class="container-fluid newsroom_header shadow-sm">
      <h3 class="newsroom_header_title">最新消息</h3>
   </div>

   <div class="container mt-3">
      <div class="row">
         <?php if(have_posts()): while(have_posts()):the_post();?>
            <div class="col-md-4 mb-3">
               <div class="archive_post-image">
                  <img class="img-fluid" src="<?php the_post_thumbnail_url();?>" alt="">
                  <div class="archive_post-overlay">
                     <div class="archive_post-content">
                        <h2 class="archive_post-title"><?php the_title();?></h2>
                        <div class="archive_post-date text-wrap"><?php the_date(Y-m-d);?></div>
                        <div class="archive_post-excerpt text-wrap"><?php the_excerpt();?></div>
                        <a class="btn btn-primary align-self-center stretched-link" href="<?php the_permalink();?>">詳細內容</a>
                     </div>
                  </div>
               </div>

               
            </div>   
         <?php endwhile; else: endif;?> 
      </div>
   </div>

   <div class="container p-0">
      <ul class="pagination justify-content-center">
         <?php the_posts_pagination();?>
      </ul>
   </div>
</div>
<?php get_footer();?>