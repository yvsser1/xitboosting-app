<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <meta name='author' content='Davit Papalashvili, Ucha Tsereteli'>
    <meta name='description' content='Trusted by Gamers. Proven Boosters. Track Progress, Spectate, Chat, Schedule & Pause Boost. Select Lines, Champions, Summoners & Stream Games. Choose between Regular and Test Text Duo. Select Between Solo/Duo. Encrypted VPN Connection. 24/7 Qualified Support.'>
    <meta name='keywords' content='lol boost, lol boosting, boost, cheap boost, league boosting'>
    <meta name="theme-color" content="#0072ff">
    <!-- CSRF Token -->
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico') }}">

    <meta property="fb:pages" content="2313322968925540"/>
    <meta name="og:site_name" content="xitboosting.com"/>
    <meta name="og:type" content="website"/>
    <meta name="og:title" content="xitboosting.com / Boost Account / Cheap Boost"/>
    <meta name="og:url" content="https://www.xitboosting.com"/>
    <meta name="og:description" content="Trusted by Gamers. Proven Boosters. Track Progress, Spectate, Chat, Schedule & Pause Boost. Select Lines, Champions, Summoners & Stream Games. Choose between Regular and Test Text Duo. Select Between Solo/Duo. Encrypted VPN Connection. 24/7 Qualified Support."/>
    <meta name="og:image" content="{{ asset('css/assets/images/yone.png') }}"/>

    <title>XIT Boosting</title>
    <link rel='stylesheet' href='{{ asset('css/cyb/style.css') }}'>
    <link rel='stylesheet' href='{{ asset('css/cyb/all.min.css') }}'>
    <link rel='stylesheet' href='{{ asset('css/cyb/animate.css') }}' type='text/css'>
    {{-- <script src="//code.tidio.co/6c5nit3lvgzfaxlxjweu6bopprtmj6iu.js" async></script> --}}
</head>
<body>
<div class='preloader-wrapper'>
    <div class='preloader'>
        <div class='name'>XIT Boosting</div>
        <div class='spinner'>
            <div class='bounce1'></div>
            <div class='bounce2'></div>
            <div class='bounce3'></div>
        </div>
    </div>
