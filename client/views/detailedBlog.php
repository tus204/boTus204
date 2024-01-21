<?php
extract($blog);
?>

<main class="main">
    <div class="container">
        <div class="main-layout">
               <div class="post">
                    <div class="post-main">
                         <div class="post-info-1">
                              <h2 class="post-username"><?=$full_name?></h2>
                              <div class="post-reaction">
                              <div class="post-views">
                                        <i class="fa-solid fa-eye"></i>
                                        <span><?=$view?></span>
                                   </div>
                                   <div class="post-cmt">
                                        <i class="fa-regular fa-comment"></i>
                                        <?php 
                                            foreach ($total_comments as $comments) {
                                             extract($comments);
                                            }
                                        ?>
                                        <span><?=$total_cmt?></span>
                                   </div>
                              </div>
                         </div>
                         <div class="post-content">
                              <h1 class="post-heading"><?=$post_title?></h1>
                              <div class="post-text">
                             <?=$post_content?>
                              </div>
                         </div>
                    </div>
               </div>
        </div>
    </div>
</main>
