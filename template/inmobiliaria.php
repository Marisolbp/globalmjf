<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rethouse - Real Estate HTML Template">
    <meta name="keywords" content="Real Estate, Property, Directory Listing, Marketing, Agency" />
    <meta name="author" content="mardianto - retenvi.com">
    <title>Rethouse - Real Estate HTML Template</title>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link rel="manifest" href="site.webmanifest">
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="icon.png">
    <meta name="theme-color" content="#3454d1">
    <link href="./css/styles.css?8918068d71def746395d" rel="stylesheet">
</head>

<body>
    <!-- HEADER -->
    <?php include "menu.php"?>

    <div class="bg-theme-overlay">
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-white">Inmobiliaria</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="clearfix"></div>

    <!-- LISTING LIST -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                    <!-- FORM FILTER -->
                    <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">

                                <h5 class="text-center text-capitalize">property filter</h5>
                            </div>
                            <div class="products__filter__body">
                                <div class="form-group">

                                    <select class="wide select_option">
                                        <option data-display="Property Status">Property Status</option>
                                        <option>For Sale</option>
                                        <option>For Rent</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Property Type">Property Type</option>
                                        <option>Residential</option>
                                        <option>Commercial</option>
                                        <option>Land</option>
                                        <option>Luxury</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Area From">Area From </option>
                                        <option>1500</option>
                                        <option>1200</option>
                                        <option>900</option>
                                        <option>600</option>
                                        <option>300</option>
                                        <option>100</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Locations">Locations</option>
                                        <option>United Kingdom</option>
                                        <option>American Samoa</option>
                                        <option>Belgium</option>
                                        <option>Canada</option>
                                        <option>Delaware</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Bedrooms">Bedrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <select class="wide select_option">
                                            <option data-display="Bathrooms">Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-3">Price range</label>
                                    <div class="filter__price">
                                        <input class="price-range" type="text" name="my_range" value="" />
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-2">

                                    <a class="btn btn-outline-primary btn-block text-capitalize advanced-filter"
                                        data-toggle="collapse" href="#multiCollapseExample1"
                                        aria-controls="multiCollapseExample1"><i class="fa fa-plus-circle"></i> advanced
                                        filter
                                    </a>

                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="advancedfilter">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox2" type="checkbox">
                                                <label for="checkbox2" class="label-brand text-capitalize">
                                                    Air Conditioning
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox3" type="checkbox">
                                                <label for="checkbox3" class="label-brand text-capitalize">
                                                    Swiming Pool
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox4" type="checkbox">
                                                <label for="checkbox4" class="label-brand text-capitalize">
                                                    Central Heating
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox5" type="checkbox">
                                                <label for="checkbox5" class="label-brand text-capitalize">
                                                    Spa & Massage
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox6" type="checkbox">
                                                <label for="checkbox6" class="label-brand text-capitalize">
                                                    Pets Allow
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox">
                                                <label for="checkbox7" class="label-brand text-capitalize">
                                                    Air Conditioning
                                                </label>

                                            </div>

                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox8" type="checkbox">
                                                <label for="checkbox8" class="label-brand text-capitalize">
                                                    Gym
                                                </label>

                                            </div>

                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox9" type="checkbox">
                                                <label for="checkbox9" class="label-brand text-capitalize">
                                                    Alarm
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox10" type="checkbox">
                                                <label for="checkbox10" class="label-brand text-capitalize">
                                                    Window Covering
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox11" type="checkbox">
                                                <label for="checkbox11" class="label-brand text-capitalize">
                                                    Free WiFi
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox12" type="checkbox">
                                                <label for="checkbox12" class="label-brand text-capitalize">
                                                    Car Parking
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products__filter__footer">
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary text-capitalize btn-block"><i
                                            class="fa fa-search ml-1"></i> search
                                        property </button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- END FORM FILTER -->
                    <!-- ARCHIVE CATEGORY -->
                    <div class=" wrapper__list__category">
                        <!-- CATEGORY -->
                        <div class="widget widget__archive">
                            <div class="widget__title">
                                <h5 class="text-dark mb-0 text-center">Categories Property</h5>
                            </div>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#" class="text-capitalize">
                                        apartement
                                        <span class="badge badge-primary">14</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-capitalize">
                                        villa
                                        <span class="badge badge-primary">4</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-capitalize">
                                        family house
                                        <span class="badge badge-primary">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-capitalize">
                                        modern villa
                                        <span class="badge badge-primary">8</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-capitalize">
                                        town house
                                        <span class="badge badge-primary">10</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-capitalize">
                                        office
                                        <span class="badge badge-primary">12</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END CATEGORY -->
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs__custom-v2">
                                <!-- FILTER VERTICAL -->
                                <ul class="nav nav-pills myTab" role="tablist">
                                    <li class="list-inline-item mr-auto">
                                        <span class="title-text">Sort by</span>
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Based Properties
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)">Low to High Price</a>
                                                <a class="dropdown-item" href="javascript:void(0)">High to Low Price
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0)">Sell Properties</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Rent Properties</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pills-tab-one" data-toggle="pill" href="#pills-tab-one"
                                            role="tab" aria-controls="pills-tab-one" aria-selected="true">
                                            <span class="fa fa-th-list"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active pills-tab-two" data-toggle="pill"
                                            href="#pills-tab-two" role="tab" aria-controls="pills-tab-two"
                                            aria-selected="false">
                                            <span class="fa fa-th-large"></span></a>
                                    </li>
                                </ul>



                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade " id="pills-tab-one" role="tabpanel"
                                        aria-labelledby="pills-tab-one">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery16.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">vila in coral gables</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!

                    </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery17.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">Ample Apartment At Last Floor</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery18.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">Ample Apartment At Last Floor</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery8.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">Family Home For Sale</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                    
                                        </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery9.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">Luxury Villa With Pool</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                    
                                        </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery10.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">184 Lexington Avenue</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                    
                                        </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>
                                                                    </li>

                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card__image card__box-v1">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 col-lg-3 col-xl-4">
                                                            <div class="card__image__header h-250">
                                                                <a href="#">
                                                                    <div class="ribbon text-capitalize">sold out</div>
                                                                    <img src="images/gallery11.jpg" alt=""
                                                                        class="img-fluid w100 img-transition">
                                                                    <div class="info"> for sale</div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                            <div class="card__image__body">

                                                                <span
                                                                    class="badge badge-primary text-capitalize mb-2">house</span>
                                                                <h6>
                                                                    <a href="#">The Citizen Apartment 5th Floor</a>
                                                                </h6>
                                                                <div class="card__image__body-desc">
                                                                    <!-- <p class="text-capitalize">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                    
                                        </p> -->
                                                                    <p class="text-capitalize">
                                                                        <i class="fa fa-map-marker"></i>
                                                                        west flaminggo road, las vegas
                                                                    </p>
                                                                </div>

                                                                <ul class="list-inline card__content">
                                                                    <li class="list-inline-item">

                                                                        <span>
                                                                            baths <br>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            beds <br>
                                                                            <i class="fa fa-bed"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            rooms <br>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            area <br>
                                                                            <i class="fa fa-map"></i> 4300 sq ft
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                            <div class="card__image__footer">
                                                                <figure>
                                                                    <img src="images/logo.jpg" alt=""
                                                                        class="img-fluid rounded-circle">
                                                                </figure>
                                                                <ul class="list-inline my-auto">
                                                                    <li class="list-inline-item name">
                                                                        <a href="#">
                                                                            tom wilson
                                                                        </a>

                                                                    </li>


                                                                </ul>
                                                                <ul class="list-inline  my-auto ml-auto price">
                                                                    <li class="list-inline-item ">

                                                                        <h6>$350.000</h6>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="tab-pane fade show active" id="pills-tab-two" role="tabpanel"
                                        aria-labelledby="pills-tab-two">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->

                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Citra Garden Estate</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery18.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Ample Apartment At Last Floor</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery16.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Contemporary Apartment</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery17.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Citra Garden Estate</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery2.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Family Home For Sale</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery7.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->

                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Citra Garden Estate</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery8.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Luxury Villa With Pool</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery9.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->

                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Citra Garden Estate</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery10.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> 184 Lexington Avenue</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery17.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> The Citizen Apartment 5th Floor</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery12.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->

                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6>
                                                                        Ample Apartment At Last Floor</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery15.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mt-4">
                                                <!-- CARD IMAGE -->
                                                <a href="#">
                                                    <div class="card__image-hover h-250">
                                                        <div class="card__image-hover-overlay">
                                                            <div class="listing-badges">
                                                                <span class="featured">
                                                                    Featured
                                                                </span>
                                                                <span>
                                                                    For Rent
                                                                </span>
                                                            </div>
                                                            <div class="card__image-content">
                                                                <div class="card__image-content-desc">
                                                                    <h6> Contemporary Apartment</h6>
                                                                    <p class="mb-0"> $1300 / monthly</p>
                                                                </div>
                                                                <ul class="list-inline card__hidden-content">
                                                                    <li class="list-inline-item">
                                                                        Baths
                                                                        <span>
                                                                            <i class="fa fa-bath"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Beds
                                                                        <span>
                                                                            <i class="fa fa-bed"></i> 2
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Rooms
                                                                        <span>
                                                                            <i class="fa fa-inbox"></i> 3
                                                                        </span>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        Area
                                                                        <span>
                                                                            <i class="fa fa-map"></i> 1450 sq ft
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <img alt="" src="images/gallery14.jpg"
                                                                class="img-fluid h-40 ">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="cleafix"></div>
                                    </div>



                                </div>
                                <!-- END FILTER VERTICAL -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END LISTING LIST -->

    <!-- CALL TO ACTION -->
    <section class="cta-v1 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <h2 class="text-uppercase text-white">¿Desea vender o alquilar su propiedad?</h2>
                    <p class="text-white">Le ayudaremos con los mejores y más cómodos servicios inmobiliarios.
                    </p>

                </div>
                <div class="col-lg-3">
                    <a href="#" class="btn btn-light text-uppercase ">solicitar cotización
                        <i class="fa fa-angle-right ml-3 arrow-btn "></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- END CALL TO ACTION -->

    <!-- Footer  -->
    <footer>
        <div class="wrapper__footer bg-theme-footer">
            <div class="container">
                <div class="row">
                    <!-- ADDRESS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <figure>
                                <img src="images/logo-blue.png" alt="" class="logo-footer">
                            </figure>
                            <p>
                                Rethouse Real Estate is a premium Property template based on Bootstrap 4. Rethouse Real
                                Estate helped thousands of clients to find the right property for their needs.

                            </p>

                            <ul class="list-unstyled mb-0 mt-3">
                                <li> <b> <i class="fa fa-map-marker"></i></b><span>214 West Arnold St. New York, NY
                                        10002</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(123) 345-6789</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(+100) 123 456 7890</span> </li>
                                <li> <b><i class="fa fa-headphones"></i></b><span>support@realvilla.demo</span> </li>
                                <li> <b><i class="fa fa-clock-o"></i></b><span>Mon - Sun / 9:00AM - 8:00PM</span> </li>
                            </ul>
                        </div>

                    </div>
                    <!-- END ADDRESS -->

                    <!-- QUICK LINKS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <h4 class="footer-title">Quick Links</h4>
                            <div class="link__category-two-column">
                                <ul class="list-unstyled ">
                                    <li class="list-inline-item">
                                        <a href="#">Commercial</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">business</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">House</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Residential</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Residential Tower</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Beverly Hills</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Los angeles</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">The beach</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Property Listing</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Clasic</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Modern Home</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Luxury</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Beach Pasadena</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END QUICK LINKS -->


                    <!-- NEWSLETTERS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <h4 class="footer-title">follow us </h4>
                            <p class="mb-2">
                                Follow us and stay in touch to get the latest news
                            </p>
                            <p>
                                <button class="btn btn-social btn-social-o facebook mr-1">
                                    <i class="fa fa-facebook-f"></i>
                                </button>
                                <button class="btn btn-social btn-social-o twitter mr-1">
                                    <i class="fa fa-twitter"></i>
                                </button>

                                <button class="btn btn-social btn-social-o linkedin mr-1">
                                    <i class="fa fa-linkedin"></i>
                                </button>
                                <button class="btn btn-social btn-social-o instagram mr-1">
                                    <i class="fa fa-instagram"></i>
                                </button>

                                <button class="btn btn-social btn-social-o youtube mr-1">
                                    <i class="fa fa-youtube"></i>
                                </button>
                            </p>
                            <br>
                            <h4 class="footer-title">newsletter</h4>
                            <!-- Form Newsletter -->
                            <div class="widget__form-newsletter ">
                                <p>

                                    Don’t miss to subscribe to our news feeds, kindly fill the form below
                                </p>
                                <div class="mt-3">
                                    <input type="text" class="form-control mb-2" placeholder="Your email address">

                                    <button class="btn btn-primary btn-block text-capitalize" type="button">subscribe

                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END NEWSLETTER -->
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg__footer-bottom-v1">
            <div class="container">
                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-6">
                        <span>
                            © 2020 Rethouse Real Estate - Premium real estate & theme &amp; theme by
                            <a href="#">retenvi.com</a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline ">
                            <li class="list-inline-item">
                                <a href="#">
                                    privacy
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    contact
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    about
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    faq
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer  -->
    </footer>



    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="./js/index.bundle.js?8918068d71def746395d"></script>
</body>

</html>