@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <title>Item Name | Documentation by Author Name</title>

    <link rel="shortcut icon" href="{{asset('doc_assets/images/favicon.ico' ) }}" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/assetfonts/font-awesome-4.3.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/stroke.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/prettyPhoto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/js/syntax-highlighter/styles/shCore.css')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/js/syntax-highlighter/styles/shThemeRDark.css')}}" media="all">

    <!-- CUSTOM -->
    <link rel="stylesheet" type="text/css" href="{{ asset('doc_assets/css/custom.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>

    <script>
        var mybutton = document.getElementById("myBtn");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        function topFunction() {
            window.scrollTo({ top: 0, behavior: 'smooth' })
            document.documentElement.scrollTo({ top: 0, behavior: 'smooth' })
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector('#mode').addEventListener('click',()=>{
                document.querySelector('html').classList.toggle('dark');
            })
        });


    </script>

    <div id="wrapper">

        <div id="mode" >
            <div class="dark">
                <svg aria-hidden="true" viewBox="0 0 512 512">
                    <title>lightmode</title>
                    <path fill="currentColor" d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"></path>
                </svg>
            </div>
            <div class="light">
                <svg aria-hidden="true" viewBox="0 0 512 512">
                    <title>darkmode</title>
                    <path fill="currentColor" d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z"></path>
                </svg>
            </div>
        </div>

        <div class="container">

            <section id="top" class="section docs-heading">

                <div class="row">
                    <div class="col-md-12">
                        <div class="big-title text-center">
                            <h1>Warehouse Management System</h1>
                            <p class="lead">For Product Distribution</p>
                        </div>
                        <!-- end title -->
                    </div>
                    <!-- end 12 -->
                </div>
                <!-- end row -->

                <hr>

            </section>
            <!-- end section -->

            <div class="row">

                <div class="col-md-3">
                    <nav class="docs-sidebar" data-spy="affix" data-offset-top="300" data-offset-bottom="200" role="navigation">
                        <ul class="nav">
                            <li><a href="#line1">Getting Started</a></li>
                            <li><a href="#line2">System Overview</a></li>
                            <li><a href="#line3">How to Use the System</a></li>
                            <li><a href="#line4">Copyright and license</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                        </ul>
                    </nav >
                </div>
                <div class="col-md-9">
                    <section class="welcome">

                        <div class="row">
                            <div class="col-md-12 left-align">
                               <h2 class="dark-text">Introduction<hr></h2>
                                <div class="row">

                                    <div class="col-md-12 full">
                                        
                                        <div>
                                            <p> The warehouse management gives a company the ability to track inventory location and usage throughout the warehouse operations, in multiple warehouse locations, in multiple distribution centers and stores.It also provides you a simple interface for maintenance of shops information,order history and delivery process. 
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </section>


                    <section id="line2" class="section">

                        <div class="row">
                            <div class="col-md-12 left-align">
                                <h2 class="dark-text">System Overview <hr></h2>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="intro2 clearfix">
                            <p><i class="fa fa-wordpress"></i> The warehouse management system within the company is broken down into three different divisions: order placement,  order fulfillment and order receiving. </p>
                        </div>

                        <hr>

                        <h4>Order Placement</h4>

                        <p>The first division is order placement which is where they will create orders,
                            receive missing orders, reorder missing orders and send orders to be recorded.The clients would like this system to be able to order multiple products in multiple quantities as a single order. They currently have been having issues with order fulfillment and would like the ability to list previous orders that were either damaged or missing with the capacity to reorder them along with other items that have not been recently purchased. They would also like to be able to review order totals and have the power to edit their line items. </p>


                        <h4>Order Fulfillment</h4>

                        <p>In this division they receive order information from order placement and  store it on their data base.After that the products are placed onto pallets and then  are shipped out  to the third division. In this area of the warehouse management system they would like the ability to view
                            received orders and to be able to pack multiple orders on a single pallet. They would like to be
                            able to do this because they follow the business accounting rule of first in first out (FIFO) for
                            their inventory. The clients also need to be able to have more control over what pallets are being
                            shipped and the details of the order.</p>

                        <h4>Order Receiving</h4>

                        <p>The final division of the warehouse management system is order receiving. This division is used for receiving orders of parts for their shops. They will simulate the delivery of the products by using ways. This information is then entered into the data base and will update the order placement division on the status of the order that was placed. In this area of the warehouse system the clients would like to have the capability to update current statuses at the shipping dock.</p>

                       

                    </section>
                    <!-- end section -->

                    <section id="line3" class="section">

                        <div class="row">
                            <div class="col-md-12 left-align">
                                <h2 class="dark-text">How to Use the System <hr></h2>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">

                            <div class="col-md-12">
                                <p>For Admin Panel,<br>
                                    <ul>
                                        <li><strong>email address- admin@gmail.com</strong> , <strong>password - password</strong></li>
                                    </ul>
                                </p>

                                <p>For Sales Staff Panel,<br>
                                    <ul>
                                        <li><strong>email address- kyawkyaw@sale.com</strong> , <strong>password - password</strong></li>
                                         <li><strong>email address- kaungmyat@sale.com</strong> , <strong>password - password</strong></li>
                                         <li><strong>email address- nyinyi@sale.com</strong> , <strong>password - password</strong></li>
                                    </ul>
                                </p>

                                <p>For Delivery Staff Panel,<br>
                                    <ul>
                                        <li><strong>email address- tuntun@gmail.com</strong> , <strong>password - password</strong></li>
                                         <li><strong>email address- aungaung@gmail.com</strong> , <strong>password - password</strong></li>
                                         <li><strong>email address- mgmg@gmail.com</strong> , <strong>password - password</strong></li>
                                    </ul>
                                </p>
                               
                               


                            </div>

                            <div class="col-md-4">
                                <a href="upload/thumbnail.png" data-rel="prettyPhoto"><img src="images/upload/thumbnail.png" alt="" class="img-responsive img-thumbnail"></a>
                                <h4 id="line5_1">Admin Panel -</h4>
                                <ul>
                                    <li><strong>Step 1</strong> - Login.</li>
                                    <li><strong>Step 2</strong> - Add products to distribute.</li>
                                    <li><strong>Step 3</strong> - Add ways to deliver.</li>
                                    <li><strong>Step 4</strong> - Check orders and confirm.</li>
                                </ul>
                            </div>
                            <!-- end col -->

                            <div class="col-md-4">
                                <a href="upload/thumbnail.png" data-rel="prettyPhoto"><img src="images/upload/thumbnail.png" alt="" class="img-responsive img-thumbnail"></a>
                                <h4 id="line5_2">Sales Staff Panel -</h4>
                                <ul>
                                    <li><strong>Step 1</strong> - Login.</li>
                                    <li><strong>Step 2</strong> - Choose Way.</li>
                                    <li><strong>Step 3</strong> - Choose shops which will place order on the chosen way.</li>
                                    <li><strong>Step 3</strong> - Order Placed.</li>
                                </ul>
                            </div>
                            <!-- end col -->

                            <div class="col-md-4">
                                <a href="upload/thumbnail.png" data-rel="prettyPhoto"><img src="images/upload/thumbnail.png" alt="" class="img-responsive img-thumbnail"></a>
                                <h4 id="line5_3">Delivery Staff Panel -</h4>
                                <ul>
                                    <li><strong>Step 1</strong> - Login</li>
                                    <li><strong>Step 2</strong> - Confirm orders are delivered to the customers.</li>
                                </ul>
                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->

                    </section>
                    <!-- end section -->

                    <section id="line4" class="section">

                        <div class="row">
                            <div class="col-md-12 left-align">
                                <h2 class="dark-text">Copyright and license <hr></h2>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                
                                <p> This system is released under the <a href="#" target="_blank">Un License</a> License.</p>                        
                                <p>For more information about copyright and license check <a href="https://choosealicense.com/" target="_blank">choosealicense.com</a>.</p>
                            
                            </div>
                        </div>
                        <!-- end row -->

                    </section>
                    <!-- end section -->
                </div>
                <!-- // end .col -->

            </div>
            <!-- // end .row -->

        </div>
        <!-- // end container -->

    </div>
    <!-- end wrapper -->

    <script src="{{asset('doc_assets/js/jquery.min.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/bootstrap.min.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/retina.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/jquery.fitvids.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/wow.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/jquery.prettyPhoto.js' ) }}"></script>

    <!-- CUSTOM PLUGINS -->
    <script src="{{asset('doc_assets/js/custom.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/main.js' ) }}"></script>

    <script src="{{asset('doc_assets/js/syntax-highlighter/scripts/shCore.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/syntax-highlighter/scripts/shBrushXml.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/syntax-highlighter/scripts/shBrushCss.js' ) }}"></script>
    <script src="{{asset('doc_assets/js/syntax-highlighter/scripts/shBrushJScript.js' ) }}"></script>

</body>

</html>










@endsection