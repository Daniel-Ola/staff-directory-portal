$(function() {
    $('.material-card > .mc-btn-action').click(function () {
        var card = $(this).parent('.material-card');
        var icon = $(this).children('i');
        icon.addClass('fa-spin-fast');

        if (card.hasClass('mc-active')) {
            card.removeClass('mc-active');

            window.setTimeout(function() {
                icon
                    .removeClass('fa-arrow-left')
                    .removeClass('fa-spin-fast')
                    .addClass('fa-bars');

            }, 800);
        } else {
            card.addClass('mc-active');

            window.setTimeout(function() {
                icon
                    .removeClass('fa-bars')
                    .removeClass('fa-spin-fast')
                    .addClass('fa-arrow-left');

            }, 800);
        }
    });
    
    // profile view function
    $(document).on('click', '.fetchProfile', function(e){
        let btn = $(this);
        let id = $(this).attr('user');
        let spin = '<i class="fa fa-spin fa-cog"></i>';
        let user = '<i class="fa fa-user"></i>';
        let url = '/getProfile';
        let token = $("meta[name='csrf-token']").attr('content');
        $(this).html(spin);
        $.post(url, {
            'id': id,
            '_token': token
        }).done(function(data){
            data = data[0];
            fname = data.firstname;
            lname = data.lastname;
            email = data.email;
            dp = data.dp;
            phone = data.phone ? data.phone : 'not set' ;
            sub = data.subsidiary ? data.subname : 'not set';
            desig = data.designation ? data.desname : 'not set';
            $('#staffName').text(fname+' '+lname);
            $('#staffMail').text(email);
            $('#staffSub').text(sub);
            $('#staffDesig').text(desig);
            $('#staffPhone').text(phone);
            $('#staffImg').attr('src', '../'+dp);
            btn.html(user);
            $('#myModal').modal('show');
        });
    });




    (function ($) {
        $.fn.serializeFormJSON = function () {
    
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);



     // profile update function
     $(document).on('click', '.updateProfile', function(e){
        e.preventDefault();
       let btn = $(this);
       let input = btn.attr('in');
       let output = btn.attr('out');
       let count = btn.attr('count');
       let form = $('#'+btn.attr('form'));
       let id = form.find('input[name="id"]').val();
       let spin = '<i class="fa fa-spin fa-cog"></i>';
       let save = '<i class="fa fa-save"></i>';
       let url = '/updateProfile';
       let token = $("meta[name='csrf-token']").attr('content');
       let data = form.serializeFormJSON();
       data._token = token;
       $(this).html(spin);
       $.post(url, data).done(function(data){
           data = data[0];
           email = data.email;
           phone = data.phone ? data.phone : '' ;
           sub = data.subname ? data.subname : '';
           desig = data.desname ? data.desname : '';
           $('#email'+count).text(email);
           $('#sub'+count).text(sub);
           $('#desig'+count).text(desig);
           $('#phone'+count).text(phone);
           btn.html(save);
           btn.toggle();
           let fa = $('.noEditBtn').find('i.fa');
           fa.toggleClass('fa-times');
           fa.toggleClass('fa-pencil');
           $(input).hide();
           $(output).show();
       });
   });

     // profile delete function
     $(document).on('click', '.deleteProfile', function(e){
         e.preventDefault();
        let ask = confirm('This user will be deleted permanently. Do you still want to continue?');
        if(ask == true) {
            let btn = $(this);
            let count = btn.attr('count');
            let id = $(this).attr('user');
            let form = $('#'+btn.attr('form'));
            let spin = '<i class="fa fa-spin fa-cog"></i>';
            let del = '<i class="fa fa-trash"></i>';
            let url = '/deleteProfile';
            let token = $("meta[name='csrf-token']").attr('content');
            let data = form.serializeFormJSON();
            data._token = token;
            $(this).html(spin);
            $.post(url, {
                'id': id,
                '_token': token
            }).done(function(data){
                $(btn.attr('remove')).remove();
                btn.html(del);
            });

        }
    });

    $(document).on('click', '.noEditBtn', function(e) {
        let td = $(this);
        let fa = td.find('i.fa');
        fa.toggleClass('fa-times');
        fa.toggleClass('fa-pencil');

        $('.updateProfile').toggle();

        $(td.attr('select1')).val($(td.attr('select2')).val());
        $(td.attr('deselect1')).val($(td.attr('deselect2')).val());

        $('#profile-sub-edit').val($('#profile-settings-sub').val());
        
        let input = td.attr('in');
        let output = td.attr('out');
        $(input).toggle();
        $(output).toggle();
        let inId = td.attr('inId');
        fa.hasClass('fa-pencil') ? $(inId).blur() : $(inId).focus();
    });

    let doc = $(document);

    doc.on('click', '.deleteAnn', function(e) {
        const form = $(this);
        const formId = '#'+form.attr('form');
        const question = form.attr('subject')+ "\r\n\r\nDo you really want to delete this anouncement?\r\nYou cannot undo this action.";
        let ask = confirm(question);
        if(ask) {
            $(formId).submit();
        } else {
            e.preventDefault();
        }
    });

    doc.on('click', '.deleteAnn', function(e) {
        const form = $(this);
        const formId = '#'+form.attr('form');
        const question = form.attr('subject')+ "\r\n\r\nDo you really want to delete this anouncement?\r\nYou cannot undo this action.";
        let ask = confirm(question);
        if(ask) {
            $(formId).submit();
        } else {
            e.preventDefault();
        }
    });

    doc.on('click', '.deletePol', function(e) {
        const form = $(this);
        const formId = '#'+form.attr('form');
        const question = form.attr('subject')+ "\r\n\r\nDo you really want to delete this policy?\r\nYou cannot undo this action.";
        let ask = confirm(question);
        if(ask) {
            $(formId).submit();
        } else {
            e.preventDefault();
        }
    });

    doc.on('click', '.removeRole', function(e) {
        const form = $(this);
        const formId = '#'+form.attr('form');
        const user = form.attr('user');
        let ask = confirm('Remove '+ user+ ' from admin list?\r\nYou can set it back later');
        if(ask) {
            $(formId).submit();
        } else {
            e.preventDefault();
        }
    });

    // getName
    $('.editsubdesig').on('click', function (e) {
        $('#getName').val($(this).attr('target-name'));
        $('#getType').val($(this).attr('target-type'));
        $('#getId').val($(this).attr('target-id'));
    })

    $('#modal-subdesigedit').on('shown.bs.modal', function () {
        $('#getName').trigger('focus');
    })

    doc.on('change', '.selectable', function(e) {
        let input = $(this).next();
        input.val($(this).val());
    });
    // $('#profile-desig-edit').val($('#profile-settings-desig').val());

    // $('#profile-sub-edit').val($('#profile-settings-sub').val());

    




// end of document.ready
});
