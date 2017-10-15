$(function(){
	var lmPos = $('#more_posts').length ? $('#more_posts').offset().top : false;
    $("#more_posts").on("click",function(e){ // When btn is pressed.
    	e.preventDefault();
        $("#more_posts").attr("disabled",true).html('Загрузка'); // Disable the button, temp.
        load_posts();
    });

	var ppp = 3; // Post per page
	var pageNumber = 1;
	var $loader = $('#more_posts');


    function load_posts(){
        pageNumber++;
        var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
        $.ajax({
            type: "POST",
            dataType: "html",
            url: php_vars.ajaxurl,
            data: str,
            success: function(data){
                var $data = $(data);
                if($data.length){
                    $("#ajax-posts").append($data);
                    $("#more_posts").attr("disabled",false).html('Показать больше постов');
                    $('#ajax-posts').trigger("change");
                } else{
                    $("#more_posts").html('Нет постов').fadeOut(300);
                }                
            },
            error : function(jqXHR, textStatus, errorThrown) {
                $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }

        });
        return false;
    }
    $('body').on("change","#ajax-posts",function(){
    	$('body').animate({scrollTop: lmPos - 80},500);
    	lmPos = $('#more_posts').offset().top;
    });
});