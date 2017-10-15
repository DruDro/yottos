<?php get_header(); ?>
<section class="section-main">
	<div class="container">
	    <article class="article">
	        <?php if (have_posts()): while (have_posts()): the_post(); ?>
	        	<?php setPostViews(get_the_ID()); ?>
		        <header class="article__header">
		            <h1 class="article__title"><?php the_title(); ?></h1>
		            
		            <?php if ( has_post_thumbnail() ) { ?>
		            <div class="article__thumb" style="background-image:url(<?php echo the_post_thumbnail_url(); ?> );"></div>
					<?php } ?>

		            <div class="article__controls">
		            	<span class="date"><i class="material-icons">&#xE916;</i><span><?php echo get_the_date(); ?></span></span>
		            	<span class="views"><i class="material-icons">&#xE417;</i><span><?php echo getPostViews(get_the_ID()); ?></span></span>
		            	<span class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></span>
		            </div>

		            <div class="article__postpone">
		            	<span class="time-to-read"><i class="material-icons">&#xE192;</i><span>Время на чтение:</span><span class="time"><?php echo estimated_reading_time(); ?></span></span>
		            	<a href="#" class="js-read-later">Нет времени читать?</a>
		            	<div id="readLater">
			            	<a href="mailto:?subject=YOTTOS | <?php the_title(); ?>&amp;body=Почитай статью <?php the_permalink(); ?>" class="to-mail"><i><img src="<?php echo get_template_directory_uri() . '/assets/images/mail.svg'?>" alt=""></i><span>На почту</span></a>
			            	<a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php the_title(); ?>&url=<?php the_permalink(); ?>" class="to-flipboard" onclick="event.preventDefault(); window.open(this.href, 'Popup', 'location,status,scrollbars,resizable');"><i><img src="<?php echo get_template_directory_uri() . '/assets/images/flipboard.svg'?>" alt=""></i><span>На Flipboard</span></a>
			            	<a href="https://getpocket.com/edit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="to-pocket"  onclick="event.preventDefault(); window.open(this.href, 'Popup', 'center,status,scrollbars,resizable)');"><i><img src="<?php echo get_template_directory_uri() . '/assets/images/pocket.svg'?>" alt=""></i><span>В Pocket</span></a>
		            	</div>

		        		<!-- Go to www.addthis.com/dashboard to customize your tools --> 
		        		<div class="addthis_inline_share_toolbox"></div>
		            </div>

		        </header>
		        <main class="article__content">
		            <?php the_content(); ?>
		        </main>
		        <footer class="article__footer">
		        	<!-- Go to www.addthis.com/dashboard to customize your tools --> 
		        	<div class="addthis_inline_share_toolbox"></div>
		        	<?php if(has_tag()) { ?>
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
					            	<span class="comments"><i class="material-icons">&#xE24C;</i><span><?php comments_number( '0', '1', '%' ); ?></span></span>
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