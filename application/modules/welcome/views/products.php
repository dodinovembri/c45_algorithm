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
                <li><a href="<?php echo base_url('/products') ?>" class="nav-link active">Products</a></li>
                <li><a href="<?php echo base_url('/#purchase-section') ?>" class="nav-link">Purchase</a></li>
                <li><a href="<?php echo base_url('/#about-section') ?>" class="nav-link">About Us</a></li>
                <li><a href="<?php echo base_url('/#contact-section') ?>" class="nav-link">Contact Us</a></li>
                <li><a href="#fanspage-section" class="nav-link">Fanspage Fb</a></li>
                <li><a href="<?php echo base_url('/admin') ?>" class="nav-link">Login</a></li>     
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

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
                      <a href="<?php echo base_url('products/'.$row['id']) ?>" class="btn btn-black mr-1 rounded-0">View</a>
                    </div>
                  </div>
                </div>
              </div>         
          <?php  }
          ?>
          
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