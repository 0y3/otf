<!--begin::Modal - New Address-->
<div class="modal fade" id="modal_edit_address" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form id="modal_address_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?= site_url('otfadmin/edit/address')?>" method="POST">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_address_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Edit Address</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="modal_address_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Billing toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7 active" data-bs-toggle="collapse" href="#kt_modal_add_address_billing_info" role="button" aria-expanded="true" aria-controls="kt_modal_add_address_billing_info">Shipping Information 
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span></div>
                        <!--end::Billing toggle-->
                        <!--begin::Billing form-->
                        <div id="kt_modal_add_address_billing_info" class="collapse show" style="">

                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                <label class="fs-6 fw-bold mb-2 required">Address</label>
                                <input class="form-control form-control-solid inputaddress" placeholder="" name="address" required="required" value="">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>

                            <div class="row g-9 mb-7">

                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold mb-2">Phone No.</label>
                                    <input class="form-control form-control-solid inputphone" placeholder="" name="phone" value="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="fs-6 fw-bold mb-2 required">City / State</label>
                                    <select name="delivery" class="form-select form-select-solid fw-bolder delivery" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" required="required" value="" >
                                        <option></option>
                                        <?php foreach ($deliveryloc as $data) :?>
                                        <option value="<?=$data['id']?>"> <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                                        <?php endforeach;?>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="modal_address_cancel" class="btn btn-light me-3">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="modal_address_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            <div></div></form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - New Address-->