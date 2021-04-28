<?php get_header();?>

   <div class="container-fluid newsroom_header shadow-sm">
      <h3 class="newsroom_header_title">最新消息</h3>
   </div>

   <div class="container mt-3 mt-md-5 d-flex justify-content-center">
         <?php if(have_posts()): while(have_posts()):the_post();?>
            <div class="col-md-10 post_container bg-dark"> 
               
               <div class="post_image px-3 px-md-5 pt-3 pt-md-5">
                  <?php if(has_post_thumbnail()):?>
                     <img src="<?php the_post_thumbnail_url();?>" class="img-fluid" alt="">
                  <?php endif;?>   
               </div>

               <div class="post_content-box p-3 p-md-5">
                  <h3><?php the_title();?></h3>
                  <p class="post_content-date"><?php echo get_the_date('Y/m/d h:i:s');?></p>
                  <hr>
                  <article class="post_content-article">
                     <?php the_content();?>
                  </article>
               </div>

               <div class="text-center my-3 my-md-5">
                  <a href="./newsroom/" class="btn btn-secondary">回消息列表</a>
               </div>
            </div>        
         <?php endwhile; else: endif;?> 
   </div>

<?php get_footer();?>