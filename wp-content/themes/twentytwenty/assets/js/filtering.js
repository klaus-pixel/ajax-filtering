
(function($){

$(document).ready(function(){
  $('.post_type_item').on('click', function() {
    $('.post_type_item').removeClass('active');
    $(this).addClass('active');

    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filter_cpt',
        type: $(this).data('type'),
      },
      success: function(res) {
        $('.post-titles').html(res);
      }
    })
  });
    });

    let currentPage = 1;
    $('#load-more').on('click', function() {
      currentPage++; // Do currentPage + 1, because we want to load the next page
    
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'load_more_cpt',
          paged: currentPage,
        },
        success: function (res) {
          $('.post-titles').append(res);
        }
      });
    });

})(jQuery);