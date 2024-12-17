@extends('website.layouts.app')
@section('title','MKGROUP')
@push('css')

@endpush



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
