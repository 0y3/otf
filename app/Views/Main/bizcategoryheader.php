<section class="restaurant-detailed-banner">
    <div class="text-center">
        <img class="img-fluid cover" src="<?= site_url('img/vendor/'.$biz->id.'/logo/'.$biz->image)?>">
    </div>
    <div class="restaurant-detailed-header">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-md-8">
                    <div class="restaurant-detailed-header-left">
                        <img class="img-fluid mr-3 float-left" alt="<?= esc(ucwords($biz->name)) ?>" src="<?=  ($biz->logo) ?  base_url('img/vendor/'.$biz->id.'/logo/'.$biz->logo) : base_url('img/logo_1.jpg') ?> ">
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