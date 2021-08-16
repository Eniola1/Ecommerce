<?php 

if(isset($_GET['name']))
{
  $username = $_GET['name'];    
}

$info = "SELECT * FROM customers WHERE username = '$username'";
$run_info = mysqli_query($con, $info);

while($row = mysqli_fetch_array($run_info))
{
    $email = $row['email']; 
    $phone_no = $row['phone'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cropper.js</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@4/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/cropper.css">
  <style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .alert {
      display: none;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Upload cropped image to server</h1>
    <label class="label" data-toggle="tooltip" title="Change your avatar">
      <img class="rounded" id="avatar" src="https://avatars0.githubusercontent.com/u/3456749?s=160" alt="avatar">
      <input type="file" class="sr-only" id="input" name="image" accept="image/*">
    </label>
    <input type="hidden" name="user" value="<?php echo $username?>" id="user">
    <div id = "inf">
      <button id="">
        Username
        <?php echo $username ?>
      </button>
      <button id="">
        Status
        <?php echo $email ?>
      </button>
      <button id="">
        phone_no
        <?php echo $phone_no ?>
      </button></a>
    </div>
    <div id = "msg"> </div>
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div class="alert" role="alert"></div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Crop the image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id = "msg"><a href = "customer_login.php"> <button> Next</button> </a> </div>
  
  <script src="https://unpkg.com/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap@4/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/cropper.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
      var $alert = $('.alert');
      var $modal = $('#modal');
      var cropper;

      $('[data-toggle="tooltip"]').tooltip();

      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });

      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 3,
        });
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

        document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
          });
          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          $progress.show();
          $alert.removeClass('alert-success alert-warning');
            var url = avatar.src;
            var username = $('#user').val();
            //url = url.split('/');
            //var num = url.length - 1;
            //console.log('url: >>>>>>> ' + url[num]);
            //$.get('profile_info.php?url=' + url[num]);
            console.log('url: >>>>>>> ' + url);
            //window.open('profile_info.php?url=' + url, '_self')

            $.ajax({
                url:'profile_pic.php',
                method:'post',
                data:{url:url, username:username},
                success:function(response)
                {
                    $("#msg").html(response);
                }
            });
        }
      });
    });
  </script>


</body>

</html>
