<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Data Laporan Asset</h4>
                        <p class="card-category"> Approve laporan dari masing-masing PCM</p>
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
                                    <th>Nama PCM</th>
                                    <th>Nama Asset</th>
                                    <th>Jenis Asset</th>
                                    <th>Jumlah Asset</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php 
                                        $no = 1;
                                        foreach ($laporan as $l) {
                                    ?>
                                    <td><?php echo $no++; ?></td>
                                     <!-- get data pengguna kiriman dari controller pengguna -->
                                     <td><?php echo $l->nama; ?></td>
                                     <td><?php echo $l->nama_asset; ?></td>
                                     <td>
                                        <?php
                                            if ($l->jenis_asset == 0) {
                                                echo "<b>Tidak Bergerak</b>";
                                            }else{
                                                echo "<b>Bergerak</b>";
                                            }
                                        ?>          
                                     </td>
                                     <td><?php echo $l->jml_asset; ?></td>
                                     <td>
                                        <?php 
                                            if ($l->status == 0) {
                                                echo "<span class='btn-warning' style='padding: 4px;'> <b>Belum diperiksa</b>.</span>";
                                            }elseif ($l->status == 1) {
                                                echo "<span class='btn-danger' style='padding: 4px;'> <b>Ditolak</b>.</span>";
                                            }elseif ($l->status == 2) {
                                                echo "<span class='btn-success' style='padding: 4px;'> <b>Diterima</b>.</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo date("d/m/Y", strtotime($l->tanggal)); ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="javascript:;"
                                            data-id="<?php echo $l->id; ?>"
                                            data-kode="<?php echo $l->kode_daftar; ?>"
                                            data-nama="<?php echo $l->nama_asset; ?>"
                                            data-jns="<?php echo $l->jenis_asset; ?>"
                                            data-jml="<?php echo $l->jml_asset; ?>"
                                            data-status="<?php echo $l->status; ?>"
                                            data-tanggal="<?php echo $l->tanggal; ?>"

                                            data-toggle="modal" data-target="#edit-data">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </a>

                                        <a href="<?php echo base_url().'laporan/hapus/'.$l->id; ?>">
                                            <button type="button" rel="tooltip" title="Remove"
                                                    class="btn btn-danger btn-link btn-sm">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Ubah -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Status</h4>                  
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        </div>
                            <form class="form-horizontal" action="<?php echo base_url('laporan/update')?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                        
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" class="form-control" id="kode" name="kode" placeholder="Nama Asset">
                        
                                <input type="hidden" class="form-control" id="nama" name="nama" placeholder="Nama Asset">
                        
                                <input type="hidden" class="form-control" id="jns" name="jns" placeholder="Jns Asset">                                    
                        
                                <input type="hidden" class="form-control" id="jml" name="jml" placeholder="Jml Asset">
                        
                                <input type="hidden" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal">
                                
                                <div class="form-group">
                                    <input type="radio" name="status" value="2" checked="checked"/>Disetujui
                                    <input type="radio" name="status" value="1"/>Ditolak
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Modal Ubah -->
        </div>
    </div>
