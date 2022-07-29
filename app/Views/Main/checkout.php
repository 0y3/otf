<?=$this->section("styles")?>
    <link href="<?=base_url()?>/admin/css/style.bundle.css" rel="stylesheet" type="text/css" />
<?=$this->endSection()?>
<?= $this->extend('main/layout') ?>


<?= $this->section('content') ?>
<form id="addToCart" action="<?= route_to('user_payment') ?>" method="POST">
    <section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
            <?= $this->include('errors/html/alerts') ?>
                    <div class="bg-white rounded shadow-sm p-4 mb-4">
                        <h4 class="mb-1">Choose a delivery address</h4>
                        <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>
                        <div class="row">
                        <?php foreach ($user->address as $data) :?> 
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 borderr border-successs">
                                    <label class="btn d-flex flex-stack text-start p-6o mb-5o">
                                        <div class="d-flex align-items-center me-2">
                                            <div class="form-check form-check-custom form-check-solid form-check-primary mr-5">
                                                <input class="form-check-input" type="radio" required <?= $data['delivery_locations_id'] == $encrypter->decrypt(base64_decode(getDeliveryLocationTemp()['deliveryLocateId'])) ? 'checked' : '' ?>  name="address_id" data-deliverylocations="<?=base64_encode($encrypter->encrypt($data['delivery_locations_id']))?>" value="<?= $data['id']?>"/>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-flex align-items-center fs-4 fw-bolder flex-wrap mb-1"><?= $data['address']?>,</h6>
                                                <div class="fw-bold opacity-50"><?= $data['city_name'].' ,'.$data['state_name']?>.</div>
                                                <p class="fw-bold text-dark"><?= $data['phone']?></p>
                                            </div>
                                        </div>
                                    </label>
                                    <!-- <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-black">Home</h6>
                                                <p class="text-black">291/d/1, 291, Jawaddi Kalan, Ludhiana, Punjab 141002, India</p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-success mr-2" href="#"> DELIVER HERE</a>
                                                    <span>30MIN</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div> --> 
                                </div> 
                            </div>
                        <?php endforeach; ?>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                            <div class="media-body">
                                                <p class="mb-0 text-black font-weight-bold"><a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2" href="#"> ADD NEW ADDRESS</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                        <div class="d-flex mb-4 osahan-cart-item-profile">
                            <img class="img-fluid mr-3 rounded-pill" alt="<?= esc(ucwords($biz->name)) ?>" src="<?=  ($biz->logo) ?  site_url('img/vendor/'.$biz->id.'/logo/'.$biz->logo) : site_url('img/logo_1.jpg') ?> ">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-white"><?= esc(ucwords($biz->name)) ?></h6>
                                <p class="mb-0 text-white"><i class="icofont-location-pin"></i> <?= esc(ucwords($biz->address.', '.$city['city_name'].', '.$state['state_name'] )) ?></p>
                            </div>
                        </div>
                        <div id = "checkout" class="bg-white rounded shadow-sm mb-2">
                        <?php foreach ($cart as $data) :?> 
                            <div class="gold-members p-2 border-bottom">
                                <p class="text-gray mb-0 float-right ml-2">₦<?= number_format($data['total'],2)?></p>
                                <span id="<?=$data['rowid']?>" class="count-number float-right" data-row="<?=$data['rowid']?>">
                                    <!-- <a href="javascript:;" class="btn btn-outline-info btn-sm left edi" data-toggle="tooltip" title="Edit!"><i class="icofont-edit-alt"></i> </a> -->
                                    <a href="javascript:;" class="btn btn-outline-danger btn-sm right del" title="Delete!"> <i class="icofont-ui-delete"></i> </a>
                                </span>
                                <div class="media" data-toggle="tooltip" title="<?=ucwords($data['name']) ?> x <?=$data['qty'] ?>qty">
                                    <div class="mr-2"><i class="icofont-food-cart text-success food-item"></i></div>
                                    <div class="media-body"><p class="mt-1 mb-0 text-black"><?=ucwords($data['name']) ?> x <?=$data['qty'] ?> Qty</p></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <div class="mb-2 bg-white rounded p-2 clearfix">
                            <p class="mb-1">Item Total <span class="float-right text-dark subtotal" data-subtotal="<?=$sum_total?>">₦<?= number_format($sum_total,2)?></span></p>
                            <p class="mb-1">Delivery Fee 
                                <span class="text-info" data-toggle="tooltip" data-placement="top" title="Delivery Fee to Your Location"><i class="icofont-info-circle"></i></span>
                                <span class="float-right text-dark delivery-fee" data-deliverylocationfee="<?=$delivery_fee?>">₦<?= number_format($delivery_fee,2)?></span>
                            </p>
                            <hr />
                            <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right grand-total">₦<?= number_format($grand_total,2)?></span></h6>
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-lg">PAY <span class="grand-total">₦<?= number_format($grand_total,2)?><i class="icofont-long-arrow-right"></i></span></butoon>
                        <!-- <a href="<?= route_to('user_payment') ?>" class="btn btn-success btn-block btn-lg">PAY <span class="grand-total">₦<?= number_format($grand_total,2)?><i class="icofont-long-arrow-right"></i></span></a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

    <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addAddress" action="<?= site_url('user/add/address')?>" method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Delivery Address</label>
                            <input type="text" class="form-control" required name="address" placeholder="Complete Address e.g. house number, street name, landmark">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Phone No.</label>
                            <input type="number" required class="form-control" required  name="phone" placeholder="080*******">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Delivery City / State</label>
                            <select class="custom-select form-control-lg locationselection select2" data-placeholder="Select your delivery location" name="delivery" value ="<?= !empty(getDeliveryLocationTemp()) ? $encrypter->decrypt(base64_decode(getDeliveryLocationTemp()['deliveryLocateId'])) : '' ?>" required>
                            <option value=""> Select your delivery location </option>
                            <?php foreach ($deliveryloc as $data) :?>
                            <?php if(getDeliveryLocationTemp()): ?>
                            <option value="<?=$data['id']?>" <?= ($data['id'] == $encrypter->decrypt(base64_decode(getDeliveryLocationTemp()['deliveryLocateId']))) ? 'selected' : '' ?> > <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                            <?php else: ?>
                            <option value="<?=$data['id']?>"> <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                            <?php endif; ?>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="user_address_submit" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->endsection() ?>