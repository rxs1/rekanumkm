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
                                <i class="fa fa-money "></i> <a href="<?=base_url()?>user/common_user/pajak/<?=$store['store_id']?>">pajak</a>
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
                        
                  <div class="col-md-12">
                     <a href="<?=base_url()?>user/common_user/pajak/pajak_kalkulasi/<?=$store['store_id']?>/kawin" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Status: Kawin</h3>
                     <p>Berkeluarga</p>
                     </a>

                       <a href="<?=base_url()?>user/common_user/pajak/pajak_kalkulasi/<?=$store['store_id']?>/tidak-kawin" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>Status: Tidak Kawin</h3>
                     <p></p>
                     <a href="<?=base_url()?>user/common_user/pajak/pajak_kalkulasi_manual/<?=$store['store_id']?>/" style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> <h3>MANUAL INPUT PERBULAN</h3>
                     <p>INPUT MANUAL PAJAK PPH21</p>
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
