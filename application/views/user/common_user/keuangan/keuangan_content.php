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
                                <i class="fa fa-dashboard"></i> <a href="<?=base_url()?>user/common_user/dashboard">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-money "></i> <a href="<?=base_url()?>user/common_user/akuntansi/<?=$store['store_id']?>">Keuangan</a>
                            </li>

                           

                            
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
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
                        
                  <div class="col-md-6">
                     <a href="<?=base_url()?>user/common_user/keuangan/ratio_kalkulasi/<?=$store['store_id']?>/likuiditas" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Rasio Likuiditas</h3>
                     <p>Menilai kemampuan bisnis anda untuk </p>
                     <p>melunasi hutang jangka pendek</p>
                     </a>

                       <a href="<?=base_url()?>user/common_user/keuangan/ratio_kalkulasi/<?=$store['store_id']?>/solvensi" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Rasio Solvensi</h3>
                     <p>Menilai kemampuan bisnis anda untuk </p>
                     <p>memenuhi hutang jangka panjang</p>
                    </a>



                         


                       
                    </div>
                    <div class="col-md-6">
                   

                     <a href="<?=base_url()?>user/common_user/keuangan/ratio_kalkulasi/<?=$store['store_id']?>/aktivitas" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Rasio Aktivitas</h3>
                     <p>Mengukur kinerja bisnis anda dan </p>
                     <p>keuntungan dari usaha anda</p>
                     </a>


                     <a href="<?=base_url()?>user/common_user/keuangan/ratio_kalkulasi/<?=$store['store_id']?>/profitabilitas" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Rasio Profitabilitas</h3>
                     <p>Mengukur kinerja bisnis anda dan </p>
                     <p>keuntungan dari usaha anda</p>
                     </a>
                       

                    

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

    
    <script src="<?=base_url()?>public/assets/admin/plugin/datepicker/bootstrap-datetimepicker.js"></script>

     <script type="text/javascript">
        
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 3,
    minView: 3,
    maxViewMod:3,
    forceParse: 0
    });
    </script>

</body>

</html>
