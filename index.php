<?php get_header(); ?>
<section class="section-main">
	<div class="container">
		<main class="main">
				<?php
				if ( have_posts() ) :
		            $postsPerPage = 3;
		            $args = array(
		                    'post_type' => 'post',
		                    'posts_per_page' => $postsPerPage
		            );

		            $loop = new WP_Query($args);

		            while ($loop->have_posts()) : $loop->the_post(); ?>

					<article class="article-item">
		            
		            <?php if ( has_post_thumbnail() ) { ?>
		            <div class="article__thumb" style="background-image:url(<?php echo the_post_thumbnail_url(); ?> );"></div>
					<?php } ?>

		            <h2 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="article__excerpt"><?php the_excerpt(); ?></div>

		            <div class="article__controls">
		            	<span class="date"><i class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
		            	<span class="views"><i class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
		            	<span class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></span>
		            </div>

		        	<div class="article__tags"><i class="material-icons">&#xE892;</i>
		        		<?php
						$tags = get_tags(array(
						  'hide_empty' => false
						));
						foreach ($tags as $tag) {
						  echo '<a href="' . get_tag_link ($tag->term_id) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
						}
							      
						?>
		        	</div>
		        	</article>
					<?php endwhile;
        			wp_reset_postdata();
						endif;
					?>			
					<div id="ajax-posts"></div>
					<a id="more_posts" href="#" class="action-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Показать больше постов</a>
		</main>
		<aside class="sidebar">		
			<?php get_sidebar(); ?>
		</aside>
	</div>
</section>
<?php get_footer(); ?>