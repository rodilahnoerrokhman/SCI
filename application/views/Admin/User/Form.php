<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo isset($h2_title) ? $h2_title : '' ?></h1>
  </section>
  
  <section class="content">
    <div class="row">
      <form id="form_" name="form_" method="post" action="<?php echo $form_action; ?>">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
<?php
  echo!empty($message) ? '<p class="text-red">' . $message . '</p>' : '';

  $flashmessage = $this->session->flashdata('message');
  echo!empty($flashmessage) ? '<p class="text-red">' . $flashmessage . '</p>' : '';
?>

              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="Email" id="Email" value="<?php echo set_value('Email', isset($default['Email']) ? $default['Email'] : ''); ?>">
                <?php echo form_error('Email', '<p class="text-red">', '</p>');?>
              </div>
<?php
  if (!isset($default['ID'])) {
?>
              <div class="form-group">
                <label>Password</label>
                <input type="Password" class="form-control" name="Password" id="Password" value="<?php echo set_value('Password', isset($default['Password']) ? $default['Password'] : ''); ?>">
                <?php echo form_error('Password', '<p class="text-red">', '</p>'); ?>
              </div>
<?php
  }
?>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="Name" id="Name" value="<?php echo set_value('Name', isset($default['Name']) ? $default['Name'] : ''); ?>">
                <?php echo form_error('Name', '<p class="text-red">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label>Role</label>
                <select name="Role" class="form-control">
                  <option <?php echo set_value('Role', isset($default['Role']) ? $default['Role'] : '') == '' ? 'selected' : '' ?> value=""></option>
<?php
  if (isset($DataRole) and count($DataRole) > 0) {
    for ($i = 0; $i < count($DataRole); $i++) {
?>
                  <option <?php echo set_value('Role', isset($default['Role']) ? $default['Role'] : '') == $DataRole[$i][0] ? 'selected' : '' ?> value="<?php echo $DataRole[$i][0] ?>"><?php echo $DataRole[$i][1] ?></option>
<?php
    }
  }
?>
                </select>
                <?php echo form_error('Role', '<p class="text-red">', '</p>'); ?>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="form-group">
              <!-- Tombol kembali -->
              <button onClick="javascript:window.open('<?php echo $link; ?>', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-arrow-left"></i></button>
              <!-- Tombol simpan -->
              <button type="submit" form="form_" class="btn btn-social-icon btn-primary btn-warning btn-sm"><i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>