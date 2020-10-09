<section class="content-header">
      <h1>
      Data Master User
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
            <div id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
					<div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
							<a type='button' class='btn btn-success btn-flat btn-md' href='<?php echo site_url("user/create") ?>'><i class='fa fa-plus'></i>      Tambah User</a>
							<hr>
              <table id="example1" class="table table-striped table-hover" width="100%">
				  <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
				  </thead>
				  <tbody>
				  <?php
                    $start = 0;
                    foreach($user_data as $user){  ?>
                        <tr>
                            <td class="text-center"><?php echo ++$start ?></td>
                            <td><?php echo $user->username ?></td>
                            <td><?php echo $user->nama_user ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('user/update/'.$user->username) ?>" data-toggle="tooltip" title="Edit User" class="btn btn-effect-ripple btn-md btn-success"><i class="fa fa-pencil"></i></a>

                                <span data-toggle="tooltip" title="Hapus User"><a href="#modal-fade<?php echo $user->username; ?>" data-toggle="modal" class="btn btn-effect-ripple btn-md btn-danger"><i class="fa fa-times"></i></a></span>
                                <div id="modal-fade<?php echo $user->username; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title"><strong>Konfirmasi</strong></h3>
                                            </div>
                                            <div class="modal-body">
                                                Anda yakin ingin menghapus data?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo site_url('user/delete/'.$user->username) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
                                                <button type="button" class="btn btn-effect-ripple btn-info" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
				  </tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
    </section>