      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Tambah Data PCM</h4>
                  <p class="card-category">Tambahkan data untuk PCM baru</p>
                </div>
                <div class="card-body">

                  <?php 
                      //cek ada kiriman data
                      if (isset($_GET['pesan'])) {
                        //cek apakah pesan == gagal
                        if ($_GET['pesan'] == 'success') {
                          echo "<div class='alert alert-success'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Data berhasil disimpan.
                                  </span>
                                </div><br>";
                         }
                      }
                  ?>

                  <form action="<?php echo base_url().'user/add_act'; ?>" method="post">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">NO Daftar</label>
                          <input type="hidden" name="nomer" value="PCMPKL-<?php echo $kode; ?>">
                          <input type="text" class="form-control" disabled value="PCMPKL-<?php echo $kode; ?>">
                          <?php echo form_error('nomer'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama PCM</label>
                          <input type="text" class="form-control" name="pcm">
                          <?php echo form_error('pcm'); ?>                          
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email">
                          <?php echo form_error('email'); ?>          
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Alamat</label>
                          <input type="text" class="form-control" name="alamat">
                          <?php echo form_error('alamat'); ?>                          
                        </div>
                      </div>                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="password">
                          <?php echo form_error('password'); ?>
                        </div>
                      </div>
                    </div>
                    </div>                    
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>