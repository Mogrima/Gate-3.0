<script>
  $('#login-form').submit(function (event) {
    event.preventDefault();
    var username = $('#login-name').val();
    var password = $('#login-pass').val();

    $.ajax({
      url: "./core/business/auth_modal.php",
      type: 'POST',
      cache: false,
      data: {
        'username': username,
        'password': password
      },
      dataType: 'html',
      success: function (data) {
        if (data == 'OK') {
          $('#errorLogin').hide();
          $('.login__button').text('Загрузка..');
          document.location.reload(true); // перезагрузка страницы
        } else {
          $('#errorLogin').show();
          $('#errorLogin').text(data);
        }
      }
    });
  });
</script>