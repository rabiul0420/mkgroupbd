$(function () {
  'use strict';
  let current_url = window.location.href;


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.single-menu').each(function (index, value) {
    console.log("single menu",value);
    let full_url = value.href;
    if (current_url === full_url) {
      let self = $(this);
      self.parent().addClass('open');
    }
  });

  // For child menu
  $('.child-menu').each(function (index, value) {
    let full_url = value.href;
    if (current_url === full_url) {
      let self = $(this);
      self.css({
        'background' : '#f8f8f8a8',
        'color': '#F1592A',
        'font-weight': 'bold',
        'border-radius': '10px'
      });
      self.parent().parent().parent().addClass('open').click();
    }
  });

  $(document).on('submit', '#prevent-form', function () {
    let spinTag = "<i class='fa fa-spinner fa-spin me-2 spinner'></i>";
    let text = " Please wait...";
    let buttonText = spinTag + text;
    $('#submit-button').prop('disabled', true).html(buttonText);
  });

  $(document).on('click', '.delete-data', function (e) {
    e.preventDefault();
    let target = $(this).attr('data-id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't to delete this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#' + target).submit();
      }
    })
  });
})