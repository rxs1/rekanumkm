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
                              <li>
                                <i class="fa fa-book "></i><a href="<?=base_url()?>user/common_user/akuntansi/jurnal_pengeluaran_kas/<?=$store['store_id']?>/2"> Jurnal Pengeluaran Kas</a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                    <div class="col-md-3"> 
                         <a href="<?=base_url()?>user/common_user/akuntansi/tambahTransaksiJurnalPengeluaranKas/<?=$store['store_id']?>/2"><button style="margin-bottom: 20px" class="btn btn-danger btn-lg col-md-12">+ Tambah Transaksi</button></a>
                    </div>
                    <div class="col-md-12">
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
                    </div>
                    <div class="col-md-12">
                   
                        <table id="example" class="table table-stripped" width="100%">
                          <thead>
                              <tr>
                                <th>Create On</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>Tipe Transaksi</th>
                                <th>Tujuan Transaksi</th>
                                <th>Transaksi Secara</th>
                                <th>Tanggal Jurnal</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                              <?php 
                              if($cashpaymentjournals){
                              foreach ($cashpaymentjournals as $list){
                                  $button_tindakan="
                             <a href ='".base_url()."user/common_user/akuntansi/editTransaksiJurnalPengeluaranKas/".$store['store_id']."/".$list['journal_id']."/2'  class='btn btn-success' ><i class='glyphicon glyphicon-edit'></i></a> 

                             <a onClick='return confirm(\"Anda yakin ingin hapus data ini\")' href ='".base_url()."user/common_user/akuntansi/jurnal_pengeluaran_kas/hapus/".$list['journal_id']."' class='btn btn-danger'><i class='glyphicon glyphicon-trash'></i></a> 
                             ";
                                ?>
                                <tr>
                                  <td>
                                       <?php
                                       $date = strtotime($list['create_at']);
                                       $date = date('D, d M Y  (H:i:s)', $date );
                                       echo $date;
                                       ?>
                                    </td> 
                                    <td>
                                      <?=$list['description']?>
                                    </td>
                                    <td>
                                       <?=$list['nominal']?>
                                    </td>
                                       <td>
                                       <?php
                                       
                                         echo $transactioncategory_obj->getNameById($list['transactioncategory_id']);

                                       ?>
                                    </td>
                                    <td>
                                       <?php
                                       
                                         echo $subtransactioncategory_obj->getNameById($list['subtransactioncategory_id']);

                                       ?>
                                    </td>
                                       <td>
                                        <?php
                                       
                                         echo $paymentmethod_obj->getNameById($list['paymentmethod_id']);

                                       ?>
                                    </td>
                                    <td>
                                    <?=$list['journal_date']?>
                                    </td>
                                    <td>
                                    <?=$button_tindakan?>
                                    </td>
                                </tr>

                              <?php
                                }
                              }
                              ?>
                        
                        </table>  
                        

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

    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable( {
              order: [[ 0, 'desc' ]]
          } );
      } );
    </script>
    
</body>

</html>
