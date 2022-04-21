@extends('layouts.app')

@section('content')
<!-- Banner Section  -->
<section class="banner-home-custom d-flex flex-wrap align-items-end position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="home-banner-cont position-relative">
                        <h1 class="font-title--lg">Learn With Bright Anytime Anywhere.</h1>
                        <p class="fs-20 fw-light mt-24">
                            My mision is to Tech people to find the best course online and learn with expert anytime,
                            anywhere.
                        </p>
                        <a class="button button--dark" href="#">Get Started</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="home-banner-img text-md-end position-relative">
                        <img src="{{asset('front/dist/images/newDesign/banner-img.png')}}" alt="banner-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section Ends -->

    <!-- New Course Feature Starts Here -->
    <section class="section new-course-feature">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="font-title--md">New Online Courses</h2>
                </div>
            </div>

            <div class="new__courses">
                <div class="contentCard contentCard--marketing shadow-sm mb-1">
                    <div class="contentCard-top">
                        <a href="course-details.html">
                            <img src="{{asset('front/dist/images/newDesign/onlineCourse1.png')}}" alt="images" class="img-fluid" />
                        </a>
                    </div>
                    <div class="contentCard-bottom">
                        <span class="contentCard--type">marketing</span>
                        <h5>
                            <a href="course-details.html" class="font-title--card">Chicago International Conference on
                                Education</a>
                        </h5>
                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                            <a href="instructor-profile.html" class="contentCard-user d-flex align-items-center">
                                <img src="{{asset('front/dist/images/newDesign/courseInstructorIcon.png')}}" alt="client-image"
                                    class="rounded-circle" />
                                <p class="font-para--md">Brandon Dias</p>
                            </a>
                            <div class="price">
                                <span>$12</span>
                                <del>$95</del>
                            </div>
                        </div>
                        <div class="contentCard-more">
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/eye.png')}}" alt="eye" />
                                </div>
                                <span>24,517</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/book.png')}}" alt="book" />
                                </div>
                                <span>37 Lesson</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/clock.png')}}" alt="clock" />
                                </div>
                                <span>3 Hours</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentCard contentCard--marketing shadow-sm mb-1">
                    <div class="contentCard-top">
                        <a href="course-details.html">
                            <img src="{{asset('front/dist/images/newDesign/onlineCourse2.png')}}" alt="images" class="img-fluid" />
                        </a>
                    </div>
                    <div class="contentCard-bottom">
                        <span class="contentCard--type">marketing</span>
                        <h5>
                            <a href="course-details.html" class="font-title--card">Chicago International Conference on
                                Education</a>
                        </h5>
                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                            <a href="instructor-profile.html" class="contentCard-user d-flex align-items-center">
                                <img src="{{asset('front/dist/images/newDesign/courseInstructorIcon.png')}}" alt="client-image"
                                    class="rounded-circle" />
                                <p class="font-para--md">Brandon Dias</p>
                            </a>
                            <div class="price">
                                <span>$12</span>
                                <del>$95</del>
                            </div>
                        </div>
                        <div class="contentCard-more">
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/eye.png')}}" alt="eye" />
                                </div>
                                <span>24,517</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/book.png')}}" alt="book" />
                                </div>
                                <span>37 Lesson</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/clock.png')}}" alt="clock" />
                                </div>
                                <span>3 Hours</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentCard contentCard--marketing shadow-sm mb-1">
                    <div class="contentCard-top">
                        <a href="course-details.html">
                            <img src="{{asset('front/dist/images/newDesign/onlineCourse3.png')}}" alt="images" class="img-fluid" />
                        </a>
                    </div>
                    <div class="contentCard-bottom">
                        <span class="contentCard--type">marketing</span>
                        <h5>
                            <a href="course-details.html" class="font-title--card">Chicago International Conference on
                                Education</a>
                        </h5>
                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                            <a href="instructor-profile.html" class="contentCard-user d-flex align-items-center">
                                <img src="{{asset('front/dist/images/newDesign/courseInstructorIcon.png')}}" alt="client-image"
                                    class="rounded-circle" />
                                <p class="font-para--md">Brandon Dias</p>
                            </a>
                            <div class="price">
                                <span>$12</span>
                                <del>$95</del>
                            </div>
                        </div>
                        <div class="contentCard-more">
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/eye.png')}}" alt="eye" />
                                </div>
                                <span>24,517</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/book.png')}}" alt="book" />
                                </div>
                                <span>37 Lesson</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <img src="{{asset('front/dist/images/icon/clock.png')}}" alt="clock" />
                                </div>
                                <span>3 Hours</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="course-search.html" class="button button-lg button--primary mt-lg-5 mt-5">Browse all
                        Courses</a>
                </div>
            </div>
        </div>
    </section>
    <!-- New Course Feature Starts Here ENDS -->

    <!-- Find Course with top categories -->
    <section class="section section--bg-offwhite-one find-courses-with-top-categories">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="font-title--md">Find Course with Top Categories</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category1.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">UI/UX Design</h5>
                                <span class="text-light-custom fs-14">90k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category2.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">Development</h5>
                                <span class="text-light-custom fs-14">100k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category3.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">IT & Software</h5>
                                <span class="text-light-custom fs-14">90k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category4.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">Health & Fitness</h5>
                                <span class="text-light-custom fs-14">90k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category1.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">Art & Design</h5>
                                <span class="text-light-custom fs-14">100k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="find-courses-category-block section--bg-white">
                        <a href="#" class="text-reset d-flex flex-wrap">
                            <div class="find-courses-category-img">
                                <img src="{{asset('front/dist/images/newDesign/category1.png')}}" alt="category" />
                            </div>
                            <div class="find-courses-category-cont">
                                <h5 class="fs-20">Academics</h5>
                                <span class="text-light-custom fs-14">90k Courses</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="course-search.html" class="button button-lg button--primary mt-lg-5 mt-5">Browse all
                        Courses</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Find Course with top categories Ends -->

    <!-- Why choose my course  -->
    <section class="section why-choose-us-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="font-title--md">Why Choose My Courses?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="why-choose-block bgShade1 shadow">
                        <div class="why-choose-img bg-white">
                            <img src="{{asset('front/dist/images/newDesign/whyChoose1.png')}}" alt="whyChoose" />
                        </div>
                        <div class="why-choose-cont">
                            <h4>Many Online Courses</h4>
                            <p class="mb-0 fw-light">Explore a variety of fresh topics</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-choose-block bgShade2 shadow">
                        <div class="why-choose-img bg-white">
                            <img src="{{asset('front/dist/images/newDesign/whyChoose2.png')}}" alt="whyChoose" />
                        </div>
                        <div class="why-choose-cont">
                            <h4>Expert instruction</h4>
                            <p class="mb-0 fw-light">Find the right course for you</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-choose-block bgShade3 shadow">
                        <div class="why-choose-img bg-white">
                            <img src="{{asset('front/dist/images/newDesign/whyChoose3.png')}}" alt="whyChoose" />
                        </div>
                        <div class="why-choose-cont">
                            <h4>Lifetime access</h4>
                            <p class="mb-0 fw-light">Learn on your schedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why choose my course Ends -->

    <!-- Testimonial Area Starts Here -->
    <section class="section section--bg-white">
        <div class="container">
            <h2 class="font-title--md text-center">
                What My Students Says <br class="d-none d-md-block" />
                About our Services
            </h2>
            <div class="testimonial testimonial--two testimonial__slider--two">
                <div class="testimonial__item">
                    <ul class="testimonial__item-star d-flex align-items-center">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                    </ul>
                    <p class="font-para--lg">
                        “Nam hendrerit quam eu neque egestas, nec lobortis enim rutrum. Quisque ligula tortor, mollis a
                        efficitur vitae, imperdiet et mauris. Nam in orci quis risus dapibus mollis.“
                    </p>

                    <div class="testimonial__user d-flex align-items-center justify-content-lg-start">
                        <div class="testimonial__user-img">
                            <img src="{{asset('front/dist/images/newDesign/avatar-img-testimonial.png')}}" alt="Client" />
                        </div>
                        <div class="testimonial__user-info">
                            <h6>Sheikh Rashed</h6>
                            <span class="font-para--md">Front End Developer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial__item">
                    <ul class="testimonial__item-star d-flex align-items-center">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                    </ul>
                    <p class="font-para--lg">
                        “Nam hendrerit quam eu neque egestas, nec lobortis enim rutrum. Quisque ligula tortor, mollis a
                        efficitur vitae, imperdiet et mauris. Nam in orci quis risus dapibus mollis.“
                    </p>

                    <div class="testimonial__user d-flex align-items-center">
                        <div class="testimonial__user-img">
                            <img src="{{asset('front/dist/images/newDesign/avatar-img-testimonial.png')}}" alt="Client" />
                        </div>
                        <div class="testimonial__user-info">
                            <h6>Sheikh Rashed</h6>
                            <span class="font-para--md">Front End Developer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial__item">
                    <ul class="testimonial__item-star d-flex align-items-center">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                    </ul>
                    <p class="font-para--lg">
                        “Nam hendrerit quam eu neque egestas, nec lobortis enim rutrum. Quisque ligula tortor, mollis a
                        efficitur vitae, imperdiet et mauris. Nam in orci quis risus dapibus mollis.“
                    </p>

                    <div class="testimonial__user d-flex align-items-center">
                        <div class="testimonial__user-img">
                            <img src="{{asset('front/dist/images/newDesign/avatar-img-testimonial.png')}}" alt="Client" />
                        </div>
                        <div class="testimonial__user-info">
                            <h6>Sheikh Rashed</h6>
                            <span class="font-para--md">Front End Developer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial__item">
                    <ul class="testimonial__item-star d-flex align-items-center">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </li>
                    </ul>
                    <p class="font-para--lg">
                        “Nam hendrerit quam eu neque egestas, nec lobortis enim rutrum. Quisque ligula tortor, mollis a
                        efficitur vitae, imperdiet et mauris. Nam in orci quis risus dapibus mollis.“
                    </p>

                    <div class="testimonial__user d-flex align-items-center">
                        <div class="testimonial__user-img">
                            <img src="{{asset('front/dist/images/newDesign/avatar-img-testimonial.png')}}" alt="Client" />
                        </div>
                        <div class="testimonial__user-info">
                            <h6>Sheikh Rashed</h6>
                            <span class="font-para--md">Front End Developer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Area Starts Here ENDS -->

    <!--  Get Started Starts Here -->
    <section class="section get-started">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="get-started-area">
                        <div class="get-started-item mb-4 mb-lg-0">
                            <h6 class="font-title--sm">Become an Instructor</h6>
                            <p class="font-para--lg">
                                Duis posuere maximus arcu eu tincidunt. Nam rutrum, nibh vitae tempus venenatis, ex
                                tortor ultricies magna, et faucibus magna eros.
                            </p>
                            <a href="become-instructor.html" class="green-btn d-inline-block">Apply as Instructor</a>
                        </div>
                        <div class="get-started-item">
                            <h6 class="font-title--sm">Use Eduguard For Business</h6>
                            <p class="font-para--lg">
                                Praesent ultricies nulla ac congue bibendum. Aliquam tempor euismod purus posuere
                                gravida. Praesent augue sapien, vulputate eu imperdiet eget, tempor at enim.
                            </p>
                            <a href="#" class="green-btn d-inline-block">Get Eduguard For Business</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Get Started Starts Here ENDS -->

    <!-- News Letter Starts Here -->
    <section style="background-color: rgba(235, 235, 242, 0.6);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="newsletter-area">
                        <h4 class="font-title--md">Subscribe our Newsletter</h4>
                        <p class="mt-2 mb-lg-4 mb-3">
                            Duis posuere maximus arcu eu tincidunt. Nam rutrum, nibh vitae tempus venenatis, ex tortor
                            ultricies magna, et faucibus magna eros quis arcu.
                        </p>
                        <form>
                            <div class="input-group">
                                <input type="email" class="form-control border-lowBlack" placeholder="Your email" />

                                <button class="button button-lg button--primary" type="button">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Letter Starts Here Ends-->

    <!-- Footer Starts Here ENDS -->
@endsection
