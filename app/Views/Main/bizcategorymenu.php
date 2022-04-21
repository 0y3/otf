<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>

<section class="restaurant-detailed-banner">
    <div class="text-center">
        <img class="img-fluid cover" src="<?= site_url('img/vendor/'.$biz->id.'/logo/'.$biz->image)?>">
    </div>
    <div class="restaurant-detailed-header">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-md-8">
                    <div class="restaurant-detailed-header-left">
                        <img class="img-fluid mr-3 float-left" alt="osahan" src="<?=  ($biz->logo) ?  site_url('img/vendor/'.$biz->id.'/logo/'.$biz->logo) : site_url('img/logo_1.jpg') ?> ">
                        <h2 class="text-white"><?= esc(ucwords($biz->name)) ?></h2>
                        <p class="text-white mb-1"><i class="icofont-location-pin"></i> <?= esc(ucwords($biz->address.', '.$city['city_name'].', '.$state['state_name'] )) ?> </p>
                        <!-- <p class="text-white mb-0"><i class="icofont-food-cart"></i> North Indian, Chinese, Fast Food, South Indian</p> -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant-detailed-header-right text-right">
                        <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> Open</button>
                        <!-- <h6 class="text-white mb-0 restaurant-detailed-ratings"><span class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span> 23 Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <span class="restaurant-detailed-action-btn float-right">
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-heart text-danger"></i> Mark as Favourite</button>
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-cauli-flower text-success"></i> Pure Veg</button>
                    <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i> OFFERS</button>
                </span> -->
                <ul class="nav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Order Online</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-biz-info" aria-selected="false">Biz Info</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
    <div class="container">
        <div class="row">



            <div class="col-md-8">
                <div class="offer-dedicated-body-left">
                    <div class="tab-content" id="pills-tabContent">


                        <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">

                            <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
                                <h5 class="mb-4">Recommended</h5>
                                <form class="explore-outlets-search mb-4">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search for dishes..." class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-link">
                                                <i class="icofont-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row">
                             <?php foreach ($menuByCategory as $cate) :?>  
                                <h5 class="mb-4 mt-3 col-md-12"><?= esc(ucwords($cate['name']))?></h5>
                                <div class="col-md-12">
                                    <div class="bg-white rounded border shadow-sm mb-4">
                                     <?php foreach ($cate['menu'] as $menu) :?> 
                                        <div class="menu-list p-3 border-bottom">
                                            <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                            <div class="media">
                                                <?= ($menu->image) ? '<img class="mr-3 rounded-pill" src= "'.site_url('img/vendor/'.$biz->id.'/menus/'.$menu->image). '">' : '<div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>' ?> 
                                                <div class="media-body">
                                                    <h6 class="mb-1"><?= esc(ucwords($menu->name))?></h6>
                                                    <p class="text-gray mb-0"><?= esc(number_to_currency($menu->price,'NGN','en_NG',2))?></p>
                                                </div>
                                            </div>
                                        </div>
                                     <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                                
                            </div>

                        </div>


                        <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                            <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                                <div class="address-map float-right ml-5">
                                    <!-- <div class="mapouter">
                                        <div class="gmap_canvas"><iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                    </div> -->
                                </div>
                                <h5 class="mb-4">Restaurant Info</h5>
                                <p class="mb-3"><?= esc(ucwords($biz->address )) ?>,
                                <br> <?= esc(ucwords($city['city_name'].', '.$state['state_name'] )) ?>
                                </p>
                                <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> <?= esc($biz->phone)?></p>
                                <p class="mb-2 text-black">
                                    <i class="icofont-email text-primary mr-2"></i>
                                    <a href="" class="__cf_email__" data-cfemail="cea7afa3a1bdafa6afa08ea9a3afa7a2e0ada1a3">[<?= esc($biz->email)?>]</a>
                                </p>
                                <p class="mb-2 text-black">
                                    <i class="icofont-clock-time text-primary mr-2"></i> 
                                    Today 11am – 5pm, 6pm – 11pm
                                    <span class="badge badge-success"> OPEN NOW </span>
                                </p>
                                <hr class="clearfix">
                                    <!-- <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; 
                                        <a class="text-info font-weight-bold" href="#">Venue Map</a>
                                    </p> -->
                                <hr class="clearfix">
                                <h5 class="mt-4 mb-4">More Info</h5>
                                <p class="mb-3"><?= esc($biz->description)?></p>
                                <!-- <div class="border-btn-main mb-4">
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                    <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                    <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                </div> -->
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Cart -->
            <div class="col-md-4">
                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                    <h5 class="mb-1 text-white">Your Order</h5>
                    <p class="mb-4 text-white">6 ITEMS</p>
                    <div class="bg-white rounded shadow-sm mb-2">
                        <div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">$314</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-danger food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">Chicken Tikka Sub</p>
                                </div>
                            </div>
                        </div>
                        <div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">$260</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">Cheese corn Roll</p>
                                </div>
                            </div>
                        </div>
                        <div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">$260</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">Cheese corn Roll</p>
                                </div>
                            </div>
                        </div>
                        <div class="gold-members p-2">
                            <p class="text-gray mb-0 float-right ml-2">$122</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-danger food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">Mixed Veg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <!-- <img class="img-fluid float-left" src="img/wallet-icon.png"> -->
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger">$456.4</span></h6>
                        <p class="seven-color mb-1 text-right">Extra charges may apply</p>
                        <p class="text-black mb-0 text-right">You have saved $955 on the bill</p>
                    </div>
                    <a href="checkout.html" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
                </div>
                <div class="text-center pt-2 mb-4">
                    <img class="img-fluid" src="https://dummyimage.com/352x600/ccc/ffffff.png&amp;text=Google+ads">
                </div>
                <div class="text-center pt-2">
                    <img class="img-fluid" src="https://dummyimage.com/352x568/ccc/ffffff.png&amp;text=Google+ads">
                </div>

            </div>
        </div>
    </div>
<section>


<?= $this->endsection() ?>