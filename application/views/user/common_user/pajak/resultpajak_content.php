 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?=$title?> <?=$this->session->userdata('bulan-tahun')?>
                           
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                                <i class="fa fa-dashboard"></i> <a href="<?=base_url()?>user/common_user/dashboard">Dashboard</a>
                            </li>

                          <li>
                                <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/akuntansi/<?=$store['store_id']?>">Akuntansi</a>
                            </li>
                            <li>
                            <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/neraca/kalkulasi/<?=$store['store_id']?>">Neraca Pilih Bulan</a>
                            </li>
                            <li>
                            <i class="fa fa-calculator "></i> <a href="##">Hasil Kalkulasi Neraca</a>
                            </li>

                            
                           
                        </ol>
                    </div>
                </div>


                  <?php
                      
                        
                       
                        $this->session->unset_userdata('notif_code');
                        $this->session->unset_userdata('status');
                        $this->session->unset_userdata('message');
                        $this->session->unset_userdata('bulan-tahun');

                      
                    ?>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                  <div class="col-md-6">
                     <h2 style="background: #ccc;padding: 2%">PENDAPATAN</h2>
                     
                     <div class="col-md-12">
                        <h3>Pendapatan Penjualan</h3>
                        <table class="table">
                        <thead>
                          <tr>
                              <th>
                               <b>Akun</b>
                              </th>
                              <th>
                               <b>Nominal<b>
                              </th>
                          </tr>
                          </thead>
                          <tbody>                          
                          <tr  class="alert alert-warning" style="font-size: 30px">
                              <td>
                              Pendapatan Penjualan
                              </td>
                              <td>
                             <?=$bukubesarpend_hpp['pendapatan_penjualan_total']?>
                              </td>
                              

                          </tr>

                         
                          </tbody>

                           
                        </table>

                        
                     </div>
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>Pendapatan Bersih :  <?=$bukubesarpend_hpp['pendapatan_penjualan_total']?></center>
                     </div>

                  </div>
                  <div class="col-md-6">
                 
                         <h2 style="background: #ccc;padding: 2%">Harga Pokok Penjualan</h2>
                     
                     <div class="col-md-12">
                        <h3>Pendapatan Penjualan</h3>
                        <table class="table">
                        <thead>
                          <tr>
                              <th>
                               <b>Akun</b>
                              </th>
                              <th>
                               <b>Nominal<b>
                              </th>
                          </tr>
                          </thead>
                          <tbody>                          
                          <tr  class="alert alert-warning" style="font-size: 30px">
                              <td>
                              Beban Pokok Penjualan
                              </td>
                              <td>
                             <?=$bukubesarpend_hpp['beban_pokokpenjualan_total']?>
                              </td>
                              

                          </tr>

                         
                          </tbody>

                           
                        </table>

                        
                     </div>
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>Harga Pokok Penjualan :  <?=$bukubesarpend_hpp['beban_pokokpenjualan_total']?></center>
                     </div>
                      </div>
                  
                </div>

                

                <div class="row" style="margin:50px">

                     <h2 style="background: #ccc;padding: 2%">Laba/Rugi Kotor</h2>
                     
                   
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>  <?=$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']?></center>
                     </div>
                </div>


                 <div class="row" style="margin: 100px">
                  <div class="col-md-6">
                     <h2 style="background: #ccc;padding: 2%">Beban Operasional</h2>
                     
                     <div class="col-md-12">
                       
                        <table class="table">
                        <thead>
                          <tr>
                              <th>
                               <b>Akun</b>
                              </th>
                              <th>
                               <b>Nominal<b>
                              </th>
                          </tr>
                          </thead>
                          <tbody>                          
                          <tr >
                              <td>
                            Beban Sewa Tempat Usaha

                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_sewa_tempatusaha_total']?>
                              </td>
                          </tr>

                          <tr >
                              <td>
                            Beban Gaji Karyawan


                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_gajikaryawan_total']?>
                              </td>
                          </tr>

                           <tr >
                              <td>
                           Beban Listrik
                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_listrik_total']?>
                              </td>
                          </tr>

                            <tr >
                              <td>
                           Beban Telepon
                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_telepon_total']?>
                              </td>
                          </tr>

                          <tr >
                              <td>
                           Beban Air
                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_air_total']?>
                              </td>
                          </tr>

                          <tr >
                              <td>
                           Beban Pengiriman
                              </td>
                              <td>
                             <?=$bukubesarbeban['beban_pengiriman_total']?>
                              </td>
                          </tr>



                         
                          </tbody>
                            <tfoot class="alert alert-warning">
                           <tr>
                              <td style="font-size: 30px">
                              <center><b>TOTAL</b><center>
                              </td>
                              <td style="font-size: 30px">
                                    <?php
                                        $totalbeban=$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total'];
                                        echo $totalbeban;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                           
                        </table>

                        
                     </div>
                   </div> 
                   <div class="col-md-6">
                    <div class="col-md-12">
                          <h2 style="background: #ccc;padding: 2%">Laba/Rugi Operasional</h2>
                         
                       
                         <div class="col-md-12 alert-success" style="font-size: 30px">
                          <center>  <?=$totalbeban+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']?></center>
                         </div>
                       </div>
                       <div class="col-md-12">
                       <h2 style="background: #ccc;padding: 2%">Pendapatan/Beban Di Luar Usaha</h2>
                     
                     <div class="col-md-123">
                       
                        <table class="table">
                        <thead>
                          <tr>
                              <th>
                               <b>Akun</b>
                              </th>
                              <th>
                               <b>Nominal<b>
                              </th>
                          </tr>
                          </thead>
                          <tbody>                          
                          <tr >
                              <td>
                              Pendapatan Bunga Bank
                              </td>
                              <td>
                             <?=$bukubesarlainlain['pendapatan_bungabank_total']?>
                              </td>
                          </tr>

                          <tr >
                              <td>
                            Beban Administrasi Bank
                              </td>

                              <td>
                             <?=$bukubesarlainlain['beban_administrasibank_total']?>
                              </td>
                          </tr>

                          


                         
                          </tbody>
                            <tfoot class="alert alert-warning">
                           <tr>
                              <td style="font-size: 30px">
                              <center><b>TOTAL</b><center>
                              </td>
                              <td style="font-size: 30px">
                                    <?php
                                        $totallainlain=$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total'];
                                        echo $totallainlain;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                           
                        </table>

                        
                     </div>
                     </div>
                   </div> 
                </div>


               <div class="row" style="margin: 100px">
                  <div class="col-md-6">
                     <h2 style="background: #ccc;padding: 2%">Beban Bunga Bank</h2>
                     
                   
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>  <?=$bukubesarbeban['beban_bungabank_total']?></center>
                     </div>
                  </div>
                  <div class="col-md-6">
                       <h2 style="background: #ccc;padding: 2%">Laba Rugi Sebelum Pajak</h2>
                     
                   
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>  <?=$bukubesarbeban['beban_bungabank_total']+$totallainlain+$totalbeban+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']?></center>
                     </div>
                  </div>
                </div>

              
             
               <div class="row" style="margin: 100px">

                     <h2 style="background: #ccc;padding: 2%">Beban Pajak</h2>
                     
                   
                     <div class="col-md-12 alert-danger" style="font-size: 30px">
                      <center>  <?=$bukubesarbeban['beban_pajak_total']?></center>
                     </div>
                </div>


                <div class="row" style="margin: 100px">

                     <h2 style="background: #ccc;padding: 2%">Laba Rugi Setelah Pajak(BERSIH)</h2>
                     
                   
                     <div class="col-md-12 alert-success" style="font-size: 30px">
                      <center>  <?=$bukubesarbeban['beban_bungabank_total']+$totallainlain+$totalbeban+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total']?></center>
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
