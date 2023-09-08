@extends('admin.master')
@section('js')
    <script src="{{asset('adminAssets/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script>
        // let inputId = '';

        $(document).ready(function () {
            $('#meta_keywords').select2({ tags: true });
            let regulationsSection = $('#album_section');
            let id = regulationsSection.children().length;

            for (let i = 0; i <= id; i++) {
                document.getElementById(`button-image-${i}`).addEventListener('click', (event) => {
                    event.preventDefault();
                    inputId = `image_label-${i}`;
                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            }
        })

        let inputId = '';


        $('#image_btn1').on('click', (event) => {
            event.preventDefault();
            inputId = "image_label1";
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        })
        $('#image_btn2').on('click', (event) => {
            event.preventDefault();
            inputId = "image_label2";
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        })
        $('#image_btn3').on('click', (event) => {
            event.preventDefault();
            inputId = "image_label3";
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        })

        // set file link
        function fmSetLink($url) {
            document.getElementById(inputId).value = $url;
        }


        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
@section('breadcrumb')
    <!--begin::Separator-->
    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
    <!--end::Separator-->
    <!--begin::Description-->
    <small class="text-muted fs-7 fw-bold my-1 ms-1">Products</small>
    <!--end::Description-->
    <!--begin::Separator-->
    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
    <!--end::Separator-->
    <!--begin::Description-->
    <small class="text-muted fs-7 fw-bold my-1 ms-1">Edit</small>
    <!--end::Description-->
@endsection
@section('content')
    {{-- <div class="wrapper d-flex flex-column flex-row-fluid pt-0" id="kt_wrapper"> --}}
    <div id="kt_content_container" class="container-xxl">
        <div class="row gy-5 g-xl-10">
            <div class="card mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="py-5">
                        <h1 class="anchor fw-bolder mb-5" id="custom-form-control">Edit Product</h1>
                        @if ($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-dismissible bg-light-warning border border-warning d-flex flex-column flex-sm-row p-5 mb-10">
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                                </svg>
                                            </span>
                                    <div class="d-flex align-items-center pe-0 pe-sm-10">
                                        <div class="fw-bold">
                                            <div class="fs-6 text-gray-700">{{ $error }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                        <i class="bi bi-x fs-1 text-warning"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <form action="{{ route('products.update' , $product->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="rounded border p-10">
                                <div class="row mb-10">
                                    <div class="col-lg-6">
                                        <label for="title" class="required form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                                               placeholder="Enter the title" value="{{ old('title', $product->title) }}"/>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-lg-6">
                                        <label for="price" class="required form-label">Title</label>
                                        <input type="text" name="price" id="price" class="form-control form-control-solid"
                                               placeholder="Enter the price" value="{{ old('price', $product->price) }}"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="e_price" class="required form-label">Price</label>
                                        <input type="text" name="e_price" id="e_price" class="form-control form-control-solid"
                                               placeholder="price input" value="{{ old('e_price', $product->e_price) }}"/>
                                    </div>
                                </div>

                                <div class="row mb-10">
                                    <div class="col-lg-6">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <select class="form-select form-select-solid" id="meta_keywords" name="meta_keywords[]" data-control="select2" data-placeholder="Select a meta keywords" data-allow-clear="true" multiple="multiple">
                                            @foreach (explode(',', $product->meta_keywords) as $keyword)
                                                <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="categories" class="required form-label">Category</label>
                                        <select class="form-select form-select-solid" name="categories[]" data-control="select2" data-placeholder="Select a category" data-allow-clear="true" multiple="multiple">
                                            <option></option>
                                            @php
                                                $selectedCategory = $product->categories->pluck('id')->toArray();
                                            @endphp
                                            @foreach(\App\Models\Category::latest()->get() as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id , $selectedCategory) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-lg-12">
                                        <label for="short_desc" class="required form-label">Short detail</label>
                                        <input type="text" name="short_desc" id="short_desc" class="form-control form-control-solid"
                                               placeholder="Enter the detail" value="{{ old('short_desc', $product->short_desc) }}"/>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-lg-12">
                                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                                        <textarea name="description" rows="5" id="kt_docs_ckeditor_classic">
                                                {{ old('description', $product->description) }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="form-group col-sm-12">
                                        <label class="mb-3" for="image_btn1">Image 1</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="image_btn1" class="btn btn-primary" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">Select image</button>
                                            </div>
                                            <input type="text" id="image_label1" name="image1" class="form-control form-control-solid" value="{{ old('image1', $product->image1) }}" aria-label="Image" aria-describedby="button-image" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="form-group col-sm-12">
                                        <label class="mb-3" for="image_btn2">Image 2</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="image_btn2" class="btn btn-primary" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">Select image</button>
                                            </div>
                                            <input type="text" id="image_label2" name="image2" class="form-control form-control-solid" value="{{ old('image2', $product->image2) }}" aria-label="Image" aria-describedby="button-image" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="form-group col-sm-12">
                                        <label class="mb-3" for="image_btn3">Image 3</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="image_btn3" class="btn btn-primary" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">Select image</button>
                                            </div>
                                            <input type="text" id="image_label3" name="image3" class="form-control form-control-solid" value="{{ old('image3', $product->image3) }}" aria-label="Image" aria-describedby="button-image" required readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator my-10"></div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('products.index') }}" class="btn btn-light-danger">Cancle</a>
                                    <button type="submit" class="btn btn-light-success">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
