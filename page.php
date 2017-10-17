<?php get_header(); ?>
<section class="section-main">
	<div class="container">
	    <article class="article">
	        <?php if (have_posts()): while (have_posts()): the_post(); ?>
	        	<?php setPostViews(get_the_ID()); ?>
		        <header class="article__header">
		            <h1 class="article__title"><?php the_title(); ?></h1>

		            <?php if ( has_post_thumbnail() ) { ?>
		            <div class="article__thumb"><img src="<?php the_post_thumbnail_url(); ?>"></div>
					<?php } ?>

		        </header>
		        <main class="article__content">
		            <?php the_content(); ?>
		        </main>
		        <section class="article__misc">
					<?php if ( comments_open() || get_comments_number() ) : ?>
					<div class="article__comments">
						<h2>Комментарии</h2>
    						<?php comments_template(); ?>
						<div class="article__comments-form">
    						<?php $comment_args = array( 
							'title_reply'=>'',
							'fields' => apply_filters( 'comment_form_default_fields', array(
								'author' => '<div class="input-field double"><input id="author" name="author" placeholder="Ваше имя" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
								'email'  => '<input id="email" placeholder="Ваш e-mail" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</div>',
								'url'    => '' ) ),
							'comment_field' => '<div class="input-field">' . 
							'<textarea id="comment" name="comment" placeholder="Текст сообщения" aria-required="true"></textarea>' . '</div>',
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
	        <?php 
				get_sidebar();
			?>
	    </aside>
    </div>
</section>
<?php get_footer(); ?>