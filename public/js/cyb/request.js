$('.login-dialog').on('submit', function(ev) {
    ev.preventDefault();
    var thisForm = $(this)

    var url = $(this).attr('action');
    var post = $(this).attr('method');

    email = $('#login_email').val();
    password = $('#login_password').val();

    $.ajax({
        method: post,
        url: url,
        data: { email: email, password: password},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        beforeSend: function(){
            $('#for-user .preloader').addClass('visible').fadeIn('fast').delay(1400).fadeOut("fast");
            $('#for-user .auth').hide();
        },
        success: function(msg){
            $('#for-user .authorized').show();
            $('#for-user .authorized span.user, .my-profile li:first-child .info, .my-profile .half:first-child h1 span').text('test');
            $('.popup-overlay').css('transform', 'translateY(-100%)');

            $(thisForm.find('li.err-txt')).html('');
            $('.profile_name,.user').html(msg.name);
            $('.profile_email').html(msg.email);
            active = '<div class="status not-verified"><span>Not Verified</span><i class="material-icons">error_outline</i></div>';
            if(msg.active == 1){
                active = '<div class="status verified"><span>Verified</span><i class="material-icons">verified_user</i></div>';
            }
            $('.profile_active').html(active);
            if(msg.admin == 1){
                $('.profile_name,.user').html('<a href="/admin">'+msg.name+'</a>');
            }
            getOrders();

            refresh_token();
        },
        error: function (error) {
            console.log(error);
            $('#for-user .authorized').hide();
            $('#for-user .auth').show();
            refresh_token();
            notValid(thisForm.find('li'));
            $(thisForm.find('li.err-txt')).html(error.responseJSON.msg);
        }
    });
});

$('.signup form').on('submit', function(ev) {
    ev.preventDefault();
    var thisForm = $(this)

    var url = $(this).attr('action');
    var post = $(this).attr('method');

    sum_name = $('#reg_name').val();
    email = $('#reg_email').val();
    password = $('#reg_pass').val();
    password_confirmation = $('#reg_pass_con').val();

    $.ajax({
        method: post,
        url: url,
        data: { name: sum_name, email: email, password: password, password_confirmation: password_confirmation },
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        beforeSend: function(){
            $('#for-user .preloader').addClass('visible').fadeIn('fast').delay(1400).fadeOut("fast");
            $('#for-user .auth').hide();
        },
        success: function(msg){
            $('#for-user .authorized').show();
            $('#for-user .authorized span.user, .my-profile li:first-child .info, .my-profile .half:first-child h1 span').text('test');
            // $('.popup-overlay').css('transform', 'translateY(-100%)');
            $('.signup .popup').addClass('success');
            $('.profile_name,.user').html(msg.name);
            $('.profile_email').html(msg.email);
            active = '<div class="status not-verified"><span>Not Verified</span><i class="material-icons">error_outline</i></div>';
            if(msg.active == 1){
                active = '<div class="status verified"><span>Verified</span><i class="material-icons">verified_user</i></div>';
            }
            if(msg.admin == 1){
                $('.profile_name,.user').html('<a href="/admin">'+msg.name+'</a>');
            }
            $('.profile_active').html(active);
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            $('#for-user .authorized').hide();
            $('#for-user .auth').show();

            notValid(thisForm.find('li'));

            refresh_token();
            $(thisForm.find('li.err-txt')).html(error.responseJSON.errors.email[0]);
        }
    });
});

$('.forgot-dialog').on('submit', function(ev) {
    ev.preventDefault();
    var thisForm = $(this)

    var url = $(this).attr('action');
    var post = $(this).attr('method');

    email = $('#forgot_email').val();

    $.ajax({
        method: post,
        url: url,
        data: { email: email},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        beforeSend: function(){
            $(thisForm.find('li.err-txt')).html('');
        },
        success: function(msg){
            if(msg.error){
                notValid(thisForm.find('li'));
                $(thisForm.find('li.err-txt')).html(msg.error);
            }else{
                thisForm.addClass('success')
                thisForm.find('input:not([type="submit"])').val('');
                checkInput(thisForm)
                $(thisForm.find('li.err-txt')).html('');
            }
        },
        error: function (error) {

        }
    });
});

