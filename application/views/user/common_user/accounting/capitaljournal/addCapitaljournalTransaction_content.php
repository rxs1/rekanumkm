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
                                <i class="fa fa-book "></i> <a href="<?=base_url()?>user/common_user/akuntansi/jurnalModal/<?=$store['store_id']?>/2">Jurnal Penerimaan Kas</a>
                            </li>

                             <li>
                                <i class="fa fa-book "></i> <a href="<?=base_url()?>user/common_user/akuntansi/tambahTransaksiJurnalModal/<?=$store['store_id']?>">Tambah Transaksi</a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="margin: 100px">
                   
                    <div class="col-md-8 col-md-offset-2">
                        <h3><b>Input Transaksi</b></h3>
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
                        <form method="POST" action="<?=base_url()?>user/common_user/akuntansi/tambahTransaksijurnalModal_proses/<?=$store['store_id']?>">
                          <div class="form-group">
                            <label for="email">Deskripsi Trasansaksi</label>
                            <textarea  class='form-control' name="description" placeholder="Isi Keterangan" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="pwd">Tipe Transaksi</label>
                            <select class="form-control" name="transactioncategory_id" id="sel1" required>
                             <option disabled selected value> -- Pilih Tipe Transaksi -- </option>
                              <?php foreach ($transactioncategory as $list) {
                                ?>
                                    <option value="<?=$list['transactioncategory_id']?>"><?=$list['name']?></option>
                             <?php }?>
                             
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="pwd" id="lbl2">Tujuan Transaksi</label>
                            <select class="form-control" name="subtransactioncategory_id"  id="sel2">
                              <option>Pilih Terlebih Dahulu Tipe Transaksi</option>
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="pwd" id="lbl3">Transaksi Secara</label>
                            <select class="form-control" name="paymentmethod_id" 
                             id="sel3">
                              <option>Pilih Terlebih Dahulu Tujuan Transaksi</option>
                            </select>
                          </div>
                          <div class="form-group">
                                  <label for="dtp_input2">Tanggal Pencatatan</label>
                                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                      <input class="form-control" size="16" name="journal_date" type="text"  readonly>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                          </div>
                                  
                              </div>
                          <div class="form-group">
                               <label for="email">Nominal</label>
                            <input onkeydown="converting()" onkeyup="converting()" onkeypress="converting()" type="number" id="price" class="form-control" name="nominal">
                            <br><br>
                            <center><p id="convert_value" class="alert alert-info" style="width: 100%; height: 50px">Masukkan Nominal Transaksi</p></center>
                          </div>
                         
                          <button type="submit" class="btn btn-danger btn-lg">Proses Transaksi</button>
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

 $("#sel3").hide();
 $("#sel2").hide();
 $("#lbl2").hide(); 
 $("#lbl3").hide();
$('#sel1').change(function () {
    var id = $(this).val();
       
       
    $("#sel2").html("-");
    $("#sel3").html("-");
    $("#sel2").hide(); 
    $("#sel3").hide();
    $("#lbl2").hide(); 
    $("#lbl3").hide();
    $.ajax({

        
        type: 'POST',
        
        url: 'http://localhost/rekanumkm/user/common_user/ajax/getAllSubTransactionCategoryByTransactionCategoryId',
        
        data: {
             'transactioncategory_id': id
        },

        crossDomain: false,
        
        dataType: 'json',
        
        cache: false,
        
        success: function(data)
        {
            var options=" <option disabled selected value> -- Pilih Tujuan Transaksi -- </option>";
            var i = 0;

           for (i=0;i<data.length;i++){
              options += "<option value='"+data[i]['subtransactioncategory_id']+"'>"+data[i]['name']+"</option>" ;
            }


              $("#sel2").html(options);
              $("#sel2").fadeIn();
               $("#lbl2").fadeIn(); 
        },
        error: function (request, status, error) {
            console.log(error);
        }
    });

});

  $('#sel2').change(function () {
      var id = $(this).val();
       
      $.ajax({
          type: 'POST',
          url: 'http://localhost/rekanumkm/user/common_user/ajax/getAllPaymentmethodBySubTransactionCategoryId',
          data: {
              'subtransactioncategory_id': id
          },
          crossDomain: false,
          dataType: 'json',
          cache: false,
          success: function(data)
          {
              if(data.length>0){
                 var options=" <option disabled selected value> -- Pilih -- </option>";
              var i = 0;

             for (i=0;i<data.length;i++){
                options += "<option value='"+data[i]['paymentmethod_id']+"'>"+data[i]['name']+"</option>"; 
              }


                $("#sel3").html(options);
                $("#sel3").fadeIn();
                $("#lbl3").fadeIn();
              }
             
                
          },
          error: function (request, status, error) {
              console.log(error);
          }
      });

  });

 
    </script>
    
</body>

</html>
