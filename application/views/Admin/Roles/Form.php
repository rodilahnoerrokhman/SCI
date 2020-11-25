<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo isset($h2_title) ? $h2_title : '' ?></h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
<?php
  echo!empty($message) ? '<p class="text-red">' . $message . '</p>' : '';
  
  $flashmessage = $this->session->flashdata('message');
  echo!empty($flashmessage) ? '<p class="text-red">' . $flashmessage . '</p>' : '';
?>
            <form id="form_" name="form_" method="post" action="<?php echo $form_action; ?>" autocomplete="off">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="Name" id="Name" value="<?php echo set_value('Name', isset($default['Name']) ? $default['Name'] : ''); ?>">
                <?php echo form_error('Name', '<p class="text-red">', '</p>'); ?>
              </div>
            </form>
            <button onClick="javascript:window.open('<?php echo $link; ?>', '_self');" class="btn btn-social-icon btn-primary btn-sm"><i class="fa fa-arrow-left"></i></button>
            <button type="submit" form="form_" class="btn btn-social-icon btn-primary btn-warning btn-sm"><i class="fa fa-save"></i></button>
           </div>
        </div>
      </div>
    </div>
  </section>
</div>
