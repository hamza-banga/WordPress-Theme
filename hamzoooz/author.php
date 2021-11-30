<?php get_header() ?>
<div class="container author-page"><h1 class="profile-header text-center">
        "<?php the_author_meta('nickname') ?>" Page</h1>
    <div class="author-main-info">
        <div class="row ">
            <div class="col-md-3">
                <?php    
                    $avatar_arguments = array(
                        'class' => 'img-responsive img-thumbnail center-block avatar-class'
                        );  
                        echo get_avatar(get_the_author_meta('ID')  , 196 , '', '' , $avatar_arguments);
                    ?>
            </div>
            <div class="col-md-9">
                    <ul class="list-unstyled author-names">
                        <li> <span>First Name :</span> <?php the_author_meta('first_name') ?> </li>
                        <li><span>Last Name :</span> <?php the_author_meta('last_name') ?> </li>
                        <li><span>NickName :</span> <?php the_author_meta('nickname') ?> </li>
                    </ul>
                    <hr>
                    <?php 
                        if(get_the_author_meta('description')) { ?>
                        <p class="lead"> <?php the_author_meta('description') ?> </p>
                        <?php }else{
                            echo "Thers No Biography";
                        }
                    ?>
                    </div>
            </div>
    </div>
    <div class="row author-stats">
            <div class="col-md-3">
                <div class="stats">
                Post Count
                <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                    Comment Count
                <span>
                    <?php
                        $commentscount_arguments = array(
                            'user_ai' => get_the_author_meta('ID') ,
                            'count'   => true 
                        );
                        echo get_comments($commentscount_arguments);
                    ?>
                </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                        Total Post View
                <span>0</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                        Test 
                <span>0</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row the-author-posts">
                <?php
                $author_posts_arguments = array(
                    'author'            => get_the_author_meta('ID'),
                    'posts_per_page'    => -1 // 5
                );
                $author_posts  = new wp_Query($author_posts_arguments);
                if($author_posts -> have_posts()){ ?> 
                <h3 class="h3"><?php the_author_meta('nickname') ?> Posts</h3>
                <?php
                    while($author_posts -> have_posts()){
                        $author_posts ->the_post(); ?>
                        <div class="author-posts">
                            <div class="col-sm-3">
                                <?php the_post_thumbnail('' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post-Image']) ?>
                            </div>
                            <div class="col-sm-9">
                                <h3>
                                    <a href="<?php the_permalink() ?>">
                                    <?php the_title() ?>
                                </h3>
                                <span class="post-date">
                                    <i class="fa fa-calendar "></i> <?php the_date() ?> at <?php the_time() ?>
                                </span>
                                <span class="post-comment">
                                    <i class="fa fa-comments "></i>
                                    <?php comments_popup_link('no comments' ,'one comment' , '% comments' , 'comment-url' , 'comment disabled') ?>
                                </span>
                                <!-- <hr> -->
                                <br>
                                <br>
                                <div class="post-content" >
                                    <?php the_excerpt() ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php                    
                    }
                }
                wp_reset_postdata();
                $comments_per_page = 20;
                $comments_arguments = array(
                    'user_id'       => get_the_author_meta('ID'),
                    'status'        => 'approve',
                    'number'        => $comments_per_page,
                    'post_type'     => 'publish',
                    'post_type'     => 'post'
                );
                $comments = get_comments($comments_arguments);
                ?><h2 class="author-title">The Comment </h2><?php
                if($comments){
                    foreach ($comments as $comment ) { ?>
                    <div class="author-title">
                        <h3 class="post-title">
                            <a href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                                <?php echo get_the_title( $comment->comment_post_ID ) ?>
                            </a>
                        </h3>
                        <span class="post-date">
                            <i class="fa fa-calendar fa-fw"></i>
                            <?php echo 'Added On' . mysql2date('l , F j ,Y ' , $comment->comment_date); ?>
                        </span>
                        <div class="post-content lead">
                        <?php echo $comment->comment_content ?>
                        </div>
                    </div>
                    <?php
                    }
                }else{
                    echo 'This Author Dont Have Any Comments';
                }
                ?>
            </div>
    </div>
<?php get_footer() ?>