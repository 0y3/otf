<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
<section class="section pt-4 pb-4">
    <div class="container">
        <div class="row">
            <?= $this->include('user/sidebar') ?>
            <div class="col-md-9">
                <div class="shadow-sm bg-white p-4 h-10000">
                    <h5 class="font-weight-bold mt-0 mb-2"><a href="<?= site_url($order->biz->biz_type.'/'.$order->biz->slug) ?>"><i class="icofont-food-cartt"></i></i><?=$order->biz->name?></a></h5>
                    <p class="mb-1 text-blackk text-gray"><span class="text-black font-weight-bold"><i class="icofont-list"></i> Ref:</span> <?=$order->reference?></p>
                    <p class="mb-1 text-black text-primary"><span class="text-black font-weight-bold"><i class="icofont-fast-delivery"></i> Delivered Fee:</span> ₦<?= number_format($order->delivery_fee,2)?>
                    <p class="mb-3 text-black text-primary"><span class="text-black font-weight-bold"><i class="icofont-pay"></i> Grand Total:</span> ₦<?= number_format($order->grand_total,2)?>
                    <?php foreach ($order->order_details as $orders) :?>
                    <div class="bg-white card mb-4 order-list shadow-sm">
                        <div class="gold-members p-4">
                        <?php
                            if($orders['order_status'] == ORDER_PEN){$icon= 'warning';}
                            elseif($orders['order_status'] == ORDER_PRO){$icon= 'info';}
                            elseif($orders['order_status'] == ORDER_DIS){$icon= 'primary';}
                            elseif($orders['order_status'] == ORDER_DEL){$icon= 'success';}
                            elseif($orders['order_status'] == ORDER_CAN){$icon= 'danger';}
                            else{$icon= 'secondary';}
                        ?>
                                <div class="media">
                                    <div class="media-body">
                                        <span class="float-right text-<?=$icon?>">Order Status: <?= ucwords($orders['order_status'])?> <i class="icofont-check-circled text-<?=$icon?>"></i></span>
                                        <h6 class="mb-2"><?= ucwords($orders['name']) ?> x <?= $orders['quantity']?> Qty <small class="badge badge-secondary">₦<?= number_format($orders['price'],2)?></small></h6>
                                        <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER: <?= $orders['order_code'] ?> <i class="icofont-clock-time ml-2"></i> <?=date("jS M\, Y \: g:i A", strtotime($orders['created_at']))?></p>
                                        <?php if(!empty($orders['addup_menu'])): ?> 
                                        <p class="text-dark">
                                            <?php 
                                                $addup = json_decode($orders['addup_menu'],true);
                                                foreach($addup as $addups) {
                                                    if((float)$addups['price']){ 
                                                        echo ucwords($addups['name']).': <small class="badge badge-secondary">₦'.number_format((float)$addups['price'],2). '</small>, ' ; 
                                                    }
                                                    else{
                                                        echo strtolower($addups['cate_name']).': <small class="badge badge-secondary">'.ucwords($addups['name']). '</small>, ' ; 
                                                    }
                                                }
                                            ?>
                                        </p>
                                        <?php endif; ?>
                                        <hr>
                                        <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Bill:</span> ₦<?= number_format($orders['grant_total'],2)?>
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