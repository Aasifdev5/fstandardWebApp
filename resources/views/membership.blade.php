@extends('master')
@section('title')
    {{ __('Single Product') }}
@endsection
@section('content')
<div class="pages-hero">
    <div class="pages-hero-diagonal"></div>
    <div class="container">
        <div class="pages-title">
            <h1>Single Product</h1>
            <p>Shopping with style</p>
        </div>
    </div>
</div>
    <!-- CONTENT START -->
    <section>
        <div class="container mt-5 mb-4">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <!-- PRODUCT CAROUSEL START -->
                        <div class="col-md-6">
                            <div class="item-carousel">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{ asset('images/commons/product-1.jpg') }}"
                                                alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('images/commons/product-5.jpg') }}"
                                                alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset('images/commons/product-2.jpg') }}"
                                                alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    <div class="item-thumbs pt-4">
                                        <div class="row carousel-indicators">
                                            <div class="col-4 item">
                                                <img src="{{ asset('images/commons/product-1.jpg') }}" class="img-fluid"
                                                    data-target="#carouselExampleIndicators" alt="" data-slide-to="0" />
                                            </div>
                                            <div class="col-4 item">
                                                <img src="{{ asset('images/commons/product-5.jpg') }}" class="img-fluid"
                                                    data-target="#carouselExampleIndicators"  alt="" data-slide-to="1" />
                                            </div>
                                            <div class="col-4 item">
                                                <img src="{{ asset('images/commons/product-2.jpg') }}" class="img-fluid"
                                                    data-target="#carouselExampleIndicators" alt="" data-slide-to="2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUCT CAROUSEL END -->

                        <!-- PRODUCT DESCRIPTION START -->
                        <div class="col-md-6 spacing-md">
                            <div class="item-description">
                                <h6>Power Drill</h6>
                                <h2>Power Tool Lithium Ion Cordless Drill</h2>
                                <div class="item-review">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                        <li class="review-count">(3 reviews)</li>
                                    </ul>
                                </div>
                                <hr class="item-description">
                                <p class="item-full-description">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium, totam rem aperiam,
                                    eaque ipsa quae ab illo inventore veritatis.
                                </p>
                                <h3 class="price">$360.00 </h3>
                                <p class="stock-layer">In Stock</p>

                                <div class="item-order-layer d-flex justify-content-start">
                                    <div class="order-qty">
                                        <input type="number" id="count" min="1" max="1000" value="1" class="number">
                                    </div>
                                    <button class="btn btn-default" type="submit">Add to cart</button>
                                </div>
                                <hr class="item-description">
                                <ul class="share-layer">
                                    <li>Share</li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- PRODUCT DESCRIPTION END -->
                    </div>

                    <div class="more-information default-tabs mt-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="specifications-tab" data-bs-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">Specifications</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active custom-tab-pane" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <h4>Description</h4>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have
                                        suffered alteration
                                        in some form, by injected humour, or randomised words which don't look even
                                        slightly
                                        believable.</p>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a
                                        page when looking at its layout.
                                        The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                                        of letters,
                                        as opposed to using 'Content here, content here'</p>
                            </div>
                            <div class="tab-pane fade custom-tab-pane" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                                <h4>Technical Details</h4>
                                    <table>
                                        <tr>
                                            <td>Brand Name. </td>
                                            <td class="justified">Kronos</td>
                                        </tr>
                                        <tr>
                                            <td>Operating System </td>
                                            <td class="justified">Drill</td>
                                        </tr>
                                        <tr>
                                            <td>Item Weight</td>
                                            <td class="justified">5.2 pounds</td>
                                        </tr>
                                        <tr>
                                            <td>Product Dimensions</td>
                                            <td class="justified">13 x 3 x 2.4 inches</td>
                                        </tr>
                                        <tr>
                                            <td>Item Dimensions L x W x H</td>
                                            <td class="justified">13 x 3 x 2.4 inches</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td class="justified">Space Gray Aluminum Case, Gray Sport Band</td>
                                        </tr>
                                    </table>
                            </div>
                            <div class="tab-pane fade custom-tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="row">
                                    <div class="col-md-9">
                                        <ul class="list-unstyled item-opinion-layer">
                                            <li class="media">
                                                <img src="{{ asset('images/commons/avatar-1.jpg') }}" class="customer-avatar"
                                                    alt="...">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">Sara Smith</h5>
                                                    <h6>Marketing Director</h6>
                                                    <ul class="customer-review">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star-half-alt"></i></li>
                                                    </ul>
                                                    <p>Reader will be distracted by the readable content of a page
                                                        when looking at its layout. The point of using Lorem Ipsum
                                                        is that it.</p>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img src="{{ asset('images/commons/avatar2.jpg') }}" class="customer-avatar"
                                                    alt="...">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">Lorena Jones</h5>
                                                    <h6>Web Designer</h6>
                                                    <ul class="customer-review">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star-half-alt"></i></li>
                                                    </ul>
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit
                                                        voluptatem accusantium doloremque laudantium, totam rem
                                                        aperiam, eaque ipsa quae.</p>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img src="{{ asset('images/commons/avatar3.jpg') }}" class="customer-avatar"
                                                    alt="...">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">Mario Johnson</h5>
                                                    <h6>Construction Engineer</h6>
                                                    <ul class="customer-review">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star-half-alt"></i></li>
                                                    </ul>
                                                    <p>Denouncing pleasure and praising pain was born and I will
                                                        give you a complete account of the system, and expound the
                                                        actual teachings.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>




                </div>

                <!-- PRODUCT SIDEBAR START -->
                <div class="col-lg-3 spacing-md">
                    <aside>
                        <div class="aside-block">
                            <div class="form-group blog-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <ul class="list-unstyled related-products">
                                <li class="media">
                                    <a href="#"><img src="{{ asset('images/commons/product-1.jpg') }}" class="mr-3" alt="..."> </a>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1"><a href="#">Power Cordless Rotary Tool Blue</a></h5>
                                        <p>$190.00</p>
                                    </div>
                                </li>
                                <li class="media center-media">
                                    <a href="#"><img src="{{ asset('images/commons/product-2.jpg') }}" class="mr-3" alt="..."> </a>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1"><a href="#">Power Tire Inflator Air Compressor</a></h5>
                                        <p>$230.00</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#"><img src="{{ asset('images/commons/product-3.jpg') }}" class="mr-3" alt="..."> </a>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1"><a href="#">Vacuum Cleaner 2 in 1 Handheld</a></h5>
                                        <p>$190.00</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="inner-aside mt-4">
                            <figure class="promo-banner">
                                <img src="{{ asset('images/commons/banner.jpg') }}" alt="">
                            </figure>
                        </div>
                    </aside>
                </div>
                <!-- PRODUCT SIDEBAR END -->
            </div>
        </div>

        <!-- POPULAR PRODUCTS CAROUSEL START -->
        <div class="container mt-4 mb-5">
            <div class="popular-product-header">
                <h3>POPULAR <span>PRODUCTS</span></h3>
                <hr>
            </div>
            <div class="products-carousel">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="item-box">
                            <figure class="product-img">
                                <a href="#"><img src="{{ asset('images/commons/product-1.jpg') }}" alt=""></a>
                            </figure>
                            <div class="item-caption">
                                <h5>Power Drill</h5>
                                <h4><a href="#">Power Tool Lithium Ion Cordless Drill</a></h4>
                                <div class="item-review">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                        <li class="review-count">(3 reviews)</li>
                                    </ul>
                                </div>
                                <div class="item-bottom">
                                    <div class="item-price">
                                        <h3>$195.00</h3>
                                    </div>
                                    <div class="item-cart">
                                        <figure class="cart-icon">
                                            <a href="#"><img class="default-icon"
                                                    src="{{ asset('images/icons/shopping-cart-default.png') }}" alt=""></a>
                                            <a href="#"><img class="active-icon" src="{{ asset('images/icons/shopping-cart.png') }}"
                                                    alt=""></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-box">
                            <figure class="product-img">
                                <a href="#"><img src="{{ asset('images/commons/product-2.jpg') }}" alt=""></a>
                            </figure>
                            <div class="item-caption">
                                <h5>Mechanics Tools</h5>
                                <h4><a href="#">Power Cordless Rotary Tool Blue</a> </h4>
                                <div class="item-review">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                        <li class="review-count">(3 reviews)</li>
                                    </ul>
                                </div>
                                <div class="item-bottom">
                                    <div class="item-price">
                                        <h3>$210.00</h3>
                                    </div>
                                    <div class="item-cart">
                                        <figure class="cart-icon">
                                            <a href="#"><img class="default-icon"
                                                    src="{{ asset('images/icons/shopping-cart-default.png') }}" alt=""></a>
                                            <a href="#"><img class="active-icon" src="{{ asset('images/icons/shopping-cart.png') }}"
                                                    alt=""></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-box">
                            <figure class="product-img">
                                <a href="#"><img src="{{ asset('images/commons/product-3.jpg') }}" alt=""></a>
                            </figure>
                            <div class="item-caption">
                                <h5>Tool Set</h5>
                                <h4><a href="#">Power Tire Inflator Air Compressor</a> </h4>
                                <div class="item-review">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                        <li class="review-count">(3 reviews)</li>
                                    </ul>
                                </div>
                                <div class="item-bottom">
                                    <div class="item-price">
                                        <h3>$185.00</h3>
                                    </div>
                                    <div class="item-cart">
                                        <figure class="cart-icon">
                                            <a href="#"><img class="default-icon"
                                                    src="{{ asset('images/icons/shopping-cart-default.png') }}" alt=""></a>
                                            <a href="#"><img class="active-icon" src="{{ asset('images/icons/shopping-cart.png') }}"
                                                    alt=""></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-box">
                            <figure class="product-img">
                                <a href="#"><img src="{{ asset('images/commons/product-4.jpg') }}" alt=""></a>
                            </figure>
                            <div class="item-caption">
                                <h5>Mechanics Tools</h5>
                                <h4><a href="#">Vacuum Cleaner 2 in 1 Handheld</a> </h4>
                                <div class="item-review">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                        <li class="review-count">(3 reviews)</li>
                                    </ul>
                                </div>
                                <div class="item-bottom">
                                    <div class="item-price">
                                        <h3>$200.00</h3>
                                    </div>
                                    <div class="item-cart">
                                        <figure class="cart-icon">
                                            <a href="#"><img class="default-icon"
                                                    src="{{ asset('images/icons/shopping-cart-default.png') }}" alt=""></a>
                                            <a href="#"><img class="active-icon" src="{{ asset('images/icons/shopping-cart.png') }}"
                                                    alt=""></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-theme">
                    <div class="owl-controls">
                        <div class="custom-nav owl-nav"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- POPULAR PRODUCTS CAROUSEL END -->
    </section>
    <!-- CONTENT END -->

@endsection
