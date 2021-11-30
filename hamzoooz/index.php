<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://www.hamzoooz.com
 * @package WordPress
 * @subpackage hamzooo
 * @since 2020 
 */

//  get header 
get_header();?>

<div class="container">
    <div class="row">
        <?php
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                        <div class="col-sm-6">
                            <div class="main-post">
                                <h3> <a href="<?php the_permalink() ?>"> <?php the_title() ?> </h3>
                                <span class="post-auther"> <i class="fa fa-user "></i> <?php the_author_posts_link() ?>, </span>
                                <span class="post-date"> <i class="fa fa-calendar "></i> <?php the_date() ?> at <?php the_time() ?> </span>
                                <span class="post-comment"> <i class="fa fa-comments "></i> <?php comments_popup_link('no comments' ,'one comment' , '% comments' , 'comment-url' , 'comment disabled') ?></span>
                                <hr>
                                <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post-Image']) ?>
                                <hr>
                                <div class="post-content" ><?php the_excerpt() ?></div>
                                <hr>
                                <p class="categories"> <i class="fa fa-tags fa-fw"></i><?php the_category(' , ') ?></p>
                                <p class="post-tags"> <?php if (has_tag() ):the_tags();} else { echo 'no tag can send';}?></p>
                            </div>
                        </div>
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

<?php get_footer();?>