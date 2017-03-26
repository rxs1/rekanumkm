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
                                <i class="fa fa-calculator "></i> <a href="<?=base_url()?>user/common_user/bukubesar/aset/<?=$store['store_id']?>">Buku Besar</a>
                            </li>

                            
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                    <div class="col-md-6">
                         <a href="<?=base_url()?>user/common_user/bukubesar/aset/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Aset</button></a>
                         <a href="<?=base_url()?>user/common_user/bukubesar/ekuitas/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Ekuitas</button></a>
                         <a href="<?=base_url()?>user/common_user/bukubesar/pend_hpp/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Pend+HPP</button></a> 
                    </div>
                    <div class="col-md-6">
                    <a href="<?=base_url()?>user/common_user/bukubesar/kewajiban/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Kewajiban</button></a>
                    <a href="<?=base_url()?>user/common_user/bukubesar/beban/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Beban</button></a>
                         <a href="<?=base_url()?>user/common_user/bukubesar/lainlain/<?=$store['store_id']?>"><button style="margin-bottom: 20px" class="btn btn-primary btn-lg col-md-12"> Buku Besar Lain-Lain</button></a>
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