$('.changePassword').on('submit', function(ev) {
    ev.preventDefault();
    var thisForm = $(this)

    var url = $(this).attr('action');
    var post = $(this).attr('method');

    oldPassword = $('input[name="oldPassword"]').val();
    password = $('.half input[name="password"]').val();
    password_confirmation = $('.half input[name="password_confirmation"]').val();

    $.ajax({
        method: post,
        url: url,
        data: { oldPassword: oldPassword, password: password, password_confirmation: password_confirmation},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            if(msg.error) {
                refresh_token();
                var d = '';
                $.each(msg.error, function (i) {
                    d += '<p>'+msg.error[i]+'</p>';
                });

                $(thisForm.find('li.err-txt')).html(d);
                notValid(thisForm.find('li'));
            } else {
                thisForm.addClass('success')
                setTimeout(function() {
                    thisForm.removeClass('success');
                    thisForm.find('input:not([type="submit"])').val('');
                    checkInput(thisForm)
                    $(thisForm.find('li.err-txt')).html('');
                }, 2000);
            }


        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$('#for-user .authorized .signout').on('click', function(ev) {
    $.ajax({
        method: "POST",
        url: "logout",
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        beforeSend: function(){

        },
        success: function(msg){
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
    $('#for-user .preloader').fadeIn('fast').delay(1400).fadeOut("fast");
    $('#for-user .authorized').hide();
    $('#for-user .auth').show();
});

$('#contact form').on('submit', function(ev) {
    ev.preventDefault();
    var thisForm = $(this)

    var url = $(this).attr('action');
    var post = $(this).attr('method');

    subject = $('#cont_subject').val();
    email = $('#cont_email').val();
    description = $('#cont_message').val();

    $.ajax({
        method: post,
        url: url,
        data: { subject: subject, email: email, description: description},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            thisForm.addClass('success')
            setTimeout(function() {
                thisForm.removeClass('success');
            }, 1500);
            thisForm.find('input:not([type="submit"]), textarea').val('');
            checkInput(thisForm)
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            notValid(thisForm.find('li'));
            refresh_token();
        }
    });
});

$(document).on('click','#league-l .option',function () {
    var league_id = $(this).attr('value');
    $('input[name="now_league_id"]').val(league_id);
    $.ajax({
        method: "POST",
        url: "division",
        data: { league_id: league_id},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            var option = '';
            $.each(msg, function (key, val) {
                option += '<div class="option" value="'+val.id+'" photo="'+val.photo.name+'">'+val.name+'</div>';
            });

            $('#league-d .options').html(option);
            getPrice();
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$(document).on('click','#league-d .option',function () {
    var photo = $(this).attr('photo');
    var division_id = $(this).attr('value');
    $('input[name="now_division_id"]').val(division_id);
    var url = $('#url').val();
    $('#league-i img').attr('src',url+'/'+photo);
    getPrice();
});

$(document).on('click','#league-l-n .option',function () {
    var league_id = $(this).attr('value');
    $('input[name="next_league_id"]').val(league_id);
    $.ajax({
        method: "POST",
        url: "division",
        data: { league_id: league_id},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            var option = '';
            $.each(msg, function (key, val) {
                option += '<div class="option" value="'+val.id+'" photo="'+val.photo.name+'">'+val.name+'</div>';
            });

            $('#league-d-n .options').html(option);
            getPrice();
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$(document).on('click','#league-d-n .option',function () {
    var photo = $(this).attr('photo');
    var division_id = $(this).attr('value');
    $('input[name="next_division_id"]').val(division_id);
    var url = $('#url').val();
    $('#league-i-n img').attr('src',url+'/'+photo);
    getPrice();
});

// duo

$(document).on('click','#duo-l .option',function () {
    var league_id = $(this).attr('value');
    $('input[name="now_league_id"]').val(league_id);
    $.ajax({
        method: "POST",
        url: "division",
        data: { league_id: league_id},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            var option = '';
            $.each(msg, function (key, val) {
                option += '<div class="option" value="'+val.id+'" photo="'+val.photo.name+'">'+val.name+'</div>';
            });

            $('#duo-d .options').html(option);
            getPrice();
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$(document).on('click','#duo-d .option',function () {
    var photo = $(this).attr('photo');
    var division_id = $(this).attr('value');
    $('input[name="now_division_id"]').val(division_id);
    var url = $('#url').val();
    $('#duo-i img').attr('src',url+'/'+photo);
    getPrice();
});

$(document).on('click','#duo-l-n .option',function () {
    var league_id = $(this).attr('value');
    $('input[name="next_league_id"]').val(league_id);
    $.ajax({
        method: "POST",
        url: "division",
        data: { league_id: league_id},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            var option = '';
            $.each(msg, function (key, val) {
                option += '<div class="option" value="'+val.id+'" photo="'+val.photo.name+'">'+val.name+'</div>';
            });

            $('#duo-d-n .options').html(option);
            getPrice();
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$(document).on('click','#duo-d-n .option',function () {
    var photo = $(this).attr('photo');
    var division_id = $(this).attr('value');
    $('input[name="next_division_id"]').val(division_id);
    var url = $('#url').val();
    $('#duo-i-n img').attr('src',url+'/'+photo);
    getPrice();
});

// win

$(document).on('click','#win-l .option',function () {
    var league_id = $(this).attr('value');
    $('input[name="now_league_id"]').val(league_id);
    $.ajax({
        method: "POST",
        url: "division",
        data: { league_id: league_id},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            var option = '';
            $.each(msg, function (key, val) {
                option += '<div class="option" value="'+val.id+'" photo="'+val.photo.name+'">'+val.name+'</div>';
            });

            $('#win-d .options').html(option);
            getPrice();
            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
});

$(document).on('click','#win-d .option',function () {
    var photo = $(this).attr('photo');
    var division_id = $(this).attr('value');
    $('input[name="now_division_id"]').val(division_id);
    var url = $('#url').val();
    $('#win-i img').attr('src',url+'/'+photo);
    getPrice();
});


$(document).on('click','.boosts ul li',function () {
    $('input[name="type"]').val($(this).data('value'));
    getPrice();
});

$(document).on('click','.serv div',function () {
    $('input[name="service"]').val($(this).data('value'));
    getPrice();
});

$(document).on('click','.server .options div',function () {
    $('input[name="server_id"]').val($(this).attr('value'));
    getPrice();
});

$(document).on('click','.queue .options div',function () {
    $('input[name="queue_id"]').val($(this).attr('value'));
    getPrice();
});

$(document).on('click','.game_service .options div',function () {
    $('input[name="game_service"]').val($(this).attr('value'));
    getPrice();
});

$(document).on('click','.line div',function () {
    data = '';
    if($('.line div').eq(0).hasClass( "active" )) {data = 'top'}
    if($('.line div').eq(1).hasClass( "active" )) {data = 'mid'}
    if($('.line div').eq(2).hasClass( "active" )) {data = 'jungle'}
    if($('.line div').eq(3).hasClass( "active" )) {data = 'adc'}
    if($('.line div').eq(4).hasClass( "active" )) {data = 'support'}
    $('input[name="line"]').val(data);
    getPrice();
});

$(document).on('click','.rank div',function () {
    $('input[name="rank"]').val($(this).data('value'));
    getPrice();
});

function refresh_token(){
    $.get('refresh-csrf').done(function(data){
        $('[name="csrf-token"]').attr('content',data);
    });
}

function notValid(li) {
    li.removeClass('shake');

    li.addClass('not-valid shake');
    setTimeout(function() {
        li.removeClass('not-valid');
    }, 1500);
}

function getOrders() {
    $.ajax({
        method: "GET",
        url: "getOrders",
        data: {},
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            $('.my-orders table tbody').html('');
            if(msg.length < 1){$('.my-orders table tbody').html('<tr><td colspan="6" align="center">No Records</td></tr>');}
            $.each(msg, function (i, value) {
                var tr = $('<tr/>', {
                    id: value.id
                });
                tr.append($('<td/>', {
                    text: value.id
                })).append($('<td/>', {
                    text: value.type
                })).append($('<td/>', {
                    text: value.price
                })).append($('<td/>', {
                    text: value.pay_status
                })).append($('<td/>', {
                    text: value.status
                })).append($('<td/>', {
                    text: value.created_at
                }));
                $('.my-orders table tbody').append(tr);

            });

            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
}

function getPrice(){
    var type = $('input[name="type"]').val();
    var service = $('input[name="service"]').val();
    var rank = $('input[name="rank"]').val();
    var hours = $('input[name="hours"]').val();
    var now_league_id = $('input[name="now_league_id"]').val();
    var now_division_id = $('input[name="now_division_id"]').val();
    var next_league_id = $('input[name="next_league_id"]').val();
    var next_division_id = $('input[name="next_division_id"]').val();
    var games = $('input[name="games"]').val();
    var game_service = $('input[name="game_service"]').val();

    $.ajax({
        method: "POST",
        url: "getPrice",
        data: { type: type,
            service: service,
            rank: rank,
            hours: hours,
            now_league_id: now_league_id,
            now_division_id: now_division_id,
            next_league_id: next_league_id,
            next_division_id: next_division_id,
            games: games,
            game_service: game_service
        },
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('[name="csrf-token"]').attr('content') },
        success: function(msg){
            $('.price h1').html(parseFloat(msg).toFixed(2)+ ' €');

            refresh_token();
        },
        error: function (error) {
            console.log(error);
            refresh_token();
        }
    });
}
