<!DOCTYPE html>
<html>
  <!-- </head> -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/dist/css/skins/_all-skins.min.css">


    <!-- Morris chart -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/morris.js/morris.css">-->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE/dist/css/AdminLTE.min.css">

    <!-- <link href="<?php echo base_url() ?>AdminLTE/bower_components/datatables/css/buttons.datatables.min.css" rel="stylesheet" type="text/css" />-->
    <!-- <link href="<?php echo base_url() ?>AdminLTE/bower_components/datatables/css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!-- <link href="<?php echo base_url() ?>AdminLTE/bower_components/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css" />-->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script language="javascript">
      function confirmDialog(confirmDIalog, url) {
        var r = confirm(confirmDIalog);
        if (r == true)
        {
          x = window.open(url, '_self');
        }
      }

      function checkAll(id, row) {
        if (document.getElementById(id).checked) {
          for (i = 0; i < row; i++)
          {
            document.getElementById(id + i).checked = true;
          }
        } else {
          for (i = 0; i < row; i++)
          {
            document.getElementById(id + i).checked = false;
          }
        }
      }

      function setTwoNumberDecimal(event) {
        this.value = parseFloat(this.value).toFixed(2);
      }
      
      function showNotification() {
        //Inisialisasi
        $.ajax({
          url:"<?php echo base_url();?>index.php/NotificationAdmin/showNotification/",
          success: function(response){
            $("#listNotification").html(response);
          },
          dataType:"html"
        });
        
        //timer
        setInterval(function(){
          $.ajax({
            url:"<?php echo base_url();?>index.php/NotificationAdmin/showNotification/",
            success: function(response){
              $("#listNotification").html(response);
            },
            dataType:"html"
          });
          return false;
          
        }, 30000);
      }
    </script>
  </head>
  <body class="hold-transition skin-green sidebar-mini" onLoad="showNotification(); onLoadTypePrice()" >
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url() ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>I</b>HP</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>IHP</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
          
          
          <div id="listNotification"></div>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url() . 'uploads/Empty.jpg'; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('LoginName'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?php echo site_url('Login/processLogout'); ?>" class="btn btn-default btn-flat">Keluar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            <li class="<?php echo ($this->session->userdata('menu1') == 'Home') ? 'active' : '' ?>"><a href="<?php echo site_url('Admin/Home'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="<?php echo ($this->session->userdata('menu1') == 'Roles') ? 'active' : '' ?>"><a href="<?php echo site_url('Admin/Roles'); ?>"><i class="fa fa-dashboard"></i> <span>Roles</span></a></li>
            <li class="<?php echo ($this->session->userdata('menu1') == 'User') ? 'active' : '' ?>"><a href="<?php echo site_url('Admin/User'); ?>"><i class="fa fa-circle-o"></i> User</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <?php isset($main_view) ? $this->load->view($main_view) : ''; ?>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
      </footer>

      <div class="control-sidebar-bg"></div>
    </div>

    <script src="<?php echo base_url() ?>AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url() ?>AdminLTE/dist/js/demo.js"></script>
    <script>
      function openMenu(Menu1, Menu2, Menu3, url) {
        //alert(url);
        
        $.ajax({
          url:"<?php echo base_url();?>index.php/Session/sessions/"+
              Menu1+"/"+
              Menu2+"/"+
              Menu3,
          success: function(response){ window.open(url, '_self'); },
          dataType:"html"
        });
        return false;
      }
      
      
      /*
      function changePrice(i, Code, ID, Day) {
        TimeStart = document.getElementById("TimeStart" + i).value;
        TimeFinish = document.getElementById("TimeFinish" + i).value;
        Overpax = document.getElementById("Overpax" + i).value;
        Price = document.getElementById("Price" + i).value;
        Point = document.getElementById("Point" + i).value;
        
        $.ajax({
          url:"<?php echo base_url();?>index.php/MasterRoomTypePrice/changePrice/"+
              Code+"/"+
              ID+"/"+
              Day+"/"+
              TimeStart+"/"+
              TimeFinish+"/"+
              Overpax+"/"+
              Price+"/"+
              Point,
          success: function(response){},
          dataType:"html"
        });
        return false;
      }*/
      
      

      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
      })
      /*
       $(function () {
       // Replace the <textarea id="editor1"> with a CKEditor
       // instance, using default configuration.
       CKEDITOR.replace('editor2')
       //bootstrap WYSIHTML5 - text editor
       $('.textarea').wysihtml5()
       })*/

      function confirmDialog(confirmDIalog, url) {
        var r = confirm(confirmDIalog);
        if (r == true)
        {
          x = window.open(url, '_self');
        }
      }

      function GetLookup(url, param1 = 0) {
        if (param1 != 0)
          url = url + "&ff10=" + document.getElementById(param1).value;
        var popup = window.open(url, "Popup", "width=500,height=500");
        popup.focus();
        return false;
      }

      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        for (var i = 1; i <= 20; i++) {
          $('#datepicker' + i).datepicker({
            autoclose: true
          })
        }

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
      })
    </script>
  </body>
</html>
