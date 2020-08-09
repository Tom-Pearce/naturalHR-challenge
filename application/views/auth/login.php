  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-6 border-right border-info">
              <h3 class="fon-weight-light">Existing User</h3>
              <form id="loginForm">
                <input type="email" class="form-control mb-2" name="email" maxlength="128" placeholder="Email" required/>
                <input type="password" class="form-control mb-2" name="password" minlength="8" maxlength="32" placeholder="Password" required/>
                <button type="submit" class="btn btn-success float-right" id="loginBtn">Login</button>
              </form>
            </div>
            <div class="col-6" id="signUpArea">
              <h3 class="fon-weight-light">New User</h3>
              <form id="signupForm">
                <div class="row mb-2">
                  <div class="col-6">
                    <input type="text" class="form-control" name="first_name" maxlength="64" placeholder="First Name" required/>
                  </div>
                  <div class="col-6">
                    <input type="text" class="form-control" name="last_name" maxlength="64" placeholder="Last Name" required/>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-12">
                    <input type="email" class="form-control" name="email" maxlength="128" placeholder="Email" required/>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-6">
                    <input type="password" class="form-control" name="password" maxlength="64" placeholder="Password" required/>
                  </div>
                  <div class="col-6">
                    <input type="password" class="form-control" name="password_confirm" maxlength="64" placeholder="Confirm Password" required/>
                  </div>
                </div>

                <button type="submit" class="btn btn-success float-right">Signup!</button>
              </form>
            </div>
          </div>
        </div>
      </div>
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
                displayValidationErrors(obj.errors)
              }else{

                var type = obj.type,
                  title = obj.title,
                  message = obj.message;

                toastr[type](message, title);

                if(code == 1){
                  token = obj.token_data.token;
                  tokenIv = obj.token_data.iv;
                  loadHome();
                }
              }
            }
          });
        }else{
          $(this).addClass('was-validated');
        }
      });

      $('#signupForm').submit(function(e){

        e.preventDefault();

        if(this.checkValidity()){

          var formData = $(this).serialize();

          $.ajax({
            url: 'https://naturalhr-challenge.herokuapp.com/signup/task',
            type: 'POST',
            data: formData,
            success: function(response){
              var obj = $.parseJSON(response),
                code = obj.code;

              if(code == -1){
                displayValidationErrors(obj.errors)
              }else{

                var type = obj.type,
                  title = obj.title,
                  message = obj.message;

                toastr[type](message, title);

                if(code == 1){
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
