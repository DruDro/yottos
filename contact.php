
 <?php 
 /*
Template Name: Contact Page
*/

 get_header(); 
?>

<section class="section-main">
	<div class="container">
	    <article class="article">
		    <header class="article__header">
		        <h1 class="article__title"><?php the_title(); ?></h1>
		    </header>
		    <main class="article__content">

				<form id="contactForm" action="" method="post" enctype="multipart/form-data">

					<div class="input-field required"> 
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<label for="name" class="mdl-textfield__label">Имя</label>
							<input name="name" type="text" value="" required class="mdl-textfield__input" />
						</div>
						<div class="required"><span>обязательно</span></div>
					</div>
					<div class="input-field required"> 
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<label for="email" class="mdl-textfield__label">E-Mail</label>
							<input name="email" type="email" value="" required class="mdl-textfield__input" />
						</div>
						<div class="required"><span>обязательно</span></div>
					</div>
					<div class="input-field required"> 
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<label for="phone" class="mdl-textfield__label">Телефон</label>
							<input name="phone" type="tel" value="" required class="mdl-textfield__input" />
						</div>
						<div class="required"><span>обязательно</span></div>
					</div>
					<div class="input-field"> 
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<label for="subject" class="mdl-textfield__label">Тема</label>
							<input name="subject" type="text" value="" class="mdl-textfield__input" />
						</div>
					</div>
					<div class="input-field"> 
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<label for="message" class="mdl-textfield__label">Текст сообщения</label>
							<textarea id="message" name="message" aria-required="true" class="mdl-textfield__input"></textarea>
						</div>

					</div>
					<div class="input-field files">
						<input type="file" name="files" id="files" onchange="javascript:updateList();" multiple>
						<input type="text" id="hFiles" name="hFiles" style="display:none">
						<label class="action-link btn-default mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" for="files">Прикрепить файл</label>
						<div id="fileList"></div>
					</div>
					<div class="input-field submit-field">
						<input id="submit" name="submit_form" type="submit" value="Отправить" class="action-link mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					</div>
				</form>
				<div class="contact__footer">
					<p>*Зачем заполнять контактные данные, e-mail, телефон?</p>
					<p>Мы считаем, что будет правильно дать вам обратную связь по вашей инициативе и держать вас в курсе о решении вашего вопроса!</p>
				</div>
		    </main>
	    </article>
	    <aside class="sidebar">
	        <?php 
				get_sidebar();
			?>
	    </aside>
    </div>
</section>
<?php get_footer(); ?>

