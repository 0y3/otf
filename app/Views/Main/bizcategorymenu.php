<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>

<!-- Vendor Header -->
<?= $this->include('main/bizcategoryheader') ?>
<!-- /Vendor Header -->
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

                            <!-- <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
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
                            </div> -->

                            <div class="row">
                             <?php foreach ($menuByCategory as $cate) :?>  
                                <h5 class="mb-4 mt-3 col-md-12"><?= esc(ucwords($cate['name']))?></h5>
                                <div class="col-md-12">
                                    <div class="bg-white rounded border shadow-sm mb-4">
                                     <?php foreach ($cate['menu'] as $menu) :?> 
                                        <div class="menu-list p-3 border-bottom">
                                            <a class="btn btn-outline-secondary btn-sm  float-right addup-menu" data-toggle="modal" data-target="#addupMenuModal" data-menu="<?= base64_encode($encrypter->encrypt($menu->id))?>" data-name="<?= $menu->name ?>" data-mi="<?= $menu->slug ?>" data-bi="<?= $biz->slug ?>">ADD</a>
                                            <div class="media">
                                                <?= ($menu->image) ? '<img class="mr-3 rounded-pill lazyload" data-src= "'.site_url('img/vendor/'.$biz->id.'/menus/'.$menu->image). '" data-original= "'.site_url('img/vendor/'.$biz->id.'/menus/'.$menu->image). '">' : '<div class="mr-3"><i class="icofont-restaurant text-danger food-itemm"></i></div>' ?> 
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
                                    <a href="" class="__cf_email__" data-cfemail="">[<?= esc($biz->email)?>]</a>
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
                <!-- Vendor Cart -->
            <?= $this->include('main/bizcategorycart') ?>
            <!-- /Vendor Cart -->
            </div>
        </div>
    </div>
<section>

<?= $this->include('main/menu_modal') ?>

<!-- location modal -->
<?= $this->include('main/delivery_location_modal') ?>
<!-- /location modal -->

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <script src="/js/lazyload.js"></script>
    <script>
        $(function() {
            $("img.lazyload").lazyload({
                effect: "fadeIn"
            });
            
        });
    </script>
<?=$this->endSection()?>