
    // Popup
    $('.popup-link').click(function(e){
        e.preventDefault();
        var targetPopup = this.hash,
            $parentPopup = $(this).closest('.show');
        $(targetPopup).parent('.popup-wrap').addClass('show');
        if ($parentPopup.length !== 0) {
            $parentPopup.removeClass('show');
        }
        return false;
    }); 

    $(document).on("click", ".close-btn", function(){
        $(this).closest('.popup-wrap').removeClass('show');
    });

    $(document).on("click touchend", function(e) {
        if(!$(e.target).is(".popup") && !$(e.target).parents().is(".popup")){            
            $(".popup-wrap").removeClass("show");
        }
        
        if(!$(e.target).is("#subscriptionDrop") && !$(e.target).parents().is("#subscriptionForm")){            
            $('#subscriptionForm').removeClass('show');
        }
    });

    $(document).on("click", "#subscriptionDrop", function(e){
        e.stopPropagation();
        console.log('igor');
        $('#subscriptionForm').toggleClass('show');
    });