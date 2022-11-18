"use strict";
// Class Menu List
var KTDatatables = function() {
    // Shared variables
    var table = '#kt_vendor_menu_datatable';
    var dt;
    var filterPayment;
    // Private functions
    var initDatatable = function() {
        dt = $(table).DataTable({
            data: data,
            responsive: true,
            // stateSave: true,
            pageLength: 20,
            lengthMenu: [
                [20, 50, 100, 200, 500, -1],
                [20, 50, 100, 200, 500, 'All'],
            ],
            // paging: false,
            // deferRender:    true,
            // scrollY:        500px,  //
            // scrollCollapse: true,
            // scroller:       true
            order: [
                [2, 'asc']
            ],
            columns: [
                { data: 'id' },
                { data: null },
                { data: 'created_at' },
                {
                    data: 'category_name',
                    render: function(data, type, row) {
                        let status = 'danger';
                        let va = 'Locked';
                        if (row['catestatus'] == 1) {
                            status = 'success';
                            va = 'Active';
                        }
                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                        <span class="badge badge-light-${status} fs-7">${va}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                            `;
                    }
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        let status = 'danger';
                        let va = 'Locked';
                        if (row['status'] == 1) {
                            status = 'success';
                            va = 'Active';
                        }
                        var stateNo = KTUtil.getRandomInt(0, 7);
                        var states = [
                            'success',
                            'primary',
                            'danger',
                            'success',
                            'warning',
                            'dark',
                            'primary',
                            'info'
                        ];
                        var state = states[stateNo];
                        var img = (row['image']) ?
                            '<div class="symbol symbol-60 symbol-2by3 flex-shrink-0 me-2"><img src= "' + base_url + '/img/vendor/' + row['biz_id'] + '/menus/' + row['image'] + '"></div>' :
                            '<div class="symbol symbol-60 symbol-2by3 flex-shrink-0 me-2">\
                                                    <span class="symbol-label  bg-' + state + ' fs-2 fw-bold font-weight-bold">' + data.substring(0, 1) + '</span>\
                                                </div>';
                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    ${img}
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column ms-2">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                        <span class="badge badge-light-${status} fs-7">${va}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                            `;
                        // <a href="${base_url+'/otfadmin/vendor/'+row['slug']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}</a>
                        // <span class="badge badge-light-${status} fs-7">${va}</span>
                    }
                },
                { data: 'description' },
                { data: 'price' },
                { data: 'sort' },
                { data: null }
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                },
                {
                    targets: 1,
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (row['addupMenusCounts'] >= 1) {
                            return `
                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px position-relative submenubutton" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Addup Menu">
                                    <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-primary">${row['addupMenusCounts']}</span>

                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-on">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>`;
                        } else { return ''; }
                    }
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        return moment(data).format("Do MMM, YYYY");
                    }
                },
                {
                    target: 3,
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
                    targets: 6,
                    render: function(data, type, row) {
                        return '₦' + parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return `
                        <div>
                            <button type="button" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="${base_url+'/otfadmin/vendor/'+row['slug']}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        View
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="d">
                                        Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
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

        var subtableMenu = (e) => {
            // `e` is the original data object for the row
            let value = '<div class="col-md-80">' +
                '<table class="table table-bordered">';

            _.forEach(e.addupMenus, function(data) {
                let status = 'danger';
                let va = 'Locked';
                if (data.status == 1) {
                    status = 'success';
                    va = 'Active';
                }
                var price = ((data.price == null) || (data.price == 'undefined') || (data.price == '')) ? 0 : parseFloat(data.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                value += `
                    <tr>
                        <td colspan="3">
                            <div class="text-gray-800 fs-7">Category Name</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.addup_category_name)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Options</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.name)}</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7">Cost</div>
                            <div class="text-muted fs-7 fw-bolder">₦ ${price}</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7 me-3">Status</div>
                            <div class="text-muted fs-7 fw-bolder"><div class="badge badge-light-${status}">${va}</div></div>
                        </td>
                        <td></td>
                    </tr>
                `;

            });
            value += '</table></div>';
            return value;
        };

        // Add event listener for opening and closing details
        $('#kt_vendor_menu_datatable tbody').on('click', '.submenubutton', function() {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            // console.log(row.data());

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                $(this).removeClass('active');
                //tr.removeClass('isOpen');
            } else {
                // Open this row
                row.child(subtableMenu(row.data())).show();
                $(this).addClass('active');
                //tr.addClass('isOpen');
            }
        });
    }

    var handleSearchDatatable = function() {
        const filterSearch = document.querySelector('[data-kt-vendor-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            dt.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            initDatatable();
            KTMenu.createInstances();
            // exportButtons();
            // handleSearchDatatable();
            // handleFilterDatatable();
            // handleResetForm();
        }
    }
}();


// Class Add Menu
var biz_isRest = '0';
var KTAddMenu = function() {
    // Elements
    var form;
    var validator;
    var formSubmitButton;



    var handleMenu = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

        validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Product Name is required'
                            },
                            remote: {
                                method: 'GET',
                                url: `${base_url}/otfadmin/menu/${biz_id}/checkmenuname`,
                                message: 'Product Name exists',
                            },
                        },
                    },
                    'price': {
                        validators: {
                            notEmpty: {
                                message: 'Price is required'
                            },
                            numeric: {
                                message: 'Price is not valid',
                                // decimalSeparator: '.',
                            },
                        },
                    },
                    'image_file': {
                        validators: {
                            notEmpty: {
                                message: 'Thumbnail Image is required'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                message: 'Thumbnail Image must be Only *.png, *.jpg and *.jpeg'
                            },
                        },
                    },
                    'status': {
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            },
                        },
                    },
                    'category': {
                        validators: {
                            notEmpty: {
                                message: 'Category is required'
                            },
                        },
                    },
                    // 'addupctgy': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Add Up Menu Category Name is required'
                    //         },
                    //     },
                    // },
                    // 'addupname': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Add Up Menu Name is required'
                    //         },
                    //     },
                    // },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                    })
                }
            }
        );

        // Handle form submit
        formSubmitButton.addEventListener('click', function(e) {
            // Prevent button default action
            e.preventDefault();
            // Validate form
            validator.validate().then(function(status) {
                console.log(status);
                if (status == 'Valid') {
                    // Show loading indication
                    // formSubmitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click 
                    // formSubmitButton.disabled = true;
                    // form.submit();
                    // $("#myForm").submit();

                    var formData = new FormData(form);
                    axios.post(form.action, formData)
                        .then(function(response) {

                            console.log(response.data);
                            // Simulate form submission
                            setTimeout(function() {
                                // Simulate form submission
                                formSubmitButton.removeAttribute('data-kt-indicator');

                                // Show popup confirmation 
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                location.reload(true);
                            }, 2000);

                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        });

                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

    }

    if (biz_isRest == "1") {
        // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
        const initFormRepeater = () => {
            $('#addup_menu_repeater').repeater({
                initEmpty: true,

                // defaultValues: {
                //     'text-input': 'foo'
                // },

                repeaters: [{
                    selector: '.addup-menu-repeater',
                    show: function() {
                        $(this).slideDown();
                    },

                    hide: function(deleteElement) {
                        var $this = $(this);
                        Swal.fire({
                            text: "Are you sure you would like to delete this Add-Up Menu Row?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, Delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function(result) {
                            if (result.value) {
                                $this.slideUp(deleteElement);
                            }
                        });
                    }
                }],

                // show: function() {
                //     $(this).slideDown();
                // },

                hide: function(deleteElement) {
                    //$(this).slideUp(deleteElement);
                    var $this = $(this);
                    Swal.fire({
                        text: "Are you sure you would like to delete this Row?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, Delete it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            $this.slideUp(deleteElement);
                        }
                    });
                }
            });
        }
    }
    return {
        // Public Functions
        init: function() {
            form = document.querySelector('#newMenu_form');
            formSubmitButton = document.querySelector('#menu_submit');
            KTImageInput.createInstances();
            handleMenu();
            if (biz_isRest == "1") {
                initFormRepeater();
            }

        }
    }
}();

// Menu Category List
var biz_type ;
var KTMenuCategoryDatatables = function() {
    // Shared variables
    var table = '#kt_cate_menu';
    var dt;
    // Private functions
    var initDatatable = function() {
        if (biz_type != 'restaurant') {
            dt = $(table).DataTable({
                data: data,
                responsive: true,
                // stateSave: true,
                pageLength: 20,
                lengthMenu: [
                    [20, 50, 100, 200, 500, -1],
                    [20, 50, 100, 200, 500, 'All'],
                ],
                // paging: false,
                // deferRender:    true,
                // scrollY:        500px,  //
                // scrollCollapse: true,
                // scroller:       true
                order: [
                    [4, 'asc']
                ],
                columns: [
                    { data: 'id' },
                    { data: null },
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
                                    <div class="d-flex align-items-center">
                                        <!--begin::Name-->
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                            <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                            <span class="badge badge-light-${status} fs-7">${va}</span>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                `;
                            // <a href="${base_url+'/otfadmin/vendor/'+row['slug']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}</a>
                            // <span class="badge badge-light-${status} fs-7">${va}</span>
                        }
                    },
                    { data: 'created_at' },
                    { data: 'sort' },
                    { data: 'menucount' },
                    { data: null }
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        searchable: false,
                    },
                    {
                        targets: 1,
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row['childrencount'] >= 1) {
                                return `
                                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px position-relative subcategotybutton" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Sub Categories">
                                        <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-primary">${row['childrencount']}</span>
    
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                        <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                        <span class="svg-icon svg-icon-3 m-0 toggle-on">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>`;
                            } else { return ''; }
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
                                    <div class="d-flex align-items-center">
                                        <!--begin::Name-->
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                            <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                            <span class="badge badge-light-${status} fs-7">${va}</span>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                    `;
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {
                            return moment(data).format("Do MMM, YYYY");
                        }
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function(data, type, row) {
                            if (row['childrencount'] >= 1) {
                                return `
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Add Sub-Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="addsubctgy" data-innit="${row['biz_id']}" data-name="${row['name']}" data-ctgyinnit="${row['id']}">
                                    <span class="svg-icon svg-icon-primary svg-icon-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Files/Folder-plus.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                            // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            //     <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 L15,13 C15.5522847,13 16,13.4477153 16,14 C16,14.5522847 15.5522847,15 15,15 L13,15 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,15 L9,15 C8.44771525,15 8,14.5522847 8,14 C8,13.4477153 8.44771525,13 9,13 L11,13 Z" fill="#000000"/>
                                            // </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Edit Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="editctgy" data-innit="${row['biz_id']}" data-name="${row['name']}" data-ctgyinnit="${row['id']}">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            `;
                            } else {
                                return `
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Add Sub-Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="addsubctgy" data-innit="${row['biz_id']}" data-name="${row['name']}" data-ctgyinnit="${row['id']}">
                                    <span class="svg-icon svg-icon-primary svg-icon-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Files/Folder-plus.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                            // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            //     <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 L15,13 C15.5522847,13 16,13.4477153 16,14 C16,14.5522847 15.5522847,15 15,15 L13,15 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,15 L9,15 C8.44771525,15 8,14.5522847 8,14 C8,13.4477153 8.44771525,13 9,13 L11,13 Z" fill="#000000"/>
                                            // </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Edit Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="editctgy" data-innit="${row['biz_id']}" data-name="${row['name']}" data-ctgyinnit="${row['id']}">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </a>
                                <button type="button" class="btn btn-icon btn-flex btn-active-light-primary deleteCategory w-30px h-30px me-1" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" data-innit="${row.id}" data-name="${row['name']}" title="Delete Category">
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
                            }
                        },
                    },
                ]
            });
        } else {
            dt = $(table).DataTable({
                data: data,
                responsive: true,
                // stateSave: true,
                pageLength: 20,
                lengthMenu: [
                    [20, 50, 100, 200, 500, -1],
                    [20, 50, 100, 200, 500, 'All'],
                ],
                // paging: false,
                // deferRender:    true,
                // scrollY:        500px,  //
                // scrollCollapse: true,
                // scroller:       true
                order: [
                    [4, 'asc']
                ],
                columns: [
                    { data: 'id' },
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
                                <div class="d-flex align-items-center">
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                        <span class="badge badge-light-${status} fs-7">${va}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                            `;
                            // <a href="${base_url+'/otfadmin/vendor/'+row['slug']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}</a>
                            // <span class="badge badge-light-${status} fs-7">${va}</span>
                        }
                    },
                    { data: 'created_at' },
                    { data: 'sort' },
                    { data: 'menucount' },
                    { data: null }
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        searchable: false,
                    },
                    {
                        target: 1,
                        render: function(data, type, row) {
                            let status = 'danger';
                            let va = 'Locked';
                            if (row['status'] == 1) {
                                status = 'success';
                                va = 'Active';
                            }
                            return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">
                                        <span class="badge badge-light-${status} fs-7">${va}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                `;
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, row) {
                            return moment(data).format("Do MMM, YYYY");
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
                                        <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Edit Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="editctgy" data-innit="${row['biz_id']}" data-name="${row['name']}" data-ctgyinnit="${row['id']}">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-flex btn-active-light-primary deleteCategory w-30px h-30px me-1" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" data-innit="${row.id}" data-name="${row['name']}" title="Delete Category">
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
        }
        dt.on('order.dt search.dt', function() {
            let i = 1;

            dt.cells(null, 0, { search: 'applied', order: 'applied' }).every(function(cell) {
                this.data(i++);
            });
        }).draw();

        var subtableCategory = (e) => {
            // `e` is the original data object for the row
            let value = '<div class="col-md-80">' +
                '<table class="table table-bordered">';

            _.forEach(e.children, function(data) {
                let status = 'danger';
                let va = 'Locked';
                if (data.status == 1) {
                    status = 'success';
                    va = 'Active';
                }
                value += `
                    <tr>
                        <td colspan="3">
                            <div class="text-gray-800 fs-7">Category Name</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.name)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Sort</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.sort)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Menus Count</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.menucount)}</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7 me-3">Status</div>
                            <div class="text-muted fs-7 fw-bolder"><div class="badge badge-light-${status}">${va}</div></div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7">Action</div>
                            <div class="text-muted fs-7 fw-bolder">
                                <div class="d-flex justify-content-end flex-shrink-0">
                                    <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1" title="Edit Category" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="editsubctgy" data-innit="${e.biz_id}" data-name="${e.name}" data-ctgyinnit="${data.id}" data-ctgyname="${data.name}">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-flex btn-active-light-primary deleteCategory w-30px h-30px me-1" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" data-innit="${data.id}" data-name="${data.name}" title="Delete Category" >
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
                            </div>
                        </td>
                        <td></td>
                    </tr>
                `;

            });
            value += '</table></div>';
            return value;
        };

        // Add event listener for opening and closing details
        $('#kt_cate_menu tbody').on('click', '.subcategotybutton', function() {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            console.log(row.data());

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                $(this).removeClass('active');
                //tr.removeClass('isOpen');
            } else {
                // Open this row
                row.child(subtableCategory(row.data())).show();
                $(this).addClass('active');
                //tr.addClass('isOpen');
            }
        });
    }

    var handleSearchDatatable = function() {
        const filterSearch = document.querySelector('[data-kt-catemenu-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            dt.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function() {
            initDatatable();
            KTMenu.createInstances();
            // exportButtons();
            handleSearchDatatable();
            // handleFilterDatatable();
            // handleResetForm();
        }
    }
}();


// Class definition for Add Adress 
var ModalMenuCtgy = function(e) {

    let bizid;
    let submitButton;
    let cancelButton;
    let closeButton;
    let form;
    let modalEl;
    let modal;
    let validator;

    var formNewCtgy = function(e) {

        modalEl.on('hidden.bs.modal', function(event) {
            validator.resetForm(true);
        })

        modalEl.on('show.bs.modal', function(event) {

            var button = event.relatedTarget
                // Extract info from data-bs-* attributes
            bizid = button.getAttribute('data-innit');
            let modaltype = button.getAttribute('data-modaltype');

            if (modaltype == 'addctgy') {
                $('.ctgyheader').text('Add Menu Category');
                $('.ctgybody').html(null);
                $('input[name=name]').val(null);
                form.setAttribute(`action`, `${base_url}/otfadmin/add/menu-category/${bizid}`);
            }
            if (modaltype == 'addsubctgy') {
                $('.ctgyheader').text('Add Menu Category');
                $('.ctgybody').html(`
                            <div class="d-flex flex-column mb-7">
                                <label class="fs-6 fw-bold mb-2 required"> Parent Category Name</label>
                                <input class="form-control form-control-solid" disabled value="${button.getAttribute('data-name')}">
                            </div>
                            `);
                $('input[name=name]').val(null);
                form.setAttribute(`action`, `${base_url}/otfadmin/add/menu-category-child/${bizid}/${button.getAttribute('data-ctgyinnit')}`);
            }
            if (modaltype == 'editctgy') {
                $('.ctgyheader').text('Edit Menu Category');
                $('.ctgybody').html(``);
                $('input[name=name]').val(button.getAttribute('data-name'));
                form.setAttribute(`action`, `${base_url}/otfadmin/edit/menu-category/${button.getAttribute('data-ctgyinnit')}`);
            }
            if (modaltype == 'editsubctgy') {
                $('.ctgyheader').text('Edit Child Menu Category');
                $('.ctgybody').html(`
                            <div class="d-flex flex-column mb-7">
                                <label class="fs-6 fw-bold mb-2 required"> Parent Category Name</label>
                                <input class="form-control form-control-solid" disabled value="${button.getAttribute('data-name')}">
                            </div>
                            `);
                $('input[name=name]').val(button.getAttribute('data-ctgyname'));
                form.setAttribute(`action`, `${base_url}/otfadmin/edit/menu-category/${button.getAttribute('data-ctgyinnit')}`);
            }


        });
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Category Name is required'
                            },
                            remote: {
                                method: 'GET',
                                url: `${base_url}/otfadmin/menu/checkmenuctgyname`,
                                data: function() {
                                    return {
                                        id: bizid,
                                    };
                                },
                                message: 'Category Name exists',
                            },
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }
        );

        // Action buttons
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            validator.validate().then(function(status) {
                if (status == 'Valid') {

                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    var formData = new FormData(form);
                    // input, select, textarea or :input
                    // $("#modal_addres_form :input").each(function(key, e) {
                    //     formData.append($(this).attr("name"), $(this).val());
                    // });

                    axios.post(form.action, formData)
                        .then(function(response) {

                            //console.log(response.data);
                            // Simulate form submission

                            setTimeout(function() {
                                submitButton.removeAttribute('data-kt-indicator');

                                // Show popup confirmation 
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
                                        // remove loading indication
                                        submitButton.removeAttribute('data-kt-indicator');
                                        modal.hide();
                                    }
                                });
                                location.reload(true);
                            }, 2000);

                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            // remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');
                        });


                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please fill the form Correctly.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        cancelButton.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                if (result.value) {
                    submitButton.removeAttribute('data-kt-indicator'); // remove loading indication
                    form.reset(); // Reset form 
                    modal.hide(); // Hide modal   
                }
                // else if (result.dismiss === 'cancel') {
                //     Swal.fire({
                //         text: "Your form has not been cancelled!.",
                //         icon: "error",
                //         buttonsStyling: false,
                //         confirmButtonText: "Ok, got it!",
                //         customClass: {
                //             confirmButton: "btn btn-primary",
                //         }
                //     });
                // }
            });
        });

        closeButton.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                if (result.value) {
                    submitButton.removeAttribute('data-kt-indicator'); // remove loading indication
                    form.reset(); // Reset form 
                    modal.hide(); // Hide modal             
                }
            });
        });

        // $('.deleteCategory').on('click', function(e) {
        $(document).on('click', '.deleteCategory', function(e) {
            e.preventDefault();
            var id = $(this).data('innit');
            Swal.fire({
                text: `Are you sure you want to delete this Category ${$(this).data('name')}?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                // console.log(result);
                if (result.dismiss === 'cancel') {} else if (result.value) {

                    axios.delete(base_url + '/otfadmin/delete/menu-category/' + id)
                        .then(function(response) {
                            setTimeout(function() {
                                Swal.fire({
                                    text: `Category ${$(this).data('name')} has not been Deleted!.`,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                                location.reload(true);
                            }, 2000);
                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        });
                }
            });
        });
    }

    return {
        // Public Functions
        init: function() {
            // Elements
            modalEl = $("#newCategoryModal"); // document.querySelector('#newCategoryModal');
            if (!modalEl) { return; }
            modal = new bootstrap.Modal(modalEl);

            form = document.querySelector('#modal_ctgy_form');
            submitButton = form.querySelector('#modal_ctgy_submit');
            cancelButton = form.querySelector('#modal_ctgy_cancel');
            closeButton = document.querySelector('#modal_ctgy_close');

            formNewCtgy();

        }
    }
}();

// On document ready
// KTUtil.onDOMContentLoaded(function () {
jQuery(document).ready(function() {
    // Boostrap & 3rd-party components initialization
    KTApp.init();
    if (typeof data !== "undefined") {
        KTDatatables.init();

        KTMenuCategoryDatatables.init();
        ModalMenuCtgy.init();
    }

    const checkform = document.querySelector('#newMenu_form');
    if (typeof checkform !== 'undefined' && checkform != null) {
        KTAddMenu.init()
    }
});