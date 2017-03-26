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
                      
                        $bukubesaraset=$this->session->userdata('bukubesaraset');
                        $this->session->unset_userdata('bukubesaraset');
                        
                        $bukubesarkewajiban=$this->session->userdata('bukubesarkewajiban');
                        $this->session->unset_userdata('bukubesarkewajiban');

                        $bukubesarekuitas=$this->session->userdata('bukubesarekuitas');
                        $this->session->unset_userdata('bukubesarekuitas');
                        $bukubesarlainlain=$this->session->userdata('bukubesarlainlain');
                        $this->session->unset_userdata('bukubesarlainlain');
                        $bukubesarpend_hpp=$this->session->userdata('bukubesarpend_hpp');
                        $this->session->unset_userdata('bukubesarpend_hpp');
                         $bukubesarbeban=$this->session->userdata('bukubesarbeban');
                        $this->session->unset_userdata('bukubesarbeban');
                        
                        


                        $this->session->unset_userdata('notif_code');
                        $this->session->unset_userdata('status');
                        $this->session->unset_userdata('message');
                        $this->session->unset_userdata('bulan-tahun');
                        $kewajiban=(-1*$bukubesarkewajiban['utang_bank_jangkapanjang_total'])+(-1*$bukubesarkewajiban['utang_bank_total']) + (-1*$bukubesarkewajiban['utang_usaha_total']);
                        $ekuitas=(-1*$bukubesarekuitas['modal_pemilik_total']) + (-1*$bukubesarekuitas['penarikan_modal_total'])+(-1*($bukubesarbeban['beban_bungabank_total']+$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total']+$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total']+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total']));
                        $aset=$bukubesaraset['tanah_total'] + $bukubesaraset['peralatan_toko_total'] +$bukubesaraset['kendaraan_total']+$bukubesaraset['kas_total'] + $bukubesaraset['bank_total'] +$bukubesaraset['persediaan_barang_dagang_total'] + $bukubesaraset['perlengkapan_total'];
                         
                        if((($kewajiban+$ekuitas)-$aset)==0){


                          echo "<p class='alert-success' style='padding:3%;font-size:24px'>NERACA BULAN INI BALANCE</p>";


                        }else{

                          echo "<p class='alert-danger' style='padding:3%;font-size:24px'>NERACA ANDA TIDAK BALANCE CEK KEMBALI TRANSAKSI</p>";


                        }
                      
                    ?>
                <!-- /.row -->
                <div class="row" style="margin: 100px">

                     <h2 style="background: #ccc;padding: 2%">ASET</h2>
                     
                     <div class="col-md-6">
                        <h3>Aset Lancar Lancar</h3>
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
                          <tr>
                              <td>
                              Kas
                              </td>
                              <td>
                             <?=$bukubesaraset['kas_total']?>
                              </td>
                              

                          </tr>

                          <tr>
                              <td>
                             Bank
                              </td>
                              <td>
                             <?=$bukubesaraset['bank_total']?>
                              </td>
                              

                          </tr>

                           <tr>
                              <td>
                              Persediaan Barang Dagang
                              </td>
                              <td>
                             <?=$bukubesaraset['persediaan_barang_dagang_total']?>
                              </td>
                          </tr>


                           <tr>
                              <td>
                              Perlengkapan
                              </td>
                              <td>
                             <?=$bukubesaraset['perlengkapan_total']?>
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
                                        $totalasetlancar = $bukubesaraset['kas_total'] + $bukubesaraset['bank_total'] +$bukubesaraset['persediaan_barang_dagang_total'] + $bukubesaraset['perlengkapan_total'];
                                        echo $totalasetlancar;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                        </table>

                        
                     </div>


                      <div class="col-md-6">
                          <h3>Aset Tidak Lancar Lancar</h3>
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
                          <tr>
                              <td>
                              Tanah
                              </td>
                              <td>
                             <?=$bukubesaraset['tanah_total']?>
                              </td>
                              

                          </tr>

                          <tr>
                              <td>
                             Peralatan Toko
                              </td>
                              <td>
                             <?=$bukubesaraset['peralatan_toko_total']?>
                              </td>
                              

                          </tr>

                           <tr>
                              <td>
                              Kendaraan
                              </td>
                              <td>
                             <?=$bukubesaraset['kendaraan_total']?>
                              </td>
                          </tr>


                          
                          </tbody>

                          <tfoot class="alert alert-warning">
                           <tr>
                              <td style="font-size: 28px">
                              <center><b>TOTAL</b><center>
                              </td>
                              <td style="font-size: 28px">
                                    <?php
                                        $totalasettidaklancar = $bukubesaraset['tanah_total'] + $bukubesaraset['peralatan_toko_total'] +$bukubesaraset['kendaraan_total'] ;
                                        echo $totalasettidaklancar;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                        </table>

                     </div>

                     <div class=" col-md-12 alert alert-success" style="font-size:34px;">
                        <center>TOTAL ASET : <?=$totalasettidaklancar + $totalasetlancar?></center>
                     </div>
                    

                </div>

                <!-- /.row -->
                <div class="row" style="margin: 100px">

                     <h2 style="background: #ccc;padding: 2%">KEWAJIBAN</h2>
                     
                     <div class="col-md-6">
                        <h3>Kewajiban Lancar</h3>
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
                          <tr>
                              <td>
                              Utang Bank
                              </td>
                              <td>
                             <?=-1*$bukubesarkewajiban['utang_bank_total']?>
                              </td>
                              

                          </tr>

                          <tr>
                              <td>
                             Utang Usaha
                              </td>
                              <td>
                             <?=-1*$bukubesarkewajiban['utang_usaha_total']?>
                              </td>
                              

                          </tr>

                         
                          </tbody>

                            <tfoot class="alert alert-warning">
                           <tr>
                              <td style="font-size: 28px">
                              <center><b>TOTAL</b><center>
                              </td>
                              <td style="font-size: 28px">
                                    <?php
                                        $totalkewajibanlancar = (-1*$bukubesarkewajiban['utang_bank_total']) + (-1*$bukubesarkewajiban['utang_usaha_total']);
                                        echo $totalkewajibanlancar;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                        </table>

                        
                     </div>


                      <div class="col-md-6">
                          <h3>Kewajiban Jangka Panjang</h3>
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
                          <tr>
                              <td>
                              Utang Bank Jangka Panjang 
                              </td>
                              <td>
                             <?=-1*$bukubesarkewajiban['utang_bank_jangkapanjang_total']?>
                              </td>
                              

                          </tr>

                          


                          
                          </tbody>

                          <tfoot class="alert alert-warning">
                           <tr>
                              <td style="font-size: 28px">
                              <center><b>TOTAL</b><center>
                              </td>
                              <td style="font-size: 28px">
                                    <?php
                                        $totalkewajibanjangkapanjang =(-1*$bukubesarkewajiban['utang_bank_jangkapanjang_total']);
                                        echo $totalkewajibanjangkapanjang;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                        </table>

                     </div>

                     <div class=" col-md-12 alert alert-success" style="font-size:28px;">
                        <center>TOTAL KEWAJIBAN : <?=$totalkewajibanjangkapanjang+ $totalkewajibanlancar?></center>
                     </div>
                    

                </div>

                 <!-- /.row -->
                <div class="row" style="margin: 100px">

                     <h2 style="background: #ccc;padding: 2%">EKUITAS</h2>
                     
                     <div class="col-md-6 col-md-offset-3">
                       
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
                          <tr>
                              <td>
                              Modal Pemilik
                              </td>
                              <td>
                             <?=-1*$bukubesarekuitas['modal_pemilik_total']?>
                              </td>
                              

                          </tr>

                          <tr>
                              <td>
                             Penarikan Modal
                              </td>
                              <td>
                             <?=-1*$bukubesarekuitas['penarikan_modal_total']?>
                              </td>
                              

                          </tr>

                           <tr>
                              <td>
                              Ikhtisar Lab/Rugi
                              </td>
                              <td>
                             <?=(-1*($bukubesarbeban['beban_bungabank_total']+$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total']+$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total']+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total']))?>
                              </td>
                          </tr>


                           
                          </tbody>

                            <tfoot class="alert alert-success">
                           <tr>
                              <td style="font-size: 28px">
                              <center><b>TOTAL EKUITAS</b><center>
                              </td>
                              <td style="font-size: 28px">
                                    <?php
                                        $totalekuitas = (-1*$bukubesarekuitas['modal_pemilik_total']) + (-1*$bukubesarekuitas['penarikan_modal_total'])+(-1*($bukubesarbeban['beban_bungabank_total']+$bukubesarlainlain['pendapatan_bungabank_total']+$bukubesarlainlain['beban_administrasibank_total']+$bukubesarbeban['beban_sewa_tempatusaha_total']+$bukubesarbeban['beban_gajikaryawan_total']+$bukubesarbeban['beban_listrik_total']+$bukubesarbeban['beban_telepon_total']+$bukubesarbeban['beban_air_total']+$bukubesarbeban['beban_pengiriman_total']+$bukubesarpend_hpp['pendapatan_penjualan_total']+$bukubesarpend_hpp['beban_pokokpenjualan_total']+$bukubesarbeban['beban_pajak_total']));
                                        echo $totalekuitas;
                                    ?>
                              </td>
                          </tr>
                          </tfoot>
                        </table>

                        
                     </div>






                </div>
                <div class="col-md-6 col-md-offset-3" style="font-size: 30px">
                  <p class="alert alert-success"> 
                  Total Kewajiban + Ekuitas :<?=($totalkewajibanjangkapanjang+$totalkewajibanlancar+$totalekuitas)?>
                  </p>
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
