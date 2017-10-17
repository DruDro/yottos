<div class="sidebar__item sidebar__posts">
    <h2 class="sidebar__item-caption">Последние записи</h2>
    <ul class="sidebar__item-content sidebar__posts-list">
    <?php $the_query = new WP_Query( 'posts_per_page=10' ); ?>
     
    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
     
    	<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
     
    <?php 
    endwhile;
    wp_reset_postdata();
    ?>
    </ul>
</div>
<div class="sidebar__item sidebar__tags">
    <h2 class="sidebar__item-caption">Популярные тэги</h2>
    <div class="sidebar__item-content sidebar__tags-list">
    <?php 
        $tags = get_tags(array(
            'number'=>30
        ));
        foreach ( $tags as $tag ) {            
            echo '<a href="' . get_tag_link ($tag->term_id) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
        }
    ?>
    </div>
</div>