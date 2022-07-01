
"use strict";
// Class definition
var KTDatatables = function() {
    // Shared variables
    var table = '#kt_customer_datatable';
    var dt;
    var filterPayment;
    // Private functions
    var initDatatable = function() {
        dt = $(table).DataTable({
            data: data,
            responsive: true,
            stateSave: true,
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
                [4, 'desc']
            ],
            columns: [
                { data: 'id' },
                {
                    data: null,
                    render: function(data, type, row) {
                        let status = 'danger';
                        let va = 'Locked';
                        if (row['status'] == 1) {
                            status = 'success';
                            va = 'Active';
                        }
                        return `
                            <a href="${base_url+'/otfadmin/customer/'+row['id']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${row['surname'] +' '+ row['firstname']}</a>
                            <span class="badge badge-light-${status} fs-7">${va}</span>
                            `;
                    }
                },
                { data: 'email' },
                { data: 'phone' },
                { data: 'created_at' },
                { data: 'user_orders' },
                { data: null }
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
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
                                <a href="${base_url+'/otfadmin/vendor/'+row['id']}"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}
                                <span class="badge badge-light-${status} fs-7">${va}</span></a>
                                `;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        return `<span class="badge badge-light fw-bolder" > ${moment(data.date).format("Do MMM, YYYY")} </span>`;
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
                            <a href="${base_url+'/otfadmin/customer/'+row['id']}" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30pxbtn-sm me-1">
                                <span class="svg-icon svg-icon-3">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Visible.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.5" d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor"/>
                                            <path opacity="0.5" d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor"/>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30px me-1">
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
        const filterSearch = document.querySelector('[data-kt-customer-table-filter="search"]');
        if (filterSearch !== null && filterSearch !== undefined) {
            filterSearch.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }
    }

    // Public methods
    return {
        init: function() {
            initDatatable();
            KTMenu.createInstances();
            // exportButtons();
            handleSearchDatatable();
        }
    }
}();


var PaymentDatatables = function() {
    // Shared variables
    let table = '#customers_payment';
    let dt;
    // Private functions
    var initDatatable2 = function() {
        dt = $(table).DataTable({
            data: data,
            responsive: false,
            stateSave: true,
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
                [5, 'desc']
            ],
            columns: [
                { data: null },
                { data: 'pi_id' },
                { 
                    data: 'biz_name',
                    render: function(data, type, row) {
                        return `<a href="${base_url+'/'+row['biz_type']+'/'+row['biz_slug']}" target="_blank"  class="text-gray-800 text-hover-primary d-block mb-1 fs-6 ">${data}</a>`;
                    }
                },
                {
                    data: 'order_status',
                    render: function(data, type, row) {
                        let status = 'danger';
                        if (row['order_status'] == 'Canceled') {status = 'danger';}
                        if (row['order_status'] == 'Pending') {status = 'warning';}
                        if (row['order_status'] == 'Processing') {status = 'info';}
                        if (row['order_status'] == 'Dispatched') {status = 'primary';}
                        if (row['order_status'] == 'Delivered') {status = 'success';}
                        return `<span class="badge badge-light-${status} fs-7">${data}</span>`;
                    }
                },
                { data: 'grand_total' },
                { data: 'pi_paid_at' },
                { data: null }
            ],
            columnDefs: [{
                    targets: 0,
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row){
                        return `
                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px position-relative submenubutton" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Order Details">
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
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        let status = 'text-danger';
                        if(row['status'] == 1){ status = 'text-success';}
                        return `<span class="${status}">₦${parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</span>`;
                    }
                },
                {
                    targets: 5,
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
                        <div class="">
                            <a href="${base_url+'/otfadmin/customer/'+row['user_id']+'/'+row['id']}" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30pxbtn-sm me-1">
                                <span class="svg-icon svg-icon-3">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Visible.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.5" d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor"/>
                                            <path opacity="0.5" d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor"/>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </div>
                        `;
                    },
                },
            ]
        });


        var subtableMenu = (e) => {
            // `e` is the original data object for the row
            let value = '<div class="col-md-80">'+
                        '<table class="table table-bordered">';
                    
            _.forEach(e.order_details, function(data) {
                let status = 'danger';
                if (data.order_status == 'Canceled') {status = 'danger';}
                if (data.order_status == 'Pending') {status = 'warning';}
                if (data.order_status == 'Processing') {status = 'info';}
                if (data.order_status == 'Dispatched') {status = 'primary';}
                if (data.order_status == 'Delivered') {status = 'success';}
                var price = ((data.grant_total == '')) ? 0 : parseFloat(data.grant_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                let addup = '';
                _.forEach(JSON.parse(data.addup_menu), function(data1) {
                    if(data1.price){
                    addup += _.upperFirst(data1.name)+': <small class="text-dark fw-bolder fs-7">₦'+ parseFloat(data1.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</small>, ';
                    }
                    else{
                    addup +=_.upperFirst(data1.cate_name)+': <small class="text-dark fw-bolder fs-7">'+data1.name+'</small>, ';
                    }
                });
                

                value +=  `
                    <tr>
                        <td colspan="3">
                            <div class="text-gray-800 fs-7 w-150px">Order No.</div>
                            <div class="text-gray-800 text-hover-primary fs-7 fw-bolder">${_.upperFirst(data.order_code)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Name</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.name)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Qty</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.quantity)}</div>
                        </td>
                        <td>
                            <div class="text-gray-800 fs-7">Cost</div>
                            <div class="text-muted fs-7 fw-bolder">₦${price}</div>
                        </td>
                        <td>
                            <div class="text-gray-800 fs-7">Addup Menus</div>
                            <div class="text-muted fs-7 fw-bolder">${addup}</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7 me-3">Status</div>
                            <div class="text-muted fs-7 fw-bolder"><div class="badge badge-light-${status}">${_.upperFirst(data.order_status)}</div></div>
                        </td>
                        <td></td>
                    </tr>
                `;

            });
            value += '</table></div>';
            return value;
        };

        // Add event listener for opening and closing details
        $('#customers_payment tbody').on('click', '.submenubutton', function () {
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
                row.child( subtableMenu(row.data()) ).show();
                $(this).addClass('active');
                //tr.addClass('isOpen');
            }
        });
    }

    // Public methods
    return {
        init: function() {
            initDatatable2();
            KTMenu.createInstances();
        }
    }
}();



// On document ready
// KTUtil.onDOMContentLoaded(function () {
jQuery(document).ready(function() {
    KTDatatables.init();
    PaymentDatatables.init();
});