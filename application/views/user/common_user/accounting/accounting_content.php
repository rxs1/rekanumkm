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
                                <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/akuntansi/<?=$store['store_id']?>">Akuntasi</a>
                            </li>

                            
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                    <div class="col-md-6">
                     <a href="<?=base_url()?>/user/common_user/akuntansi/jurnalModal/<?=$store['store_id']?>/5"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Jurnal Modal</button></a>

                         <a href="<?=base_url()?>/user/common_user/akuntansi/jurnal_pembelian/<?=$store['store_id']?>/1"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Jurnal Pembelian</button></a>

                         <a href="<?=base_url()?>/user/common_user/akuntansi/jurnalPenjualan/<?=$store['store_id']?>/3"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Jurnal Penjualan</button></a>
                          <a href="<?=base_url()?>/user/common_user/akuntansi/jurnalPenerimaanKas/<?=$store['store_id']?>/4"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Jurnal Penerimaan Kas</button></a>
                           <a href="<?=base_url()?>/user/common_user/akuntansi/jurnal_pengeluaran_kas/<?=$store['store_id']?>/2"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Jurnal Pengeluaran Kas</button></a>

                         


                       
                    </div>
                    <div class="col-md-6" style="padding-top: 3%;padding-bottom: 3%">
                   

      
                    <center>
                     <a href="<?=base_url()?>user/common_user/bukubesar/<?=$store['store_id']?>" class="btn btn-warning" style="padding: 3%;text-align: center;margin: 3%;font-size: 35px"><i class="fa fa-book "></i> Buku Besar</a>
                     <br>

                     <a href="<?=base_url()?>user/common_user/neraca/kalkulasi/<?=$store['store_id']?>" class="btn btn-warning" style="padding: 3%;text-align: center;margin: 3%;font-size: 35px"><i class="fa fa-balance-scale"></i> Neraca</a>

                      <a href="<?=base_url()?>user/common_user/labarugi/kalkulasi/<?=$store['store_id']?>" class="btn btn-warning" style="padding: 3%;text-align: center;margin: 3%;font-size: 35px"><i class="fa fa-balance-scale"></i> Laba Rugi</a>
                     </center>
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

</body>

</html>
