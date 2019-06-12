<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">                        
                        <div class="row">
                            <div class="col-md-11">
                                <h4 class="card-title mt-0">Data PCM</h4>
                                <p class="card-category"> Kelola anggota PCM</p>                            
                            </div>
                            <div class="col-md-1">                            
                                <a href="<?php echo base_url().'user/add'; ?>">
                                    <button type="submit" class="btn btn-warning btn-round btn-just-icon">
                                    <i class="material-icons">add</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                </button>
                            </div>
                        </div>
                    </div>                    

                    <?php 
                      //cek ada kiriman data
                      if (isset($_GET['pesan'])) {
                        //cek apakah pesan == gagal
                        if ($_GET['pesan'] == 'success') {
                          echo " <br>
                                <div class='alert alert-success'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Data berhasil dihapus.
                                  </span>
                                </div>";
                         }else if ($_GET['pesan'] == 'update') {
                          echo " <br>
                                <div class='alert alert-success'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Data berhasil diubah.
                                  </span>
                                </div>";
                         }
                      }
                    ?>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="table-datatable">                        
                                <thead class="">
                                    <th>No</th>
                                    <th>Kode Daftar</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php 
                                        $no = 1;
                                        foreach ($pengguna as $p) {
                                    ?>
                                    <td><?php echo $no++; ?></td>
                                     <!-- get data pengguna kiriman dari controller pengguna -->
                                     <td><?php echo $p->kode_daftar; ?></td>
                                     <td><?php echo $p->nama; ?></td>
                                     <td><?php echo $p->email; ?></td>
                                     <td><?php echo $p->alamat; ?></td>
                                     <td><?php echo $p->password; ?></td>
                                        <td class="td-actions text-right">
                                            <a href="<?php echo base_url().'user/edit/'.$p->id; ?>">
                                                <button type="button" rel="tooltip" title="Edit Task"
                                                        class="btn btn-primary btn-link btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </a>
                                            <a href="<?php echo base_url().'user/hapus/'.$p->id; ?>">
                                                <button type="button" rel="tooltip" title="Remove"
                                                        class="btn btn-danger btn-link btn-sm">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </a>
                                        </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>