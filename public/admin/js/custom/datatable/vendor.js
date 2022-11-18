// "use strict";

// // Class definition
// var KTDatatablesButtons = function () {
//     // Shared variables
//     var table;
//     var datatable;

//     // Private functions
//     var initDatatable = function () {
//         // Set date data order
//         const tableRows = table.querySelectorAll('tbody tr');

//         tableRows.forEach(row => {
//             const dateRow = row.querySelectorAll('td');
//             const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
//             dateRow[3].setAttribute('data-order', realDate);
//         });

//         // Init datatable --- more info on datatables: https://datatables.net/manual/
//         datatable = $(table).DataTable({
//             "info": false,
//             'order': [],
//             'pageLength': 10,
//         });
//     }

//     // Hook export buttons
//     var exportButtons = () => {
//         const documentTitle = 'Vendors List';
//         var buttons = new $.fn.dataTable.Buttons(table, {
//             buttons: [
//                 {
//                     extend: 'copyHtml5',
//                     title: documentTitle
//                 },
//                 {
//                     extend: 'excelHtml5',
//                     title: documentTitle
//                 },
//                 {
//                     extend: 'csvHtml5',
//                     title: documentTitle
//                 },
//                 {
//                     extend: 'pdfHtml5',
//                     title: documentTitle
//                 }
//             ]
//         }).container().appendTo($('#kt_vendor_export_menu'));

//         // Hook dropdown menu click event to datatable export buttons
//         const exportButtons = document.querySelectorAll('#kt_vendor_export_menu [data-kt-vendor-export]');
//         exportButtons.forEach(exportButton => {
//             exportButton.addEventListener('click', e => {
//                 e.preventDefault();

//                 // Get clicked export value
//                 const exportValue = e.target.getAttribute('data-kt-vendor-export');
//                 const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

//                 // Trigger click event on hidden datatable export buttons
//                 target.click();
//             });
//         });
//     }

//     // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
//     var handleSearchDatatable = () => {
//         const filterSearch = document.querySelector('[data-kt-vendor-table-filter="search"]');
//         filterSearch.addEventListener('keyup', function (e) {
//             datatable.search(e.target.value).draw();
//         });
//     }

//     // Public methods
//     return {
//         init: function () {
//             table = document.querySelector('#kt_vendor_datatable');

//             if ( !table ) {
//                 return;
//             }

//             initDatatable();
//             exportButtons();
//             handleSearchDatatable();
//         }
//     };
// }();

// // On document ready
// KTUtil.onDOMContentLoaded(function () {
//     KTDatatablesButtons.init();
// });



// "use strict";

// // Class definition
// var KTDatatablesServerSide = function() {
//     // Shared variables
//     var table;
//     var dt;
//     var filterPayment;

//     // Private functions
//     var initDatatable = function() {
//         dt = $("#kt_vendor_datatable").DataTable({
//             data: data,
//             responsive: true
//             // searchDelay: 500,
//             // processing: true,
//             // serverSide: true,
//             // order: [
//             //     [5, 'desc']
//             // ],
//             // stateSave: true,
//             select: {
//                 style: 'multi',
//                 selector: 'td:first-child input[type="checkbox"]',
//                 className: 'row-selected'
//             },
//             // ajax: {
//             //     //  url: "https://preview.keenthemes.com/api/datatables.php",
//             // },
//              columns: [
//                 { data: 'id' },
//                 { data: 'name' },
//                 { data: 'email' },
//                 { data: 'biz_type' },
//                 { data: 'phone' },
//                 { data: 'created_at' },
//                 { data: null },
//             ],
//             columnDefs: [{
//                     targets: 0,
//                     orderable: false,
//                     render: function(data) {
//                         return `
//                             <div class="form-check form-check-sm form-check-custom form-check-solid">
//                                 <input class="form-check-input" type="checkbox" value="${$data}" />
//                             </div>`;
//                     }
//                 },
//                 {
//                     targets: 6,
//                     data: null,
//                     orderable: false,
//                     className: 'text-end',
//                     render: function(data, type, row) {
//                         return `
//                             <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
//                                 Actions
//                                 <span class="svg-icon svg-icon-5 m-0">
//                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
//                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
//                                             <polygon points="0 0 24 0 24 24 0 24"></polygon>
//                                             <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
//                                         </g>
//                                     </svg>
//                                 </span>
//                             </a>
//                             <!--begin::Menu-->
//                             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
//                                 <!--begin::Menu item-->
//                                 <div class="menu-item px-3">
//                                     <a href="#" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
//                                         Edit
//                                     </a>
//                                 </div>
//                                 <!--end::Menu item-->

