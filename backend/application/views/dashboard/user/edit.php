      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Ubah Data PCM</h4>
                  <p class="card-category">Ubah data untuk PCM baru</p>
                </div>
                <div class="card-body">

                <?php foreach ($pengguna as $p) { ?>
                  <form action="<?php echo base_url().'user/update' ?>" method="post">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">NO Daftar</label>
                          <input type="hidden" name="id" value="<?php echo $p->id; ?>">
                          <input type="hidden" name="nomer" value="<?php echo $p->kode_daftar; ?>">
                          <input type="text" class="form-control" disabled value="<?php echo $p->kode_daftar; ?>">
                          <?php echo form_error('nomer'); ?>                          
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama PCM</label>
                          <input type="text" name="pcm" class="form-control" value="<?php echo $p->nama; ?>">
                          <?php echo form_error('pcm'); ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $p->email; ?>">
                          <?php echo form_error('email'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Alamat</label>
                          <input type="text" class="form-control" name="alamat" value="<?php echo $p->alamat; ?>">
                          <?php echo form_error('alamat'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="text" class="form-control" name="password" value="<?php echo $p->password; ?>">
                          <?php echo form_error('password'); ?>
                        </div>
                      </div>
                    </div>
                    </div>                    
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    <div class="clearfix"></div>
                  </form>
                  <?php } ?>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>