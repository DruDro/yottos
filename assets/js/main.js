//=======YOTTOS JAVASCRIPT=======//
var $ = jQuery;

$(window).on("load resize", function () {
    var fh = $('.footer').height();
    $('body').css("paddingBottom", fh);
});

$(function () {
    $("img").error(function () {
        $(this).hide();
    });
    /**
     * Check the validity state and update field accordingly.
     *
     * @public
     */
    MaterialTextfield.prototype.checkValidity = function () {
        if (this.input_.validity.valid) {
            this.element_.classList.remove(this.CssClasses_.IS_INVALID);
        } else {
            if (this.element_.getElementsByTagName('input')[0].value.length > 0) {
                this.element_.classList.add(this.CssClasses_.IS_INVALID);
            }
        }
    };
    $('#top-menu ul').flexMenu({
        linkText: 'Еще',
        linkTextAll: 'Еще',
        cutoff: 1
    });

    $(document).on('mouseup touchend', function (e) {
        if (!$(e.target).closest('.flexMenu-popup, .flexMenu-popup *, .flexMenu-viewMore > a').length) {
            $('.flexMenu-popup').slideUp(300);
        }
    });

    shadyHeader();

    $(window).scroll(function () {
        shadyHeader();
    });


    // Dropdown
    $('.dropdown-submenu .dropdown-toggle').on("click", function (e) {

        $(this).closest('.dropdown').toggleClass('open');

        e.stopPropagation();
        e.preventDefault();

    });


    //SmoothScroll
    function shadyHeader() {

        var header = $('header'),
            headerPos = header.offset().top,
            breakpoint = $(window).innerHeight() - 80;

        if (headerPos > breakpoint) {
            header.addClass('shady');
        } else {
            header.removeClass('shady');
        }
    }


    // Popup
    $('.popup-link').click(function (e) {
        e.preventDefault();
        var targetPopup = this.hash,
            $parentPopup = $(this).closest('.show');
        $(targetPopup).parent('.popup-wrap').addClass('show');
        if ($parentPopup.length !== 0) {
            $parentPopup.removeClass('show');
        }
        return false;
    });

    $(document).on("click", ".close-btn", function () {
        $(this).closest('.popup-wrap').removeClass('show');
    });

    $(document).on("mouseup touchend", function (e) {
        if (!$(e.target).is(".popup") && !$(e.target).parents().is(".popup")) {
            $(".popup-wrap").removeClass("show");
        }
    });
    $('#readLater').on("submit", function(e){
        e.preventDefault();
        $('#readLater').hide();
        $('#thanks').show();
    });
    $('#closeReadLater').click(function(){
        $('#readLater').closest('.popup-wrap').removeClass('show');
    });
    $('#subscriptionForm').on("submit", function(e){
        e.preventDefault();
        $('#subscriptionForm').hide();
        $('#thanksSubscription').addClass('show');
    });
    $('#closeSubscription').click(function(){
        $('.subscription').remove();
    });
    $(document).on("click", ".delete-file", function (e) {
        e.preventDefault();
        var inputReplace = $('<input type="file" name="files" id="files" class="newInput" onchange="javascript:updateList();" multiple>');
        var input = $('#files');
        input.replaceWith(inputReplace);
        updateList();
    });
});



function updateList() {
    var input = document.getElementById('files');
    var output = document.getElementById('fileList');

    var fileList = [];
    fileList = input.files;
    output.innerHTML = '';
    for (var i = 0; i < fileList.length; i++) {
        output.innerHTML += '<span class="file-item"><span>' + fileList.item(i).name + '</span><a href="#" class="delete-file"><i class="material-icons">&#xE5CD;</i></a></span>';
    }
}


$(function () {
    $(document).on("change", "#files", function () {
        updateList();
    });
});