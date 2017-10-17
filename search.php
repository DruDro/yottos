<?php get_header(); ?>
<section class="section-main">
	<div class="container">
		<main class="main">
			<?php
				$allsearch = new WP_Query("s=$s&showposts=0"); 
				$heading = '<h2 class="search-heading">Найдено результатов: '. $allsearch ->found_posts . '</h2>';

				echo $heading;
			 ?>
				<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

					<article class="article-item">
		            

		            <?php if ( has_post_thumbnail() ) { ?>
		            <div class="article__thumb"><img src="<?php the_post_thumbnail_url(); ?>"></div>
					<?php } ?>

		            <h2 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="article__excerpt"><?php the_excerpt(); ?></div>

		            <div class="article__controls">
		            	<span class="date"><i class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
		            	<span class="views"><i class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
		            	<span class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></span>
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
					?>
		        	</article>
					<?php endwhile;
						endif;
					?>			
		</main>
		<aside class="sidebar">		
			<?php get_sidebar(); ?>
		</aside>
	</div>
</section>
<?php get_footer(); ?>