@extends('website.layouts.app')
@section('title','MKGROUP')
@push('css')

@endpush




@section('content')


    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h1>{{ $title }}</h1>
            </div>

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                     data-aos-delay="100">
                    {!! siteSetting()['privacy_policy'] !!}
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

@endsection

@push('js')



@endpush
