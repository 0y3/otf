<?= $this->extend('superadmin/layout') ?>


<?= $this->section('content') ?>
<!--begin::Container-->
<div class="container-xxl"> 
    <!--begin::Navbar-->
    <?= $this->include('superadmin/vendors_details_menu') ?>
    <!--end::Navbar-->
	
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">

        <!--begin::Col-->
        <div class="col-xl-8 mb-xl-10">
            <!--begin::Chart widget 5-->
            <div class="card card-flush h-lg-100">
                <!--begin::Header-->
                <div class="card-header flex-nowrap pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Cover Image</span>
                    </h3>
                    <!--end::Title-->
                    <div class="card-toolbar">
                        <a class="btn btn-sm btn-light">Change Image</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5 ps-6">
                    <!--begin::Overlay-->
                    <a class="d-block overlay" data-fslightbox="lightbox-basic" href="<?= base_url('img/vendor/'.$biz->id.'/logo/'.$biz->image)?>">
                        <!--begin::Image-->
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-300px"style="background-image:url('<?= base_url('img/vendor/'.$biz->id.'/logo/'.$biz->image)?>')"></div>
                        <!--end::Image-->

                        <!--begin::Action-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                        </div>
                        <!--end::Action-->
                    </a>
                    <!--end::Overlay-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-4 mb-xl-10">
            <!--begin::List widget 5-->
            <div class="card card-flush h-lg-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Product Delivery</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="../apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">Order Details</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height:300px">
                        <!--begin::Item-->
                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="#" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <a class="btn fw-bold px-2 badge badge-light text-hover-primary justify-content-end" href="#">view...</a>
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-400 fw-bolder">To: 
                                <a href="../apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Jason Bourne</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="../assets/media/stock/ecommerce/209.gif" class="w-50px ms-n1 me-1" alt="" />
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="../apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">RiseUP</a>
                                    <!--end::Title-->
                                </div>
                                <a class="btn fw-bold px-2 badge badge-light text-hover-primary justify-content-end" href="#">view...</a>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-400 fw-bolder">To: 
                                <a href="../apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Marie Durant</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="../assets/media/stock/ecommerce/214.gif" class="w-50px ms-n1 me-1" alt="" />
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="../apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Yellow Stone</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <a class="btn fw-bold px-2 badge badge-light text-hover-primary justify-content-end" href="#">view...</a>
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-400 fw-bolder">To: 
                                <a href="../apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Dan Wilson</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-danger">Confirmed</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="../assets/media/stock/ecommerce/211.gif" class="w-50px ms-n1 me-1" alt="" />
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="../apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <a class="btn fw-bold px-2 badge badge-light text-hover-primary justify-content-end" href="#">view...</a>
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-400 fw-bolder">To: 
                                <a href="../apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Lebron Wayde</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="../assets/media/stock/ecommerce/215.gif" class="w-50px ms-n1 me-1" alt="" />
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="../apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">RiseUP</a>
                                    <!--end::Title-->
                                </div>
                                <a class="btn fw-bold px-2 badge badge-light text-hover-primary justify-content-end" href="#">view</a>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-400 fw-bolder">To: 
                                <a href="../apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">Ana Simmons</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->

    </div>
    <!--end::Row-->
    
</div>
<!--end::Container-->

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <script>var data = <?= json_encode($biz)?>;</script>
    <script src="<?=base_url('admin/js/custom/datatable/vendor.js')?>"></script>
<?=$this->endSection()?>