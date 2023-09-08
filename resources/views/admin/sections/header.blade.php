
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <div id="kt_header" style="" class="header align-items-stretch">
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <div class="d-flex align-items-center d-lg-none ms-n1 me-2" title="Show aside menu">
                <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                    <span class="svg-icon svg-icon-2x mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="#" class="d-lg-none">
                    <img alt="Logo" src="{{asset('adminAssets/assets/media/logos/logo-2.svg')}}" class="h-30px" />
                </a>
            </div>
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                <div id="kt_toolbar_container" class="container-fluid d-flex align-items-center">
                    <div class="flex-grow-1 flex-shrink-0 me-5">
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Dashboard
                            @yield('breadcrumb')
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-stretch flex-shrink-0">
                        <div class="d-flex align-items-stretch ms-1 ms-lg-3">
                            <div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                                <div class="d-flex align-items-center" data-kt-search-element="toggle" id="kt_header_search_toggle">
                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                        <i class="bi bi-search fs-2"></i>
                                    </div>
                                </div>
                                <div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
                                    <div data-kt-search-element="wrapper">
                                        <form data-kt-search-element="form" class="w-100 position-relative mb-3" autocomplete="off">
                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control form-control-flush ps-10" name="search" value="" placeholder="Search..." data-kt-search-element="input" />
                                            <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
                                                <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                            </span>
                                            <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none" data-kt-search-element="clear">
                                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                    </svg>
                                                </span>
                                            </span>
                                            <div class="position-absolute top-50 end-0 translate-middle-y" data-kt-search-element="toolbar">

                                                <div data-kt-search-element="preferences-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-1" data-bs-toggle="tooltip" title="Show search preferences">
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
                                                            <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div data-kt-search-element="advanced-options-form-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary" data-bs-toggle="tooltip" title="Show more search options">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="separator border-gray-200 mb-6"></div>
                                        <div data-kt-search-element="results" class="d-none">
                                            <div class="scroll-y mh-200px mh-lg-350px">
                                                <h3 class="fs-5 text-muted m-0 pb-5" data-kt-search-element="category-title">Users</h3>
                                                <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40px me-4">
                                                        <img src="{{asset('adminAssets/assets/media/avatars/150-1.jpg')}}" alt="" />
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="d-flex flex-column justify-content-start fw-bold">
                                                        <span class="fs-6 fw-bold">Karina Clark</span>
                                                        <span class="fs-7 fw-bold text-muted">Marketing Manager</span>
                                                    </div>
                                                    <!--end::Title-->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <form data-kt-search-element="advanced-options-form" class="pt-1 d-none">

                                        <h3 class="fw-bold text-dark mb-7">Advanced Search</h3>
                                        <div class="mb-5">
                                            <input type="text" class="form-control form-control-sm form-control-solid" placeholder="Contains the word" name="query" />
                                        </div>
                                        <div class="mb-5">
                                            <div class="nav-group nav-group-fluid">
                                                <label>
                                                    <input type="radio" class="btn-check" name="type" value="has" checked="checked" />
                                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">All</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <input type="text" name="assignedto" class="form-control form-control-sm form-control-solid" placeholder="Assigned to" value="" />
                                        </div>
                                        <div class="mb-5">
                                            <input type="text" name="collaborators" class="form-control form-control-sm form-control-solid" placeholder="Collaborators" value="" />
                                        </div>
                                        <div class="mb-5">
                                            <!--begin::Radio group-->
                                            <div class="nav-group nav-group-fluid">
                                                <!--begin::Option-->
                                                <label>
                                                    <input type="radio" class="btn-check" name="attachment" value="has" checked="checked" />
                                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">Has attachment</span>
                                                </label>
                                                <!--end::Option-->
                                                <!--begin::Option-->
                                                <label>
                                                    <input type="radio" class="btn-check" name="attachment" value="any" />
                                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Any</span>
                                                </label>
                                                <!--end::Option-->
                                            </div>
                                            <!--end::Radio group-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <select name="timezone" aria-label="Select a Timezone" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                                <option value="next">Within the next</option>
                                                <option value="last">Within the last</option>
                                                <option value="between">Between</option>
                                                <option value="on">On</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-8">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <input type="number" name="date_number" class="form-control form-control-sm form-control-solid" placeholder="Lenght" value="" />
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <select name="date_typer" aria-label="Select a Timezone" data-control="select2" data-placeholder="Period" class="form-select form-select-sm form-select-solid">
                                                    <option value="days">Days</option>
                                                    <option value="weeks">Weeks</option>
                                                    <option value="months">Months</option>
                                                    <option value="years">Years</option>
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                            <a href="#" class="btn btn-sm fw-bolder btn-primary" data-kt-search-element="advanced-options-form-search">Search</a>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <form data-kt-search-element="preferences" class="pt-1 d-none">
                                        <h3 class="fw-bold text-dark mb-7">Search Preferences</h3>
                                        <div class="pb-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Projects</span>
                                                <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-end pt-7">
                                            <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2" data-kt-search-element="preferences-dismiss">Cancel</button>
                                            <button type="submit" class="btn btn-sm fw-bolder btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                            <!--begin::Menu wrapper-->
                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <img src="{{asset('adminAssets/assets/camera.jpg')}}" alt="image" />
                            </div>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px me-5">
                                            <img alt="Logo" src="{{asset('adminAssets/assets/camera.jpg')}}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Username-->
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5">{{auth()->user()->name}}

                                            <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{auth()->user()->email}}</a>
                                        </div>
                                        <!--end::Username-->
                                    </div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">My Profile</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                    <a href="#" class="menu-link px-5">
														<span class="menu-title position-relative">Language
														<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
														<img class="w-15px h-15px rounded-1 ms-2" src="{{asset('adminAssets/assets/media/flags/united-states.svg')}}" alt="" /></span></span>
                                    </a>
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo6/dist/account/settings.html" class="menu-link d-flex px-5 active">
															<span class="symbol symbol-20px me-4">
																<img class="rounded-1" src="{{asset('adminAssets/assets/media/flags/united-states.svg')}}" alt="" />
															</span>English</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo6/dist/account/settings.html" class="menu-link d-flex px-5">
															<span class="symbol symbol-20px me-4">
																<img class="rounded-1" src="{{asset('adminAssets/assets/media/flags/spain.svg')}}" alt="" />
															</span>Spanish</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo6/dist/account/settings.html" class="menu-link d-flex px-5">
															<span class="symbol symbol-20px me-4">
																<img class="rounded-1" src="{{asset('adminAssets/assets/media/flags/germany.svg')}}" alt="" />
															</span>German</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo6/dist/account/settings.html" class="menu-link d-flex px-5">
															<span class="symbol symbol-20px me-4">
																<img class="rounded-1" src="{{asset('adminAssets/assets/media/flags/japan.svg')}}" alt="" />
															</span>Japanese</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo6/dist/account/settings.html" class="menu-link d-flex px-5">
															<span class="symbol symbol-20px me-4">
																<img class="rounded-1" src="{{asset('adminAssets/assets/media/flags/france.svg')}}" alt="" />
															</span>French</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5 my-1">
                                    <a href="#" class="menu-link px-5">Account Settings</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <form id="logout_form" action="{{ route('logout') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <a href="javascript:$('#logout_form').submit();" class="menu-link px-5">Sign Out</a>
                                    </form>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content px-5">
                                        <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="#" />
                                            <span class="pulse-ring ms-n1"></span>
                                            <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                        </label>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>

                        <div class="d-flex align-items-center d-lg-none ms-2" title="Show header menu">
                            <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
                                        <path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        @yield('content')
    </div>


