 <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text" >
                <div class="intro-lead-in">Welcome to REKAN </div>
                <div class="intro-heading">Rencanakan Keuangan UMKM Anda</div>
                <center><a href="#services" class="page-scroll btn btn-xl">Explore !</a> </center>
                <br>
                <br>
                <br>
                
                
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Fitur Kami</h2>
                       <hr> 
                  
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-calculator fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Akuntansi</h4>
                    <p class="text-muted">Mencatat transaksi, membuat jurnal, <i>posting</i> ke buku besar dan membuat laporan keuangan</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Finance</h4>
                    <p class="text-muted">Perkiraan <i>growth</i> dan menganalisa keuangan</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Tax</h4>
                    <p class="text-muted">Perhitungan pajak PPh 21 dan Badan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    

   
    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Tim REKAN</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="<?=base_url()?>public/assets/static_img/team-2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Andreas Ricardo</h4>
                        <p class="text-muted">CEO & Co-Founder</p>
                        <ul class="list-inline social-buttons">
                           
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="<?=base_url()?>public/assets/static_img/team-1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Angela Shinta Puspitasari</h4>
                        <p class="text-muted">CFO & Co-Founder</p>
                        <ul class="list-inline social-buttons">
                          
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="<?=base_url()?>public/assets/static_img/team-4.jpg" class="img-responsive img-circle" alt="">
                        <h4>Muhamad Ramadhan</h4>
                        <p class="text-muted">COO & Co-Founder</p>
                        <ul class="list-inline social-buttons">
                          
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="<?=base_url()?>public/assets/static_img/team-3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Saufi Rahman</h4>
                        <p class="text-muted">CTO & Co-Founder</p>
                        <ul class="list-inline social-buttons">
                           
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </section>



    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Kontak Kami</h2>
                     <hr>   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="section-heading">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Anda *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                 <label class="section-heading">Email</label>
                                    <input type="email" class="form-control" placeholder="Email Anda *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label class="section-heading">No Telephone</label>
                                    <input type="tel" class="form-control" placeholder="Phone Anda *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="section-heading">Isi Pesan</label>
                                    <textarea class="form-control" placeholder="Pesan Anda *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

