
<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
<style>
 .select2-selection__rendered{
   display: unset !important;
}
</style> 
    <section class="pt-5 pb-5 homepage-search-block position-relative">
         <div class="banner-overlay"></div>
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-md-4">
                  <div class="osahan-slider pl-4 pt-3">
                     <div class="owl-carousel homepage-ad owl-theme">
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" height="auto" src="img/slider/slider.png"></a>
                        </div>
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" height="auto" src="img/slider/slider1.png"></a>
                        </div>
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" height="auto" src="img/slider/slider2.jpg"></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="homepage-search-title">
                     <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Find Awesome Deals</span> in OTF</h1>
                     <h5 class="mb-5 text-secondary font-weight-normal">Lists of top Restaurants, Groceries, pubs, and bars in Nigeria, based on trends</h5>
                  </div>
                  <div class="homepage-search-form">
                     <form class="form-noborder">
                        <div class="form-row justify-content-center">
                           <div class="col-lg-10 col-md-10 col-sm-12 form-group">
                              <div class="location-dropdown">
                                 <i class="icofont-location-arrow"></i>
                                 <select class="custom-select form-control-lg locationselection select2" data-placeholder="Select your delivery location" name="delivery" value ="<?= !empty(getDeliveryLocationTemp()) ? $encrypter->decrypt(getDeliveryLocationTemp()['deliveryLocateId']) : '' ?>" required>
                                    <option value=""> Select your delivery location </option>
                                 <?php foreach ($deliveryloc as $data) :?>
                                 <?php if(getDeliveryLocationTemp()): ?>
                                    <option value="<?=$data['id']?>" <?= ($data['id'] == $encrypter->decrypt(getDeliveryLocationTemp()['deliveryLocateId'])) ? 'selected' : '' ?> > <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                                 <?php else: ?>
                                 <option value="<?=$data['id']?>"> <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                                 <?php endif; ?>
                                 <?php endforeach;?>
                                 </select>
                              </div>
                              <span class="badge badge-pill badge-warning error_loc"></span>
                              <!-- <input type="text" placeholder="Enter your delivery location" class="form-control form-control-lg">
                              <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a> -->
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="row justify-content-center">
                     <div class="item">
                        <a class="osahan-category-item-a" href="<?=site_url('restaurant')?>" >
                           <div class="osahan-category-item" style="width:150px; height:auto">
                              <img class="img-fluid" src="img/res_s.png" alt="" style="background:linear-gradient(to top,#830190,#c8a3cc); border-radius: 10%">
                              <h6>Restaurants <i class="icofont-search-2" style="font-size:10px;"></i></h6>
                           </div>
                        </a>
                     </div>
                     <div class="item">
                        <a class="osahan-category-item-a" href="<?=site_url('grocery')?>">
                           <div class="osahan-category-item" style="width:150px; height:auto">
                              <!-- <img class="img-fluid" src="img/04.png" alt="" style="background:linear-gradient(to top,#009bfe,#00e9f0); border-radius: 10%;"> -->
                              <i class="icofont-grocery" style="background:linear-gradient(to top,#656d67,#79c792); border-radius: 10%;font-size: 42px; color: #fff; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;"></i> <h6 class="pt-2">Grocery  <i class="icofont-search-2" style="font-size:10px;"></i></h6>
                           </div>
                        </a>
                     </div>
                     
                     <div class="item">
                        <a class="osahan-category-item-a" href="<?=site_url('party')?>">
                           <div class="osahan-category-item" style="width:150px; height:auto">
                              <img class="img-fluid" src="img/04.png" alt="" style="background:linear-gradient(to top,#ff9472,#900000e0); border-radius: 10%;">
                              <h6>Party  <i class="icofont-search-2" style="font-size:10px;"></i></h6>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="section pt-5 pb-5 bg-white products-section">
         <div class="container">
            <div class="section-header text-center">
               <h2>How it Works</h2>
               <p>Top restaurants, cafes,Super-Market, pubs, and bars, based on trends</p>
               <span class="line"></span>
            </div>
            <div class="row">
               <div class="service-itemm col-md-3">
                            <div class="service-inner">
                                <div class="service-thumb">
                                    <img src="img/step1.jpg" alt="food-service">
                                    <span>01 step</span>
                                </div>
                                <div class="service-content">
                                    <h6><a href="#">Choose Your Favorite</a></h6>
                                </div>
                            </div>
                        </div>
                        
                  <div class="service-itemm col-md-3">
                        <div class="service-inner">
                           <div class="service-thumb">
                              <img src="img/step2.jpg" alt="food-service">
                              <span>02 step</span>
                           </div>
                           <div class="service-content">
                              <h6><a href="#">Vendor Will Cook/Package</a></h6>
                           </div>
                        </div>
                  </div>

                  <div class="service-itemm col-md-3">
                        <div class="service-inner">
                           <div class="service-thumb">
                              <img src="img/step3.jpg" alt="food-service">
                              <span>03 step</span>
                           </div>
                           <div class="service-content">
                              <h6><a href="#">We Deliver Your Meals</a></h6>
                           </div>
                        </div>
                  </div>
                  
                  <div class="service-itemm col-md-3">
                        <div class="service-inner">
                           <div class="service-thumb">
                              <img src="img/step4.jpg" alt="food-service">
                              <span>04 step</span>
                           </div>
                           <div class="service-content">
                              <h6><a href="#">Eat And Enjoy</a></h6>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="section pt-5 pb-5 becomemember-section border-bottom">
         <div class="container">
            <div class="section-header text-center white-text">
               <h2>Become a Member</h2>
               <p>Lorem Ipsum is simply dummy text of</p>
               <span class="line"></span>
            </div>
            <div class="row">
               <div class="col-sm-12 text-center">
                  <a href="register.html" class="btn btn-success btn-lg">
                  Create an Account <i class="fa fa-chevron-circle-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <section class="section pt-5 pb-5 text-center bg-white">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h5 class="m-0">Operate food store or restaurants? <a href="login.html">Work With Us</a></h5>
               </div>
            </div>
         </div>
    </section>
<?= $this->endSection() ?>
