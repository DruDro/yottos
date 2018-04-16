<?php get_header(); ?>
<section class="section-main">
	<div class="container">
		<main class="main">
				<?php
				if ( have_posts() ) :
		            $args = array(
						'nopaging'               => false,
						'paged'                  => $paged,
						'posts_per_page'         => '5',
						'post_type'              => 'post'
		            );

		            $loop = new WP_Query($args);

		            while ($loop->have_posts()) : $loop->the_post(); ?>

					<article class="article-item">
		            
		            <?php if ( has_post_thumbnail() ) { ?>
		            <div class="article__thumb"><img src="<?php the_post_thumbnail_url(); ?>"></div>
					<?php } ?>

		            <h2 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="article__excerpt"><?php the_excerpt(); ?>  </div>

		            <div class="article__controls">
		            	<span class="date"><i class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
		            	<span class="views"><i class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
					<?php if ( comments_open() || get_comments_number() ) : ?><a href="<?php the_permalink(); ?>#comments" class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></a> <?php endif;?>
		            </div>

					<?php
						$posttags = get_the_tags();
						$count=0;
						if ($posttags) {
							echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
						    foreach($posttags as $tag) {
						        $count++;
						        echo '<a href="' . get_tag_link ($tag->term_id) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
						        if( $count >= 5 ) break; //change the number to adjust the count
						    }
						    echo '</div>';
						}
						$postcats = get_categories();
						$count=0;
						if ($postcats) {
							echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
						    foreach($postcats as $cat) {
						        $count++;
						        echo '<a href="' . get_category_link ($cat->term_id) . '" title="' . $cat->name . '" rel="tag">' . $cat->name . '</a>';
						        if( $count >= 5 ) break; //change the number to adjust the count
						    }
						    echo '</div>';
						}
					?>
		        	<p style="text-align:right; margin: 0; padding: 25px 0 0;"><a href="<?php the_permalink(); ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--primary">read more</a></p>
		        	</article>
					<?php endwhile;
        				wp_reset_postdata();
						endif;
					?>			
					<nav class="paging">
						<div class="nav-next"><?php previous_posts_link( '<i class="material-icons">&#xE408;</i> Следующие статьи' ); ?></div>
						<div class="nav-previous"><?php next_posts_link( 'Предыдущие статьи <i class="material-icons">&#xE409;</i>' ); ?></div>
					</nav>
		</main>
		<aside class="sidebar">		
			<?php get_sidebar(); ?>
		</aside>
	</div>
</section>
<?php get_footer(); ?>