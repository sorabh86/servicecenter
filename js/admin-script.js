;(function(so) {
  'use strict';
    so.blockDiv = function($div) {
        if($div.find('.gif-loader').length>0) return;

        $div.css('position','relative');
        $div.append('<div class="gif-loader"></div>');
    }   
    so.unblockDiv = function($div) {
        $div.css('position', '');
        $div.find('.gif-loader').remove();
    } 
})(window.so = window.so || {});

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
        
        $(document.forms['engineer-form']).on('submit', function(e){
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

        var mainForm = document.forms['add_maintenanceservice_form'];
        if (mainForm) {
            $(mainForm.device_id).on('change', function (e) {
                var $this = $(e.currentTarget);
                var catid = $this.find(':selected').data('catid');
                var $engSelect = $(document.forms['add_maintenanceservice_form'].engineer_id)
                var $engDiv = $engSelect.parent();
                
                so.blockDiv($engDiv);
    
                $.ajax({
                    url: SC_URL +'ajax/get_engineer_by_expertise',
                    type:'POST',
                    data:{
                        device_category_id:catid
                    }, success:function(d) {
                        try {
                            d = JSON.parse(d);
                            $engSelect.empty();
                            for (var n in d) {
                                $engSelect.append('<option value="' + d[n].id + '">' + d[n].name + '</option>');
                            }
                        } catch(e) {
                            alert('Error: Invalid data');
                        }                    
                        so.unblockDiv($engDiv);
                    }, error: function(e) {
                        console.log(e);
                        
                        alert('Error: Fetching to server');
                        setTimeout(function(){so.unblockDiv($engDiv);},1000);
                    }
                })
                
            });
        }

        var partBillForm = document.forms['part-bill-form'];
        if(partBillForm) {
            $(partBillForm).on('submit', function(e){
                var checked = false;
                document.forms['part-bill-form'].elements.namedItem('parts[]').forEach(function (i) {
                    if(i.checked) {
                        checked = true;
                        return false;
                    }
                });

                if(!checked) {
                    alert('Please tick atleast one entry from Add Bill');
                }
                return checked;
            });
        }
    }

    $(document).ready(initListener);
}(jQuery));