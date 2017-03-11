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
                                <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>user/common_user/dashboard ">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i>  <a href="##">Profile</a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-md-3">

                    <div class="panel panel-primary">
                      <div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i>  Profile Management</div>
                      <div class="panel-body">
                         <ul style="list-style: none">

                          <li><a href="<?=base_url()?>user/common_user/profile"><i class="fa fa-id-card" aria-hidden="true"></i> Profile</a></li>
                          <li><a href="##"><i class="fa fa-user-secret" aria-hidden="true"></i> Ganti Username</a></li>
                          <li><a href="##">@ Ganti Email</a></li>
                          <li><a href="##"><i class="fa fa-key" aria-hidden="true"></i> Ganti Password</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                   <div class="col-md-6">
                        <form role="form" method="POST" enctype="multipart/form-data" action="<?=base_url()?>user/common_user/profile/update">
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
                          
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input value="<?=$user['first_name']?>" name="first_name" required type='text' class="form-control" placeholder="ex: john">
                            </div>
                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input name="last_name" type="text" value="<?=$user['last_name']?>" required class="form-control" placeholder="ex: Doe">
                            </div>
                              <div class="form-group">
                                  <label for="dtp_input2">Tanggal Lahir</label>
                                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                      <input class="form-control" size="16" name="birthdate" type="text" value="<?=$user['birthdate']?>" readonly>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                          </div>
                                  
                              </div>
                          

                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="text" name="phone_number" value="<?=$user['phone_number']?>" required class="form-control" placeholder="083-xxx-xxx-xxx/+6281-xxx-xxx-xxx">
                            </div>


                            <div class="form-group">
                                <label>Foto</label>
                                <input name="picture" type="file">
                            </div>
                            <div class="form-group">
                                <label>Foto Sekarang</label>
                                <?php 
                                  if($user['picture']){
                                     $source=base_url().$user['picture'];
                                  }else{
                                     $source = 'http://placehold.it/380x500';
                                  }
                                ?>
                                <br>
                                <img src="<?=$source?>" height="200">
                            </div>
                            
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" rows="3"><?=$user['address']?></textarea>
                            </div>

                            

                            <div class="form-group">
                                <label>Gender</label>
                                <div class="radio">
                                    <label>
                                        <input <?php if($user['gender'] == 'M'){ echo "checked";}else if($user['gender'] != 'F'){  echo "checked"; }?> type="radio" name="gender" id="optionsRadios1" value="M">Pria
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" <input <?php if($user['gender'] == 'F'){ echo "checked";}?> name="gender" id="optionsRadios2" value="F">Wanita
                                    </label>
                                </div>
                              
                            </div>

                           
                            <center>
                              <button type="submit" class="btn btn-primary btn-lg" >Update </button>
                            </center>

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
    <script src="<?=base_url()?>public/assets/admin/plugin/datepicker/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    
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
