  <div class="row">
    <div class="col-3">
      <form id="loginForm">
        <input type="email" class="form-control" name="email" maxlength="128" placeholder="Email" required/>
        <input type="password" class="form-control" name="password" minlength="8" maxlength="32" placeholder="Password" required/>
        <button type="submit" class="btn btn-success" id="loginBtn">Login</button>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#loginForm').submit(function(e){

        e.preventDefault();

        if(this.checkValidity()){

          var formData = $(this).serialize();

          $.ajax({
            url: 'https://naturalhr-challenge.herokuapp.com/auth/login_task',
            type: 'POST',
            data: formData,
            success: function(response){
              var obj = $.parseJSON(response),
                code = obj.code;

              if(code == -1){


              }else{

                var type = obj.type,
                  title = obj.title,
                  message = obj.message;

                toastr[type](message, title);

                if(code == 1){
                  alert(obj.token);
                }
              }
            }
          });
        }else{
          $(this).addClass('was-validated');
        }
      });
    });
  </script>
