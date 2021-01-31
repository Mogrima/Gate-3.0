<script>
 $('#reg-form').submit(function(event) {
    event.preventDefault();
    let tk = '';
    grecaptcha.ready(function() {
          grecaptcha.execute('6LfJljAaAAAAAHHrGwm6lU1CcfQUs9CK4IOHzF_p', {action: 'homepage'}).then(function(token) {
             tk = token;
             document.getElementById('token').value = token;
                 var username = $('#username').val();
    var userpass = $('#userpass').val();
    var userpass2 = $('#userpass2').val();
    var useremail = $('#useremail').val();

    $.ajax({
      url: "./core/business/signup__modal.php",
      type: 'POST',
      cache: false,
      data: {
        'token': tk,
        'username': username,
        'userpass': userpass,
        'userpass2': userpass2,
        'useremail': useremail
      },
      dataType: 'html',
      success: function(data) {
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
        });
  });
</script>