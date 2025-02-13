@extends('website.layouts.app')
@section('title','MKGROUP')
@push('css')

@endpush


@section('page-header')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h1>Welcome to <span>{{ siteSetting()['company_name'] ?? '' }}</span></h1>
        <h2>{{ siteSetting()['site_slogan'] ?? '' }}</h2>
        <div class="d-flex">
            <a href="{{ siteSetting()['youtube_video_link'] ?? '' }}" class="glightbox btn-watch-video"><i
                    class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div>
    </div>
</section><!-- End Hero -->
@endsection

@section('content')
<!-- ======= Featured Services Section ======= -->
<section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">

        <div class="row">
            @foreach (App\Models\SisterConcern::latest()->get() as $concern)
            <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                    {{-- <div class="icon"><i class="bx bxl-dribbble"></i></div> --}}
                    <div class="icon"><img src="{{ asset('assets/common/images/partner.png') }}" alt="" class="img-responsive" height="40" width="40"></div>
                    <h4 class="title"><a href="">{{ $concern->name ?? '' }}</a></h4>
                    <p class="description text-justify">
                        {!! strLimit($concern->description,100) !!}
                    </p>
                    <a href="{{ url('sister-concern/'.$concern->id ) }}"  data-id="{{ $concern->id }}" class="btn btn-info btn-sm view-sister-concern-details">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Featured Services Section -->

<!-- ======= About Section ======= -->
<section id="about" class="about section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>About</h2>
            <h3>Find Out More <span>About Us</span></h3>
            <p>{{ siteSetting()['about_us_section_slogan'] ?? '' }}</p>
        </div>

        <div class="row">
            <div class="col-lg-6" data-aos="fade-right" style="padding-right: 30px" data-aos-delay="100">
                @if(siteSetting()['about_us_image'])
                    <img src="{{ asset(siteSetting()['about_us_image']) }}" class="img-fluid" alt="">
                @else
                    <img src="assets/website/img/about.jpg" class="img-fluid" alt="">
                @endif
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                data-aos-delay="100">
                {!! siteSetting()['about_us'] !!}
            </div>
        </div>

    </div>
</section><!-- End About Section -->

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\Client::count() ?? 0 }}"
                        data-purecounter-duration="1" class="purecounter"></span>
                    <p>Happy Clients</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                        class="purecounter"></span>
                    <p>Projects</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="bi bi-headset"></i>
                    <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                        class="purecounter"></span>
                    <p>Hours Of Support</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="bi bi-people"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{ App\Models\User::count() ?? 0 }}"
                        data-purecounter-duration="1" class="purecounter"></span>
                    <p>Hard Workers</p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Counts Section -->

<!-- ======= Clients Section ======= -->
<section id="clients" class="clients section-bg">
    <div class="container" data-aos="zoom-in">
        <div class="section-title">
            <h2>Clients</h2>
            <h3>Our Valueable <span>Clients</span></h3>
            <p>{{ siteSetting()['client_section_slogan'] ?? '' }}</p>
        </div>
        <div class="row">
            @foreach(App\Models\Client::where('status',1)->latest()->get() as $client)
            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset($client->logo) }}" class="img-fluid" alt="">
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Clients Section -->

