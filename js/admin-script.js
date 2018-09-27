
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
    }

    $(document).ready(initListener);
}(jQuery));