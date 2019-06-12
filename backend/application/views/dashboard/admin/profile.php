      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Profile PDM</h4>
                  <p class="card-category">Ubah Data Profile PDM</p>
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
                                    Data berhasil diubah.
                                  </span>
                                </div><br>";
                         }
                      }
                  ?>
                <?php foreach ($admin as $adm) { ?>
                  <form action="<?php echo base_url().'admin/profile_act'; ?>" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama PDM</label>
                          <input type="hidden" name="id" value="<?php echo $adm->id; ?>">    
                          <input type="text" class="form-control" value="<?php echo $adm->nama; ?>" name="nama">
                          <?php echo form_error('nama'); ?>
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $adm->email; ?>">
                          <?php echo form_error('email'); ?>                          
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Alamat</label>
                          <input type="text" class="form-control" name="alamat" value="<?php echo $adm->alamat; ?>">
                          <?php echo form_error('alamat'); ?>                          
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