//                                 <!--begin::Menu item-->
//                                 <div class="menu-item px-3">
//                                     <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
//                                         Delete
//                                     </a>
//                                 </div>
//                                 <!--end::Menu item-->
//                             </div>
//                             <!--end::Menu-->
//                         `;
//                     },
//                 },
//             ],
//             // Add data-filter attribute
//             createdRow: function(row, data, dataIndex) {
//                 $(row).find('td:eq(4)').attr('data-filter', data.created_at);
//             }
//         });

//         table = dt.$;

//         // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
//         dt.on('draw', function() {
//             toggleToolbars();
//             handleDeleteRows();
//             KTMenu.createInstances();
//         });
//     }

//     // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
//     var handleSearchDatatable = function() {
//         const filterSearch = document.querySelector('[data-kt-vendor-table-filter="search"]');
//         filterSearch.addEventListener('keyup', function(e) {
//             dt.search(e.target.value).draw();
//         });
//     }

//     // Filter Datatable
//     var handleFilterDatatable = () => {
//         // Select filter options
//         filterPayment = document.querySelectorAll('[data-kt-docs-table-filter="payment_type"] [name="payment_type"]');
//         const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

//         // Filter datatable on submit
//         filterButton.addEventListener('click', function() {
//             // Get filter values
//             let paymentValue = '';

//             // Get payment value
//             filterPayment.forEach(r => {
//                 if (r.checked) {
//                     paymentValue = r.value;
//                 }

//                 // Reset payment value if "All" is selected
//                 if (paymentValue === 'all') {
//                     paymentValue = '';
//                 }
//             });

//             // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
//             dt.search(paymentValue).draw();
//         });
//     }

//     // Reset Filter
//     var handleResetForm = () => {
//         // Select reset button
//         const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');

//         // Reset datatable
//         resetButton.addEventListener('click', function() {
//             // Reset payment type
//             filterPayment[0].checked = true;

//             // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
//             dt.search('').draw();
//         });
//     }


//     // Public methods
//     return {
//         init: function() {
//             initDatatable();
//             exportButtons();
//             handleSearchDatatable();
//             handleFilterDatatable();
//             handleResetForm();
//         }
//     }
// }();

// // On document ready
// jQuery(document).ready(function() {KTDatatablesServerSide.init();});


