<?php

    // Get Category Count

    $comments_agrs = array(
        'status'        =>  'approve', // Only Approved Comments
    );
    $comments_count =0; // Start from Zero
    $all_comment = get_comments($comments_agrs); //Get All Comment
    foreach($all_comment as $comment){
        $post_id = $comment->comment_post_ID;//get post id do comment
        if(! in_category('linux' , $post_id)) {  //check if post Not in linux category
            continue; // continue loop
        }
        $comments_count++;  //counter
    }
    // Get Category post Count 
    $cat = get_queried_object();  // Get Full object propertiese
    $posts_count = $cat->count;  // Get posts _count 
?>

<div class="sidebar-linux">
    <div class="widget">
        <h3 class="widget-title"> <?php single_cat_title() ?> Statistics </h3>
        <div class="widget-content">
            <ul>
                <li>
                    <span>Comments Count</span>: <?php echo $comments_count ?>
                </li>
                <li>
                    <span>Posts Count</span>: <?php echo $posts_count ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">Latest Hot PHP </h3>
        <div class="widget-content">
            <ul>

            <?php
                $posts_argsy = array(
                    'posts_per_page'    =>  3,
                    'cat'               =>  5 //id cadegory
                );

                $query = new WP_Query($posts_argsy);
                if($query->have_posts()){
                
                    while($query->have_posts()){
                        $query->the_post() ?>
                        <li>
                            <a target="_blank" href="<?php echo the_permalink() ?> "><?php the_title() ?> </a>
                        </li>
                    <?php
                    }
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">Hot Topic</h3> <!-- can get hot Comment -->
        <div class="widget-content">
        <ul>
<?php
    $hotposts_args = array(
        'posts_per_page'    =>  3,
        'orderby'           =>  'comment_count'
        // 'cat'               =>  5  // id cadegory
    );

    $hotquery = new WP_Query($hotposts_args);
    if($hotquery->have_posts()){
    
        while($hotquery->have_posts()){
            $hotquery->the_post() ?>
            <li>
                <a target="_blank" href="<?php echo the_permalink() ?> "><?php the_title() ?> </a>
            </li>
            <?php comments_popup_link('no comments' ,'one comment' , '% comments' , 'comment-url' , 'comment disabled') ?>
            <hr>
            <?php
        }
    }
?>
</ul>
        </div>
    </div>
</div>