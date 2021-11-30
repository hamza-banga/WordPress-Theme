<!-- get header start -->
<?php get_header();?>
<!-- get header end -->

<!--  start content -->

<div class="container">
    <div class="row category-information-row">
        <div class="text-center category-information">
            <div class="col-md-4 col-lg-4 col-sm-4">
                <h1 class="category-title"><?php single_cat_title() ?></h1>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="category-desciption"> <?php echo category_description() ?> </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="cat-stats">
                    <span>Article Count : 20</span> |
                    <span>Comment Count : 100</span>
                </div>
            </div>
        </div>
        </div>
        <br>
        <!-- <div class="clearfix"></div> -->
        <?php
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                        <div class="col-sm-6">
                            <div class="main-post">
                                <h3>
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                </h3>
                                <span class="post-auther">
                                    <i class="fa fa-user "></i> <?php the_author_posts_link() ?>,
                                </span>
                                <span class="post-date">
                                    <i class="fa fa-calendar "></i> <?php the_date() ?> at <?php the_time() ?>
                                </span>
                                <span class="post-comment">
                                    <i class="fa fa-comments "></i>
                                    <?php comments_popup_link('no comments' ,'one comment' , '% comments' , 'comment-url' , 'comment disabled') ?>
                                </span>
                                <hr>
                                <p class="categories">
                                    <i class="fa fa-tags fa-fw"></i>
                                    <?php the_category(' , ') ?>
                                </p>
                                <p class="post-tags">
                                    <?php 
                                        if (has_tag() )  {
                                            the_tags();
                                        } else {
                                                echo 'no tag can send';
                                        }
                                    ?>
                                </p>
                                <!-- <div class="clear-fix"></div> -->
                            </div>
                        </div>
                        <!-- <div class="clear-fix"></div> -->
                    <?php                    
                }
            }
            echo '<div class="clearfix"></div>';
            // Add next and previous
            echo '<div class="post-pagination">';
                if(get_previous_posts_link() ){
                    previous_posts_link('<i class="fa fa-chevron-left fa-fw fa-lg" aria-hidden="true"></i> Prev');
                }else{
                    echo '<span class="pagination-prev-span" >prev</span>';
                }
                if (get_next_posts_link() ){
                    next_posts_link( ' Next <i class="fa fa-chevron-right fa-fw fa-lg" aria-hidden="true"></i>');
                } else {
                    echo '<span class="pagination-next-span" > Next </span>';
                }
            echo '</div>';

            echo '<div class="numbering_pagination">';
            
            echo numbering_pagination(); //Get Current Page 
            echo '</div>';
        ?>
    </div>
</div>
<!-- get_footer start -->
<?php get_footer();?>
<!-- get_footer end -->