<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-6">
            <h3 class="font-weight-light">Upload a file:</h3>
            <form id="fileUploadForm">
              <div class="input-group">

                <input type="file" class="form-control" id="fileUpload" required />
                <div class="input-group-append">
                  <button type="submit" class="btn btn-success">Upload!</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/text/javascript">

  $('#fileUploadForm').submit(function(e){
    e.preventDefault();

    var fileData = $('#fileUpload').prop('files')[0];
    var formData = new formData('')
    formData.append('userfile', fileData);

    $.ajax({
      url: 'https://naturalhr-challenge.herokuapp.com/home/upload_file',
      type: 'POST',
      data: formData,
      success: function(response){
        var obj = $.parseJSON(response),
          code = obj.code;

        if(code == -1){
          displayValidationErrors(obj.errors);
        }else{

          var type = obj.type,
            title = obj.title,
            message = obj.message;

          toastr[type](message, title);

          if(code == 1){

          }
        }
      }
    })
  });
</script>
