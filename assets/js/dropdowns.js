$(function() {
    var $dropdownLinks = $('.js-dropdown'),
        $dropdownConts = $('.js-dropdown-cont');
    $dropdownConts.hide();
    $('.js-dropdown').click(function(e) {
        e.preventDefault();
        
        var $dropdownLink = $(this),
            $dropdownCont = $(this.hash);

        if(!$dropdownCont.hasClass('dropped')){            
            $dropdownCont.fadeIn(300).addClass('dropped');
            $dropdownLink.addClass('dropped');            
        } else {
            $dropdownCont.fadeOut(300).removeClass('dropped');
            $dropdownLink.removeClass('dropped');              
        }
     
        $dropdownConts.not($dropdownCont).fadeOut(300).removeClass('dropped');
        $dropdownLinks.not($dropdownLink).removeClass('dropped');     
        
        $(window).resize();

        return false;
    });

    $(document).on('mouseup touchend', function(e) {
        if (!$(e.target).closest('.dropdown, .dropdown *, js-dropdown').length) {
            $dropdownConts.fadeOut(300).removeClass('dropped');            
            $dropdownLinks.removeClass('dropped');            
        }
    });


});