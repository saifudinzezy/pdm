<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">                        
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="card-title mt-0">Data Laporan Asset</h4>
                                <p class="card-category"> Cetak Laporan Asset Tahunan</p>                            
                            </div>

                            <div class="col-md-2">                            
                                Tahun :
                               <form class="navbar-form" method="post" action="<?php echo base_url().'cetaklap' ?>">
                                  <div class="input-group no-border">

                                    <select class="form-control" style="color:white" name="tahun">
                                       <?php foreach ($tahun as $t) {   
                                       ?>
                                       <option style="color:black"><?php echo date("Y", strtotime($t->tahun)); ?></option>
                                        <?php } ?>
                                    </select >

                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                      <i class="material-icons">search</i>
                                      <div class="ripple-container"></div>
                                    </button>
                                  </div>
                                </form>

                            </div>
                        </div>
                    </div>                    

                    <br>
                    <div class="btn-group">
                        <!-- <form method="post" action="<?php echo base_url().'cetaklap/printspdf' ?>">
                            <input type="hidden" name="tahun" value="<?php echo set_value('tahun') ?>">
                             <button type="submit" class="btn btn-primary">
                                <i class="material-icons">print</i>
                            Cetak PDF
                        </form> -->
                        <!-- <a class="btn btn-danger btn-sm" href="<?php echo base_url().'cetaklap/printspdf' ?>">
                            <i class="material-icons">print</i>
                            Cetak PDF
                        </a> -->
                        <a class="btn btn-success btn-sm" href="<?php echo base_url().'cetaklap/prints/?tahun='.set_value('tahun') ?>">
                            <i class="material-icons">print</i>
                            Print
                        </a>
                    </div>

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
