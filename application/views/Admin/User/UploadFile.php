<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($title) ? $title : ''; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>Other/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>Other/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>Other/plugins/iCheck/square/blue.css">
    <style type="text/css">@import url("<?php echo base_url() . 'Other/css/uploadfile.css'; ?>");</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo base_url() . 'Other/js/jquery-2.1.1.js'; ?>"></script>
    <script src="<?php echo base_url() . 'Other/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'Other/js/jquery.uploadfile.min.js'; ?>"></script>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo"><?php echo isset($h2_title)?$h2_title:'' ?></div><!-- /.login-logo -->
      <div class="login-box-body">
        <div id="main">
          <div id="mulitplefileuploader">Upload</div>
          <script>
            $(document).ready(function() {
              var settings = {
                url: "<?php echo $link.'/ProcessUploadFile'; ?>",
                method: "POST",
                allowedTypes:"xlsx",
                maxFileSize: 1000000,
                fileName: "myfile",
                multiple: false,
                onSuccess:function(files,data,xhr) {
                  $("#status").html("<font color='green'>Upload is success</font>");
                  
                },
                onError: function(files,status,errMsg) {    
                  $("#status").html("<font color='red'>Upload is Failed</font>");
                }
              }
              $("#mulitplefileuploader").uploadFile(settings);
            });
          </script>
          <button onClick="javascript:window.open('<?php echo $link; ?>', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-arrow-left"></i></button>
        </div>
      </div>
    </div>
  </body>
</html>