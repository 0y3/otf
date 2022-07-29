<?= $this->extend('superadmin/layout') ?>


<?= $this->section('content') ?>
<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">


                                <!--begin::Layout-->
                                <div class="d-flex flex-column flex-xl-row">
                                    <!--begin::Sidebar-->
                                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                                        <!--begin::Card-->
                                        <div class="card mb-5 mb-xl-8">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-15">
                                                <!--begin::Summary-->
                                                <div class="d-flex flex-center flex-column mb-5">

                                                    <div class="d-flex align-items-center mb-6">
                                                        <!--begin::Logo-->
                                                        <div class="symbol symbol-70px symbol-circle me-3">
                                                            <span class="symbol-label fs-2 fw-bold bg-<?=BG_NAME[array_rand(BG_NAME)]?> text-inverse-danger"><?= strtoupper($user->surname[0].' '. $user->firstname[0])?></span>
                                                        </div>
                                                            <!-- <img src="../../assets/media/svg/card-logos/mastercard.svg" class="w-40px me-3" alt=""> -->
                                                        <!--end::Logo-->
                                                        <!--begin::Summary-->
                                                        <div class="me-3">
                                                            <div class="d-flex align-items-center mb-1">
                                                                <div class="fs-3 text-gray-800 fw-bolder"><?= ucwords($user->surname.' '. $user->firstname)?></div>
                                                                <div class="badge badge-light-<?= ($user->status == 1) ? 'success' : 'danger' ?> ms-5"><?= ($user->status == 1) ? 'Active' : 'InActive' ?></div>
                                                            </div>
                                                            <div class="fs-6 fw-bold text-muted"><?= strtolower($user->email)?></div>
                                                            <div class="fs-6 fw-bold text-muted"><?= strtolower($user->phone)?></div>
                                                        </div>
                                                        <!--end::Summary-->
                                                    </div>
                                                    <!--end::Position-->
                                                </div>
                                                <!--end::Summary-->
                                                <!--begin::Details toggle-->
                                                <div class="d-flex flex-stack fs-6 py-3">
                                                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">Address Book 
                                                        <span class="ms-2 rotate-180">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
                                                        <a href="#" class="btn btn-sm btn-light-primary addAddress" data-bs-toggle="modal" data-bs-target="#modal_address">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                                </svg>
                                                            </span>
                                                            Add address
                                                        </a>
                                                    </span>
                                                </div>
                                                <!--end::Details toggle-->
                                                <div class="separator separator-dashed my-3"></div>
                                                <!--begin::Details content-->
                                                <div id="kt_customer_view_details" class="collapse show">
                                                    <?php foreach ($user->Address as $address) :?> 
                                                    <div id="address<?=$address['id']?>" class="py-0 fs-6">
                                                        <!--begin::Header-->
                                                        <div class="pt-3 d-flex flex-stack flex-wrap">
                                                            <!--begin::Toggle-->
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="fw-bolder text-gray-600"><?= strtoupper($address['state_code']) ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Toggle-->
                                                            <!--begin::Toolbar-->
                                                            <div class="d-flex my-33 ms-9">
                                                                <!--begin::Edit-->
                                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 editAddress" data-bs-toggle="modal" data-bs-target="#modal_edit_address" data-innit="<?= base64_encode($address['id'])?>" data-address="<?=$address['address']?>" data-phone="<?=$address['phone']?>" data-delivery="<?=$address['delivery_locations_id']?>">
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Edit">
                                                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                        <span class="svg-icon svg-icon-3">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                                </a>
                                                                <!--end::Edit-->
                                                                <!--begin::Delete-->
                                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 deleteAddress" data-innit="<?=$address['id']?>" data-bs-toggle="tooltip" title="" data-kt-customer-payment-method="delete" data-bs-original-title="Delete">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                                    <span class="svg-icon svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <!--end::Delete-->
                                                            </div>
                                                            <!--end::Toolbar-->
                                                        </div>
                                                        <!--end::Header-->
                                                        <!--begin::Details-->
                                                        <div class="d-flex flex-column pb-5">
                                                            <div class="text-muted"><?= $address['address']?>,
                                                            <br><?= $address['city_name']?>,
                                                            <br><?= $address['state_name']?>
                                                            <br><?= $address['phone']?>
                                                            </div>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <!--end::Details content-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Sidebar-->


                                    <!--begin::Content-->
                                    <div class="flex-lg-row-fluid ms-lg-10">
                                        <!--begin:::Tabs-->
                                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a class="nav-link text-active-primary pb-4 active" href="<?= route_to('customer', $user->id)?>">Orders</a>
                                            </li>
                                            <!--end:::Tab item-->
                                            <!--begin:::Tab item-->
                                            <li class="nav-item">
                                                <a class="nav-link text-active-primary pb-4" href="<?= route_to('customer', $user->id)?>">Statements</a>
                                            </li>
                                            <!--end:::Tab item--> 
                                        </ul>
                                        <!--end:::Tabs-->
                                                <!--begin::Card-->
                                                <div class="card pt-4 mb-6 mb-xl-9">
                                                    <!--begin::Card header-->
                                                    <div class="card-header border-0">
                                                        <!--begin::Card title-->
                                                        <div class="card-title">
                                                            <h2>Transaction History</h2>
                                                        </div>
                                                        <!--end::Card title-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body pt-0 pb-5">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle table-row-dashed gy-5" id="customers_payment">
                                                            <!--begin::Table head-->
                                                            <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                                                <!--begin::Table row-->
                                                                <tr class="text-start text-muted text-uppercase gs-0">
                                                                    <th class="min-w-10px"></th>
                                                                    <th class="min-w-100px">Payment No.</th>
                                                                    <th>Vendor</th>
                                                                    <th>Status</th>
                                                                    <th>Amount</th>
                                                                    <th>Date</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                <!--end::Table row-->
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody class="fs-6 fw-bold text-gray-600">
                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Layout-->


                                
                                <?= $this->include('superadmin/modal_add_address') ?>
                                <?= $this->include('superadmin/modal_edit_address') ?>
                                <!--end::Modals-->
</div>
<!--end::Container-->

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <script>var data = <?= json_encode($user->all_orders)?>;</script>
    <script src="<?=base_url('admin/js/custom/datatable/customer.js')?>"></script>
<?=$this->endSection()?>