<!-- ======= Services Section ======= -->
<section id="services" class="services">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Services</h2>
            <h3>Check our <span>Services</span></h3>
            <p>{{ siteSetting()['service_section_slogan'] ?? '' }}</p>
        </div>

        <div class="row">
            @foreach(App\Models\OurService::latest()->get() as $service)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-1" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                    {{-- <div class="icon"><i class="bx bxl-dribbble"></i></div> --}}
                    <div class="icon">
                        @if(file_exists($service->icon))
                        <img src="{{ asset($service->icon) }}" alt="" class="img-responsive" height="40" width="40">
                        @else
                        <img src="{{ asset('assets/common/images/settings.png') }}" alt="" class="img-responsive" height="40" width="40">
                        @endif
                    </div>
                    <h4><a href="">{{ $service->name }}</a></h4>
                    <p>{{ strLimit($service->short_note,200) ?? '' }}</p>
                    <a href="{{ url('service/'.$service->id) }}"
                        class="btn btn-info btn-sm view-service-details mt-3">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Services Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
    <div class="container" data-aos="zoom-in">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/website/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                        <h3>Saul Goodman</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                            Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/website/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                        <h3>Sara Wilsson</h3>
                        <h4>Designer</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
                            eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
                            culpa.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/website/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                        <h3>Jena Karlis</h3>
                        <h4>Store Owner</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                            minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/website/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3>Matt Brandon</h3>
                        <h4>Freelancer</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                            velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                            veniam.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/website/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                        <h3>John Larson</h3>
                        <h4>Entrepreneur</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
                            enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore
                            nisi cillum quid.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Events</h2>
            <h3>Check our <span>Events</span></h3>
            <p>{{ siteSetting()['event_section_slogan'] ?? '' }}</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach (App\Models\EventCategory::all() as $category)
                    <li data-filter=".filter-app-{{ $category->id }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach (App\Models\EventCategory::with('events','events.photos')->whereHas('events')->latest()->get() as
            $category)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app-{{ $category->id }}">
                @foreach($category->events as $event)
                <img src="{{ asset($event->thumbnail_image) }}" class="img-fluid" alt="" width="416" height="275">
                    @foreach($event->photos as $photo)
                        <div class="portfolio-info">
                            <h4>{{ $event->title }}</h4>
                            <p>{{ $event->category->name ?? '' }}</p>
                            <a href="{{ asset($photo->photo_path) }}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="{{ $photo->title }}"><i
                                    class="bx bx-plus"></i></a>
                            {{-- <a target="_blank" href="{{ asset($photo->photo_path) }}" class="details-link"
                                title="More Details"><i class="bx bx-link"></i></a> --}}
                        </div>
                    @endforeach
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section><!-- End Portfolio Section -->

<!-- ======= Team Section ======= -->
<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Team</h2>
            <h3>Our Hardworking <span>Team</span></h3>
            <p>{{ siteSetting()['team_section_slogan'] ?? ''}}</p>
        </div>

        <div class="row">
            @foreach(App\Models\User::where('display_on_website',1)->where('status',1)->get() as $member)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <div class="member-img">
                        <img src="{{ $member->image }}" class="img-fluid" alt="">
                        <div class="social">
                            @if(!empty($member->facebook_url))
                            <a target="_blank" href="{{ $member->facebook_url }}"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if(!empty($member->linkedin_url))
                            <a target="_blank" href="{{ $member->linkedin_url }}"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>{{ strLimit($member->name,50) }}</h4>
                        <span>{{ $member->designation->name ?? '' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Team Section -->

<!-- ======= Frequently Asked Questions Section ======= -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>F.A.Q</h2>
            <h3>Frequently Asked <span>Questions</span></h3>
            <p>{{ siteSetting()['faq_section_slogan'] ?? '' }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <ul class="faq-list">
                    @foreach(App\Models\Faq::latest()->get() as $faq)
                    <li>
                        <div data-bs-toggle="collapse" class="{{ $loop->first ? 'collapsed question' : '' }} "
                            href="#faq{{ $loop->index }}">{{ $faq->question }}<i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq{{ $loop->index }}" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</section><!-- End Frequently Asked Questions Section -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-modal-title">Modal Title</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body my-modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="aboutUsModal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">About Us</h5>
                <button type="button" class="close close-about-us-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body my-modal-body">
                {!! siteSetting()['about_us'] !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-about-us-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script>
    let base_url = $('meta[name="base-url"]').attr('base_url');

    $('.view-sister-concern-details').click(function() {
        const concern_id = $(this).attr('data-id');
        $.ajax({
            url: base_url+'/api/view-sister-concern-details/'+concern_id,
            type: 'GET',
            success: function(response){
                if(response.type == "success") {
                    $('#myModal').modal('show');
                    $('.my-modal-title').empty().html(response.heading);
                    $('.my-modal-body').empty().html(response.content);
                }
            }
        });
    });
    $('.view-service-details').click(function() {
        const service_id = $(this).attr('data-id');
        $.ajax({
            url: base_url+'/api/view-service-details/'+service_id,
            type: 'GET',
            success: function(response){
                if(response.type == "success") {
                    $('#myModal').modal('show');
                    $('.my-modal-title').empty().html(response.heading);
                    $('.my-modal-body').empty().html(response.content);
                }
            }
        });
    });
    $('.about-us-details').click(function() {
        $('#aboutUsModal').modal('show');
    });
   $('.close-modal').click(function() {
        $('#myModal').modal('hide'); // Open the modal
    });
   $('.close-about-us-modal').click(function() {
        $('#aboutUsModal').modal('hide'); // Open the modal
    });
</script>

@endpush
