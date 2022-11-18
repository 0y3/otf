<!--begin::Modal - New Address-->
<div class="modal fade" id="modal_edit_vendor" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">

            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_vendor_header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Edit Vendor</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div id="modal_vendor_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
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
                    <!--begin::Vendor Logo toggle-->
                    <div class="fw-bolder fs-3 rotate collapsible mb-7 active" data-bs-toggle="collapse"
                        href="#kt_modal_add_vendor_logo" role="button" aria-expanded="true"
                        aria-controls="kt_modal_add_vendor_logo">Logo
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <!--end::Vendor Logo toggle-->

                    <!--begin::Vendor Logo form-->
                    <div id="kt_modal_add_vendor_logo" class="collapse show mb-10">
                        <!--begin::Form-->
                        <form id="modal_address_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                            action="<?= site_url('otfadmin/editlogo/vendor')?>" method="POST">


                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card body-->
                                <div class="fv-row card-body text-center pt-0">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty image-input-outline mb-3"
                                        data-kt-image-input="true"
                                        style="background-image: url(<?= base_url('img/blank_image.svg')?>)">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="image_file" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and
                                        *.jpeg image
                                        files are accepted</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Thumbnail settings-->


                            <!--begin::Button-->
                            <button type="submit" id="modal_address_submit" class="btn btn-sm btn-primary">
                                <span class="indicator-label">Update Logo</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                            <div class="separator separator-dashed my-3"></div>
                        </form>
                        <!--end::Form-->

                    </div>

                    <!--begin::Form-->
                    <form id="modal_address_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        action="<?= site_url('otfadmin/edit/vendor')?>" method="POST">
                        <!--begin::Vendor Info toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_add_vendor_info" role="button" aria-expanded="true"
                            aria-controls="kt_modal_add_vendor_info">Vendor Information
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Vendor Info toggle-->

                        <!--begin::Vendor Info form-->
                        <div id="kt_modal_add_vendor_info" class="collapse show" style="">

                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Business Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        title="Full Details of the Business"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" id="biz_name" class="form-control form-control-lg form-control-solid"
                                    name="name" required="required" placeholder="" value="" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-10 d-flex flex-column">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label">Business Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea name="desc" class="form-control form-control-lg form-control-solid"
                                    required="required" rows="2" style="height: 46px;"></textarea>
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="row fv-row mb-10">
                                <div class="col-6">
                                    <label class="required fs-6 fw-bold form-label mb-2">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg form-control-solid"
                                        name="phone" required="required" placeholder="" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-6">
                                    <label class="required fs-6 fw-bold form-label mb-2">Email </label>
                                    <input type="email" class="form-control form-control-lg form-control-solid"
                                        name="email" required="required" placeholder="" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                            </div>
                            <div class="fv-row mb-10 d-flex flex-column">
                                <!--begin::Label-->
                                <label class="required d-flex align-items-center form-label">Business Address</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea name="address" class="form-control form-control-lg form-control-solid"
                                    required="required" rows="2" style="height: 46px;"></textarea>
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="row fv-row mb-10">
                                <div class="col-6">
                                    <!--begin::Label-->
                                    <label class="required d-flex align-items-center form-label">City/State</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select name="delivery" class="form-select form-select-solid fw-bolder delivery"
                                        data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                        required="required" value="">
                                        <option></option>
                                        <?php foreach ($deliveryloc as $data) :?>
                                        <option value="<?=$data['id']?>"> <?= ucwords($data['city_name']) ?>
                                            <small>(<?= ucwords($data['state_name']) ?>)</small>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-6">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Label-->
                                        <div class="me-5">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold">Activate Biz Status?</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!-- <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div> -->
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input" name="status" type="checkbox" value="1"
                                                id="kt_modal_add_customer_billing" checked="checked">
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <span class="form-check-label fw-bold text-muted"
                                                for="kt_modal_add_customer_billing">Yes</span>
                                            <!--end::Label-->
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                    <!--begin::Wrapper-->
                                </div>
                            </div>

                            <!--begin::Button-->
                            <button type="submit" id="modal_vendor_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" id="modal_vendor_cancel" class="btn btn-light me-3">Discard</button>
                <!--end::Button-->

            </div>
            <!--end::Modal footer-->
            <div></div>
        </div>
    </div>
</div>
<!--end::Modal - New Address-->