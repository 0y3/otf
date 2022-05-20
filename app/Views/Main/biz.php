<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>

    <?php if($biz): ?>
    <section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
        <h1 class="text-white">Offers Near You</h1>
        <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
    </section>
    <?php else: ?>
        <section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
        <h1 class="text-white">Oh snap!</h1>
        <h6 class="text-white-50">Sorry No product for this Category Now.</h6>
    </section>
    <?php endif;?>
    <section class="section pt-5 pb-5 products-listing">
        <div class="container">
            <div class="row d-none-m">
                <div class="col-md-12">
                    <div class="dropdown float-right mt-0 mb-3">
                        <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" data-toggle="modal" data-target="#deliveryLocateModal">
                        <small>Delivery Location:</small> <span class="text-theme span-delivery-location"> <?= (getDeliveryLocationTemp()) ? getDeliveryLocationTemp()['deliveryLocateCity'].' (<small>'.getDeliveryLocationTemp()['deliveryLocateState'].'</small>)' : 'None' ?></span> &nbsp;&nbsp;
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 ">
                            <a class="dropdown-item" href="#">Distance</a>
                            <a class="dropdown-item" href="#">No Of Offers</a>
                            <a class="dropdown-item" href="#">Rating</a>
                        </div>
                    </div>
                    <!-- <h4 class="font-weight-bold mt-0 mb-3">OFFERS <small class="h6 mb-0 ml-2">299 restaurants</small></h4> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                 <?php if($biz): ?>

                    <div class="row">
                     <?php foreach ($biz as $bizs) :?>  
                        <div class="col-md-4 col-sm-6 mb-4 pb-2">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-eye-open"></i> Open</span></div> 
                                    <!-- <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div> -->
                                    <!-- <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div> -->
                                    <a href="<?= site_url($bizs->biz_type.'/'.$bizs->slug) ?>">
                                        <img src="<?= site_url('img/vendor/'.$bizs->id.'/logo/'.$bizs->image)?>" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <a href="<?= site_url($bizs->biz_type.'/'.$bizs->slug) ?>">
                                    <div class="list-card-body">
                                        <h6 class="mb-1" class="text-black"><?= ucwords($bizs->name)?></h6>
                                        <p class="text-gray mb-3">North Indian • American • Pure veg</p>
                                        <p class="text-gray mb-3 time">
                                            <span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-calendar"></i> M,T,W,T,F,S,S Days</span>
                                            <!-- <span class="float-right text-black-50"> $250 FOR TWO</span> -->
                                        </p>
                                    </div>
                                    <!-- <div class="list-card-badge">
                                        <span class="badge badge-success">OFFER</span> <small>65% off | Use Coupon OSAHAN50</small>
                                    </div> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                     <?php endforeach; ?>
                         <!-- Pagination -->
                        <?php if ($pager->getPageCount() > 1) :?>
                        <div class="col-md-12 text-center load-more">
                            <div class="d-flex justify-content-end">
                                <?= $pager->links() ?>
                            </div>
                            <button class="btn btn-primary" type="button" disabled="">
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                        <?php endif ?>
                    </div>

                 <?php else: ?>
                    <div class="col-md-12 text-center">
                        <strong>Oh snap!</strong>
                        Sorry No product for this Category Now.
                    </div>

                 <?php endif; ?>
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

<!-- location modal -->
<?= $this->include('main/delivery_location_modal') ?>
<!-- /location modal -->

<?= $this->endsection() ?>