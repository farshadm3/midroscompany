@extends('admin.master')
@section('header')
    <link href="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('adminAssets/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('adminAssets/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script>

        let t;

        $(document).ready(function() {
            t = $("#category_table").DataTable({
                responsive: true,
                "columnDefs": [
                    {"className": "text-center", "targets": "_all"}
                ]
            });
        })

        let inputId = '';
        let imageUrl = '';

        $('#image_btn').on('click', (event) => {
            event.preventDefault();
            inputId = "image";
            imageUrl = "image_url";
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        })

        $('#edit_image_btn').on('click', (event) => {
            event.preventDefault();
            inputId = "edit_image";
            imageUrl = "edit_image_url";
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        })

        // set file link
        function fmSetLink($url) {
            $(`#${imageUrl}`).val($url);
            $(`#${inputId}`).css('background-image', `url('${$url}')`)
        }

        function createCategory(PARENT, TABLE_ID = 'category_table') {
            // $('.page-loader-wrapper').show();
            const submitButton = document.getElementById('btnCategory');
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;
            // $('#btnCategory').text('Save');
            // $('#createCategoryTitle').html('create category');
            let data = getModalValues(PARENT);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: "POST",
                url: "{{ route('categories.store') }}",
                data: JSON.stringify(data),
                success: function ({category}) {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                    let trCat = $(`#${TABLE_ID}`).DataTable().row.add([
                        `<td>${category.id}</td>`,
                        `<td><span class="badge badge-changelog badge-light-info bg-hover-info text-hover-white px-2 cursor-pointer" onclick="showSubCategory(${category.parent_id}, ${category.id})">${category.name}</span></td>`,
                        `
                         <td>
                            <img  class="image-input image-input-circle image-input-wrapper w-50px h-50px" src="${category.image}"/>
                         </td>
                         `,
                        `
                         <td>
                            <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                <input class="form-check-input h-25px w-45px" type="checkbox" id="status${category.id}" onchange="changeCategoryStatus(${category.id})" ${(category.status) ? "checked" : ""}>
                            </div>
                         </td>
                         `,
                        `<td>${category.created_at}</td>`,
                        `
                         <td>
                            <button class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#create_category_modal" onclick="deleteModalVal();setAttrToCatBtn(${category.id}, 'CategoryTable${category.id}')"><i class="fas fa-plus-square fs-2 me-1"></i></button>
                            <button class="btn btn-icon btn-warning" onclick="showEditCategory(${category.id})"><i class="fas fa-pencil-alt fs-2 me-1"></i></button>
                            <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-trash fs-2 me-1"></i></a>
                         </td>
                         `
                    ]).draw(false).node();
                    $(trCat).attr('id', `table_row_${category.id}`);
                    $(trCat).addClass('py-5 fw-bold  border-bottom border-gray-300 fs-6');
                    $('#create_category_modal').modal('toggle');
                    Swal.fire({
                        text: "Your operation done successfully",
                        icon: "success",
                        timer: 2000,
                        timerProgressBar: true,
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    let time = 0;
                    for (error in jqXhr.responseJSON.errors) {
                        showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                    }
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        }

        function showSubCategory(PARENT, ID) {
            let modal = $(`#subModal${ID}`);
            if (! modal.length === 0) {
                modal.remove();
            }
            $('#subModal').append(
                `
                    <div class="modal fade" tabindex="-1" id="subModal${ID}">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="subModal${ID}Label">Sub Categories</h5>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="black"/>
                                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="black"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="modal-body" id="subModal${ID}Content">

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-light-danger" onclick="$('.modal').modal('hide')" data-toggle="modal" >
                                        Close All Modals
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            )

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            // $('.page-loader-wrapper').show();
            $.ajax({
                type: 'GET',
                url: '/admin/category/getSub/' + ID,
                success: function ({data}) {
                    $(`#subModal${ID}Content`).html(
                        `
                            <table id="CategoryTable${ID}" class="table table-bordered table-hover" style="width: 100%">
                                <thead>
                                    <tr class="fw-bold fs-7 text-danger border-bottom border-gray-200 py-4">
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Name(Click)</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-${ID}">

                                </tbody>
                            </table>
                        `
                    );
                    let table_cat = $(`#CategoryTable${ID}`).DataTable({
                        responsive: true,
                        "columnDefs": [
                            {"className": "text-center", "targets": "_all"}
                        ]
                    });
                    if (!jQuery.isEmptyObject(data)) {
                        $.each(data, function (key, val) {

                            let trCat = table_cat.row.add([
                                `<td>${val.id}</td>`,
                                `<td><span class="badge badge-changelog badge-light-info bg-hover-info text-hover-white px-2 cursor-pointer" onclick="showSubCategory(${val.parent_id}, ${val.id})">${val.name}</span></td>`,
                                `
                                <td>
                                    <img  class="image-input image-input-circle image-input-wrapper w-50px h-50px" src="${val.image}"/>
                                </td>
                                `,
                                `
                                <td>
                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                        <input class="form-check-input h-25px w-45px" type="checkbox" id="status${val.id}" onchange="changeCategoryStatus(${val.id})" ${(val.status) ? "checked" : ""}>
                                    </div>
                                </td>
                                `,
                                `<td>${val.created_at}</td>`,
                                `
                                <td>
                                    <button class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#create_category_modal" onclick="deleteModalVal();setAttrToCatBtn(${val.id}, 'CategoryTable${val.id}')"><i class="fas fa-plus-square fs-2 me-1"></i></button>
                                    <button class="btn btn-icon btn-warning" onclick="showEditCategory(${val.id}, 'CategoryTable${ID}')"><i class="fas fa-pencil-alt fs-2 me-1"></i></button>
                                    <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-trash fs-2 me-1"></i></a>
                                </td>
                                `
                            ]).draw(false).node().id = `table_row_${val.id}`;
                            $(trCat).addClass('py-5 fw-bold  border-bottom border-gray-300 fs-6')
                        })
                    }

                    $(`#subModal${ID}`).modal('toggle')

                },
                error: function (jqXhr, textStatus, errorMessage) {
                    let time = 0;
                    for (error in jqXhr.responseJSON.errors) {
                        showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                    }
                }
            });
        }

        function deleteModalVal(PREVENT = '') {
            $(`#${PREVENT}name`).val("");
            $(`#${PREVENT}image`).css('background-image', `url('{{ env('APP_URL') }}/adminAssets/assets/camera.jpg')`);
            $(`#${PREVENT}image_url`).val("")
            // $('#btnCategory').text('save');
            // $('#createCategoryTitle').html('create category');
        }

        function showEditCategory(ID, TABLE_ID = 'category_table') {
            // $('.page-loader-wrapper').show();
            deleteModalVal('edit_');
            $('#edit_category_modal').modal('toggle');
            $('#edit_modal_body').addClass('overlay overlay-block');
            $('#edit_overlay').removeClass('d-none')
            $('#btnEditCategory').attr('onclick', `editCategory("${ID}", "${TABLE_ID}")`)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: "GET",
                url: "categories/" + ID + "/edit",
                success: function ({category}) {
                    $('#edit_modal_body').removeClass('overlay overlay-block');
                    $('#edit_overlay').addClass('d-none')
                    $('#edit_name').val(category.name)
                    $(`#edit_image_url`).val(category.image);
                    if (category.image)
                        $(`#edit_image`).css('background-image', `url('${category.image}')`);
                    // $('#editCategoryTitle').html(`Edit ${category.name}`);
                    // $('.page-loader-wrapper').hide();
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    let time = 0;
                    for (error in jqXhr.responseJSON.errors) {
                        showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                    }
                    $('#edit_modal_body').removeClass('overlay overlay-block');
                    $('#edit_overlay').addClass('d-none')
                }
            });
        }

        function editCategory(ID, TABLE_ID = 'category_table') {
            // $('.page-loader-wrapper').show()
            let data = getModalValues(ID, 'edit_');
            const submitButton = document.getElementById('btnEditCategory');
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: "PATCH",
                url: "categories/" + ID,
                data: JSON.stringify(data),
                success: function ({category}) {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                    $(`#${TABLE_ID}`).DataTable().row(`#table_row_${ID}`).data([
                        `<td>${category.id}</td>`,
                        `<td><span class="badge badge-changelog badge-light-info bg-hover-info text-hover-white px-2 cursor-pointer" onclick="showSubCategory(${category.parent_id}, ${category.id})">${category.name}</span></td>`,
                        `
                         <td>
                            <img  class="image-input image-input-circle image-input-wrapper w-50px h-50px" src="${category.image}"/>
                         </td>
                         `,
                        `
                         <td>
                            <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                <input class="form-check-input h-25px w-45px" type="checkbox" id="status${category.id}" onchange="changeCategoryStatus(${category.id})" ${(category.status) ? "checked" : ""}>
                            </div>
                         </td>
                         `,
                        `<td>${category.created_at}</td>`,
                        `
                         <td>
                            <button class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#create_category_modal" onclick="deleteModalVal();setAttrToCatBtn(${category.id}, 'CategoryTable${category.id}')"><i class="fas fa-plus-square fs-2 me-1"></i></button>
                            <button class="btn btn-icon btn-warning" onclick="showEditCategory(${category.id})"><i class="fas fa-pencil-alt fs-2 me-1"></i></button>
                            <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-trash fs-2 me-1"></i></a>
                         </td>
                         `
                    ]).draw();
                    $('#edit_category_modal').modal('toggle');
                    deleteModalVal('edit_');
                    $('.page-loader-wrapper').hide()
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    let time = 0;
                    for (error in jqXhr.responseJSON.errors) {
                        showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                    }
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                }
            });
        }

        function showNotification(TIME = "500", MESSAGE = "Empty...", STATUS = "success") {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": TIME,
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            switch (STATUS) {
                case "success":
                    toastr.success(MESSAGE);
                    break;
                case "error":
                    toastr.error(MESSAGE);
                    break;
                case "warning":
                    toastr.warning(MESSAGE);
                    break;
                default:
                    toastr.info(MESSAGE);
            }
        }

        function deleteCategory(ID, TABLE_ID = 'category_table') {
            Swal.fire({
                text: "Are you sure you want to delete this field?",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    $.ajax({
                        type: "DELETE",
                        url: "categories/" + ID,
                        success: function (data) {
                            $('#table_row_' + ID).toggle('slow', function () {
                                $(`#${TABLE_ID}`).DataTable().row('#table_row_' + ID).remove().draw(false)
                            });
                            Swal.fire("Deleted!", "Your category has been deleted.", "success");
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                            let time = 0;
                            for (error in jqXhr.responseJSON.errors) {
                                showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                            }
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire("Canceled", "Your category is safe.", "error");
                }
            })
        }

        function getModalValues(PARENT, PREVENT = '') {

            let data = {
                name: $(`#${PREVENT}name`).val(),
                image: $(`#${PREVENT}image_url`).val(),
                parent_id: PARENT
            }
            return data;
        }

        function setAttrToCatBtn(CAT_ID, TABLE_ID = "category_table") {
            $('#btnCategory').attr('onclick', `createCategory("${CAT_ID}", "${TABLE_ID}")`)
        }

        function changeCategoryStatus(ID) {
            let json_data = {
                'status': $('#status' + ID).prop('checked')
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: "PATCH",
                url: "categories/status/" + ID,
                data: JSON.stringify(json_data),
                success: function (data) {
                    if (data) {
                        let status = (json_data.status) ? 'active' : 'not active';
                        showNotification('500', "Your category status changed to " + status, 'success');
                    } else {
                        $('#status' + ID).prop('checked', json_data.status);
                        showNotification('500', "There is some problem please try again later", 'error')
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    let time = 0;
                    for (error in jqXhr.responseJSON.errors) {
                        showNotification(time + 500, jqXhr.responseJSON.errors[error][0], 'error');
                    }
                }
            });
        }

        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
    </script>
@endsection
@section('breadcrumb')
    <!--begin::Separator-->
    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
    <!--end::Separator-->
    <!--begin::Description-->
    <small class="text-muted fs-7 fw-bold my-1 ms-1">Category</small>
    <!--end::Description-->
@endsection
@section('content')
    {{-- <div class="wrapper d-flex flex-column flex-row-fluid pt-0" id="kt_wrapper"> --}}
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-12">
                <!--begin::Col-->
                <div class="col-xxl-12">
                    <!--begin::List Widget 9-->
                    <div class="card card-xxl-stretch">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0 mt-3">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder text-dark fs-3">All Categories</span>
                            </h3>
                            <button type="button" class="btn btn-bg-light btn-active-color-primary"
                                    data-bs-toggle="modal" data-bs-target="#create_category_modal"
                                    onclick="setAttrToCatBtn(0);deleteModalVal()">Create New
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <table id="category_table" class="table table-rounded table-flush">
                                    <thead>
                                    <tr class="fw-bold fs-7 text-danger border-bottom border-gray-200 py-4">
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Name(Click)</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr id="table_row_{{ $category->id }}" class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                                            <td>{{$category->id}}</td>
                                            <td><span class="badge badge-changelog badge-light-info bg-hover-info text-hover-white px-2 cursor-pointer" onclick="showSubCategory({{ $category->parent_id }}, {{ $category->id }})">{{$category->name}}</span></td>
                                            <td>
                                                <img  class="image-input image-input-circle image-input-wrapper w-50px h-50px" src="{{$category->image}}"/>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                    <input class="form-check-input h-25px w-45px" type="checkbox" id="status{{ $category->id }}" onchange="event.preventDefault();changeCategoryStatus({{ $category->id }})" {{ ($category->status) ? "checked" : "" }} />
                                                </div>
                                            </td>
                                            <td>{{$category->created_at}}</td>
                                            <td>

                                                <button class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#create_category_modal" onclick="deleteModalVal();setAttrToCatBtn({{ $category->id }}, 'CategoryTable{{ $category->id }}')"><i class="fas fa-plus-square fs-2 me-1"></i></button>
                                                <button class="btn btn-icon btn-warning" onclick="showEditCategory({{ $category->id }})"><i class="fas fa-pencil-alt fs-2 me-1"></i></button>

                                                <button class="btn btn-icon btn-danger" onclick="deleteCategory({{ $category->id }})"><i class="fas fa-trash fs-2 me-1"></i></button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- model --}}
    <div class="modal fade" tabindex="-1" id="create_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryTitle">Create Category</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="black"/>
                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <div class="row mb-10">
                        <div class="col-lg-12">
                            <label for="exampleFormControlInput1" class="required form-label">name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter the name"/>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-12">
                            <div class="image-input image-input-circle" data-kt-image-input="true">
                                <div
                                    id="image"
                                    class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{asset('adminAssets/assets/camera.jpg')}})"></div>
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change avatar"
                                    id="image_btn">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="hidden" id="image_url" />
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="avatar_remove"/>
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnCategory" onclick="createCategory(0)">
                        <span class="indicator-label">
                            Save
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit_category_modal" role="dialog" aria-labelledby="editCategoryTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryTitle">Edit Category</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="black"/>
                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <div id="edit_modal_body" class="modal-body">
                    <!--begin::Overlay Layer-->
                    <div id="edit_overlay" class="overlay-layer bg-dark bg-opacity-5 d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <!--end::Overlay Layer-->
                    <div class="row mb-10">
                        <div class="col-lg-12">
                            <label for="edit_name" class="required form-label">name</label>
                            <input type="text" name="edit_name" id="edit_name" class="form-control form-control-solid" placeholder="Enter the name"/>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-12">
                            <div class="image-input image-input-circle" data-kt-image-input="true">
                                <div
                                    id="edit_image"
                                    class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{asset('adminAssets/assets/camera.jpg')}})"></div>
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change avatar"
                                    id="edit_image_btn">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="hidden" id="edit_image_url" />
                                    <input type="file" name="edit_image" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="edit_avatar_remove"/>
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnEditCategory">
                        <span class="indicator-label">
                            Edit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="subModal"></div>
@endsection
