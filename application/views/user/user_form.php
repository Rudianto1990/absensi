<!-- Blank Header -->
<section class="content-header">
    <h1>Data User</h1>
</section>
<!-- END Blank Header -->
<div  id="message">
    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
</div>
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
            <div id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <form id="form-validation" action="<?php echo $action; ?>" method="post" class="form-horizontal form-bordered">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Username</label>
                    <div class="col-md-10"><input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" />
                    </div>
                </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-10"><input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
                </div>
            </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="password">Konfirmasi Password</label>
                <div class="col-md-10"><input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Konfirmasi Password" value="<?php echo $password; ?>" />
                </div>
            </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="nama_user">Nama User</label>
                <div class="col-md-10"><input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="nama user" value="<?php echo $nama_user; ?>" />
                </div>
            </div>
                <input type="hidden" name="usernameedit" value="<?php echo $username; ?>" />
                <div class="form-group form-actions">
                    <div class="col-md-9 col-md-offset-2">
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                        <a href="<?php echo site_url('user') ?>" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>			
			</div>
		</div>
	</div>
</div>
</section>