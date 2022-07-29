                <!-- Cart -->
                <div class="dropdown mt-0 mb-3">
                    <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" data-toggle="modal" data-target="#deliveryLocateModal">
                    <small>Delivery Location:</small> <span class="text-theme span-delivery-location"> <?= (getDeliveryLocationTemp()) ? getDeliveryLocationTemp()['deliveryLocateCity'].' (<small>'.getDeliveryLocationTemp()['deliveryLocateState'].'</small>)' : 'None' ?></span> &nbsp;&nbsp;
                    </a>
                </div>
                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                    <h5 class="mb-1 text-white">Your Order</h5>
                    <?php if(isset($cart) && !empty($cart)):?>
                    <p id="order-count" class="mb-4 text-white"><?= $total_items?> Quantity</p>
                    <div id = "checkout" class="bg-white rounded shadow-sm mb-2">
                    <?php foreach ($cart as $data) :?> 
                        <div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">₦<?= number_format($data['total'],2)?></p>
                            <span id="<?=$data['rowid']?>" class="count-number float-right" data-row="<?=$data['rowid']?>">
                                <!-- <a href="javascript:;" class="btn btn-outline-info btn-sm left edi" data-toggle="tooltip" title="Edit!"><i class="icofont-edit-alt"></i> </a> -->
                                <a href="javascript:;" class="btn btn-outline-danger btn-sm right del" data-toggle="tooltipp" title="Delete!"> <i class="icofont-ui-delete"></i> </a>
                            </span>
                            <div class="media" data-toggle="tooltip" title="<?=ucwords($data['name']) ?> x <?=$data['qty'] ?>qty">
                                <div class="mr-2"><i class="icofont-food-cart text-success food-item"></i></div>
                                <div class="media-body"><p class="mt-1 mb-0 text-black"><?=ucwords($data['name']) ?> x <?=$data['qty'] ?> Qty</p></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <!-- <img class="img-fluid float-left" src="img/wallet-icon.png"> -->
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger subtotal">₦<?= number_format($sum_total,2)?></span></h6>
                    </div>
                    <div class="pad">
                        <a id="btn-checkout" href="<?= current_url()?>/checkout" class="btn btn-success btn-block btn-lg btn-checkout">Checkout <i class="icofont-long-arrow-right"></i></a>
                    </div>
                  <?php else: ?>
                    <p id="order-count" class="mb-4 text-white">0 ITEM</p>
                    <div id="checkout" class="bg-white rounded shadow-sm mb-2">
                        <div class="gold-members p-2">
                            <div class="media-body">
                                <h6 class="mt-1 mb-0 text-black">No Order</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <!-- <img class="img-fluid float-left" src="img/wallet-icon.png"> -->
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-danger subtotal">₦00.00</span></h6>
                    </div>
                    <div id="pad">
                        
                    </div>
                  <?php endif;?>
                </div>
                <div class="text-center pt-2 mb-4">
                    <img class="img-fluid" src="https://dummyimage.com/352x600/ccc/ffffff.png&amp;text=Google+ads">
                </div>
                <div class="text-center pt-2">
                    <img class="img-fluid" src="https://dummyimage.com/352x568/ccc/ffffff.png&amp;text=Google+ads">
                </div>