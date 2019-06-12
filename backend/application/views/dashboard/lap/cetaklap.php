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
                                       <option style="color:black"><?php echo $t->tahun; ?></option>
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

                </div>
            </div>
        </div>
    </div>
