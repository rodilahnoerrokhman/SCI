<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo isset($h2_title) ? $h2_title : '' ?></h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <button type="button" onClick="javascript:window.open('<?php echo $link; ?>/add', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-plus"></i></button>
          </div><!-- /.box-body --> 
<?php
  echo!empty($message) ? '<div class="box-body"><p class="text-red">' . $message . '</p></div>' : '';

  $flashmessage = $this->session->flashdata('message');
  echo!empty($flashmessage) ? '<div class="box-body"><p class="text-red">' . $flashmessage . '</p></div>' : '';
?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
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
                <th>Nama</th>
              </tr>
<?php
      for ($x = 0; $x < count($result['array_']); $x++) {
 ?>
              <tr>
                <td><?php echo ($x + 1); ?>.</td>
                <td>
                  <button onClick="javascript:window.open('<?php echo $link; ?>/update/<?php echo $result['array_'][$x][0]; ?>', '_self');" class="btn btn-social-icon btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                  <button onClick="javascript:confirmDialog('Apakah anda yakin menghapus data ini ?','<?php echo $link; ?>/delete/<?php echo $result['array_'][$x][0]; ?>');" class="btn btn-social-icon btn-danger btn-sm"><i class="fa fa-times"></i></button>
                </td>
                <td><?php echo $result['array_'][$x][1]; ?></td>
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
      </div>
    <!-- /.box -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>