<!-- get header start -->
<?php
    get_header(); //Get Header

    include(get_template_directory() . '/include/breadcrumb.php'); //include breadcrumb

?>
<!--  start content -->

<div class="container">
        <?php
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                            <div class="main-post single-post">
                                <?php edit_post_link('<span>Edit</span>  <svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="18" height="13" viewBox="0 0 18 18"><path fill="" d="M14.7272727,11.1763636 C14.7272727,10.7244943 15.0935852,10.3581818 15.5454545,10.3581818 C15.9973239,10.3581818 16.3636364,10.7244943 16.3636364,11.1763636 L16.3636364,15.5454545 C16.3636364,16.9010626 15.2646989,18 13.9090909,18 L2.45454545,18 C1.09893743,18 0,16.9010626 0,15.5454545 L0,4.09090909 C0,2.73530107 1.09893743,1.63636364 2.45454545,1.63636364 L6.82363636,1.63636364 C7.2755057,1.63636364 7.64181818,2.00267611 7.64181818,2.45454545 C7.64181818,2.9064148 7.2755057,3.27272727 6.82363636,3.27272727 L2.45454545,3.27272727 C2.00267611,3.27272727 1.63636364,3.63903975 1.63636364,4.09090909 L1.63636364,15.5454545 C1.63636364,15.9973239 2.00267611,16.3636364 2.45454545,16.3636364 L13.9090909,16.3636364 C14.3609602,16.3636364 14.7272727,15.9973239 14.7272727,15.5454545 L14.7272727,11.1763636 Z M6.54545455,9.33890201 L6.54545455,11.4545455 L8.66109799,11.4545455 L16.0247344,4.09090909 L13.9090909,1.97526564 L6.54545455,9.33890201 Z M14.4876328,0.239639906 L17.7603601,3.51236718 C18.07988,3.83188705 18.07988,4.34993113 17.7603601,4.669451 L9.57854191,12.8512692 C9.42510306,13.004708 9.21699531,13.0909091 9,13.0909091 L5.72727273,13.0909091 C5.27540339,13.0909091 4.90909091,12.7245966 4.90909091,12.2727273 L4.90909091,9 C4.90909091,8.78300469 4.99529196,8.57489694 5.14873082,8.42145809 L13.330549,0.239639906 C13.6500689,-0.0798799688 14.1681129,-0.0798799688 14.4876328,0.239639906 Z"></path></svg> ') ?>
                                <h3 class="post-title">
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
                                <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post-Image']) ?>
                                <hr>
                                <div class="post-content" >
                                    <!-- <?php the_excerpt() ?> -->
                                    <?php the_content() ?>
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
            echo '<div class="clearfix"></div>';
            $random_post_arguments = array(
                'posts_per_page'     =>   5,
                'orderby'           =>  'rand',
                'category__in'      =>   wp_get_post_categories(get_queried_object_id()),    //ned array 
                'post__not_in'       =>  array(get_queried_object_id()),

            );?>
            <h3 class ="object-same-as"> object same as</h3><?php
            $random_posts  = new WP_Query($random_post_arguments);
                if($random_posts-> have_posts()){
                    while($random_posts-> have_posts()){
                        $random_posts->the_post(); ?>
                        <div class="author-posts">
                                <h3 class="post-title">
                                    <a href="<?php the_permalink() ?>">
                                    <?php the_title() ?>
                                    </a>
                                </h3>
                        </div>
                        <?php 
                    }
                }
                // wp_reset_postdate();
            ?>
            <div class="row">
                <div class="col-md-2">
                    <?php
                        $avatar_arguments = array(
                            'class' => 'img-responsive img-thumbnail center-block avatar-class'
                        );
                        echo get_avatar(get_the_author_meta('ID')  , 80 , '', '' , $avatar_arguments);
                    
                    ?>
                </div>
                <div class="col-md-10 author-info">
                    <h4>
                        <?php the_author_meta('first_name') ?> 
                        <?php the_author_meta('last_name') ?> 
                        (<?php the_author_meta('nickname') ?>) 
                    </h4>
                    <?php if(get_the_author_meta('description')) { ?>
                    <p> <?php the_author_meta('description') ?> </p>
                    <?php }else{
                        echo "Thers No Biography";
                    }?>
                </div>
            </div>
            <div class="auther-stats">
                <div> <i class="fa fa-user "></i> User Post Count: <span class="post-count"><?php echo count_user_posts(get_the_author_meta('ID')) ?> </span>  </div>
                <p><i class="fa fa-tag "></i>User Profile Link: <?php the_author_posts_link() ?> </p>
            </div>
            <?php 
            echo '<div class="clearfix"></div>';
            echo '<hr class="comment-separator">';
            // Add next and previous
            echo '<div class="post-pagination">';
                echo '<div class="next-class">';
                if(get_previous_post_link() ){
                    previous_post_link();
                }else{
                    echo '<span class="pagination-prev-span" >prev</span>';
                }
                echo '</div>';
                echo '<div class="prev-class">';
                if (get_next_post_link() ){
                    next_post_link();
                } else {
                    echo '<span class="pagination-next-span" > Next </span>';
                }
                echo '</div>';

                echo '</div>' . '<br>'. '<br>'. '<br>';
                echo '<div class="numbering_pagination-in-single">';
                echo numbering_pagination(); //Get Current Page 
                echo '</div>';

            echo '<hr class="comment-separator">';
            comments_template();
        ?>
        <br> <br><br>
    </div>
</div><!-- get_footer start -->
<?php get_footer();?>
<!-- get_footer end -->