"use strict";
// Class definition
var KTDatatables = function() {
    // Shared variables
    var table = '#kt_vendor_datatable';
    var dt;
    var filterPayment;
    // Private functions
    var initDatatable = function() {
        dt = $(table).DataTable({
            data: data,
            responsive: true,
            // stateSave: true,
            // fixedHeader: true,
            pageLength: 20,
            lengthMenu: [
                [20, 50, 100, 200, 500, -1],
                [20, 50, 100, 200, 500, 'All'],
            ],
            // deferRender:    true,
            // scrollY:        200,  //
            // scrollCollapse: true,
            // scroller:       true
            order: [
                [1, 'desc']
            ],
            columns: [
                { data: 'id' },
                { data: 'created_at.date' },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        let status = 'danger';
                        let va = 'Locked';
                        if (row['status'] == 1) {
                            status = 'success';
                            va = 'Active';
                        }
                        return `
                            <a href="${base_url+'/otfadmin/vendor/'+row['slug']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}</a>
                            <span class="badge badge-light-${status} fs-7">${va}</span>
                            `;
                    }
                },
                { data: 'email' },
                { data: 'biz_type' },
                { data: 'phone' },
                { data: null }
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                },
                {
                    targets: 1,
                    render: function(data, type, row) {
                        return moment(data.date).format("Do MMM, YYYY");
                    }
                },
                {
                    target: 2,
                    render: function(data, type, row) {
                        let status = 'danger';
                        let va = 'Locked';
                        if (row['status'] == 1) {
                            status = 'success';
                            va = 'Active';
                        }
                        return `
                                <a href="${base_url+'/otfadmin/vendor/'+row['slug']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}
                                <span class="badge badge-light-${status} fs-7">${va}</span></a>
                                `;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return `
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="${base_url+'/otfadmin/vendor/'+row['slug']}" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30pxbtn-sm me-1">
                                <span class="svg-icon svg-icon-3">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Visible.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.5" d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor"/>
                                            <path opacity="0.5" d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor"/>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1 editvendor" data-bs-toggle="modal"
                            data-bs-target="#modal_edit_vendor" data-name="${row['name']}" data-slug="${row['slug']}" data-description="${row['description']}" data-logo="${row['logo']}" data-phone="${row['phone']}" data-email="${row['email']}" data-address="${row['address']}" data-status="${row['status']}"> 
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                            <button type="button" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-1" data-kt-action="field_remove">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                        </div>
                        `;
                    },
                },
            ]
        });

        dt.on('order.dt search.dt', function() {
            let i = 1;

            dt.cells(null, 0, { search: 'applied', order: 'applied' }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    }

    var handleSearchDatatable = function() {
        const filterSearch = document.querySelector('[data-kt-vendor-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            dt.search(e.target.value).draw();
        });
    }


    var handleFilterDatatable = () => {
        // Select filter options
        filterPayment = document.querySelectorAll('[name="biz_status_filter"], [name="biz_type_filter"]');
        const filterButton = document.querySelector('[data-kt-vendor-table-filter="filter"]');
        // Filter Datatable
        $('[name="biz_status_filter"]').on('change', function(e) {
            if ($(this).val() === 'all') {
                dt.column(2).search('').draw();
            } else {
                dt.column(2).search($(this).val().toLowerCase()).draw();
            }
        });

        // Filter datatable on submit
        filterButton.addEventListener('click', function(e) {
            // Get filter values
            let Value = '';

            // console.log(filterPayment);
            // Get payment value
            filterPayment.forEach(r => {
                if (r.checked) {
                    Value = r.value;
                }

                // Reset payment value if "All" is selected
                if (Value === 'all') {
                    Value = '';
                }
            });
            console.log(Value);
            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search(Value).draw();
        });
    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-vendor-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function() {
            // Reset payment type
            filterPayment[0].checked = true;
            $('[name="biz_status_filter"]').val(null).trigger('change');
            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search('').draw();
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Vendors List';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                    extend: 'copyHtml5',
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle
                }
            ]
        }).container().appendTo($('#kt_ecommerce_report_customer_orders_export'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#kt_vendor_export_menu [data-kt-vendor-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-kt-vendor-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                console.log(exportValue);
                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Public methods
    return {
        init: function() {
            initDatatable();
            KTMenu.createInstances();
            exportButtons();
            handleSearchDatatable();
            handleFilterDatatable();
            handleResetForm();
        }
    }
}();



"use strict";

// Class definition
var KTAddVendor = function() {
    // Elements
    var modal;
    var modalEl;

    var stepper;
    var form;
    var formSubmitButton;
    var formContinueButton;

    var myDropzone;

    // Variables
    var stepperObj;
    var validations = [];

    // ===========Select2============
    $(".delivery").select2();
    // Private Functions
    var initStepper = function() {
        // Initialize Stepper
        stepperObj = new KTStepper(stepper);

        // Stepper change event(handle hiding submit button for the last step)
        stepperObj.on('kt.stepper.changed', function(stepper) {
            if (stepperObj.getCurrentStepIndex() === 3) {
                formSubmitButton.classList.remove('d-none');
                formSubmitButton.classList.add('d-inline-block');
                formContinueButton.classList.add('d-none');
            } else if (stepperObj.getCurrentStepIndex() === 4) {
                formSubmitButton.classList.add('d-none');
                formContinueButton.classList.add('d-none');
            } else {
                formSubmitButton.classList.remove('d-inline-block');
                formSubmitButton.classList.remove('d-none');
                formContinueButton.classList.remove('d-none');
            }
        });

        // Validation before going to next page
        stepperObj.on('kt.stepper.next', function(stepper) {
            console.log('stepper.next');

            // Validate form before change stepper step
            var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

            if (validator) {
                validator.validate().then(function(status) {
                    console.log('validated! :- ' + status);

                    if (status == 'Valid') {
                        stepper.goNext();

                        //KTUtil.scrollTop();
                    } else {
                        // Show error message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then(function() {
                            //KTUtil.scrollTop();
                        });
                    }
                });
            } else {
                stepper.goNext();

                KTUtil.scrollTop();
            }
        });

        // Prev event
        stepperObj.on('kt.stepper.previous', function(stepper) {
            console.log('stepper.previous');

            stepper.goPrevious();
            KTUtil.scrollTop();
        });

        // submit Vendor
        formSubmitButton.addEventListener('click', function(e) {
            // Validate form before change stepper step
            var validator = validations[2]; // get validator for last form

            //validate myDropzone have image
            // console.log(myDropzone.files.length);

            var form = $(this).closest('form');
            var url = form.attr('action');
            // var imageInputElement = document.querySelector("#logo_image");
            // var imageInput = KTImageInput.getInstance(imageInputElement);

            validator.validate().then(function(status) {
                console.log('validated!');
                if (myDropzone.files.length > 1) { status = 'not Valid'; }
                if (status == 'Valid') {
                    // Prevent default button action
                    e.preventDefault();
                    e.stopPropagation();

                    // Disable button to avoid multiple click 
                    formSubmitButton.disabled = true;

                    // Disable Page with overlay to avoid multiple click 
                    $('.overlay').addClass('overlay-block');

                    // Show loading indication
                    formSubmitButton.setAttribute('data-kt-indicator', 'on');

                    var formData = new FormData(form[0]);

                    myDropzone.on('sending', function(data, xhr, formData) {

                        // CSRF Hash
                        // var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                        // var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                        // formData.append(csrfName, csrfHash);

                        // input, select, textarea or :input
                        $("form :input").each(function(key, e) {
                            if ($(this).attr("name") == "logo") { formData.append($(this).attr("name"), $('input[name=logo]')[0].files[0]); }
                            // if($(this).attr("name") == "delivery"){formData.append($(this).attr("name"), $(".delivery").select2("val"));}
                            formData.append($(this).attr("name"), $(this).val());
                        });

                    });
                    myDropzone.on("maxfilesexceeded", function(file) {

                        $('.overlay').removeClass('overlay-block');

                        // this.removeFile(file);
                        this.removeAllFiles();
                        this.addFile(file);
                        Swal.fire({
                            text: "Sorry, You are not allowed to chose more than 1 file!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then(function() {
                            KTUtil.scrollTop();
                        });
                    });
                    myDropzone.on("error", function(file, response) {
                        $('.overlay').removeClass('overlay-block');
                        console.log(file);
                        console.log(response);
                    });

                    // on success
                    myDropzone.on("success", function(file, response) {
                        // get response from successful ajax request
                        console.log(response);
                        // submit the form after images upload


                        // stepperObj.goNext();

                        Swal.fire({
                            text: "Form has been successfully submitted!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                // Hide loading indication
                                // formSubmitButton.removeAttribute('data-kt-indicator');
                                // Enable submit button after loading
                                // formSubmitButton.disabled = false;

                                // Redirect to customers list page
                                setTimeout(function() { location.reload(true); }, 1000);
                            }
                        });
                        //KTUtil.scrollTop();
                        myDropzone.removeAllFiles(true);
                    });
                    myDropzone.processQueue();

                    // axios.post(url, formData,{
                    //     headers: {
                    //       'Content-Type': 'multipart/form-data'
                    //     }
                    // })
                    // .then(function(response) {

                    //      //console.log(response.data);
                    //     // Simulate form submission
                    //     setTimeout(function() {
                    //         // Hide loading indication
                    //         formSubmitButton.removeAttribute('data-kt-indicator');

                    //         // Enable button
                    //         formSubmitButton.disabled = false;

                    //         stepperObj.goNext();
                    //         //KTUtil.scrollTop();
                    //     }, 2000);

                    // })
                    // .catch(function(error) {
                    //     console.log(error);
                    // });



                } else {
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });
    }

    // Init form inputs
    // var initForm = function() {
    // 	// Expiry month. For more info, plase visit the official plugin site: https://select2.org/
    //     $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
    //         // Revalidate the field when an option is chosen
    //         validations[3].revalidateField('card_expiry_month');
    //     });

    // 	// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
    //     $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
    //         // Revalidate the field when an option is chosen
    //         validations[3].revalidateField('card_expiry_year');
    //     });
    // }

    var initValidation = function() {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    biz_type: {
                        validators: {
                            notEmpty: {
                                message: 'Biz Type is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        ));

        // Step 2
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Business Name is required'
                            },
                            remote: {
                                method: 'GET',
                                url: base_url + '/otfadmin/checkbizname',
                                message: 'Business Name exists',
                            }
                        }
                    },
                    'phone': {
                        validators: {
                            notEmpty: {
                                message: 'Business Phone number is required'
                            },
                            integer: {
                                message: 'Business Phone number is not valid'
                            },
                            stringLength: {
                                min: 8,
                                max: 13,
                                message: 'Business Phone Number range is not valid'
                            },
                        }
                    },
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Business Email is required'
                            },
                            emailAddress: {
                                message: 'Email address is not valid'
                            }
                        }
                    },
                    'address': {
                        validators: {
                            notEmpty: {
                                message: 'Business Address is required'
                            }
                        }
                    },
                    'delivery': {
                        validators: {
                            notEmpty: {
                                message: 'City/State is required'
                            }
                        }
                    },
                    'state': {
                        validators: {
                            notEmpty: {
                                message: 'State is required'
                            }
                        }
                    },
                    'city': {
                        validators: {
                            notEmpty: {
                                message: 'City is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        ));

        // Step 3
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    'cover_image_file': {
                        validators: {
                            notEmpty: {
                                message: 'Cover Image is required'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg, image/png',
                                message: 'Cover Image must be Only *.png, *.jpg and *.jpeg'
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        ));

    }


    // Init DropzoneJS --- more info:
    const initDropzone = () => {
        Dropzone.autoDiscover = false;

        myDropzone = new Dropzone("#biz_cover_image", {
            url: base_url + '/otfadmin/add/vendor', // Set the url for your upload script location
            paramName: "cover_image_file", // The name that will be used to transfer the file
            acceptedFiles: '.png, .jpg, .jpeg',
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 20, // 2MB
            autoProcessQueue: false,
            addRemoveLinks: true,
            // accept: function (file, done) {
            //     if (file.name == "wow.jpg") {
            //         done("Naha, you don't.");
            //     } else {
            //         done();
            //     }
            // }
        });
    }


    return {
        // Public Functions
        init: function() {
            // Elements
            modalEl = $("#newVendorModal"); // document.querySelector('#kt_modal_create_app');

            if (!modalEl) {
                return;
            }

            modal = new bootstrap.Modal(modalEl);

            stepper = document.querySelector('#newVendorModal_stepper');
            form = document.querySelector('#newVendorModal_form');
            formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
            formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');

            KTImageInput.createInstances();
            initStepper();
            // initForm();
            initValidation();
            initDropzone();

        }
    };
}();

var KTEditVendor = function(){
    // Elements
    var form;
    var validator;
    var formSubmitButton;
    let edit_id;
}

// On document ready
// KTUtil.onDOMContentLoaded(function () {
jQuery(document).ready(function() {
    KTDatatables.init();
    KTAddVendor.init();
});