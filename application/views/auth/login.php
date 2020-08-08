  <div class="row">
    <div class="col-3">
      <form id="loginForm">
        <input type="email" class="form-control" name="email" maxlength="128" required/>
        <input type="password" class="form-control" name="password" minlength="8" maxlength="32" required/>
        <button type="submit" class="btn btn-success" id="loginBtn">Login</button>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    $('#loginForm').submit(function(e){

      e.preventDefault();

      if(this.checkValidity()){
        alert('win');
      }else{
        $(this).addClass('was-validated');
      }
    });
  </script>
