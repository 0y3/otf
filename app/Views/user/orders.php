<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
<section class="section pt-4 pb-4">
    <div class="container">
        <div class="row">
            <?= $this->include('user/sidebar') ?>
            <div class="col-md-9">
                <div class="shadow-sm bg-white p-4 h-10000">
                    <h4 class="font-weight-bold mt-0 mb-4">Past Orders</h4><?= $this->include('errors/html/alerts') ?>
                    <?php foreach ($order as $orders) :?>
                    <div class="bg-white card mb-4 order-list shadow-sm">
                        <div class="gold-members p-4">
                            
                                <div class="media">
                                    <a href="<?= site_url($orders->biz->biz_type.'/'.$orders->biz->slug) ?>">
                                    <img class="mr-4" src="<?=($orders->biz->logo) ?  site_url('img/vendor/'.$orders->biz->id.'/logo/'.$orders->biz->logo) : site_url('img/logo_1.jpg') ?>" alt="<?= esc(ucwords($orders->biz->name)) ?>">
                                    </a>
                                    <div class="media-body">
                                        <span class="float-right text-info">Delivered Fee: ₦<?= number_format($orders->delivery_fee,2)?> <i class="icofont-check-circled text-success"></i></span>
                                        <h6 class="mb-2">
                                            <a href="<?= site_url($orders->biz->biz_type.'/'.$orders->biz->slug) ?>" class="text-black"><?= ucwords($orders->biz->name) ?></a>
                                        </h6>
                                        <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> <?= ucwords($orders->user_address['address']) ?>, <?= ucwords($orders->useraddress['city_name']) ?>, <?= ucwords($orders->user_address['state_name']) ?></p>
                                        <a href="<?= site_url(current_url().'/'.$orders->pi_reference)?>"><p class="text-gray mb-3"><i class="icofont-list"></i> Ref: <?= $orders->pi_reference ?> <i class="icofont-clock-time ml-2"></i> <?=date("jS M\, Y \: g:i A", strtotime($orders->created_at))?></p></a>
                                        <!--<p class="text-dark">Veg Masala Roll x 1, Veg Penne Pasta in Red Sauce x 1</p> -->
                                        <hr>
                                        <div class="float-right">
                                            <a class="btn btn-sm btn-primary" href="<?= site_url(current_url().'/'.$orders->pi_reference)?>"><i class="icofont-eye"></i> VIEW ORDER</a>
                                        </div>
                                        <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Paid:</span> ₦<?= number_format($orders->grand_total,2)?>
                                        </p>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endsection() ?>