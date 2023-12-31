@extends('home.master')

@section('content')

    <!-- cart header  -->
    <header class="header-carts">
        <h1>Find Products</h1>
    </header>
    <!--end of cart header-->
    <section class="section-search">
        <form class="search-from">
            <div class="search-box-container">
                <svg
                    class="search-icon"
                    fill="none"
                    height="19"
                    viewBox="0 0 19 19"
                    width="19"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M8.0005 14.182C8.78843 14.182 9.56865 14.0268 10.2966 13.7253C11.0246 13.4238 11.686 12.9818 12.2431 12.4247C12.8003 11.8675 13.2423 11.2061 13.5438 10.4781C13.8453 9.75017 14.0005 8.96995 14.0005 8.18202C14.0005 7.39409 13.8453 6.61387 13.5438 5.88592C13.2423 5.15797 12.8003 4.49653 12.2431 3.93938C11.686 3.38223 11.0246 2.94027 10.2966 2.63874C9.56865 2.33722 8.78843 2.18202 8.0005 2.18202C6.4092 2.18202 4.88308 2.81416 3.75786 3.93938C2.63264 5.0646 2.0005 6.59072 2.0005 8.18202C2.0005 9.77332 2.63264 11.2994 3.75786 12.4247C4.88308 13.5499 6.4092 14.182 8.0005 14.182ZM14.3205 13.088L17.9005 16.668C17.9959 16.7603 18.072 16.8707 18.1244 16.9928C18.1767 17.1148 18.2042 17.2461 18.2052 17.3788C18.2063 17.5116 18.1809 17.6433 18.1305 17.7661C18.0802 17.889 18.0058 18.0006 17.9119 18.0944C17.8179 18.1882 17.7062 18.2624 17.5833 18.3126C17.4604 18.3628 17.3287 18.388 17.1959 18.3868C17.0631 18.3855 16.9319 18.3578 16.8099 18.3053C16.688 18.2529 16.5777 18.1766 16.4855 18.081L12.9055 14.501C11.298 15.7489 9.2753 16.3372 7.24926 16.1462C5.22322 15.9552 3.34611 14.9993 2.00005 13.4731C0.654 11.9468 -0.0598121 9.96497 0.00392902 7.93095C0.0676701 5.89692 0.904173 3.96364 2.34315 2.52467C3.78213 1.08569 5.7154 0.249189 7.74943 0.185448C9.78345 0.121706 11.7653 0.835518 13.2916 2.18157C14.8178 3.52763 15.7737 5.40474 15.9647 7.43078C16.1557 9.45682 15.5674 11.4795 14.3195 13.087L14.3205 13.088Z"
                        fill="#181B19"
                    />
                </svg>
                <input class="search-input" placeholder="Search store" type="text" />
            </div>
        </form>
    </section>
    <!--  end of search section -->
    <!--  categories section -->
    <section class="section-categories">
        <div class="category-container">
{{--            <div class="category-header">--}}
{{--                <h4 class="category-title">Categories</h4>--}}
{{--            </div>--}}
            <div class="category-body">
                <a class="category category-1" href="#">
                    <img alt="veggies" src="{{asset('home/images/pngfuel%206.png')}}" />
                    <p>Frash Fruits & Vegetable</p>
                </a>
                <a class="category category-2" href="#">
                    <img alt="veggies" src="{{asset('home/images/oil.png')}}" />
                    <p>Frash Fruits & Vegetable</p>
                </a>
                <a class="category category-3" href="#">
                    <img alt="veggies" src="{{asset('home/images/meat.png')}}" />
                    <p>Frash Fruits & Vegetable</p>
                </a>
                <a class="category category-4" href="#">
                    <img alt="veggies" src="{{asset('home/images/bread.png')}}" />
                    <p>Frash Fruits & Vegetable</p>
                </a>
                <a class="category category-5" href="#">
                    <img alt="veggies" src="{{asset('home/images/pngfuel%206.png')}}" />
                    <p>Frash Fruits & Vegetable</p>
                </a>
            </div>
        </div>
    </section>
    <!-- end of categories section -->

@endsection
