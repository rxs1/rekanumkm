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
                            <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/bukubesar/aset/<?=$store['store_id']?>">Aset</a>
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
                        $bukubesaraset=$this->session->userdata('data');
                        $this->session->unset_userdata('data');
                        $this->session->unset_userdata('notif_code');
                        $this->session->unset_userdata('status');
                        $this->session->unset_userdata('message');
                        $this->session->unset_userdata('bulan-tahun');


                      }
                    ?>
                <!-- /.row -->
                <div class="row" style="margin-left: 100px;margin-right: 100px">
                   
                    <h2>KAS</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['kas']){
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
                              foreach ($bukubesaraset['kas'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['kas_total']."</p>
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
                   
                    <h2>BANK</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['bank']){
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
                              foreach ($bukubesaraset['bank'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['bank_total']."</p>
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
                   
                    <h2>PIUTANG USAHA</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['piutang_usaha']){
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
                              foreach ($bukubesaraset['piutang_usaha'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['piutang_usaha_total']."</p>
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
                   
                    <h2>PERSEDIAAN BARANG DAGANG</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['persediaan_barang_dagang']){
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
                              foreach ($bukubesaraset['persediaan_barang_dagang'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['persediaan_barang_dagang_total']."</p>
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
                   
                    <h2>PERLENGKAPAN</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['perlengkapan']){
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
                              foreach ($bukubesaraset['perlengkapan'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['perlengkapan_total']."</p>
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
                   
                    <h2>TANAH</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['tanah']){
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
                              foreach ($bukubesaraset['tanah'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['tanah_total']."</p>
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
                   
                    <h2>BANGUNAN TOKO</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['bangunan_toko']){
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
                              foreach ($bukubesaraset['bangunan_toko'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['bangunan_toko_total']."</p>
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
                   
                    <h2>PERALATAN TOKO</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['peralatan_toko']){
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
                              foreach ($bukubesaraset['peralatan_toko'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['peralatan_toko_total']."</p>
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
                   
                    <h2>KENDARAAN</h2>
                    <hr>
                    <br>
                    <table class="table">
                          <?php
                            if($bukubesaraset['kendaraan']){
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
                              foreach ($bukubesaraset['bank'] as $list) {
                                
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
                                <p style='font-size:30px'>".$bukubesaraset['kendaraan_total']."</p>
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
