<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Learning System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
        @if (App::getlocale()=='ar')
        
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">     
        @else
        
        @endif
        <link rel="stylesheet" href="{{ asset('frontend/css/ltr.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
        
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">

        <link rel="stylesheet" href="{{ asset('backend/fonts/web-icons/web-icons.min599c.css?v4.0.2') }}">
        <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/toastr.min599c.css?v4.0.2') }}">
        
    </head>
    <body>
    <div class="se-pre-con"></div>
    <!-- Header -->

    <nav class="navbar navbar-default fixed-top">
        <div class="row" style="flex-grow: 1;">

            <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="logo">
                <i class="fa fa-bars d-inline-block d-md-none mobile-nav"></i>
                <a href="{{ route('home') }}" class="float-xl-right"><img src="{{ asset('frontend/img/learning.png') }}" width="100" height="35" /></a>
            </div>

            <div class="col-md-1 col-lg-3 col-xl-3 d-none d-md-block">
                <div class="dropdown float-left" >
                  <span id="dropdownMenuButton" data-toggle="dropdown">{{trans('index.Categories')}} &nbsp;<i class="fa fa-caret-down"></i></span>
                    <?php 
                        $categories = SiteHelpers::active_categories();
                    ?>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('course.list','category_id[]='.$category->id) }}">
                            <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                            {{ $category->name}}
                        </a>
                    @endforeach
                  </div>
                </div>
                
            </div>
            <div class="col-sm-1 col-md-1 col-lg-3 col-xl-3 ">
                <div class="dropdown float-left" >
                  <span id="dropdownMenuButton" data-toggle="dropdown">{{trans('index.language')}} &nbsp;<i class="fa fa-caret-down"></i></span>
                    
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
                
            </div>
            
            
            <div class="col-sm-1 col-md-1 col-lg-2 col-xl-2 d-none d-sm-block">
                @if(Auth::check() && !Auth::user()->hasRole('instructor') && !Auth::user()->hasRole('admin'))
                <span class="become-instructor" href="{{ route('login') }}" data-toggle="modal" data-target="#myModal">{{trans('index.BecomeInstructor')}}</span>
                @endif
            </div>

            <div class="col-4 col-sm-1 col-md-1 col-lg-2 col-xl-2">
                @guest
                <a class="btn btn-learna" href="{{ route('login') }}">{{trans('index.Login')}} / {{trans('index.SignUp')}}</a>
                @else
                <div class="dropdown float-xl-left float-sm-right float-right">
                  <span id="dropdownMenuButtonRight" data-toggle="dropdown">
                    {{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>
                    
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">
                    @if(Auth::user()->hasRole('admin'))
                    
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}" >
                        <i class="fa fa-sign-out-alt"></i>{{trans('index.Admin')}}
                    </a>
                    
                    
                    @endif


                    @if(Auth::user()->hasRole('instructor'))
                    <a class="dropdown-item" href="{{ route('instructor.dashboard') }}" >
                        <i class="fa fa-sign-out-alt"></i>{{trans('index.Instructor')}}
                    </a>

                    <a class="dropdown-item" href="{{ route('my.courses') }}" >
                        <i class="fa fa-sign-out-alt"></i> {{trans('index.MyCourses')}}
                    </a>

                    @endif


                    <a class="dropdown-item" href="{{ route('logOut') }}" >
                        <i class="fa fa-sign-out-alt"></i> {{trans('index.Logout')}}
                    </a>
                    
                  </div>
                </div>

                @endguest
            </div>
        </div>
    </nav>

    <div id="sidebar">
        <ul>
           <li><a href="javascript:void(0)" class="sidebar-title">{{trans('index.Categories')}}</a></li>
           @foreach ($categories as $category)
           <li>
                <a href="{{ $category->slug }}">
                    <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                    {{ $category->name}}
                </a>
           </li>
           @endforeach
        </ul>
    </div>
    @yield('content')

    <!-- footer start -->
    <footer id="main-footer">
        <div class="row m-0">
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 mt-3">
                <ul>
                    <li class="mb-1"><b>{{trans('index.QuickLinks')}}</b></li>
                    <li><a href="{{ route('home') }}">{{trans('index.HomePage')}}</a></li>
                    <li><a href="{{ route('course.list') }}">{{trans('index.CoursesList')}}</a></li>
                    <li><a href="{{ route('instructor.list') }}">{{trans('index.InstructorsList')}}</a></li>
                    <li><a href="{{ route('blogs') }}">{{trans('index.BlogsList')}}</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 mt-3">
                <ul>
                    <li class="mb-1"><b>{{trans('index.Resources')}}</b></li>
                    <li><a href="{{ route('page.about') }}">{{trans('index.AboutUs')}}</a></li>
                    <li><a href="{{ route('page.contact') }}">{{trans('index.ContactUs')}}</a></li>
                    <li><a href="{{ route('register') }}">{{trans('index.RegisterPage')}}</a></li>
                    <li><a href="{{ route('login') }}">{{trans('index.LoginPage')}}</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 mt-3 d-none d-sm-block">
                <ul>
                    <li class="mb-1"><b>{{trans('index.TopCategories')}}</b></li>
                    @foreach ($categories as $category)
                        @if($loop->iteration <= 4)
                            <li><a href="{{ route('course.list','category_id[]='.$category->id) }}">{{ $category->name}}</a></li>
                        @endif
                    @endforeach
                    
                </ul>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 text-center mt-4">
                <img src="{{ asset('frontend/img/learning.png') }}" class="img-fluid" width="210" height="48">
                <br>
                <span id="c-copyright">
                    {{trans('index.CopyRight')}}
                </span>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- The Modal start -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bi-header ">
            <h5 class="col-12 modal-title text-center bi-header-seperator-head">{{trans('index.BecomeInstructor')}}</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
           
        <div class="becomeInstructorForm">
           <form id="becomeInstructorForm" class="form-horizontal" method="POST" action="{{ route('become.instructor') }}">
            {{ csrf_field() }}
                <div class="px-4 py-2">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>{{trans('index.FirstName')}}</label>
                                <input type="text" class="form-control form-control-sm" placeholder="{{trans('index.FirstName')}}" name="first_name">
                            </div>
                            <div class="col-6">
                                <label>{{trans('index.LastName')}}</label>
                                <input type="text" class="form-control form-control-sm" placeholder="{{trans('index.LastName')}}" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('index.ContactEmail')}}</label>
                        <input type="text" class="form-control form-control-sm" placeholder="{{trans('index.ContactEmail')}}" name="contact_email">
                    </div>

                    <div class="form-group">
                        <label>{{trans('index.Telephone')}}</label>
                        <input type="text" class="form-control form-control-sm" placeholder="{{trans('index.Telephone')}}" name="telephone">
                    </div>

                    <div class="form-group">
                        <label>{{trans('index.PaypalID')}}</label>
                        <input type="text" class="form-control form-control-sm" placeholder="{{trans('index.PaypalID')}}" name="paypal_id">
                    </div>

                    <div class="form-group">
                        <label>{{trans('index.Biography')}}</label>
                        <textarea class="form-control form-control" placeholder="{{trans('index.Biography')}}" name="biography"></textarea>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-lg btn-block login-page-button">{{trans('index.Submit')}}</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- The Modal end -->
    </body>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
    
    <!-- Toastr -->
    <script src="{{ asset('backend/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>

    

    <script>
    $(window).on("load", function (e){
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {   
            /* Delete record */
            $('.delete-record').click(function(event)
            {
                var url = $(this).attr('href');
                event.preventDefault();
                
                if(confirm('Are you sure want to delete this record?'))
                {
                    window.location.href = url;
                } else {
                    return false;
                }

            });

            /* Toastr messages */
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;
            @if(session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session()->has('status'))
                toastr.success("{{ session('status') }}");
            @endif
            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session()->has('info'))
                toastr.info("{{ session('info') }}");
            @endif

            $('.mobile-nav').click(function()
            {
                $('#sidebar').toggleClass('active');
                
                $(this).toggleClass('fa-bars');
                $(this).toggleClass('fa-times');
            });

            $("#becomeInstructorForm").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    contact_email:{
                        required: true,
                        email:true
                    },
                    telephone: {
                        required: true
                    },
                    paypal_id:{
                        required: true,
                        email:true
                    },
                    biography: {
                        required: true
                    },
                },
                messages: {
                    first_name: {
                        required: 'The first name field is required.'
                    },
                    last_name: {
                        required: 'The last name field is required.'
                    },
                    contact_email: {
                        required: 'The contact email field is required.',
                        email: 'The contact email must be a valid email address.'
                    },
                    telephone: {
                        required: 'The telephone field is required.'
                    },
                    paypal_id: {
                        required: 'The paypal id field is required.',
                        email: 'The paypal id must be a valid email address.'
                    },
                    biography: {
                        required: 'The biography field is required.'
                    },
                }
            });
        });
    </script>
    @yield('javascript')
</html>