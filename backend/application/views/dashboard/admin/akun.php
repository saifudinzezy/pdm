      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Akun PDM</h4>
                  <p class="card-category">Ubah Data Akun PDM</p>
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
                  <form action="<?php echo base_url().'admin/akun_act'; ?>" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="hidden" name="id" value="<?php echo $adm->id; ?>">      
                          <input type="text" class="form-control" value="<?php echo $adm->username ?>" name="username">
                          <?php echo form_error('username'); ?>
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="pass_baru">
                          <?php echo form_error('pass_baru'); ?>                          
                        </div>
                      </div>                      
                    </div>  
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Ulangi Password</label>
                          <input type="password" class="form-control" name="ulang_pass">
                          <?php echo form_error('ulang_pass'); ?>                          
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