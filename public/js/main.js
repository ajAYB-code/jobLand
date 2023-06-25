

$(function (){

  /* Initialization */
  // Datatable
  $('.datatable').DataTable({});

  // Show/Hide apply filter button
  $('#filtersForm').change(function (){
    $('#applyFiltersBtn').show();
  });

  // auto load jobs
  $(window).scroll(function (){

    // Check if the loading animation or part of it is visible in the viewport
    const scrollTop = $(window).scrollTop();
    const eleTop = $('.auto-load-jobs-animation').offset().top;
    console.log(eleTop);
    const windowHeight = $(window).height();

    const isLoadingAnimationVisible = (eleTop - scrollTop) > 0 && (eleTop - scrollTop)  < windowHeight;

    if(isLoadingAnimationVisible && !$('#jobsTable').hasClass('loading-jobs'))
    {
      
      // Prevent mutliple loading at the same time
      $('#jobsTable').addClass('loading-jobs');

      let nextPage = parseInt($('#jobsTable').attr('data-next-jobs-page'));
      $('#jobsTable').attr('data-next-jobs-page', ++nextPage);

      // Prepare URL
      let url = window.location.href;
      url += url.endsWith('/') ? '?' : '&';
      url += `page=${nextPage}`;

      $.ajax({
        type: 'GET',
        url : url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (jobsHtml){

          // jobsHtml is empty means no more pages
          // Hide loading animation
          if(jobsHtml == '')
          {
            $('.auto-load-jobs-animation').remove();
            // Stop listening to the scroll event
            $(window).off('scroll');
          }

          $('#jobsTable').append(jobsHtml);

          $('#jobsTable').removeClass('loading-jobs');
        },
        error: function (error){
          console.log(error);
        },
        processData: false,
        contentType: false,
      })
    }
  })

  /* Methods for handling favorite and unfavorite jobs */
  
  // From home page

  $(document).on('click', '.favoriteJobBtn', function() {

    const data = {
      favoriteButton: $(this),
      userId: $(this).attr('data-user-id'),
      jobId: $(this).attr('data-job-id')
    }; 
   
    if($(this).hasClass('active') == true)
    {

      // It's unfavorite
      removeFavorite(data);
    } else {

      // It's favorite
      $(this).addClass('active');
      addFavorite(data);
    }
  });
  
  // From favorites page
  
  $('.removeFavoritedJobBtn').click(function () {
    const jobId = $(this).attr('data-job-id');
    $('#removeFavoriteModal .agreeRemoveFavorite').click(function () {
      removeFavorite(jobId, removeJobRow);
    })
  })
  
  // Favorite job AJAX
  
  function addFavorite(data){

    data.favoriteButton.addClass('active');
  
    $.ajax({
      type: 'POST',
      url : 'http://127.0.0.1:8000/user/jobs/favorited/add',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        jobId: data.jobId,
        userId: data.userId
      },
      success: function (data){
  
      },
      error: function (error){
        data.favoriteButton.removeClass('active');
      }
    })
  }
  
  // Unfavorite job AJAX
  
  function removeFavorite(data){
    data.favoriteButton.removeClass('active');

    $.ajax({
      type: 'POST',
      url : 'http://127.0.0.1:8000/user/jobs/favorited/remove',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        jobId: data.jobId,
        userId: data.userId
      },
      success: function (data){
        console.log('SUCCESs');
      },
      error: function (error){
        console.log('ERROR');
      }
    })
  }
  
  /* Methods for handling deleting user created jobs */
  
  $('.deleteJob').click(function() {
    const data = {
      deleteBtn: this,
      jobId: $(this).attr('data-job-id')
    };

      $('#deleteJobModal .agreeDeleteJob').click(function() {
         deleteJob(data);
      })
  });
  
  // Delete job AJAX
  
  function deleteJob(ajaxData){
    $.ajax({
      type: 'POST',
      url : `http://127.0.0.1:8000/job/${ajaxData.jobId}/delete`,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {},
      success: function (data){
        $(ajaxData.deleteBtn)
        .parents('tr')
        .remove();
      },
      error: function (error){
        console.log(error);
      }
    })
  }
  
  
  // Callbacks
  
  // Change buttton UI for favoite/unfavorite
  
  function changeFavoriteBtnUI(data){
    const jobId = data.jobId;
    const action = data.action;
  
     if(action == 'remove')
     {
      $(`.favoriteJobBtn[data-job-id=${jobId}]`).removeClass('active');
     } else {
      $(`.favoriteJobBtn[data-job-id=${jobId}]`).addClass('active');
     }
  }
    
  // Add click to jobs table rows

  $(document).on('click', '#jobsTable tr', function(e) {
    if(!e.target.matches(':is(.favoriteJobBtn, .favoriteJobBtn *)'))
    {
     const href = $(this).attr('data-href');
     window.location.assign(href);
    }
 })  
  
  // Apply to job
  
  $('.sendCvBtn').click(applyToJob);
  
  function applyToJob(e) {
  
    // Collects form data
    const formData = new FormData();
    formData.append('jobId', $(this).attr('data-job-id'));
    formData.append('cvFile', $("input[name='cvFile']")[0].files[0]);
    
    // Empty the errors
    $('.input-error').text('');
  
    // Send ajax request
    $.ajax({
      type: 'post',
      url: `http://127.0.0.1:8000/job/apply`,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: formData,
      success: function (data) {
        $('#uploadCvModal .modal-body').html("<h4 class='text-center text-success'>You have successfully applied to the job</h4>");
      },
      error: function (err) {
        console.log(err);
        if(err.status == 422)
        {
          // It is a form validation errors
          // Show errors
          Object.keys(err.responseJSON.errors).forEach(input => {
            $(`input[name=${input}]`).siblings('p.input-error').text(err.responseJSON.errors[input][0]);
          })
        } else {
          $('#uploadCvModal .modal-body').html("<h4 class='text-center text-danger'>Error sending the email!</h4>");
        }
      },
      contentType: false,
      processData: false
    })
  
  }
  
  $(document).ajaxStart(function () {
    setSendButtonState('loading');
  }).ajaxStop(function() {
    setSendButtonState('normal');
  });
  
  // Set the sendCV button state before/after ajax call
  function setSendButtonState(state) {
     if(state.toLowerCase() == 'normal')
     {
      $('.sendCvBtn').text('send CV');
      // $('.sendCvBtn').removeAttr('disabled');
     } else {
      $('.sendCvBtn').text('sending...');
      $('.sendCvBtn').attr('disabled', '');
     }
  }
  
  // Contact Us
  
  $('#contactUsBtn').click(function (){
  
    $(this).addClass('is-loading')
  
    // Clear previous errors
    $('.input-error').each(function (){
      $(this).text('');
    })
  
    $.ajax({
      type: 'post',
      url: `http://127.0.0.1:8000/about/contact_us`,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: new FormData($('#contactForm').get(0)),
      success: function (data) {
        $('#contactUsBtn').removeClass('is-loading');
  
        $('.contact-box .alert-box')
        .attr('class', 'alert-box alert alert-success')
        .text('Email sent successfully');
      },
      error: function (err) {
        $('#contactUsBtn').removeClass('is-loading');
  
        if(err.status == 422)
        {
          // It is a form validation errors
          // Show errors
  
          const inputErrors = err.responseJSON.errors;
  
         $.each(inputErrors, function (key, value){
            $(`.input-error[data-input='${key}']`).text(value[0]);
          })
  
        }
        else {
          $('.contact-box .alert-box')
          .attr('class', 'alert-box alert alert-danger')
          .text('Error sending the email');
        }
      },
      contentType: false,
      processData: false
    })
  
  })
})


