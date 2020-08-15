<script>
  $('#reg-form').submit(function (event) {
    event.preventDefault();
    var username = $('#username').val();
    var userpass = $('#userpass').val();
    var userpass2 = $('#userpass2').val();
    var useremail = $('#useremail').val();

    $.ajax({
      url: "./core/business/signup__modal.php",
      type: 'POST',
      cache: false,
      data: {
        'username': username,
        'userpass': userpass,
        'userpass2': userpass2,
        'useremail': useremail
      },
      dataType: 'html',
      success: function (data) {
        if (data == 'OK') {
          $('#errorReg').hide();
          $('.login__button').text('Загрузка..');
         // document.location.reload(true); // перезагрузка страницы
         window.location.replace(newUrl);
        } else {
          $('#errorReg').show();
          $('#errorReg').text(data);
        }
      }
    });
  });
</script>