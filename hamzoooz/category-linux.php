<!-- get header start -->
<?php get_header();?>
<!-- get header end -->

<!--  start content -->
<div class="container linux-category">
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
                    <span><b>linux</b> </span>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>        
        <div class="col-md-9">
        <?php
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                            <div class="main-post">
                                <div class="row">
                                    <div class="col-md-6">
                                    <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post-Image']) ?>
                                    </div>
                                    <div class="cpl-md-6">
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
                                        <div class="post-content" >
                                            <?php the_excerpt() ?>
                                        </div>
                                    </div>
                                </div>
                            
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
                            </div>
                    <?php                    
                }
            }
            ?>
            </div>
            <div class="col-md-3">
                <?php
                /*
                if(is_active_sidebar('main-sidebar')){
                    dynamic_sidebar('main-sidebar');
                }
                */
                get_sidebar('linux');
                ?>
            </div>
            <div class="numbering_pagination">;
                <?php echo numbering_pagination();?>
            </div>;
    </div>
</div>
<!-- get_footer start -->
<?php get_footer();?>
<!-- get_footer end -->