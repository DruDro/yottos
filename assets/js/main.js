//=======YOTTOS JAVASCRIPT=======//
var $ = jQuery;

$(window).on("load resize", function() {
    var fh = $('.footer').height();
    $('body').css("paddingBottom", fh);
});

$(function() {
    /**
     * Check the validity state and update field accordingly.
     *
     * @public
     */
    MaterialTextfield.prototype.checkValidity = function() {
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

    $(document).on('mouseup touchend', function(e) {
        if (!$(e.target).closest('.flexMenu-popup, .flexMenu-popup *, .flexMenu-viewMore > a').length) {
            $('.flexMenu-popup').slideUp(300);
        }
    });

    shadyHeader();

    $(window).scroll(function() {
        shadyHeader();
    });


    // Dropdown
    $('.dropdown-submenu .dropdown-toggle').on("click", function(e) {

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
    $('.popup-link').click(function(e) {
        e.preventDefault();
        var targetPopup = this.hash,
            $parentPopup = $(this).closest('.show');
        $(targetPopup).parent('.popup-wrap').addClass('show');
        if ($parentPopup.length !== 0) {
            $parentPopup.removeClass('show');
        }
        return false;
    });

    $(document).on("click", ".close-btn", function() {
        $(this).closest('.popup-wrap').removeClass('show');
    });

    $(document).on("mouseup touchend", function(e) {
        if (!$(e.target).is(".popup") && !$(e.target).parents().is(".popup")) {
            $(".popup-wrap").removeClass("show");
        }
    });

    $('.js-read-later').click(function(e) {
        e.preventDefault();
        e.stopPropagation;
        $('#readLater').slideToggle(300);
        $(this).toggleClass('open');
        return false;
    });
    $(document).on("click", ".delete-file", function(e) {
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



$(function() {
    var $contactForm = $('#contactForm');

    //AJAX
    var request;

    $contactForm.submit(function(event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        var fileInput = $('#files').prop('files')[0];
        var myFormData = new FormData();
        myFormData.append('files', fileInput);
        $.ajax({
            url: '../wp-content/themes/yo/fileUpload.php',
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            dataType: 'json',
            data: myFormData,
            success: function(jsonData) {
                if (jsonData.url) {
                    alert(jsonData.url);
                    document.getElementById('hFiles').value = jsonData.url;
                }
                var $inputs = $contactForm.find("input, textarea, button");

                var serializedData = $contactForm.serialize();

                $inputs.prop("disabled", true);

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "../wp-content/themes/yo/contactForm.php",
                    type: "post",
                    data: serializedData
                });

                // Callback handler that will be called on success
                request.done(function(response, textStatus, jqXHR) {
                    // Log a message to the console
                    $contactForm.append(response);
                });

                // Callback handler that will be called on failure
                request.fail(function(response, jqXHR, textStatus, errorThrown) {
                    // Log the error to the console
                    console.error(
                        "The following error occurred: " +
                        textStatus, errorThrown
                    );
                    $contactForm.append('<div>Ошибка</div>');
                });

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function() {
                    // Reenable the inputs
                    $inputs.prop("disabled", true).css("cursor", "not-allowed");
                });
                return false;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(xhr.responseText);
                alert(thrownError);
            }
        });
    });
});