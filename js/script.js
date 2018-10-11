;(function(so) {
  'use strict';
    var $flash = $('.flash-msg');
    var $html = $('<div class="alert alert-dismissible" style="cursor:pointer" role="alert" data-dismiss="alert">\
        <span class="msg">Better check yourself, you\'re not looking too good.<span>\
      </div>');

    so.flash = function (type,msg){
        switch (type) {
            case 'success':
                $html.addClass('alert-success');
                break;
            case 'error':
                $html.addClass('alert-error');
                break;
            case 'warning':
                $html.addClass('alert-warining');
                break;
            case 'info':
                $html.addClass('alert-info');
                break;
        }
        $html.html(msg);
        $flash.append($html);
    };

    so.render = {
        doctorSelectOption : function (arr) {
            var html = "";
            for (var str in arr) {
                html += '<option value="'+arr[str].id+'">'+arr[str].name+'</option>';
            }
            return html;
        }
    }; 
})(window.so = window.so || {});

(function ($) {
    var $registerForm = $(document.forms['customer-register']);
    var $loginForm = $(document.forms['customer-login']);
    var $changePassword = $(document.forms['change-password']);
    var $bookAppForm = $(document.forms['book-appointment']);
    var $contactForm = $(document.forms['contact-form']);
    
    if($contactForm) {
        $contactForm.validate({
            rules: {
                name : {
                    minlength:6
                }, phone : {
                    number:true,
                    required:true,
                    minlength:10
                }, message : {
                    minlength:12
                }
            },
            messages: {
                phone: {
                    required: "We need your phone number to contact you",
                    minlength: jQuery.validator.format("At least {0} characters required!")
                }
            }
        })
    }
    if($registerForm) {
        $registerForm.validate({
            rules: {
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                }
            }
        });
    }
    if($changePassword) {
        $changePassword.validate({
            rules: {
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                }
            }
        });
    }
    if ($loginForm) {
        $loginForm.validate();
    }
    if($bookAppForm) {
        $bookAppForm.validate({
            rules : {
                appointment_hour: {
                    min: 1,
                    max: 4
                }
            }
        });
    }

    console.log('script running');

    $('.newletter form').submit(function(e){
        e.stopPropagation();
        var $this = $(e.currentTarget);

        $.ajax({
            url: SC_URL+'/subscriber/add',
            type: 'POST',
            data: {
                email : $this.find('input[name=email]').val()
            }
        }).success(function(s){
            var s = JSON.parse(s);
            $statusMsg = $('#status-msg');
            $statusMsg.find('.modal-title').html(s.status);
            $statusMsg.find('.modal-body').html(s.message);
            $statusMsg.modal();
        });
        
        return false;
    });

    // loading ajax
    $('#loading-image').bind('ajaxStart', function(){
        $(this).show();
    }).bind('ajaxStop', function(){
        $(this).hide();
    });

    /* book an appointment form name=book-appointment */
    if(document.forms['book-appointment']) {
        $(document.forms['book-appointment']['expertise_id']).change(function(e){
            var $this = $(e.currentTarget);
            $.ajax({
                url: SC_URL+'/patient/drexpertise',
                type: 'POST',
                data: {
                    id : $this.val()
                }
            }).success(function(s){
                s = JSON.parse(s);
                if(s.id) {
                    $(document.forms['book-appointment']).find('#dr-exp-desc').html(s.description);
                    $.ajax({
                        url: SC_URL+'/patient/drbyexpertise',
                        type: "POST",
                        data: {
                            expertise_id:$this.val()
                        }
                    }).success(function(s){
                        $.ajax({
                            url: SC_URL+'/doctor/expertiseidjson/'+$this.val(),
                            type: "POST",
                        }).success(function(s){
                            s = JSON.parse(s);
                            $docSelect = $(document.forms['book-appointment']['doctor_id']);
                            $docSelect.not(':first').remove();
                            $docSelect.append(so.render.doctorSelectOption(s));
                            $docSelect.val(window.appointment.doctor_id).change();
                        });
                    });
                }
            });
            return false;
        });
        if(window.appointment) {
            $(document.forms['book-appointment']['appointment_type']).val(window.appointment.appointment_type).change();
            $(document.forms['book-appointment']['expertise_id']).val(window.appointment.expertise_id).change();
        }
    }


    /* login by using ajax call */
    $(document.forms['widget-login']).on('submit', function(e){
        var form = e.currentTarget;
        
        $.ajax({
            url : SC_URL+'ajax/login',
            type : 'POST',
            data: {
                username : form.username.value,
                password : form.password.value
            },
            success: function(d){
                d = JSON.parse(d);
                if(d.error) {
                    $(form).prepend('<div class="alert alert-danger alert-dismissible" style="cursor:pointer" role="alert" data-dismiss="alert">\
                        <span class="msg">'+d.error+'<span>\
                    </div>');
                    console.log(d.error);
                    return;
                }

                window.location.href = SC_URL+'customer';
            }
        });

        return false;
    });

    /* controlling login-dropdown window manually */
    $('li.dropdown.login-dropdown a').on('click', function (event) {
        $(this).parent().toggleClass('open');
    });
    $('body').on('click', function (e) {
        if (!$('li.dropdown.login-dropdown').is(e.target) &&
            $('li.dropdown.login-dropdown').has(e.target).length === 0 &&
            $('.open').has(e.target).length === 0
        ) {
            $('li.dropdown.login-dropdown').removeClass('open');
        }
    });

    $('#alt-address').on('change', function(e){
        if($(this).prop('checked')) {
            $('#alt-address-box').addClass('hide');
            console.log('is checked');
        } else {
            $('#alt-address-box').removeClass('hide');
            console.log('is not checked');
            
        }
        console.log('checked called');
            
    });

    var $addMaintenanceForm = $(document.forms['add-maintenance']);
    $addMaintenanceForm.find('[name=duration]').on('change', function (e) {
        var $this = $(this);
        var $priceInput = $addMaintenanceForm.find('[name=price]');
        var price = $priceInput.val();
        var duration = $this.val();

        $addMaintenanceForm.find('.price').html(price+' X '+duration+' = <strong>'+(price*duration)+'</strong>');
    });


    /* pagination related code */
    var $paginationForm = $(document.forms['pagination-form']);
    $paginationForm.find('[name="limit"]').on('change',function(){
        $paginationForm.submit();
    });
    $('.page-change').on('click', function() {
        var form = document.forms['pagination-form'];
        form.offset.value = parseInt($(this).html())-1;
        $(form).submit();
        
        return false;
    });
})(jQuery);

