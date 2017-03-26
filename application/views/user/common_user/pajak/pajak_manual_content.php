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
                                <i class="fa fa-money "></i> <a href="<?=base_url()?>user/common_user/pajak/pajak_konten/<?=$store['store_id']?>">Pajak</a>
                            </li>
                            <li>
                                <i class="fa fa-money "></i> <a href="<?=base_url()?>user/common_user/pajak/pajak_kalkulasi_manual/<?=$store['store_id']?>">Kalkulasi Pajak Manual</a>
                            </li>

                            
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin-bottom: 100px">

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

                       <form method="post" action="<?=base_url()?>user/common_user/pajak/pajak_kalkulasi_proses/<?=$store['store_id']?>/unknown/manual">


                          
                                 
                                  <input class="form-control" size="16" name="bulan-tahun" type="hidden" value="Manual Perbulan anda"  readonly>
                              
                              
                                  
                            </div>

                            
                              
                          

                            


                          <div class="form-group col-md-5">
                            <label for="pwd">Status Kawin(Jika kawin PTKP Istri akan di kalkulasi otomatis, saat kalkulasi)</label>
                            <select class="form-control" name="status_kawin" id="sel1" required>
                             <option disabled selected value> -- Pilih Status -- </option>
                              
                                    <option value="kawin">Kawin</option>
                                    <option value="tidak-kawin">Tidak Kawin</option>
                             
                             
                            </select>
                          </div>
                            

                               
                              <div class="form-group col-md-5">
                                  <label for="dtp_input2">ISIKAN NOMINAL LABA/RUGI(bersih) PERBULAN</label>
                                  <input class="form-control" size="16" name="inputlabarugi" type="number" required>
                              </div>

                              <div class="form-group col-md-5">
                                  <label for="dtp_input2">Jumlah Tanggungan (Isikan nol jika tidak ada)</label>
                                  <input class="form-control" size="16" name="jumlah-tanggungan" type="number" required min="0" max="3">
                              </div>
                           
                              <div class="col-md-12">
                              <button type="submit" class="btn btn-danger btn-lg">Kalkulasi</button>
                              </div>
                              <div class="col-md-12" >
                  <?php

                       if( $this->session->userdata('pajak_result')){
                          echo "<p style='padding:2%;font-size:30px;margin:20px' class='alert-success'> Hasil Kalkulasi Pajak pada ".$this->session->userdata('date')." adalah ". $this->session->userdata('pajak_result')."</p>";
                          $this->session->unset_userdata('date');
                           $this->session->unset_userdata('pajak_result'); 
                            
                        }
                       ?>
                </div>
                       </form>
                    


                

                    

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
