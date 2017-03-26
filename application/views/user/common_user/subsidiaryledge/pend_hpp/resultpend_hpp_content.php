 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?=$title?> Pada <?=$this->session->userdata('bulan-tahun')?>
                           
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                                <i class="fa fa-dashboard"></i> <a href="<?=base_url()?>user/common_user/dashboard">Dashboard</a>
                            </li>

                          <li>
                                <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/bukubesar/<?=$store['store_id']?>">Buku Besar</a>
                            </li>
                            <li>
                            <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/bukubesar/kewajiban/<?=$store['store_id']?>">Pend + HPP</a>
                            </li>

                                                        <li>
                            <i class="fa fa-calculator "></i> <a href="##">Hasil</a>
                            </li>

                            
                           
                        </ol>
                    </div>
                </div>
                 <?php
                      if($this->session->userdata('data') == null){
                      
                        header("location:javascript://history.go(-1)");
                        exit();


                      }else{
                        $bukubesarpend_hpp=$this->session->userdata('data');
                        $this->session->unset_userdata('data');
                        $this->session->unset_userdata('notif_code');
                        $this->session->unset_userdata('status');
                        $this->session->unset_userdata('message');
                        $this->session->unset_userdata('bulan-tahun');


                      }
                    ?>
                <!-- /.row -->
                <div class="row" style="margin-left: 100px;margin-right: 100px">
                   
                    <h2>Pendapatan Penjualan</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesarpend_hpp['pendapatan_penjualan']){
                              echo "<tr>
                                <th>No</th>
                                <th>Jurnal</th>
                                <th>Tipe Transaksi</th>
                                <th>Tujuan Transaksi</th>
                                <th>Transaksi Secara</th>
                                <th>Keterangan</th>
                                <th>Tanggal Penjurnalan</th>
                                <th>Nominal</th>
                              </tr>
                              ";
                              $i=1;
                              foreach ($bukubesarpend_hpp['pendapatan_penjualan'] as $list) {
                                
                                ?>
                                <tr>
                                  <td>
                                    <?=$i?>
                                  </td>
                                   <td>
                                    <?php
                                       
                                         echo $journaltype_obj->getNameById($list['journaltype_id']);

                                       ?>
                                  </td>
                                  <td>
                                    <?php
                                       
                                         echo $transactioncategory_obj->getNameById($list['transactioncategory_id']);

                                       ?>
                                  </td>

                                  <td>
                                    <?php
                                        if($list['subtransactioncategory_id']){
                                         echo $subtransactioncategory_obj->getNameById($list['subtransactioncategory_id']);

                                        }else{
                                          echo "Usaha";
                                        }


                                       ?>
                                  </td>
                                  <td>
                                    <?php
                                       
                                         echo $paymentmethod_obj->getNameById($list['paymentmethod_id']);

                                       ?>
                                  </td>

                                  <td>
                                    <?=$list['description']?>
                                  </td>
                                  <td>
                                    <?=$list['journal_date']?>
                                  </td>
                                                                    <td>
                                    <?=$list['nominal']?>
                                  </td>

                                </tr>

                                <?php
                              
                              $i++;}

                              echo "<tr style='background:#ccc'>
                                <td colspan='7'>
                                <i style='font-size:30px'><center><b>Total</b></center></i>
                                </td>
                                <td>
                                <p style='font-size:30px'>".$bukubesarpend_hpp['pendapatan_penjualan_total']."</p>
                                </td>
                              </tr>
                              ";
                            }else{
                              echo "<a class='text-danger'>Data Kosong</a>";
                            }
                          ?>
                    </table>

                    

                </div>


                <div class="row" style="margin-left: 100px;margin-right: 100px">
                   
                    <h2>Beban Pokok Penjualan</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesarpend_hpp['beban_pokokpenjualan']){
                              echo "<tr>
                                <th>No</th>
                                <th>Jurnal</th>
                                <th>Tipe Transaksi</th>
                                <th>Tujuan Transaksi</th>
                                <th>Transaksi Secara</th>
                                <th>Keterangan</th>
                                <th>Tanggal Penjurnalan</th>
                                <th>Nominal</th>
                              </tr>
                              ";
                              $i=1;
                              foreach ($bukubesarpend_hpp['beban_pokokpenjualan'] as $list) {
                                
                                ?>
                                <tr>
                                  <td>
                                    <?=$i?>
                                  </td>
                                   <td>
                                    <?php
                                       
                                         echo $journaltype_obj->getNameById($list['journaltype_id']);

                                       ?>
                                  </td>
                                  <td>
                                    <?php
                                       
                                         echo $transactioncategory_obj->getNameById($list['transactioncategory_id']);

                                       ?>
                                  </td>

                                  <td>
                                    <?php
                                        if($list['subtransactioncategory_id']){
                                         echo $subtransactioncategory_obj->getNameById($list['subtransactioncategory_id']);

                                        }else{
                                          echo "Usaha";
                                        }


                                       ?>
                                  </td>
                                  <td>
                                    <?php
                                       
                                         echo $paymentmethod_obj->getNameById($list['paymentmethod_id']);

                                       ?>
                                  </td>

                                  <td>
                                    <?=$list['description']?>
                                  </td>
                                  <td>
                                    <?=$list['journal_date']?>
                                  </td>
                                                                    <td>
                                    <?=$list['nominal']?>
                                  </td>

                                </tr>

                                <?php
                              
                              $i++;}

                              echo "<tr style='background:#ccc'>
                                <td colspan='7'>
                                <i style='font-size:30px'><center><b>Total</b></center></i>
                                </td>
                                <td>
                                <p style='font-size:30px'>".$bukubesarpend_hpp['beban_pokokpenjualan_total']."</p>
                                </td>
                              </tr>
                              ";
                            }else{
                              echo "<a class='text-danger'>Data Kosong</a>";
                            }
                          ?>
                    </table>

                    

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