</div>
<header>
    <div class='middle'>
        <a href='#' class='logo wow fadeInLeft' data-wow-delay='0.4s'>
            <h1>XIT BOOSTING</h1>
        </a>

        <div class='right'>
            <nav>
                <ul>
                    <li class='wow fadeInDown' data-wow-delay='0.8s'><a href='#aboutus'>About Us</a></li>
                    <li class='wow fadeInDown' data-wow-delay='1s'><a href='#service'>Prices</a></li>
                    <li class='wow fadeInDown' data-wow-delay='1.2s'><a href='#gallery'>Our Work</a></li>
                    <li class='wow fadeInDown' data-wow-delay='1.4s'><a href='#faq'>FAQ</a></li>
                    <li class='wow fadeInDown' data-wow-delay='1.6s'><a href='#contact'>Contact us</a></li>
                </ul>
            </nav>
            
            <div id='for-user'>
                <div class='auth' @if (Auth::check()) style='display:none;' @endif>
                    <div class='btn wow fadeInRight' id='login' data-wow-delay='1.8s'><a href="/login">Login</a></div>
                    <div class='btn wow fadeInRight' id='registration'><a href="/register">Register</a></div>
                </div>

                <div class='authorized' @if (!Auth::check()) style='display:none;' @endif>
                    <ul>
                        <li class='wow fadeInRight' data-wow-delay='1.8s'>Welcome, <span class='user'>@if (Auth::check()) @if(Auth::user()->admin == 1) <a href="{{ route('admin') }}">{{Auth::user()->name}}</a>@else {{Auth::user()->name}} @endif @endif</span></li>
                        <li class='wow fadeInRight' data-wow-delay='2s'><div class='btn' id='profile' >My Profile</div></li>
                        <li class='signout wow fadeInRight' data-wow-delay='2.2s'><i class='fas fa-sign-out-alt'></i></li>
                    </ul>
                </div>
                
                <div class='preloader'>
                    <div class='spinner'>
                        <div class='bounce1'></div>
                        <div class='bounce2'></div>
                        <div class='bounce3'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-icon"><span></span></div>
    </div>

    <div class='popup-overlay my-account'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>

            <div class='bar'>
                <ul>
                    <li class='active'>My Profile</li>
                    <li>My Orders</li>
                </ul>
            </div>

            <div class='body'>
                <div class='controler'>
                    <div class='my-profile'>
                        <div class='half'>
                            <h1><span class='profile_name'>@if (Auth::check()) {{Auth::user()->name}} @endif</span>'s Profile</h1>
                            <ul class='infos'>
                                <li>
                                    <div class='desc'>Summoner Name</div>
                                    <div class='info profile_name'>@if (Auth::check()) {{Auth::user()->name}} @endif</div>
                                </li>
                                <li>
                                    <div class='desc'>Email</div>
                                    <div class='info profile_email'>@if (Auth::check()) {{Auth::user()->email}} @endif</div>
                                </li>
                                <li>
                                    <div class='desc'>Account Status</div>
                                    <div class='info profile_active'>
                                    @if (Auth::check()) @if(Auth::user()->active == 1)
                                    <div class='status verified'><span>Verified</span><i class="material-icons">verified_user</i></div> 
                                    @else 
                                    <div class='status not-verified'><span>Not Verified</span><i class="material-icons">error_outline</i></div> 
                                    @endif @endif</div>
                                </li>
                            </ul>
                        </div>
                        <div class='half'>
                            <form method='POST' action='{{ route('changePassword') }}' class="changePassword">
                                <h1>Change Password</h1>
                                <ul>
                                    <li>
                                        <input type='password' name='oldPassword' autocomplete='off' required>
                                        <label>Old Password</label>
                                        <span class='border'></span>
                                    </li>
                                    <li>
                                        <input type='password' name='password' autocomplete='off' required>
                                        <label>New Password</label>
                                        <span class='border'></span>
                                    </li>
                                    <li>
                                        <input type='password' name='password_confirmation' autocomplete='off' required>
                                        <label>Confirm password</label>
                                        <span class='border'></span>
                                    </li>
                                    <li class="submit">
                                        <input class='btn' type='submit' value='Change Password'>
                                    </li>
                                    <li class='err-txt'></li>
                                </ul>
                            </form>

                            <div class='success-dialog'>
                                <div class='title'>Password Changed Successfully</div>
                            </div>

                        </div>
                    </div>

                    <div class='my-orders'>
                        <h1>My Orders</h1>
                        <div class="table-wrapper" style='width: 100%; overflow: auto;'>
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Packet</th>
                                <th>Price</th>
                                <th>Pay Status</th>
                                <th>Service Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(empty($orders[0]->id))
                                <tr>
                                    <td colspan="6" align="center">No Records</td>
                                </tr>
                            @endif
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->type }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->pay_status }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- <div class='popup-overlay signin'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>
            <form class="login-dialog" method='POST' action='{{ route('login') }}'>
                <div class='title'>Login Form</div>
                <ul>
                    <li>
                        <input type='email' name='email' id='login_email' autocomplete='off' required>
                        <label>E-mail</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <input type='password' name='password' id='login_password' autocomplete='off' required>
                        <label>password</label>
                        <div class="forgot">Forgot?</div>
                        <span class='border'></span>
                    </li>
                    <li class="submit">
                        <input class='btn' type='submit' value='Login'>
                    </li>
                    <li class='err-txt'></li>
                </ul>
            </form>

            <form method="POST" class="forgot-dialog" action='{{ route('resetMail') }}'>
                <div class='title'>Forgot Password?</div>
                <ul>
                    <li>
                        <input type='email' name='email' id='forgot_email' autocomplete='off' required>
                        <label>E-mail</label>
                        <span class='border'></span>
                    </li>
                    <li class="submit">
                        <input class='btn' type='submit' value='Send'>
                    </li>
                    <li class='err-txt'></li>
                </ul>

                <div class='success-dialog'>
                    <div class='title'>Check Email</div>
                    <p>In order to help maintain the security of your XitBoosting account, please check your email address!</p>
                </div>
            </form>
        </div>
    </div> --}}

    {{-- <div class='popup-overlay signup'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>
            <form method='POST' action='{{ route('register') }}'>
                @csrf
                <div class='title'>Registration Form</div>
                <ul>
                    <li>
                        <input type='text' name='name' id='reg_name' autocomplete='off' required>
                        <label>Summoner Name</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <input type='email' name='email' id='reg_email' autocomplete='off' required>
                        <label>E-mail</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <input type='password' name='password' id='reg_pass' autocomplete='off' required>
                        <label>password</label>
                        <i class='far fa-question-circle' information='The password must be at least 6 characters.'></i>
                        <span class='border'></span>
                    </li>
                    <li>
                        <input type='password' name='password_confirmation' id='reg_pass_con' autocomplete='off' required>
                        <label>Confirm password</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <label class='check'>
                            <input type='checkbox' name='TermsAccepted' required>

                            <span class='checkmark'></span>
                            <span>I Agree <span>Terms and Conditions</span></span>
                        </label>
                    </li>
                    <li class="submit">
                        <input class='btn' type='submit' value='Registration'>
                    </li>
                    <li class='err-txt'></li>
                </ul>
            </form>

            <div class="terms-and-conditions">
                <img src='{{ asset('css/assets/images/close.svg') }}' class='close-terms'>
                <div class='title'>Terms and Conditions</div>
                <div class="content">
                <p>Please read these Terms and Conditions carefully before using the elouinon.com website.</p>
                </br>
                </br>
                <p>Your access to and use of the service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>
                </br>
                </br>
                <p>XitBoosting has the right either to accept or decline the order of the customer. On the other hand, we guarantee to fulfil every accepted order quickly and with maximal effectiveness.</p>
                </br>       
                <p>XitBoosting guarantees personal data safety. Every information which will be provided to us by our customers will be used solely during the service period with the explicit agreement of the customer.</p>
                </br>
                <p>Our service may contain links to third-party web sites or services that are not owned or controlled by our Company. (For example payment services). EloUnion has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. (Including Riot Games).</p>
                </br>
                <p>You further acknowledge and agree that XitBoosting shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance  on any such content, goods or services available on or through any such websites or services.</p>
                </br>
                <p>XitBoosting reserves the right to change pricing of its services at any time.  Of course, orders which were already placed will not be effected. Every change will be visible on the website.</p>
                </br>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                </br>
                <p>If you have any questions about these Terms, please contact us .</p>
                </br>
                <p>Sincerely,</p>
                <p>XitBoosting Administration.</p>
                </div>
            </div> --}}

            {{-- <div class='success-dialog'>
                <div class='title'>verify your email address</div>
                <p>In order to help maintain the security of your XitBoosting account, please verify your email address!</p>
            </div>
        </div>
    </div> --}}

    @if($activeUser)
    <div class='popup-overlay paypal'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>
            <div class='title information' style="text-transform: none;">Your email has been successfully verified.</div>
            <script>
                setTimeout(function(){ window.location = 'https://www.xitboosting.com/'; }, 3000);
            </script>
        </div>
    </div>
    @endif

    @if ($message = Session::get('success'))
    <div class='popup-overlay paypal'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>
            <div class='title information'>{!! $message !!}</div>
        </div>
    </div>
    <?php Session::forget('success');?>
    @endif

    @if ($message = Session::get('error'))
    <div class='popup-overlay paypal'>
        <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>
            <div class='title information'>{!! $message !!}</div>
        </div>
    </div>
    <?php Session::forget('error');?>
    @endif
