void function Init() {

    $('section').css('min-height', window.innerHeight)

    $(document).ready(function($) {
        var Body = $('body');
        Body.addClass('preloader-site');
    });

    function checkInput(li) {
        if( li.find('input').val() == '' ) {
            li.find('label').removeClass('active').siblings('span.border').removeClass('fucused');
        }
    }

    void function InitDomEvents() {

        $(window).on('load',function() {
            $('.preloader-wrapper').fadeOut();
            $('body').removeClass('preloader-site').css('overflow', 'unset');
        });

        $('nav a, .scroll, .scroll-to-service').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 0
                    }, 1000);
                    return false;
                }
            }
        });

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 150) {
                $("header").addClass("fixed");
            } else {
                $("header").removeClass("fixed");
            }
            scrol = 0
            if (scroll < window.innerHeight) {
                $(".scroll-top").fadeOut();
            } else {
                $(".scroll-top").fadeIn();
            }

            if(window.innerWidth <= 768) {
                var aboutHeight = $('#aboutus').innerHeight()
                var serviceHeight = $('#service').innerHeight()
                var totalHeight = $('.total').innerHeight()

                if (scroll > aboutHeight && scroll < serviceHeight + totalHeight) {
                    $('.total').addClass('visible')
                } else {
                    $('.total').removeClass('visible')
                }
            }
        });

        $('header .menu-icon').on('click', function() {
            $(this).toggleClass('toggle white')

            if ( $(this).hasClass('toggle') ) {
                $('.right').addClass('visible')
                $('body').addClass('hidden')
            } else {
                $('.right').removeClass('visible')
                $('body').removeClass('hidden')
            }
        })

        $('.right *').on('click', function() {
            if(window.innerWidth <= 970) {
                $('header .menu-icon').removeClass('toggle white')
                $('.right').removeClass('visible')
                $('body').removeClass('hidden')
            }
        })

        // $('header #login').on('click', function() {
        //     $('body').css('overflow', 'hidden')
        //     $('.popup-overlay.signin').css('transform', 'translateY(0%)');
        //     $('#login_email,#login_password').val('');
        //     $('.signin .err-txt').html('');
        // })

        // $('header #registration').on('click', function() {
        //     $('body').css('overflow', 'hidden')
        //     $('.popup-overlay.signup').css('transform', 'translateY(0%)');
        //     $('#reg_name,#reg_email,#reg_pass,#reg_pass_con').val('');
        // })

        $('header #profile').on('click', function() {
            $('body').css('overflow', 'hidden')
            $('.popup-overlay.my-account').css('transform', 'translateY(0%)');
            $('input[name="oldPassword"],.half input[name="password"],.half input[name="password_confirmation"]').val('');
            $('.half .err-txt').html('');
        })

        $('header .popup .close').on('click', function() {
            $('body').css('overflow', 'unset')
            $(this).parents('.popup-overlay').css('transform', 'translateY(100%)');

            if( $('.signin .popup').hasClass('forgot-password') ) $('.signin .popup').removeClass('forgot-password')
            if( $('.forgot-dialog').hasClass('success') ) $('.forgot-dialog').removeClass('success')

            if( $('.signup .popup').hasClass('success') ) {
                $('.signup .popup').removeClass('success')
                $('.signup .popup').find('input:not([type="submit"])').val('');
                checkInput($('.signup .popup'))
            }
        });

        $('input:not([name="TermsAccepted"]), textarea, select').on('focus', function() {
            $(this).siblings('span').addClass('fucused');
            $(this).siblings('label').addClass('active');
        });

        $('input, textarea, select').on('focusout', function() {
            if ($(this).val()) return
            $(this).siblings('span').removeClass('fucused');
            $(this).siblings('label').removeClass('active');
        });

        $('.boosts ul li').on('click', function() {
            $(this).addClass('active').siblings().removeClass('active');
        });

        $('.select').on('click', function() {
            var select = $(this)
            $('.select').not(select).each(function() {
                $(this).removeClass('active');
                $(this).next('.options').slideUp('fast');
            })
            select.toggleClass('active');
            select.next('.options').slideToggle('fast');
        });

        $('body').on('click', '.option', function() {
            var value = $(this).text();
            var attr = $(this).attr('value');
            $(this).parents('.list').find('.control').text(value);
            $(this).parents('.list').find('.control').attr('value',attr);
            $(this).parents('.options').removeClass('active').hide()
            $('.select').removeClass('active')
        });

        $('.signup form li span > span').on('click', function() {
            $('.terms-and-conditions').addClass('visible');
            $('input[name="TermsAccepted"]').prop('checked',true);
        })

        $('.signup .close-terms').on('click', function() {
            $(this).parents('.terms-and-conditions').removeClass('visible');
        })

        $('.signin li .forgot').on('click', function() {
            $(this).parents('.popup').addClass('forgot-password');
        })

        $('.bar li').on('click', function() {
            $(this).addClass('active').siblings().removeClass('active')

            if( $('.bar li:first-child').hasClass('active')) {
                $('.controler').removeClass('show-orders')
            } else {
                $('.controler').addClass('show-orders')
            }
        })

        $('#service .services-wrapper').on('click', '.service', function() {
            var val = $(this).find('span').text()

            if ($(this).parents('.type-of-service').hasClass('specific') ) {
              $(this).toggleClass('active')
            } else {
                $(this).addClass('active').siblings().removeClass('active')
            }
        })

        var number = 1
        void function IncDec() {
            $('.val').text(number)
            $('#service .inc-dec .inc').on('click', function() {
                if(number < 10){
                    number+=1
                    $(this).siblings('.val').text(number)
                    $('input[name="hours"]').val(number);
                    $('input[name="games"]').val(number);
                    getPrice();
                }
            })
    
            $('#service .inc-dec .dec').on('click', function() {
                if (number > 1) {
                    number-=1
                    $(this).siblings('.val').text(number)
                    $('input[name="hours"]').val(number);
                    $('input[name="games"]').val(number);
                    getPrice();
                }
            })
        }()

        void function SwitchService() {
            $('#duo-boosting, #win-boosting, #league-boosting').hide()
            $('#service .boosts ul li').on('click', function() {
                number = 1
                $('#service .inc-dec .val').text(number)
                var forId  = $(this).attr('for')
                $(`#${forId}`).fadeIn().siblings().hide()
            })
        }()

        $('#gallery .photos').on('click', 'li', function() {
            $('body').css('overflow', 'hidden')
            $('#gallery .popup-overlay .popup .photo').html('')
            $('#gallery .popup-overlay .popup .photo').append(`<img src='${$(this).find('.img').attr('url')}'>`)
            $(this).parents('#gallery').find('.popup-overlay').addClass('visible')
        })
        
        $('#gallery .popup-overlay').on('click', function() {
            $(this).removeClass('visible')
            $('body').css('overflow', 'unset')
        })


        //
        // $('.faq-wrapper ul').on('click', 'li', function() {
        //     $(this).find('i').toggleClass('active')
        //     $(this).find('.answer').slideToggle()
        // })

    }()


    void function copyright() {
        // var host = window.location.host;
        var host = 'XIT Boosting';
        var year = new Date().getFullYear();
        $('.copyright').html(`&copy; Copyright ${year} ${host}, All Rights Reserved!`)
    }()

    new WOW().init()
}()
