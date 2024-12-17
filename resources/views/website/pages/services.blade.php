@extends('website.layouts.app')
@section('title','MKGROUP')
@push('css')

@endpush




@section('content')


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
