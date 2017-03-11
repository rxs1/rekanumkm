 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?=$title?>
                           
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>user/common_user/dashboard ">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-building-o" aria-hidden="true"></i> <a href="##">Personalize <?=$store['name']?></a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                   <div class="col-md-6 col-md-offset-3">
                        <form role="form" method="POST" enctype="multipart/form-data" action="<?=base_url()?>user/common_user/umkm/edit_process">
                                  <?php
                      if($this->session->userdata('notif_code')){
                          if($this->session->userdata('status')){
                            echo "<p class='alert alert-success'> <i class='glyphicon glyphicon-ok-sign'></i> ".$this->session->userdata('message')."</p>";
                          }else{
                            echo "<p class='alert alert-danger'> <i class='glyphicon glyphicon-remove-sign'></i> ".$this->session->userdata('message')."</p>";
                          }
                      }

                     

                      $this->session->unset_userdata('notif_code');
                      $this->session->unset_userdata('status');
                      $this->session->unset_userdata('message'); 

                ?>
                          
                            <div class="form-group">
                                <label>Nama UMKM</label>
                                <input value="<?=$store['name']?>"  name="name" required type='text' class="form-control" placeholder="ex: PT. UMKM Sukses">
                                <input value="<?=$store['store_id']?>"  name="store_id" required type='hidden' class="form-control" placeholder="ex: PT. UMKM Sukses">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" rows="3"><?=$store['address']?></textarea>
                            </div>
                            <center>
                              <button type="submit" class="btn btn-primary btn-lg" >Konfirmasi Perubahan </button>
                            </center>

                        </form>
                    </div>
                    

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
      <div class="row" style="background: #222;color: #fff;padding: 1%">
                <div class="col-md-12" >
                    <center>
                     
                     <hr>
                     <h2>Copyright &copy; 2017 REKAN Team</h2>
                    </center>
                </div>
            </div>
    <!-- jQuery -->
    <script src="<?=base_url()?>public/assets/admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>public/assets/admin/js/bootstrap.min.js"></script>
    
</script>

</body>

</html>
