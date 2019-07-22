<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PT. GREENTECH EQUIPMENT INDONESIA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/fonts/icomoon/style.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/owl.theme.default.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/jquery.fancybox.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/bootstrap-datepicker.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/fonts/flaticon/font/flaticon.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/aos.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/public/selling/css/style.css') ?>">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    <div class="top-bar py-3 bg-light" id="home-section">
      <div class="container">
        <div class="row align-items-center">
         
          <div class="col-6 text-left">
            <ul class="social-media">
              <li><a href="#" class=""><span class="icon-facebook"></span></a></li>
              <li><a href="#" class=""><span class="icon-twitter"></span></a></li>
              <li><a href="#" class=""><span class="icon-instagram"></span></a></li>
              <li><a href="#" class=""><span class="icon-linkedin"></span></a></li>
            </ul>
          </div>
          <div class="col-6">
            <p class="mb-0 float-right">
              <span class="mr-3"><a href="tel://#"> <span class="icon-phone mr-2" style="position: relative; top: 2px;"></span><span class="d-none d-lg-inline-block text-black">(+1) 234 5678 9101</span></a></span>
              <span><a href="#"><span class="icon-envelope mr-2" style="position: relative; top: 2px;"></span><span class="d-none d-lg-inline-block text-black">shop@yourdomain.com</span></a></span>
            </p>
            
          </div>
        </div>
      </div> 
    </div>

    <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="./" class="text-black mb-0">Selling<span class="text-primary">.</span> </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="<?php echo base_url('/#home-section') ?>" class="nav-link">Home</a></li>
                <li><a href="<?php echo base_url('/#services-section') ?>" class="nav-link">Services</a></li>
                <li><a href="<?php echo base_url('/products') ?>" class="nav-link">Products</a></li>
                <li><a href="<?php echo base_url('/#purchase-section') ?>" class="nav-link">Purchase</a></li>
                <li><a href="<?php echo base_url('/#about-section') ?>" class="nav-link">About Us</a></li>
                <li><a href="<?php echo base_url('/#contact-section') ?>" class="nav-link">Contact Us</a></li>
                <li><a href="<?php echo base_url('/fanspage') ?>" class="nav-link">Fanspage Fb</a></li>
                <li><a href="<?php echo base_url('/admin') ?>" class="nav-link">Login</a></li>   
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

  <?php foreach($banners as $row)
	{
		echo '
		    <div class="site-blocks-cover overlay" style="background-image: url(' . base_url("assets/public/uploads/") . $row["nama_barang"]. ');" data-aos="fade" data-stellar-background-ratio="0.5">
		      <div class="container">
		        <div class="row align-items-center justify-content-center">

		          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
		                        
		            <div class="row mb-4">
		              <div class="col-md-7">
		                <h1>Shop With Us</h1>
		                <p class="mb-5 lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda ea quo cupiditate facere deleniti fuga officia.</p>
		                <div>
		                  <a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Shop Now</a>
		                  <a href="#" class="btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block">Club Membership</a>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>  
		';
	}
	?>
     


    <div class="site-section bg-light" id="services-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Our Services</h3>
            <h2 class="section-title mb-3">We Offer Services</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
			<?php foreach($services as $row)
				{
			?>
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                <div class="unit-4 d-flex">
                  <div class="unit-4-icon mr-4"><span class="<?= $row['icon_service']; ?>"></span></div>
                  <div>
                    <h3><?= $row['nama_service'] ?></h3>
                    <p><?= $row['ket'] ?></p>
                    <p><a href="#">Learn More</a></p>
                  </div>
                </div>
              </div>
          <?php  }
          ?>
        </div>
      </div>
    </div>

    <div class="site-section" id="products-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title">Popular Products</h3>
            <h2 class="section-title mb-3">Our Products</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nostrum natus excepturi fuga ullam accusantium vel ut eveniet aut consequatur laboriosam ipsam.</p>
          </div>
        </div>
        <div class="row">
			<?php foreach($products as $row)
				{
			?>
              <div class="col-lg-4 col-md-6 mb-5">
                <div class="product-item">
                  <figure>
                    <img src="<?php echo base_url('assets/public/uploads/') ?><?= $row['gambar_product'] ?>" alt="Image" class="img-fluid">
                  </figure>
                  <div class="px-4">
                    <h3><a href="#"><?= $row['nama_product']; ?></a></h3>
                    <div class="mb-3">
                      <span class="meta-icons mr-3"><a href="#" class="mr-2"><span class="icon-star text-warning"></span></a> 5.0</span>
                      <span class="meta-icons wishlist"><a href="#" class="mr-2"><span class="icon-heart"></span></a> 29</span>
                    </div>
                    <p class="mb-4"><?= $row['ket_product']; ?></p>
                    <div>
                      <a href="#" class="btn btn-black mr-1 rounded-0">Cart</a>
                      <a href="#" class="btn btn-black btn-outline-black ml-1 rounded-0">View</a>
                    </div>
                  </div>
                </div>
              </div>         
          <?php  }
          ?>
          
        </div>
      </div>
    </div>
    
    <div class="site-section bg-light" id="purchase-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Purchase Form</h3>
            <h2 class="section-title mb-3">Get In Touch</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-7 mb-5">

            <form action="<?php echo base_url('purchase') ?>" method="GET" class="p-5 bg-white">                          

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" name="fname" class="form-control rounded-0 required">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" name="lname" class="form-control rounded-0 required">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" name="email" class="form-control rounded-0 required">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" name="subject" class="form-control rounded-0 required">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="pesan" cols="30" rows="7" class="form-control rounded-0 required" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Purchase" class="btn btn-black rounded-0 py-3 px-4">
                </div>
              </div>

  
            </form>
          </div>
        
        </div>
        
      </div>
    </div>

    <div class="site-section" id="about-section">
      <div class="container">
        <div class="row align-items-lg-center">
          <div class="col-md-8 mb-5 mb-lg-0 position-relative">
            <img src="<?= base_url('assets/public/uploads/') ?><?= $about->image ?>" class="img-fluid" alt="Image">
            <div class="experience">
              <span class="year"><?= $about->title_image ?></span>
              <span class="caption"><?= $about->sub_title_image ?></span>
            </div>
          </div>
          <div class="col-md-3 ml-auto">
            <h3 class="section-sub-title"><?= $about->company_name ?></h3>
            <h2 class="section-title mb-3">About Us</h2>
            <p class="mb-4"><?= $about->ket ?></p>
            <p><a href="#" class="btn btn-black btn-black--hover rounded-0">Learn More</a></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Contact Form</h3>
            <h2 class="section-title mb-3">Get In Touch</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-7 mb-5">

            

            <form action="#" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Contact Form</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control rounded-0">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control rounded-0">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control rounded-0">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control rounded-0">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control rounded-0" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-black rounded-0 py-3 px-4">
                </div>
              </div>

  
            </form>
          </div>
        
        </div>
        
      </div>
    </div>

    <div class="site-blocks-cover inner-page-cover overlay get-notification"  style="background-image: url('<?php echo base_url('assets/public/selling/images/hero_2.jpg') ?>'); background-attachment: fixed;" data-aos="fade">
      <div class="container">

        <div class="row align-items-center justify-content-center">
          <form class="col-md-7" method="post">
            <h2>Get notified on each updates.</h2>
            <div class="d-flex mb-4">
              <input type="text" class="form-control rounded-0" placeholder="Enter your email address">
              <input type="submit" class="btn btn-white btn-outline-white rounded-0" value="Subscribe">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat commodi veniam doloremque ducimus tempora.</p>
          </form>
        </div>

      </div>
    </div>

  
    <footer class="site-footer bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
              </div>
              <div class="col-md-3 ">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-4">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3 ml-auto">
            <h2 class="footer-heading mb-4">Featured Product</h2>
            <a href="#"><img src="<?php echo base_url('assets/public/selling/images/product_1_bg.jpg') ?>" alt="Image" class="img-fluid mb-3"></a>
            <h4 class="h5">Leather Brown Shoe</h4>
            <strong class="text-black mb-3 d-inline-block">$60.00</strong>
            <p><a href="#" class="btn btn-black rounded-0">Add to Cart</a></p>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <script src="<?php echo base_url('assets/public/selling/js/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery-migrate-3.0.1.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery-ui.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/popper.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/owl.carousel.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery.stellar.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery.countdown.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/bootstrap-datepicker.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery.easing.1.3.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/aos.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery.fancybox.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/public/selling/js/jquery.sticky.js') ?>"></script>

  <script type="text/javascript" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&amp;version=v2.5"></script>
  
  <script src="<?php echo base_url('assets/public/selling/js/main.js') ?>"></script>
    
  </body>
</html>