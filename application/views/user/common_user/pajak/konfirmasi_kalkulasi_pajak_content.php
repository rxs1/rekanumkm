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
                                <i class="fa fa-money "></i> <a href="##>">Konfirmasi Pajak <?=$pajak?></a>
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

                       


                        <form method="post" action="<?=base_url()?>user/common_user/keuangan/kofirmasi_kalkulasi_pajak/<?=$store['store_id']?>/<?=$pajak?>">
                            
                            <center><p>Kalkulasi Pajak pada bulan <?=$date?>
                            </p></center>
                            <?php
                              if($pajak == 'kawin'){
                            ?>
                                  <center><p>PTKP istri Rp. 

                            </p></center>
                            <?php
                              }
                            ?>
                            <center><p>Tanggungan pajak
                            </p></center>

                            <p class="hidden">
                             <div class="form-group">
                                  <label for="dtp_input2">Bulan Tahun</label>
                                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="MM yyyy" data-link-field="dtp_input2" data-link-format="mm yyyy">
                                  <input class="form-control" size="16" value="<?=$date?>" name="bulan-tahun" type="text"  readonly>
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                                  
                              </div>

                                <?php
                                  if($pajak == 'kawin'){
                                      echo "<p class='alert alert-warning'>PTKP Istri Langsung dihitung saat kalkulasi</p>";
                                  }
                                ?>
                            
                                <div class="form-group col-md-5">
                                  <label for="dtp_input2">Jumlah Tanggungan (Isikan nol jika tidak ada)</label>
                                  <input class="form-control" size="16" name="tanggungan" type="text" value="<?=$totaltanggungan?>" >
                              </div>
                              </p>
                           
                              <div class="col-md-12">
                              <button type="submit" class="btn btn-danger btn-lg">Kalkulasi</button>
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
