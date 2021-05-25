@include('front.layout.header')
<section class="section swiper-container swiper-slider swiper-slider-business bg-gray-700" data-loop="true"
    data-slide-effect="fade" data-autoplay="5000" data-simulate-touch="false"
    data-custom-slide-effect="inter-leave-effect">
    <div class="swiper-wrapper context-dark">
        <div class="swiper-slide" data-slide-bg="{{ url('front/images/slider-business-slide-1-1920x800.jpg')}}">
            <div class="slide-inner">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <h3 class="wow-outer"><span class="wow" data-caption-animate="slideInDown"><span class="big" style="font-size: 30px!important;" >Swimming Pool Filtration Plants</span></span></h3>
                        <div class="swiper-caption-text-sm swiper-caption-wrap">
                            <div class="swiper-caption-text-inner">
                                <p class="text-op-gentle wow" data-caption-animate="slideInLeft">AWMS is a Water-Business Corporation, Headquarter in Ahmedabad, India. We at Apurva manage the Water since 15 Years to give the Value Added Services</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide" data-slide-bg="{{ url('front/images/slider-business-slide-2-1920x800.jpg')}}">
            <div class="slide-inner">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <h3 class="wow-outer"><span class="wow" data-caption-animate="slideInDown"><span class="big" style="font-size: 30px!important;">Purified Water Generation & Storage Distribution</span></span></h3>
                        <div class="swiper-caption-text-sm swiper-caption-wrap">
                            <div class="swiper-caption-text-inner">
                                <p class="text-op-gentle wow" data-caption-animate="slideInLeft">The purified water is prepared by purified water generation system (Reverse Osmosis System) and collected in purified water storage tank of required capacity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- A Few Words About Us-->
<section class="section section-md">
    <div class="section-wave section-wave-white">
        <svg x="0px" y="0px" viewbox="0 0 1920 45" width="1920" height="45px" preserveaspectratio="none">
            <style type="text/css"></style>
            <path
                d="M1920,0c-82.8,0-108.8,44.4-192,44.4c-78.8,0-116.5-43.7-192-43.7c-77.1,0-115.9,44.4-192,44.4c-78.2,0-114.6-44.4-192-44.4c-78.4,0-115.3,44.4-192,44.4C883.1,45,841,0.6,768,0.6C691,0.6,652.8,45,576,45C502.4,45,461.9,0.6,385,0.6C306.5,0.6,267.9,45,191,45C115.1,45,78,0.6,0,0.6V45h1920V0z">
            </path>
        </svg>
    </div>
    <div class="container">
        <div
            class="row row-50 justify-content-center justify-content-xl-between flex-xl-row-reverse text-center text-xl-left">
            <div class="col-lg-6 col-xl-5">
                <div class="inset-right-3">
                    <h4 class="wow-outer"><span class="wow slideInDown">AWMS Service</span></h4>
                    <p class="text-op-amaranthine wow-outer"><span class="wow slideInDown" data-wow-delay=".05s">AWMS provides various types of services for the plants such as Annual and Maintenance Contract, Operation and Maintenance Contract, Complete servicing of the plant, Optimizing the overall operating cost of producing the water</span></p>
                </div><br><br>
                <div class="inset-right-3">
                    <h4 class="wow-outer"><span class="wow slideInDown">AWMS Supplies</span></h4>
                    <p class="text-op-amaranthine wow-outer"><span class="wow slideInDown" data-wow-delay=".05s">AWMS provides many supplies which can be utilized for the prodution of the water and related equipments. The various types of supplies include spare parts, RO membranes, Chemicals and Consumables.</span></p>
                </div>
            </div>
            <div class="col-lg-7"><img src="{{ url('front/images/index-01-711x429.jpg')}}" alt="" width="711"
                    height="429">
            </div>
        </div>
    </div>
</section>
<section class="section section-lg text-center">
    <div class="container">
        <h3>Application Blog</h3>
        <div class="row row-50 row-xxl-70">
            @if(!empty($blog_data))
                @foreach($blog_data as $key=>$blog_datas)
                <div class="col-md-4 scaleFadeInWrap">
                    <!-- Post Modern-->
                    <div class="wow scaleFadeIn">
                        <article class="post-modern"><a class="post-modern-media" href="{{route('front.blog_single',['id' => $blog_datas->id])}}"><img src="<?php echo URL::to('/').'/storage/blog/'.$blog_datas->image; ?>" alt="" width="571" height="353"></a>
                            <h4 class="post-modern-title"><a href="{{route('front.blog_single',['id' => $blog_datas->id])}}">{{$blog_datas->title}}</a></h4>
                            <ul class="post-modern-meta">
                                <li>Publish Date:</li>
                                <li><time datetime="{{$blog_datas->created_at}}">{{$blog_datas->created_at}}</time></li>
                            </ul>
                            <p style="text-align: justify;text-justify: distribute;">{{$blog_datas->description}}</p>
                        </article>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12" style="text-align: -webkit-center;">
                    <div class="col-md-4 scaleFadeInWrap" style="display: inline-grid!important;">
                        <a href="{{route('front.blog')}}" class="button">View More</a>
                    </div>
                </div>
            @else
                <div class="col-md-12 scaleFadeInWrap text-center" style="display: block!important;">
                    <!-- Post Modern-->
                    <p>No data available in application blog</p>
                </div>
            @endif
        </div>
    </div>
</section>

<section class="section section-xl bg-gray-700 bg-image bg-image-1"
    style="background-image: url(front/images/call-to-action-1-1920x584.jpg);">
    <div class="container">
        <div class="row justify-content-sm-end">
            <div class="col-sm-9 col-md-7 col-lg-6">
                <div class="box-6">
                    <div class="wow-outer">
                        <div class="wow slideInUp">
                            <h3 class="font-weight-semibold">AWMS Product</h3>
                        </div>
                    </div>
                    <div class="wow-outer offset-top-4">
                        <div class="wow slideInDown">
                            <p>AWMS provides complete solutions for water related problems and hence provides various products such as purified water generation and distribution system, swimming pool filtration system, ETP,STP and all types of water treatment plants</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg">
    <div class="container" style="margin-left: 300px!important;">
        <div class="row row-50 justify-content-center justify-content-lg-between flex-lg-row-reverse">
            <div class="col-md-10 col-lg-6 col-xl-6"><img class="img-responsive" src="{{ url('front/images/worldmd.png')}}" alt="" width="138" height="197" style="width: 240px;">
            </div>
            <div class="col-md-10 col-lg-6 col-xl-5">
                <h3>A World From M.D.</h3>
                <p>"The ladder to achieve the success is hardwork, persistence, learning and continuous growth. The footprints on sand of time are not made by sitting down."</p><a class="button">ASHWIN GUPTA - Founder and Managing Director</a>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg section-wave-offset">
    <div class="container">
        <h3 class="text-center">Our Client</h3>
        <div class="row" style="margin-top: 100px!important;">
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet01.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet02.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet03.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp second" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet04.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet05.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp second" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet06.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
        </div>
        <div class="row" style="margin-top: 100px!important;">
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet07.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet08.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet09.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp second" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet10.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet11.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
            <div class="col-md-2">
                <article class="card-modern wow fadeInUp second" data-wow-delay=".05s">
                    <div class="card-modern-left"><img src="{{ url('front/images/clinet12.png')}}" alt=""
                            width="138" height="197">
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@include('front.layout.footer')