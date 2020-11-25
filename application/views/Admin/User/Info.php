<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo isset($h2_title) ? $h2_title : '' ?></h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-body">
            <div class="form-group">
              <img src="<?php echo base_url() . $default['Photo']; ?>" style="width:100%;">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
<?php
  echo!empty($message) ? '<div class="box-header"><p class="text-red">' . $message . '</p></div>' : '';

  $flashmessage = $this->session->flashdata('message');
  echo!empty($flashmessage) ? '<div class="box-header"><p class="text-red">' . $flashmessage . '</p></div>' : '';
?>
          <div class="box-body">
            <div class="form-group">
              <label>Username</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['UserName'] ?>">
            </div>
            <div class="form-group">
              <label>Nama Depan</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['FirstName'] ?>">
            </div>
            <div class="form-group">
              <label>Nama Belakang</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['LastName'] ?>">
            </div>
            <div class="form-group">
              <label>No HP</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['HP'] ?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['Email'] ?>">
            </div>
            <div class="form-group">
              <label>Ulang Tahun</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['NBirthday'] ?>">
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <input readonly type="text" class="form-control" value="<?php echo $default['Gender'] ?>">
            </div>
            
            <!-- Tombol kembali -->
            <button onClick="javascript:window.open('<?php echo $link; ?>', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-arrow-left"></i></button>
            <!-- Tombol unggah -->
            <button onClick="javascript:window.open('<?php echo $link; ?>/UploadFile/<?php echo $default['ID']; ?>', '_self');" class="btn btn-social-icon btn-warning btn-sm"><i class="fa fa-upload"></i></button>
            <!-- Tombol Edit -->
            <button onClick="javascript:window.open('<?php echo $link; ?>/update/<?php echo $default['ID']; ?>', '_self');" class="btn btn-social-icon btn-warning btn-sm"><i class="fa fa-edit"></i></button>
            <button onClick="javascript:window.open('<?php echo $link; ?>/access/<?php echo $default['ID']; ?>', '_self');" class="btn btn-warning btn-sm">Hak Akses</button>
            <button onClick="javascript:window.open('<?php echo $link; ?>/updatePassword/<?php echo $default['ID']; ?>', '_self');" class="btn btn-warning btn-sm">Password</button>
            <button onClick="javascript:window.open('<?php echo $link; ?>/updateEmail/<?php echo $default['ID']; ?>', '_self');" class="btn btn-warning btn-sm">Email</button>
            <!-- Tombol Hapus -->
            <button onClick="javascript:confirmDialog('Apakah anda yakin menghapus data ini ?','<?php echo $link; ?>/delete/<?php echo $default['ID']; ?>');" class="btn btn-social-icon btn-danger btn-sm"><i class="fa fa-times"></i></button>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>