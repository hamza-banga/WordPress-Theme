<?php 
    if(comments_open() ) {  // Check Comment Open 
        echo '<ul class="list-unstyled comments-list">';?>

        <h3><?php comments_number() ?></h3>
        <?php
        $comments_arguments = array(
        'max_depth'     => 5,
        'type'          => 'comment',
        'avatar_size'   => 64
        );

        wp_list_comments($comments_arguments);
        echo '</ul>';
        echo '<hr class="comment-separator">';
        comment_form();

    }else{
        echo  'Sorry Comments Are Disabled';
    }
?>