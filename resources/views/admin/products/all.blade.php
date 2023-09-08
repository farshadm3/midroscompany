@extends('admin.master')
@section('header')
    <link href="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('breadcrumb')
    <!--begin::Separator-->
    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
    <!--end::Separator-->
    <!--begin::Description-->
    <small class="text-muted fs-7 fw-bold my-1 ms-1">Products</small>
    <!--end::Description-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-12">
                <div class="col-xxl-12">
                    <div class="card card-xxl-stretch">
                        <div class="card-header align-items-center border-0 mt-3">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder text-dark fs-3">All Products</span>
                                <span class="text-gray-400 mt-2 fw-bold fs-6">you can search and find your product</span>
                            </h3>
                            <a href="{{route('products.create')}}" class="btn btn-bg-light btn-active-color-primary">
                                Create New
                            </a>

                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <table id="kt_datatable_example_5" class="table table-rounded table-flush">
                                    <thead>
                                    <tr class="fw-bold fs-7 text-danger border-bottom border-gray-200 py-4">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>E.Price</th>
                                        <th>Image1</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr id="table_row_{{ $product->id }}" class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->e_price }}</td>
                                            <td><img  class="image-input image-input-circle image-input-wrapper w-50px h-50px" src="{{$product->image1}}"/></td>
                                            <td>
                                                <button class="btn btn-icon btn-warning">
                                                    <a href="{{ route('products.edit', [$product]) }}">
                                                        <i class="fas fa-pencil-alt fs-2 me-1"></i>
                                                    </a>
                                                </button>
                                                <button onclick="deleteProduct({{ $product->id }})" class="btn btn-icon btn-danger">
                                                    <i class="fas fa-trash fs-2 me-1"></i>
                                                </button>
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
@endsection
@section('js')
    @include('sweetalert::alert')
    <script src="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        let t;
        $(document).ready(function() {
            t = $("#kt_datatable_example_5").DataTable({
                responsive: true,
                "columnDefs": [
                    {"className": "text-center", "targets": "_all"}
                ]
                // "language": {
                //     "lengthMenu": "Show _MENU_",
                // },
                // "dom":
                //     "<'row'" +
                //     "<'col-sm-12 d-flex align-items-center justify-conten-start'l>" +
                //     "<'col-sm-12 d-flex align-items-center justify-content-end'f>" +
                //     ">" +
                //
                //     "<'table-responsive'tr>" +
                //
                //     "<'row'" +
                //     "<'col-sm-12 col-md-12 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                //     "<'col-sm-12 col-md-12 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                //     ">"
            });
        })

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

        function deleteProduct(ID) {
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
                        url: "products/" + ID,
                        success: function (data) {
                            $('#table_row_' + ID).toggle('slow', function () {
                                t.row('#table_row_' + ID).remove().draw(false)
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


    </script>
@endsection
