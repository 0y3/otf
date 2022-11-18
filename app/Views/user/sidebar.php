<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm bg-white h-100">
        <div class="border-bottom p-4">
            <div class="osahan-user text-center">
                <div class="osahan-user-media">
                    <img class="mb-3 rounded-pill shadow-sm mt-1" src="<?= base_url("img/user/4.png")?>">
                    <div class="osahan-user-media-body">
                        <h6 class="mb-2"><?=$_SESSION['userSurname'] ?? ''?> <?= $_SESSION['userFirstname'] ?? ''?></h6>
                        <p class="mb-1"><?=$_SESSION['userPhone'] ?? ''?></p>
                        <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal"
                                data-target="#edit-profile-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a></p>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab">
            <li class="nav-item">
                <a class="nav-link <?=  ($currentMenu == 'order') ? 'active' : '' ?>" id="orders"
                    href="<?=site_url('user/order')?>"><i class="icofont-food-cart"></i> Orders</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link <?=  ($currentMenu == 'trackorder') ? 'active' : '' ?>" id="otrackorder" href="<?=site_url('user/trackorder')?>"><i class="icofont-delivery-time"></i> Track Order</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('logout')?>"><i class="icofont-logout"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>