<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title','MKGROUP')</title>
    <meta content="MKGROUP" name="description">
    <meta content="MKGROUP" name="keywords">
    <meta name="base-url" base_url="{!! url('/') !!}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/common/images/fav.png') }}" rel="icon">
    <link href="{{ asset('assets/common/images/fav.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{ siteSetting()['email'] ?? '' }}">{{
            siteSetting()['email'] ?? '' }}</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{ siteSetting()['phone'] ?? '' }}</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                @isset(siteSetting()['facebook_url'])
                <a target="_blank" href="{{ siteSetting()['facebook_url'] }}" class="facebook"><i class="bi bi-facebook"></i></a>
                @endisset
                @isset(siteSetting()['twitter_url'])
                <a target="_blank" href="{{ siteSetting()['twitter_url'] }}" class="twitter"><i class="bi bi-twitter"></i></a>
                @endisset
                @isset(siteSetting()['instagram_url'])
                <a target="_blank" href="{{ siteSetting()['instagram_url'] }}" class="instagram"><i class="bi bi-instagram"></i></a>
                @endisset
                @isset(siteSetting()['linkedin_url'])
                <a target="_blank" href="{{ siteSetting()['linkedin_url'] }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                @endisset
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo">
                <a href="{{ route('home') }}">
                    @if(siteSetting()['logo'])
                        <img src="{{ asset(siteSetting()['logo']) }}" alt="">
                    @else
                        {{ siteSetting()['company_name'] }}
                    @endif
                    <span></span>
                </a>
            </h1>
            <!-- <a href="{{ route('home') }}" class="logo"><img src="assets/website/img/logo.png" alt=""></a>-->


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='')?'active':'' }}" href="{{ url('/') }}">Home</a></li>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='about-us')?'active':'' }}" href="{{ url('about-us') }}">About</a></li>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='mission-vission')?'active':'' }}" href="{{ url('mission-vission') }}">Mission & Vission</a></li>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='why-choose-us')?'active':'' }}" href="{{ url('why-choose-us') }}">Why Choose Us</a></li>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='our-commitment')?'active':'' }}" href="{{ url('our-commitment') }}">Our Commitment</a></li>
                    <li><a class="nav-link scrollto {{ (Request::segment(1)=='services')?'active':'' }}" href="{{ url('services') }}">Services</a></li>
                   <li><a class="nav-link scrollto {{ (Request::segment(1)=='contact-us')?'active':'' }}" href="{{ url('contact-us') }}">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('page-header')

    <main id="main">
        @yield('content')

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3><span>Contact Us</span></h3>
                    <p>{{ siteSetting()['contact_us_section_slogan'] ?? '' }}</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Our Address</h3>
                            <p>{{ siteSetting()['address'] ?? '' }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>{{ siteSetting()['email'] }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>{{ siteSetting()['mobile'] }}</p>
                        </div>
                    </div>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-6 ">
                        <iframe class="mb-4 mb-lg-0" src="{{ siteSetting()['google_map_url'] }}" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                    </div>

                    <div class="col-lg-6">
                        <form action="{{ route('send-contact-message') }}" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="name" class="form-control name_field" id="name" placeholder="Your Name">
                                    <span class="text-danger contact-error-message name_error"></span>
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control email_field" name="email" id="email" placeholder="Your Email">
                                    <span class="text-danger econtact-error-message email_error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control subject_field" name="subject" id="subject" placeholder="Subject">
                                <span class="text-danger subcontact-error-message subject_error"></span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control message_field" name="message" rows="5" placeholder="Message"></textarea>
                                <span class="text-danger mescontact-error-message message_error"></span>
                            </div>
                            <div class="my-3">
                                <div class="loading">Please wait...</div>
                                <div class="error-message"></div>
                                <div class="sent-message"></div>
                            </div>
                            <div class="text-center"><button class="btn btn-primary" type="button" id="send-contact-message">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>{{ siteSetting()['news_letter_section_slogan'] ?? '' }}</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>{{ siteSetting()['company_name'] ?? '' }}</h3>
                        <img src="{{ asset('assets/common/images/logo.png') }}" alt="" class="img-responsive w-100">
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url(('/')) }}">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('about-us') }}">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('services') }}">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            @foreach (App\Models\OurService::latest()->get() as $service)
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ url('service/'.$service->id) }}">{{ $service->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                        <div class="social-links mt-3">
                            @isset(siteSetting()['facebook_url'])
                            <a target="_blank" href="{{ siteSetting()['facebook_url'] }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                            @endisset
                            @isset(siteSetting()['linkedin_url'])
                            <a target="_blank" href="{{ siteSetting()['linkedin_url'] }}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            @endisset
                            @isset(siteSetting()['instagram_url'])
                            <a target="_blank" href="{{ siteSetting()['instagram_url'] }}" class="instagram"><i class="bx bxl-instagram"></i></a>
                            @endisset
                            @isset(siteSetting()['twitter_url'])
                            <a target="_blank" href="{{ siteSetting()['twitter_url'] }}" class="twitter"><i class="bx bxl-twitter"></i></a>
                            @endisset
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright {{ date('Y',strtotime(\Carbon\Carbon::now())) }} <strong><span>{{ siteSetting()['company_name']
            ?? '' }}</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/website/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/vendor/waypoints/noframework.waypoints.js') }}"></script>
    {{-- <script src="{{ asset('assets/website/vendor/php-email-form/validate.js') }}"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/website/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '#send-contact-message', function() {
          event.preventDefault();
          $('.loading').show();
            $.ajax({
                url: "{{ route('send-contact-message') }}",
                method: 'POST',
                data: $('.php-email-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    $('.form-control').removeClass('is-invalid');
                    $('.to-do-error-message').empty();
                    if (response.status == 'success') {
                        $('.php-email-form')[0].reset();
                        $('.loading').hide();
                        $('.error-message').hide();
                        $('.sent-message').show().text(response.message);
                    } else if (response.status == 'error') {
                        $('.sent-message').hide()
                        $('.error-message').show().text(response.message);
                        $('.loading').hide();
                    }
                },
                error: function(error) {
                    if (error.status === 422) {
                      $('.loading').hide();
                        let errors = error.responseJSON.errors;
                        $('.contact-error-message').empty();
                        $.each(errors, function(field, messages) {
                            $('.' + field + '_field').addClass('is-invalid');
                            $('.' + field + '_error').empty().text(messages[0]);
                        });
                    }
                }
            });
        })

    </script>

    @stack('js')

</body>

</html>
