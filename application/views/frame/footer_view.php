      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
      token = null;
      tokenIv = null;

    	function resetToastrOptions(){

    		toastr.options = {
    			"closeButton": false,
    			"debug": false,
    			"newestOnTop": false,
    			"progressBar": true,
    			"positionClass": "toast-top-right",
    			"preventDuplicates": true,
    			"onclick": null,
    			"showDuration": "300",
    			"hideDuration": "1000",
    			"timeOut": "5000",
    			"extendedTimeOut": "1000",
    			"showEasing": "swing",
    			"hideEasing": "linear",
    			"showMethod": "fadeIn",
    			"hideMethod": "fadeOut"
    		}
    	}

    	function displayValidationErrors(errors){

    		toastr.options.timeOut = 0;
    		toastr.options.extendedTimeOut = 0;

    		$.each( errors, function( key, value ) {
    			toastr["error"](value, "Validation Error");
    		});

    		resetToastrOptions();
    	}

      $(document).ajaxError(function(event, xhr, settings, thrownError) {
        var code = xhr.status;

        if(code == 401){
          $('#main').load('https://naturalhr-challenge.herokuapp.com/auth/login');
        }
      });

      function loadHome(){
        $.ajax({
          url: 'https://naturalhr-challenge.herokuapp.com/home',
          type: 'GET',
          headers: {
            'BEARER-X' : token,
            'IV' : tokenIv,
          },
          success: function(response){
            $('#main').html(response);
          }
        })
      }

    </script>
  </body>
</html>
