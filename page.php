<?php get_header(); ?>
<section class="section-main">
	<div class="container">
	    <article class="article">
	        <?php if (have_posts()): while (have_posts()): the_post(); ?>
	        	<?php setPostViews(get_the_ID()); ?>

		        <main class="article__content">
		            <?php the_content(); ?>
		        </main>
		        <footer class="article__footer">
				<div class="read-later-social">
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="Share on Facebook." class="fb"></a>
  <a href="http://vk.com/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&noparse=true" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="vk"></a>
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="gp"></a>
						<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!" class="tw"></a>
						<a href="http://www.linkedin.com/shareArticle?mini=true&title=<?php the_title(); ?>&url=<?php the_permalink(); ?>" title="Share on LinkedIn" class="in"></a>
						</div>
					
		        	<?php if(has_tag()) { ?>
		        	<div class="article__tags"><i class="material-icons">&#xE892;</i>
		        		<?php
						$tags = get_the_tags();
						foreach ($tags as $tag) {
						  echo '<a href="' . get_tag_link ($tag->term_id) . '" title="' . $tag->name . '" rel="tag">' . $tag->name . '</a>';
						}

						$postcats = get_the_category();
						$ccount=0;
						if ($postcats) {
							echo '<div class="article__tags"><i class="material-icons">&#xE892;</i>';
						    foreach($postcats as $cat) {
						        $ccount++;
						        echo '<a href="' . get_category_link ($cat->term_id) . '" title="' . $cat->name . '" rel="tag">' . $cat->name . '</a>';
						        if( $ccount >= 5 ) break; //change the number to adjust the count
						    }
						    echo '</div>';
						}
							      
						?>
		        	</div>
					<?php } ?>
		        </footer>
		        <section class="article__misc">
					<?php
						$orig_post = $post;
						global $post;
						$tags = wp_get_post_tags($post->ID);
						 
						if ($tags) {
							$tag_ids = array();
							foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
							$args=array(
								'tag__in' => $tag_ids,
								'post__not_in' => array($post->ID),
								'posts_per_page'=>4, // Number of related posts to display.
								'caller_get_posts'=>1
							);
					   
					  		$my_query = new wp_query( $args );
					 
					  		if( $my_query->have_posts() ) {?>

		        	<div class="related-posts">
						<h2>Ещё статьи по теме:</h2>
						<div class="related-items">

						  	<?php while( $my_query->have_posts() ) {
						  		 $my_query->the_post(); ?>
						  	
						   
							<div class="related-item">					
							    
								<a class="related-item__img" rel="external" href="<?php the_permalink()?>" style="background-image:url(<?php 
									if ( has_post_thumbnail() ) { 
										echo the_post_thumbnail_url(); 
									} else { 
										echo get_template_directory_uri() . '/assets/images/placeholder.jpg';
										} ?> );">&nbsp;</a>

					            <div class="article__controls">
					            	<span class="date"><i class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
					            	<span class="views"><i class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
									<?php if ( comments_open() || get_comments_number() ) : ?><a href="<?php the_permalink(); ?>#comments" class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></a> <?php endif;?>
					            </div>
								<h2 class="related-item__title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
							</div>
							<?php	
								}
							}
							$post = $orig_post;
							wp_reset_query(); ?>
						</div>
					</div>
					<?php }?>

					<?php if ( comments_open() || get_comments_number() ) : ?>
					<a id="comments" name="comments"></a>		
					<div class="article__comments">
						<h2>Комментарии</h2>
    						<?php comments_template(); ?>
						<div class="article__comments-form">

    						<?php 
    						function comment_form_submit_button($button) {
								$button =
								'<button class="action-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Оставить комментарий</button>' . get_comment_id_fields();
								return $button;
								}
								add_filter('comment_form_submit_button', 'comment_form_submit_button');
    						$comment_args = array( 
							'title_reply'=>'',
							'fields' => apply_filters( 'comment_form_default_fields', array(
								'author' => '<div class="input-field double"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label for="author" class="mdl-textfield__label">Ваше имя</label><input class="mdl-textfield__input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div>',
								'email'  => '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label for="email" class="mdl-textfield__label">Ваш e-mail</label><input class="mdl-textfield__input" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</div></div>',
								'url'    => '' ) ),
							'comment_field' => '<div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' . 
							'<label for="comment" class="mdl-textfield__label">Текст сообщения</label>' .
							'<textarea id="comment" name="comment" aria-required="true" class="mdl-textfield__input"></textarea>' . '</div>',
							'comment_notes_before' => '',
							'comment_notes_after' => '');
							comment_form($comment_args); ?>
						</div>
					</div>
					<?php endif; ?>
		        </section>
	        <?php endwhile; endif; ?>
	    </article>
	    <aside class="sidebar">
	        <?php get_sidebar(); ?>
	    </aside>
    </div>
</section>
<?php get_footer(); ?>