
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
})(jQuery);