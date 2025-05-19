@extends('website.layouts.app')
@section('title','MKGROUP')
@push('css')

@endpush




@section('content')


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
                    <img src="assets/website/img/about.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                     data-aos-delay="100">
                    {!! siteSetting()['about_us'] !!}
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

@endsection

@push('js')



@endpush
