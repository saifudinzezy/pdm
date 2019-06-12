<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Anggota PDM</p>
                        <h3 class="card-title"><?php echo $this->m_crud->get_admin('pengguna')->num_rows(); ?>
                            <small>Anggota</small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">person</i>
                            <a href="<?php echo base_url().'user'; ?>">Lihat selengkapnya...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <p class="card-category">Lap. Diterima</p>
                        <h3 class="card-title"><?php echo $this->m_crud->get_data_report('laporan', '2'); ?>
                            <small>Diterima</small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">content_paste</i>
                            <a href="<?php echo base_url().'laporan'; ?>">Lihat selengkapnya...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Lap. Ditolak</p>
                        <h3 class="card-title">
                            <?php echo $this->m_crud->get_data_report('laporan', '1'); ?>
                            <small>Ditolak</small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">info_outline</i> 
                            <a href="<?php echo base_url().'laporan'; ?>">Lihat selengkapnya...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <p class="card-category">Total Laporan</p>
                        <h3 class="card-title"><?php echo $this->m_crud->get_admin('laporan')->num_rows(); ?>
                            <small>Laporan</small>                            
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i>
                            <a href="<?php echo base_url().'laporan'; ?>">Lihat selengkapnya...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Laporan:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">content_paste</i> Diterima
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">content_paste</i> Ditolak
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#settings" data-toggle="tab">
                                            <i class="material-icons">content_paste</i> Menunggu
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>No</th>
                                <th>Nama PCM</th>
                                <th>Nama Asset</th>
                                <th>Jml. Asset</th>
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
                                </tr>

                            </tbody>
                        </table>
                    </div>
                            </div>

                            <div class="tab-pane" id="messages">
                                 <table class="table table-hover">
                            <thead class="text-primary">
                                <th>No</th>
                                <th>Nama PCM</th>
                                <th>Nama Asset</th>
                                <th>Jml. Asset</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no = 1;
                                        foreach ($laporan2 as $l) {
                                    ?>
                                    <td><?php echo $no++; ?></td>
                                     <!-- get data pengguna kiriman dari controller pengguna -->
                                     <td><?php echo $l->nama; ?></td>
                                     <td><?php echo $l->nama_asset; ?></td>
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
                                </tr>

                            </tbody>
                        </table>
                            </div>
                            <div class="tab-pane" id="settings">
                                 <table class="table table-hover">
                            <thead class="text-primary">
                                <th>No</th>
                                <th>Nama PCM</th>
                                <th>Nama Asset</th>
                                <th>Jml. Asset</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no = 1;
                                        foreach ($laporan3 as $l) {
                                    ?>
                                    <td><?php echo $no++; ?></td>
                                     <!-- get data pengguna kiriman dari controller pengguna -->
                                     <td><?php echo $l->nama; ?></td>
                                     <td><?php echo $l->nama_asset; ?></td>
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
                                </tr>

                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Anggota PDM</h4>
                        <p class="card-category">List Anggota</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            </thead>
                            <tbody>
                           <tr>
                            <?php 
                                $no = 1;
                                foreach ($pengguna as $p) {
                            ?>
                            <td><?php echo $no++; ?></td>
                             <!-- get data pengguna kiriman dari controller pengguna -->
                             <td><?php echo $p->nama; ?></td>
                             <td><?php echo $p->email; ?></td>
                             <td><?php echo $p->alamat; ?></td>
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