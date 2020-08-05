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
            console.log(data);
            fname = data.firstname;
            lname = data.lastname;
            email = data.email;
            dp = data.dp;
            phone = data.phone ? data.phone : 'not set' ;
            sub = data.subsidiary ? data.subsidiary : 'not set';
            desig = data.designation ? data.designation : 'not set';
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
    
    // $('form').submit(function (e) {
    //     e.preventDefault();
    //     var data = $(this).serializeFormJSON();
    //     console.log(data);
    
    //     /* Object
    //         email: "value"
    //         name: "value"
    //         password: "value"
    //      */
    // });



     // profile update function
     $(document).on('click', '.updateProfile', function(e){
         e.preventDefault();
        let btn = $(this);
        let count = btn.attr('count');
        let form = $('#'+btn.attr('form'));
        let id = form.find('input[name="id"]').val();
        let spin = '<i class="fa fa-spin fa-cog"></i>';
        let save = '<i class="fa fa-save"></i>';
        let url = '/updateProfile';
        let token = $("meta[name='csrf-token']").attr('content');
        let data = form.serializeFormJSON();
        data._token = token;
        console.log(data);
        $(this).html(spin);
        $.post(url, data).done(function(data){
            email = data.email;
            phone = data.phone ? data.phone : '' ;
            sub = data.subsidiary ? data.subsidiary : '';
            desig = data.designation ? data.designation : '';
            $('#email'+count).text(email);
            $('#sub'+count).text(sub);
            $('#desig'+count).text(desig);
            $('#phone'+count).text(phone);
            btn.html(save);
        });
    });

    $(document).on('dblclick', '.noEdit', function(e) {
        let td = $(this);
        let input = td.attr('in');
        let output = td.attr('out');
        $(input).toggle();
        $(output).toggle();
        let inId = td.attr('inId');
        $(inId).focus();
        // console.log(input+' '+output);
    });

    // $(document).on('blur', '.form-control', function(e) {
    //     $('.editable').hide();
    //     $('.noEdit').show();
    // });
});