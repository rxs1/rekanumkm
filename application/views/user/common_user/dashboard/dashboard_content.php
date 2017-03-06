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
                           
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                   
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <?php
                                     $updateprofile = false;
                                       if( $user['picture']){
                                            $source = base_url().$user['picture'];
                                       }else{
                                         $source = 'http://placehold.it/380x500';
                                        $updateprofile = true;
                                       }
                                    ?>
                                    <img src="<?=$source    ?>" alt="" class="img-rounded img-responsive" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>
                                       <?php
                                      
                                       $user_fullname =  $user['first_name'].' '.$user['last_name'];
                                       if( $user_fullname != ' '){
                                            echo $user_fullname;
                                       }else{
                                        echo "Unknown";
                                        $updateprofile = true;
                                       }
                                       ?></h4>
                                    <small><cite >

                                    <?php
                                     if( $user['address'] ){
                                            echo $user['address'];
                                       }else{
                                        echo "Unknown";
                                        $updateprofile = true;
                                       }
                                    ?>

                                    <i class="glyphicon glyphicon-map-marker">
                                    </i></cite></small>
                                    <p>
                                        <i class="glyphicon glyphicon-envelope"></i>

                                    <?php
                                     if( $user['email'] ){
                                            echo $user['email'];
                                       }else{
                                        echo "Unknown";
                                        $updateprofile = true;
                                       }
                                    ?>
                                  
                                        <br />
                                        <i class="glyphicon glyphicon-gift"></i>


                                    <?php
                                     if( $user['birthdate'] ){
                                            echo $user['birthdate'];
                                       }else{
                                        echo "Unknown";
                                        $updateprofile = true;
                                       }
                                    ?>

                                        </p>
                                    <?php

                                    if($updateprofile){
                                        echo "<a href='".base_url()."user/common_user/profile' class='btn btn-warning' >Please Complete Profile !</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                      
                </div>

                <div class="col-md-6">
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
                    <?php
                    if($stores){

                      foreach ($stores as $list) {

                        ?>
                      <div style="margin-bottom: 40px">  
                     <button class="btn btn-default col-md-12" data-toggle="collapse" data-target="#<?=$list['store_id']?>"><i class="fa fa-building-o" aria-hidden="true"></i> <?=$list['name']?></button>

                      <div id="<?=$list['store_id']?>" class="collapse"  >
                          <center>
                              <p>
                                  <a href="<?=base_url()?>user/common_user/akuntansi/<?=$list['store_id']?>" class="btn btn-primary" style="padding: 3%;text-align: center;margin-top: 3%"> <i class="fa fa-calculator "></i> Akuntansi</a>
                                  <a href="##" class="btn btn-success" style="padding: 3%;text-align: center;margin-top: 3%"> <i class="fa fa-money "></i> Keuangan</a>
                                  <a href="##" class="btn btn-warning" style="padding: 3%;text-align: center;margin-top: 3%"> <i class="fa fa-percent"></i> Pajak</a>
                                    <a href="##" class="btn btn-warning" style="padding: 3%;text-align: center;margin-top: 3%"><i class="fa fa-book "></i> Laporan</a>
                                    <br>
                                    <a href="<?=base_url()?>user/common_user/umkm/edit?umkm_id=<?=$list['store_id']?>" class="btn btn-default" style="padding: 3%;text-align: center;margin-top: 3%; background-color: orange;color: #fff"> <i class="fa fa-cog" aria-hidden="true"></i> Personalize</a>
                                    <a href="<?=base_url()?>user/common_user/umkm/delete?umkm_id=<?=$list['store_id']?>" class="btn btn-danger" style="padding: 3%;text-align: center;margin-top: 3%"  <a href="url_to_delete" onclick="return confirm('Semua data akan hilang dan tidak bisa di recovery. Apakah anda yakin ingin menghapus data ini? ?');"> <i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                              </p>
                          </center>
                      </div>
                    </div>

                        <?php
                      }

                    }else{

                      ?>
                        <div class="well">No Data</div>
                      <?php

                    }

                    ?>
                         <a href="<?=base_url()?>user/common_user/umkm/add"><button  class="btn btn-danger col-md-12"  style="margin-top: 3%" ><i class="fa fa-plus" aria-hidden="true"></i> Tambah UMKM Baru</button></a>
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
