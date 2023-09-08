@extends('admin.master')
@section('header')
    <link href="{{asset('adminAssets/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('breadcrumb')
    <!--begin::Separator-->
    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
    <!--end::Separator-->
    <!--begin::Description-->
    <small class="text-muted fs-7 fw-bold my-1 ms-1">Message of Contacts</small>
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
                                <span class="fw-bolder text-dark fs-3">All Message</span>
                                <span class="text-gray-400 mt-2 fw-bold fs-6">you can search and find your contact</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <table id="kt_datatable_example_5" class="table table-rounded table-flush">
                                    <thead>
                                    <tr class="fw-bold fs-7 text-danger border-bottom border-gray-200 py-4">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr id="table_row_{{ $contact->id }}" class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->title }}</td>
                                            <td>
                                                <button class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#create_category_modal" >message</button>
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

    </script>
@endsection
