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
    <div class="container-fluid">
        <div class="row">

        <!-- Vendor Filter -->
        <?= $this->include('main/bizcategoryfilter') ?>
        <!-- /Vendor Filter -->


            <div class="col-md-7">
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
                             <?php foreach ($biz->NestedCategories() as $cate) :?>
                                <?php if($cate['menucount'] > 0 ): ?>  
                                <h5 class="mb-4 mt-3 col-md-12"><?= esc(ucwords($cate['name']))?></h5>
                                    <?php $i=0; shuffle($cate['menu']);?>
                                     <?php foreach ($cate['menu'] as $menu) :?> 
                                        <?php if($i++ >= 8){break;}?>
                                        <div class="col-md-3 col-sm-6 col-12 mb-4">
                                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                <div class="list-card-image">
                                                    <div class="star position-absolute">
                                                        <span class="badge badge-danger"><i class="icofont-price"></i> <?= esc(number_to_currency($menu->price,'NGN','en_NG',2))?></span>
                                                    </div>
                                                    <a href="#">
                                                        <?= ($menu->image) ? '<img class="img-fluid item-img lazyload" data-src= "'.base_url('img/vendor/'.$biz->id.'/menus/'.$menu->image). '">' : '<div class="img-fluid item-img"><i class="icofont-restaurant text-danger food-itemm"></i></div>' ?> 
                                                    <!-- <img src="img/list/7.png" class="img-fluid item-img"> -->
                                                    </a>
                                                </div>
                                                <div class="p-3 position-relative">
                                                    <div class="list-card-body">
                                                        <h6 class="mb-1 text-black" title="<?= esc(ucwords($menu->name))?>"><?= esc(ucwords(character_limiter($menu->name,40,'...')))?></h6>
                                                        <p class="text-gray mb-2"><?= (!empty($menu->description)) ? esc(ucwords(character_limiter($menu->description,20,'...'))) : ''?></p>
                                                        <p class="text-gray time mb-0">
                                                            <span class="pl-0 text-gray mb-0 pr-0" href="#"><?= esc(number_to_currency($menu->price,'NGN','en_NG',2))?> </span>
                                                            <span class="float-right"> 
                                                                <a class="btn btn-outline-secondary btn-sm  float-right addup-menu" data-toggle="modal" data-target="#addupMenuModal" data-menu="<?= base64_encode($encrypter->encrypt($menu->id))?>" data-name="<?= $menu->name ?>" data-mi="<?= $menu->slug ?>" data-bi="<?= $biz->slug ?>">ADD</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <?php endforeach; ?>
                                        <div class="col-md-12 text-center load-more mb-2">
                                            <a class="btn btn-primary" href="<?=site_url($biz->biz_type.'/'.$biz->slug.'/'.$menu->slug)?>" >View More...</a>  
                                        </div>
                                <?php else: ?> 
                                     <?php foreach ($cate['children'] as $cate2) :?>
                                      <?php if($cate2['menucount'] > 0 ): ?> 
                                        <h5 class="mb-4 mt-3 col-md-12"><?= esc(ucwords($cate2['name']))?></h5>
                                        <?php $i=0; shuffle($cate2['menu']);?>
                                      <?php foreach ($cate2['menu'] as $menu) :?>
                                        <?php if($i++ >= 8){break;}?>
                                        <div class="col-md-3 col-sm-6 col-6 mb-4">
                                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                <div class="list-card-image">
                                                    <div class="star position-absolute">
                                                        <span class="badge badge-danger"><i class="icofont-price"></i> <?= esc(number_to_currency($menu->price,'NGN','en_NG',2))?></span>
                                                    </div>
                                                    
                                                    
                                                    <a href="#">
                                                    <?= ($menu->image) ? '<img class="img-fluid item-img lazyload"  data-src= "'.base_url('img/vendor/'.$biz->id.'/menus/'.$menu->image). '">' : '<div class="img-fluid item-img"><i class="icofont-restaurant text-danger food-itemm"></i></div>' ?> 
                                                    <!-- <img src="img/list/7.png" class="img-fluid item-img"> -->
                                                    </a>
                                                </div>
                                                <div class="p-3 position-relative">
                                                    <div class="list-card-body">
                                                        <h6 class="mb-1 text-black" title="<?= esc(ucwords($menu->name))?>"><?= esc(ucwords(character_limiter($menu->name,40,'...')))?></h6>
                                                        <p class="text-gray mb-2"><?= (!empty($menu->description)) ? esc(ucwords(character_limiter($menu->description,20,'...'))) : ''?></p>
                                                        <p class="text-gray time mb-0">
                                                            <span class="pl-0 text-gray mb-0 pr-0" href="#"><?= esc(number_to_currency($menu->price,'NGN','en_NG',2))?> </span> 
                                                            <!-- <span class="badge badge-success">NEW</span>  -->
                                                            <span class="float-right"> 
                                                                <a class="btn btn-outline-secondary btn-sm  float-right addup-menu" data-toggle="modal" data-target="#addupMenuModal" data-menu="<?= base64_encode($encrypter->encrypt($menu->id))?>" data-name="<?= $menu->name ?>" data-mi="<?= $menu->slug ?>" data-bi="<?= $biz->slug ?>">ADD</a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      <?php endforeach; ?>
                                        <div class="col-md-12 text-center load-more mb-2">
                                            <a class="btn btn-primary" href="<?=site_url($biz->biz_type.'/'.$biz->slug.'/'.$menu->slug)?>" >View More...</a>  
                                        </div>
                                      <?php endif; ?>
                                     <?php endforeach; ?>
                                <?php endif; ?>
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
                                <h5 class="mb-4">Vendor Info</h5>
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
                            </div>
                        </div>


                    </div>
                </div>
            </div>
                                            
            <div class="col-md-3">
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

<!-- <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script> -->
    <script src="/js/lazyload.js"></script> 
    <script>
        $("img").lazyload();
    </script>
<?=$this->endSection()?>