<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo isset($h2_title) ? $h2_title : '' ?></h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Pencarian</h3>
          </div>
          <form name="Form" method="post" action="<?php echo $link; ?>">
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control input-sm" name="Name" id="Name" value="<?php echo set_value('Name', isset($default['Name']) ? $default['Name'] : ''); ?>">
                <input type="hidden" type="text" class="form-control input-sm" name="XX" id="XX" value="1">
              </div>
              <div class="form-group">
                <label>Role</label>
                <input type="text" class="form-control input-sm" name="Role" id="Role" value="<?php echo set_value('Role', isset($default['Role']) ? $default['Role'] : ''); ?>">
              </div>
              <button class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-search"></i></button>
            </div><!-- /.box-body -->
          </form>
          <div class="box-header">
            <h3 class="box-title"></h3>
            <!-- Tombol tambah -->
            <button type="button" onClick="javascript:window.open('<?php echo $link; ?>/add', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-plus"></i></button>
            <button onClick="javascript:window.open('<?php echo $link; ?>/UploadFile', '_self');" class="btn btn-social-icon btn-warning btn-sm"><i class="fa fa-upload"></i></button>
            <button onClick="javascript:window.open('<?php echo $link; ?>/downloadExcel', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-download"></i></button>
          </div>
<?php
  echo!empty($message) ? '<div class="box-header"><p class="text-red">' . $message . '</p></div>' : '';

  $flashmessage = $this->session->flashdata('message');
  echo!empty($flashmessage) ? '<div class="box-header"><p class="text-red">' . $flashmessage . '</p></div>' : '';
?>
        </div>
        <!-- /.box-header -->
        <div class="box">
          <div class="box-body table-responsive no-padding">
<?php
  if (isset($result['array_'])) {
    if (count($result['array_']) > 0) {
?>
                <table id="example2" class="table table-bordered table-hover">
                  <tr>
                    <th>No</th>
                    <th></th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                  </tr>
<?php
      for ($x = 0; $x < count($result['array_']); $x++) {
?>
                    <tr>
                      <td><?php echo ($x + 1); ?>.</td>
                      <td>
<?php
        if($result['array_'][$x][1]<>'nomu') {
?>
                        <!-- Tombol Edit -->
                        <button onClick="javascript:window.open('<?php echo $link; ?>/update/<?php echo $result['array_'][$x][0]; ?>', '_self');" class="btn btn-social-icon btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        <button onClick="javascript:window.open('<?php echo $link; ?>/updatePassword/<?php echo $result['array_'][$x][0]; ?>', '_self');" class="btn btn-warning btn-sm">Password</button>
                        <!-- Tombol Hapus -->
                        <button onClick="javascript:confirmDialog('Apakah anda yakin menghapus data ini ?','<?php echo $link; ?>/delete/<?php echo $result['array_'][$x][0]; ?>');" class="btn btn-social-icon btn-danger btn-sm"><i class="fa fa-times"></i></button>
                  
                  
                  
<?php
        }
?>
                      </td>
                      <td><?php echo $result['array_'][$x][1]; ?></td>
                      <td><?php echo $result['array_'][$x][2]; ?></td>
                      <td><?php echo $result['array_'][$x][3]; ?></td>
                    </tr>
<?php
      }
?>
                </table>
<?php
    }
  }
?>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>