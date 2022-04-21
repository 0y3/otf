<nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url()?>"><img alt="logo" src="/img/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= ($currentMenu == 'home') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('')?>">Home </a>
                </li>
                <li class="nav-item dropdown <?=  ($currentMenu == 'restaurant') ? 'active' : '' ?> <?=  ($currentMenu == 'grocery') ? 'active' : '' ?> <?=  ($currentMenu == 'party') ? 'active' : '' ?>" >
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Vendors 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                    <a class="dropdown-item" href="<?= site_url('restaurant')?>">Restaurants</a>
                    <a class="dropdown-item" href="<?= site_url('grocery')?>">Grocery</a>
                    <a class="dropdown-item" href="<?= site_url('party')?>">Party</a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pages
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                    <a class="dropdown-item" href="track-order.html">Track Order</a>
                    <a class="dropdown-item" href="invoice.html">Invoice</a>
                    <a class="dropdown-item" href="login.html">Login</a>
                    <a class="dropdown-item" href="register.html">Register</a>
                    <a class="dropdown-item" href="404.html">404</a>
                    <a class="dropdown-item" href="extra.html">Extra :)</a>
                    </div>
                </li>
                <?php  if($currentMenu =='login'): ?>

                <li class="nav-item dropdown <?php  ($currentMenu == 'account') ? 'active' : '' ?>">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="Generic placeholder image" src="img/user/4.png" class="nav-osahan-pic rounded-pill"></i>My Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="orders.html#orders"><i class="icofont-food-cart"></i> Orders</a>
                        <a class="dropdown-item" href="orders.html#offers"><i class="icofont-sale-discount"></i> Offers</a>
                        <a class="dropdown-item" href="orders.html#favourites"><i class="icofont-heart"></i> Favourites</a>
                        <a class="dropdown-item" href="orders.html#payments"><i class="icofont-credit-card"></i> Payments</a>
                        <a class="dropdown-item" href="orders.html#addresses"><i class="icofont-location-pin"></i> Addresses</a>
                    </div> 
                </li>
                <?php  else: ?>

                <li class="nav-item <?php  ($currentMenu == 'login') ? 'active' : '' ?>">
                    <a class="nav-link" href=""><i class="icofont-user-alt-1"></i> Login</a>
                </li>
                
                <?php  endif ?>
            </ul>
        </div>
    </div>
</nav>
      