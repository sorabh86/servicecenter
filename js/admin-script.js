
;(function($) {
    'use strict';
    function initListener () {
        var $body = $('body');
        $body.on('click', '.btn-delete', function(e){
            var con = confirm("Item will be removed, Are you sure?");
            if(con) {
                return true;
            } else {
                return false;
            }
        });
        
        $(document['engineer-form']).on('submit', function(e){
            var $form = $(e.currentTarget),
                len = $form.find('input[name="expertise[]"]:checked').length;
            
            if(len>0) return true;
            else {
                $form.find('.skill-notice').removeClass('hide');
                setTimeout(function() {
                    $form.find('.skill-notice').addClass('hide');
                }, 2000);
                return false;
            }
        });
    }

    $(document).ready(initListener);
}(jQuery));