</header>

<main>
    <section class='background-image' id='aboutus'>
        <div class='middle'>
            <div class='social wow fadeInLeft' data-wow-delay='2s'>
                <ul>
                    {{-- <li><a target="_blank" href='https://www.facebook.com/#' class='fab fa-facebook-f'></a></li>
                    <li><a target="_blank" href='https://www.instagram.com/#' class='fab fa-instagram'></a></li>
                    <li><a target="_blank" href='https://www.youtube.com/channel/#' class='fab fa-youtube'></a></li> --}}
                    <li><a target="_blank" href='https://discord.gg/6nhUrdm' class='fab fa-discord'></a></li>
                </ul>
            </div>
            <div class='container'>
                <div class='text'>
                    <h1 class='logo wow zoomIn' data-wow-delay='2s'>Xit Boosting</h1>
                    <h1 class='wow fadeInUp' data-wow-delay='2.2s'>@if($about->name) {{ $about->name }} @endif</h1>
                    <p class='wow zoomInUp' data-wow-delay='2.4s'>@if($about->text) {{ $about->text }} @endif</p>
                </div>
                <div class='scroll-down'>
                    <a href='#service' class='btn scroll-to-service wow fadeInDown' data-wow-delay='2.8s'>Let's Go</a>
                    <a href='#service' class='material-icons scroll'>keyboard_arrow_down</a>
                </div>
            </div>
        </div>
    </section>

    <section id='service'>
        <div class='middle'>
            <div class='boosts'>
                <ul>
                    <li class='active wow fadeInRight' for='coaching' data-value="coaching" data-wow-delay='0s'>
                        <div class='icon'>
                            <img src='{{ asset('css/assets/images/coaching.svg') }}'>
                        </div>
                        <p>Coaching</p>
                    </li>
                    <li class='wow fadeInRight' for='league-boosting' data-value="solo" data-wow-delay='0.2s'>
                        <div class='icon'>
                            <img src='{{ asset('css/assets/images/solo.svg') }}'>
                        </div>
                        <p>Solo<br />service</p>
                    </li>
                    <li class='wow fadeInRight' for='duo-boosting' data-value="duo" data-wow-delay='0.4s'>
                        <div class='icon'>
                            <img src='{{ asset('css/assets/images/duo.svg') }}'>
                        </div>
                        <p>Duo<br />service</p>
                    </li>
                    <li class='wow fadeInRight' for='win-boosting' data-value="win" data-wow-delay='0.6s'>
                        <div class='icon'>
                            <img src='{{ asset('css/assets/images/coaching.svg') }}'>
                        </div>
                        <p>Net<br />Wins</p>
                    </li>
                </ul>
            </div>

            <div class='league-service'>
                <div id="coaching">
                    <h1>Coaching</h1>
                    <span>If you're looking to improve your gameplay and yourself, we highly recommend you this service!</span>

                    <div class='choose'>
                        <ul>
                            <li class='type-of-service'>
                                <div class='name'><span>1</span>TYPE OF SERVICE</div>
                                
                                <div class="services-wrapper serv">
                                    <div class="service active" data-value="regular">
                                        <img class='icon' src="{{ asset('css/assets/images/regular.png') }}">
                                        <span>REGULAR</span>
                                    </div>
                                    <div class="service" data-value="premium">
                                        <img class='icon' src="{{ asset('css/assets/images/premium.png') }}">
                                        <span>PREMIUM</span>
                                    </div>
                                </div>
                            </li>

                            <li class='type-of-service'>
                                <div class='name'><span>2</span>SPECIFIC LANES</div>
                                
                                <div class="services-wrapper line">
                                    <div class="service active" data-value="top">
                                        <img class='icon' src="{{ asset('css/assets/images/top.png') }}">
                                        <span>TOP</span>
                                    </div>
                                    <div class="service" data-value="jungle">
                                        <img class='icon' src="{{ asset('css/assets/images/jungle.png') }}">
                                        <span>JUNGLE</span>
                                    </div>
                                    <div class="service" data-value="mid">
                                        <img class='icon' src="{{ asset('css/assets/images/mid.png') }}">
                                        <span>MID</span>
                                    </div>
                                    <div class="service" data-value="adc">
                                        <img class='icon' src="{{ asset('css/assets/images/adc.png') }}">
                                        <span>ADC</span>
                                    </div>
                                    <div class="service" data-value="support">
                                        <img class='icon' src="{{ asset('css/assets/images/support.png') }}">
                                        <span>SUPPORT</span>
                                    </div>
                                </div>
                            </li>

                            <li class='type-of-service'>
                                <div class='name'><span>3</span>RANK OF COACH</div>
                                
                                <div class="services-wrapper rank">
                                    <div class="service active" data-value="diamond">
                                        <img class='icon' src="{{ asset('css/assets/images/diamond.png') }}">
                                        <span>DIAMOND</span>
                                    </div>
                                    <div class="service" data-value="master">
                                        <img class='icon' src="{{ asset('css/assets/images/master.png') }}">
                                        <span>MASTER</span>
                                    </div>
                                    <div class="service" data-value="challenger">
                                        <img class='icon' src="{{ asset('css/assets/images/challenger.png') }}">
                                        <span>CHALLENGER</span>
                                    </div>
                                </div>
                            </li>

                            <li class='type-of-service'>
                                <div class='name'><span>4</span>YOUR SERVER</div>
                                
                                <div class='list-wrapper'>
                                    <div class='list server'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($servers as $server)
                                                <div class="option" value="{{ $server["id"] }}">{{ $server["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class='name'><span>5</span>AMOUNT OF HOURS</div>
                                <div class="inc-dec">
                                    <div class="dec">-</div>
                                    <div class="val">1</div>
                                    <div class="inc">+</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="league-boosting">
                    <h1>Solo Boosting</h1>
                    <span>The booster will log on your account and will play in your account until reaching your desired division.</span>

                    <div class='choose'>
                        <ul>
                            <li>
                                <div class='name'><span>1</span>YOUR CURRENT LEAGUE</div>

                                <div class='list-wrapper'>
                                    <div class='list' id="league-l">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($leagues as $league)
                                                <div class="option" value="{{ $league["id"] }}">{{ $league["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class='list' id="league-d">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>

                                        </div>
                                    </div>

                                    <div class="badges" id="league-i">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                
                            </li>
                            <li>
                                <div class='name'><span>2</span>YOUR DESIRE LEAGUE</div>
                                <div class='list-wrapper'>
                                    <div class='list' id="league-l-n">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($leagues as $league)
                                                <div class="option" value="{{ $league["id"] }}">{{ $league["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class='list' id="league-d-n">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>

                                        </div>
                                    </div>
                                    <div class="badges" id="league-i-n">
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>3</span>YOUR SERVER</div>
                                <div class='list-wrapper'>
                                    <div class='list server'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($servers as $server)
                                                <div class="option" value="{{ $server["id"] }}">{{ $server["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>4</span>TYPE OF QUEUE</div>
                                <div class='list-wrapper'>
                                    <div class='list queue'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($queues as $queue)
                                                <div class="option" value="{{ $queue["id"] }}">{{ $queue["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class='type-of-service'>
                                <div class='name'><span>5</span>TYPE OF SERVICE</div>
                                
                                <div class="services-wrapper serv">
                                    <div class="service active" data-value="regular">
                                        <img class='icon' src="{{ asset('css/assets/images/regular.png') }}">
                                        <span>REGULAR</span>
                                    </div>
                                    <div class="service" data-value="premium">
                                        <img class='icon' src="{{ asset('css/assets/images/premium.png') }}">
                                        <span>PREMIUM</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="duo-boosting">
                    <h1>Duo Boosting</h1>
                    <span>You will play on your own account and our booster will play with you until you achieve your desired division.</span>

                    <div class='choose'>
                        <ul>
                            <li>
                                <div class='name'><span>1</span>YOUR CURRENT LEAGUE</div>

                                <div class='list-wrapper'>
                                    <div class='list' id="duo-l">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($leagues as $league)
                                                <div class="option" value="{{ $league["id"] }}">{{ $league["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class='list' id="duo-d">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>

                                        </div>
                                    </div>

                                    <div class="badges" id="duo-i">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                
                            </li>
                            <li>
                                <div class='name'><span>2</span>YOUR DESIRE LEAGUE</div>
                                <div class='list-wrapper'>
                                    <div class='list' id="duo-l-n">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($leagues as $league)
                                                <div class="option" value="{{ $league["id"] }}">{{ $league["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class='list' id="duo-d-n">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>

                                        </div>
                                    </div>
                                    <div class="badges" id="duo-i-n">
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>3</span>YOUR SERVER</div>
                                <div class='list-wrapper'>
                                    <div class='list server'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($servers as $server)
                                                <div class="option" value="{{ $server["id"] }}">{{ $server["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>4</span>TYPE OF QUEUE</div>
                                <div class='list-wrapper'>
                                    <div class='list queue'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($queues as $queue)
                                                <div class="option" value="{{ $queue["id"] }}">{{ $queue["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class='type-of-service'>
                                <div class='name'><span>5</span>TYPE OF SERVICE</div>
                                
                                <div class="services-wrapper serv">
                                    <div class="service active" data-value="regular">
                                        <img class='icon' src="{{ asset('css/assets/images/regular.png') }}">
                                        <span>REGULAR</span>
                                    </div>
                                    <div class="service" data-value="premium">
                                        <img class='icon' src="{{ asset('css/assets/images/premium.png') }}">
                                        <span>PREMIUM</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="win-boosting">
                    <h1>Win Boosting</h1>
                    <span>We will perform an elo boost on your account to raise your MMR and champion win rate.</span>

                    <div class='choose'>
                        <ul>
                            <li>
                                <div class='name'><span>1</span>YOUR CURRENT LEAGUE</div>

                                <div class='list-wrapper'>
                                    <div class='list' id="win-l">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($leagues as $league)
                                                <div class="option" value="{{ $league["id"] }}">{{ $league["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class='list' id="win-d">
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>

                                        </div>
                                    </div>

                                    <div class="badges" id="win-i">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>2</span>YOUR SERVER</div>
                                <div class='list-wrapper'>
                                    <div class='list server'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($servers as $server)
                                                <div class="option" value="{{ $server["id"] }}">{{ $server["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>3</span>TYPE OF QUEUE</div>
                                <div class='list-wrapper'>
                                    <div class='list queue'>
                                        <div class='select'>
                                            <div class='control'>Choose</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            @foreach($queues as $queue)
                                                <div class="option" value="{{ $queue["id"] }}">{{ $queue["name"] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class='not-badges'>
                                <div class='name'><span>4</span>TYPE OF GAME SERVICE</div>
                                <div class='list-wrapper'>
                                    <div class='list game_service'>
                                        <div class='select'>
                                            <div class="control" value="solo">Solo</div>
                                            <i class='material-icons'>keyboard_arrow_down</i>
                                        </div>

                                        <div class='options'>
                                            <div class="option" value="solo">Solo</div>
                                            <div class="option" value="duo">Duo</div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <li class='type-of-service'>
                                <div class='name'><span>5</span>TYPE OF SERVICE</div>
                                <div class="services-wrapper serv">
                                    <div class="service active" data-value="regular">
                                        <img class='icon' src="{{ asset('css/assets/images/regular.png') }}">
                                        <span>REGULAR</span>
                                    </div>
                                    <div class="service" data-value="premium">
                                        <img class='icon' src="{{ asset('css/assets/images/premium.png') }}">
                                        <span>PREMIUM</span>
                                    </div>
                                </div>
                            </li>

                            <li class='not-badges'>
                                <div class='name'><span>6</span>AMOUNT OF GAMES</div>
                                <div class="inc-dec">
                                    <div class="dec">-</div>
                                    <div class="val">1</div>
                                    <div class="inc">+</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="total">
                <div class="price">
                    <p>Total Price</p>
                    <h1>0.00 $</h1>
                </div>
                <form method="POST" action="{!! URL::to('paypal') !!}">
                    {{ csrf_field() }}
                        <input type="hidden" name="type" id="type" type="text" value="coaching">
                        <input type="hidden" name="service" type="text" value="regular">
                        <input type="hidden" name="line" type="text" value="top">
                        <input type="hidden" name="rank" type="text" value="diamond">
                        <input type="hidden" name="server_id" type="text" value="0">
                        <input type="hidden" name="hours" type="text" value="1">
                        <input type="hidden" name="now_league_id" type="text" value="0">
                        <input type="hidden" name="now_division_id" type="text" value="0">
                        <input type="hidden" name="next_league_id" type="text" value="0">
                        <input type="hidden" name="next_division_id" type="text" value="0">
                        <input type="hidden" name="queue_id" type="text" value="0">
                        <input type="hidden" name="game_service" type="text" value="solo">
                        <input type="hidden" name="games" type="text" value="1">
                    <button class="btn">PURCHASE</button></p>
                </form>
            </div>
        </div>
    </section>
    
    <section id='gallery'>
        <div class='middle'>
            <h1 class='wow fadeInDown' data-wow-delay='0.2s'>Our Work</h1>
            <div class='photos'>
                <ul class='wow fadeInDown' data-wow-delay='0.7s'>
                 <li>
                        <div class='img' url="images/P4_ru.png" style='background-image: url("images/P4_ru.png");'></div>
                        <div class='inf'>Plat Boost</div>
                    </li>
                      <li>
                        <div class='img' url="images/gm.jpg" style='background-image: url("images/gm.jpg");'></div>
                        <div class='inf'>GM Boost</div>
                    </li>
                      <li>
                        <div class='img' url="images/master.jpg" style='background-image: url("images/master.jpg");'></div>
                        <div class='inf'>Master Boost</div>
                    </li>
                      <li>
                        <div class='img' url="images/diam.png" style='background-image: url("images/diam.png");'></div>
                        <div class='inf'>Diamond Boost</div>
                    </li>
                      <li>
                        <div class='img' url="images/gold.png" style='background-image: url("images/gold.png");'></div>
                        <div class='inf'>Gold Boost</div>
                    </li>
                    <li>
                        <div class='img' url="images/boost1.png" style='background-image: url("images/boost1.png");'></div>
                        <div class='inf'>Clean Boost</div>
                    </li>
                    <li>
                        <div class='img' url="images/boost2.png" style='background-image: url("images/boost2.png");'></div>
                        <div class='inf'>Wins Boost</div>
                    </li>
                </ul>
                <div class='btn wow fadeInUp' data-wow-delay='1s'>Show More</div>
            </div>
        </div>
        <div class='popup-overlay'>
            <div class='popup'>
            <img src='{{ asset('css/assets/images/close.svg') }}' class='close'>

                <div class="photo">
                    
                </div>
            </div>
        </div>
        <div class='overlay'></div>
    </section>

    <section id='faq'>
        <div class='middle'>
            <h1 class='wow fadeInDown' data-wow-delay='0.2s'>FAQ</h1>

            <div class='faq-wrapper'>
                <ul class='wow fadeInUp' data-wow-delay='0.7s'>
                    @foreach($faqs as $faq)
                        <li>
                            <div class='control'>
                                <p>@if($faq->name) {{ $faq->name }} @endif</p>
                                <i class='fas fa-plus'></i>
                            </div>
                            <div class='answer'>@if($faq->description) {{ $faq->description }} @endif</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class='background-image' id='contact'>
        <div class='middle'>
            <h1 class='wow fadeInDown' data-wow-delay='0.2s'>Contact</h1>

            <form class='wow fadeInUp' data-wow-delay='0.7s' method='POST' action='{{ route('contact') }}'>
                <p>If you have any further questions, feel free to contact us.</p>

                <ul>
                    <li>
                        <input type='text' name='subject' id='cont_subject' autocomplete='off' required>
                        <label>Subject</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <input type='email' name='contactEmail' id='cont_email' autocomplete='off' required>
                        <label>E-mail</label>
                        <span class='border'></span>
                    </li>
                    <li>
                        <textarea name='message' id='cont_message' rows='8' cols='80' required></textarea>
                        <label>Message</label>
                        <span class='border'></span>
                    </li>
                    <li class="submit">
                        <input class='btn' type='submit' value='Send'>
                        <div class='preloader'>
                            <div class='spinner'>
                                <div class='bounce1'></div>
                                <div class='bounce2'></div>
                                <div class='bounce3'></div>
                            </div>
                        </div>
                    </li>
                    <li class='err-txt'></li>
                </ul>
                <div class='success-dialog'>
                    <div class='title'>Message Sent Successfully</div>
                </div>
            </form>
        </div>
    </section>
    <a href='#aboutus' class="scroll scroll-top"><i class="material-icons">arrow_upward</i></a>
</main>

<footer>
    <div class='middle'>
        <p class='copyright'></p>
            <div class='social-resp'>
                <ul>
                    {{-- <li><a target="_blank" href='https://www.facebook.com/EloUnion/' class='fab fa-facebook-f'></a></li>
                    <li><a target="_blank" href='https://www.instagram.com/EloUnion/' class='fab fa-instagram'></a></li>
                    <li><a target="_blank" href='https://www.youtube.com/channel/UClUbDjBKPl3_kVdo3EwHB9w' class='fab fa-youtube'></a></li> --}}
                    <li><a target="_blank" href='https://discord.gg/6nhUrdm' class='fab fa-discord'></a></li>
                </ul>
            </div>
        <div class="inf">
            <ul>
                <li><i class='fab fa-discord'></i> <a href='https://discord.gg/6nhUrdm'>JOIN OUR DISCORD!</a></li>
            </ul>
        </div>
    </div>
</footer>

<input type="hidden" value="{{ URL::to('images') }}" id="url">
<!-- Customerly Integration Code -->
<script>
    window.customerlySettings = {
        app_id: "fa48c748"
    };
    !function(){function e(){var e=t.createElement("script");
    e.type="text/javascript",e.async=!0,
    e.src="https://widget.customerly.io/widget/fa48c748";
    var r=t.getElementsByTagName("script")[0];r.parentNode.insertBefore(e,r)}
    var r=window,t=document,n=function(){n.c(arguments)};
    r.customerly_queue=[],n.c=function(e){r.customerly_queue.push(e)},
    r.customerly=n,r.attachEvent?r.attachEvent("onload",e):r.addEventListener("load",e,!1)}();
</script>
<script src='{{ asset('js/cyb/wow.js') }}'></script>
<script src='{{ asset('js/cyb/jquery-3.4.0.min.js') }}' type='text/javascript'></script>
<script src='{{ asset('js/cyb/main.js') }}' type='text/javascript'></script>
<script src='{{ asset('js/cyb/request.js') }}' type='text/javascript'></script>
<script>
</script>

</body>
</html>
