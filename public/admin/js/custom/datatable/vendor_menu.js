"use strict";
// Class definition
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
            stateSave: true,
            pageLength: 20,
            lengthMenu: [[20, 50, 100, 200, 500, -1],[20, 50, 100, 200, 500, 'All'],],
            // paging: false,
            // deferRender:    true,
            // scrollY:        500px,  //
            // scrollCollapse: true,
            // scroller:       true
            order: [
                [2, 'desc']
            ],
            columns: [
                { data: 'id' },
                { data: null },
                { data: 'created_at' },
                { data: 'category_name' },
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
                                'info'];
                        var state = states[stateNo];
                        var img = (row['image']) ? 
                                                '<div class="symbol symbol-45px me-5"><img src= "'+base_url+'/img/vendor/'+row['biz_id']+'/menus/'+row['image']+'"></div>' : 
                                                '<div class="symbol symbol-45px me-5  flex-shrink-0">\
                                                    <span class="symbol-label  bg-'+state+' fs-2 fw-bold font-weight-bold">' + data.substring(0, 1) + '</span>\
                                                </div>';
                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    ${img}
                                    <!--end::Avatar-->
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
                    render: function(data, type, row){
                        if (row['addupMenusCounts'] >= 1)
                        {
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
                        }
                        else{return '';}
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
                        return '₦'+parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
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
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
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



        // function format(d) {
        //    var values = [];
        //    var comment_section = ('<div class="slider">' + '<table cellpadding="5" cellspacing="0" border="0" frame="box">' +
        //    '<tr>' +
        //    '<th>Comments</th>' +
        //    '<td>' + d.category_name + '</td>' +
        //    '</tr>' +
        //    '</table>' +
        //    '</div>')
 
        //    // for (i = 0; i < d.addupCate.length; i++) {
        //     _.forEach(d.addupMenus, function(data) {
        //        values.push('<div class="slider">' + '<table cellpadding="5" cellspacing="0" border="0" frame="box" >' +
 
        //        '<tr class="two">' +
        //        '<th style="width: 100px">Contact Type</th>' +
        //        '<th>Name</th>' +
        //        '<th>Email</th>' +
        //        '<th>Title</th>' +
        //        '<th>Phone</th>' +
        //        '<th>Mobile</th>' +
        //        '<th>Fax</th>' +
 
        //        '</tr>' +
        //        '<tr>' +
        //        '<td>' + data.id + '</td>' +
        //        '<td>' + data.name + '</td>' +
        //        '<td>' + data.addup_type + '</td>' +
        //        '<td>' + data.sort + '</td>' +
        //        '<td>' + data.status + '</td>' +
        //        '<td>' + data.image + '</td>' +
        //        '<td>' + data.biz_id + '</td>' +
        //        '</tr>' +
        //        '</table>' +
        //        '</div>')
        //    });
        //    return comment_section + values.join('');
        // };


        var subtableMenu = (e) => {
            // `e` is the original data object for the row
            let value = '<div class="col-md-80">'+
                        '<table class="table table-bordered">';
                    
            _.forEach(e.addupMenus, function(data) {
                let status = 'danger';
                let va = 'Locked';
                if (data.status == 1) {
                    status = 'success';
                    va = 'Active';
                }
                var price = ((data.price == null) || (data.price == 'undefined') || (data.price == '')) ? 0 : parseFloat(data.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                value +=  `
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
        $('#kt_vendor_menu_datatable tbody').on('click', '.submenubutton', function () {
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



// On document ready
// KTUtil.onDOMContentLoaded(function () {
jQuery(document).ready(function() {
    KTDatatables.init();
});