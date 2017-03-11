<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title><?=$title?></title>
  
  
  <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  		 <!-- Custom Fonts -->
    <link href="<?=base_url()?>public/assets/common/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      
   <link rel="stylesheet" href="<?=base_url()?>public/assets/common/css/login.css">

  
</head>

<body >
    <div class="wrapper">
    <form class="form-signin" method="POST" action="verification">       
      
      <h2 class="form-signin-heading"><?=$title?></h2>
  <?php
          if(isset($err_message)){
              echo "<p class='alert alert-error'>".$err_message."</p>";
            }
        ?>

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
      <i class='fa fa-user' aria-hidden='true'></i> <input type="text" class="form-control" name="username" placeholder="username" required="" autofocus="" />
      <br>
       <?php
          if(isset($username)){
              echo "<p class='alert alert-error'>".$username."</p>";
            }
        ?>
        <i class='fa fa-key' aria-hidden='true'></i> 
      <input type="password" class="form-control" name="password" placeholder="password" required=""/>   
      <br>
       <?php
          if(isset($password)){
            echo "<p class='alert alert-error'>".$password."</p>";
          }
        ?>   
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
      <br>
      <p>Belum  punya Akun? <a href="<?=base_url()?>index.php/auth/register">Daftar sekarang !</a></p>
    </form>
  </div>
  
  
</body>
</html>
