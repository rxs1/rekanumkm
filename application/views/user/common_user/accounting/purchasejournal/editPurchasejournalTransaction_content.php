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
                                <i class="fa fa-book "></i> <a href="<?=base_url()?>user/common_user/akuntansi/jurnal_pembelian/<?=$store['store_id']?>/1">Jurnal Pembelian</a>
                            </li>

                             <li>
                                <i class="fa fa-book "></i> <a href="<?=base_url()?>user/common_user/akuntansi/editTransaksiJurnalPembelian/<?=$store['store_id']?>/<?=$journal['journal_id']?>/1">Edit Transaksi</a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                   
                    <div class="col-md-8 col-md-offset-2">
                        <h3><b><?=$title?></b></h3>
                        <hr>
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
                        <form method="POST" action="<?=base_url()?>user/common_user/akuntansi/editTransaksiJurnalPembelian_proses/<?=$journal['journal_id']?>">
                          <div class="form-group">
                            <label for="email">Deskripsi Trasansaksi</label>
                            <textarea  class='form-control' name="description" placeholder="Isi Keterangan" required><?=$journal['description']?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="pwd">Tipe Transaksi</label>
                            <select class="form-control" name="transactioncategory_id" id="sel1">
                              <?php foreach ($transactioncategory as $list) {
                                ?>
                                    <option  <?php if ($journal['transactioncategory_id'] == $list['transactioncategory_id'] ) echo 'selected' ; ?> value="<?=$list['transactioncategory_id']?>"><?=$list['name']?></option>
                             <?php }?>
                             
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="pwd">Transaksi Secara</label>
                            <select class="form-control" name="paymentmethod_id" id="sel1">
                              <?php foreach ($paymentmethods as $list) {
                                ?>
                             <option <?php if ($journal['paymentmethod_id'] == $list['paymentmethod_id'] ) echo 'selected' ; ?>  value="<?=$list['paymentmethod_id']?>"><?=$list['name']?></option>
                                <?php }?>
                            </select>
                          </div>
                          <div class="form-group">
                                  <label for="dtp_input2">Tanggal Pencatatan</label>
                                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                      <input class="form-control" size="16" name="journal_date" type="text" value="<?=$journal['journal_date']?>"  readonly>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                          </div>
                                  
                              </div>
                          <div class="form-group">
                               <label for="email">Nominal</label>
                            <input value="<?=$journal['nominal']?>" onkeydown="converting()" onkeyup="converting()" onkeypress="converting()" type="number" id="price" class="form-control" name="nominal">
                            <br><br>
                            <center><p id="convert_value" class="alert alert-info" style="width: 100%; height: 50px">Masukkan Nominal Transaksi</p></center>
                          </div>
                         
                          <button type="submit" class="btn btn-danger btn-lg">Update Transaksi</button>
                        </form>
                        

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
     <script src="<?=base_url()?>public/assets/admin/plugin/datepicker/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } ); 

        function convertToRupiah(angka)
{
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0)
            rupiah += angkarev.substr(i, 3) + '.';
    return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('') ;
}
/**
 * Usage example:
 * alert(convertToRupiah(10000000)); -> "Rp. 10.000.000"
 */

function convertToAngka(rupiah)
{
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}
/**
 * Usage example:
 * alert(convertToAngka("Rp 10.000.123")); -> 10000123
 */
function converting() {

    var y = document.getElementById("price").value;
    var x = document.getElementById("convert_value");
    if(y == ''){
      x.innerHTML ='Masukkan Nominal Transaksi !';
    }else{
      x.innerHTML = convertToRupiah(y);
    }
  
}
$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });


 
    </script>
    
</body>

</html>
