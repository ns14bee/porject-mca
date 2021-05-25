@include('front.layout.header')
<section class="breadcrumbs-custom bg-image context-dark"
    style="background-image: url(front/images/breadcrumbs-image-1.jpg);">
    <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
                <h6 class="breadcrumbs-custom-subtitle title-decorated">Pages</h6>
                <h1 class="breadcrumbs-custom-title">About Us</h1>
            </div>
        </div>
    </div>
</section>
<!-- Overview-->
<section class="section section-lg-custom">
    <div class="container">
        <div class="row row-50 justify-content-center justify-content-lg-between">
            <div class="col-md-10 col-lg-6 column-ethereal">
                <h3>Overview</h3>
                <h4 class="offset-top-3">AWMS also provides Swimming Pool Filtration system</h4>
                <p>Apurva Water Manangement Systems Pvt. Ltd. established in the year 2000 provides complete water
                    solution. AWMS has mastered itself in the field of designing, manufacturing, engineering and
                    provides complete solution to any problem related to the water. We pride ourselves by being known by
                    our customers for quality, reliability, assurance and reputed partners for innovation and complex
                    engineering.</p>
                <!-- <p>we also provide Reverse Osmosis plants, Softeners and filters etc. & complete service to the existing water treatment systems along with the complete solutions to the persisting problems that includes supply of spares, chemicals, consumables, RO membranes for WTP along with AMC and O&M contracts. AWMS high tech RO system brings you the water in its purest & safest form.</p> -->
                <div class="group group-middle"><a class="button button-primary-outline button-winona" href="{{route('front.contact')}}">Let's Contact</a></div>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-5 align-self-end"><img class="img-responsive"
                    src="{{ url('front/images/images-about-01-510x482.jpg')}}" alt="" width="510" height="482">
            </div>
        </div>
    </div>
</section>
<section class="section section-lg bg-gray-100 section-wave-offset" id="our-history">
    <div class="container">
        <!-- Timeline Classic-->
        <article class="timeline-classic">
            <div class="timeline-classic-item">
                <div class="timeline-classic-item-aside"><img class="timeline-classic-item-image"
                        src="{{ url('front/images/images-timeline-1-390x250.png')}}" alt="" width="390" height="250">
                </div>
                <div class="timeline-classic-item-divider"></div>
                <div class="timeline-classic-item-main">
                    <p class="timeline-classic-item-title">Mission & Vision</p>
                    <p class="thumbnail-classic-item-subtitle">Apurva Water Management System  Pvt. Ltd.is dedicated to satisfy water related needs of customer by providing most economical & technical solutions, products & services through our qualified & efficient professionals.</p>
                    <p>We wish to be the most valued & respected company in the field of water sector with efficient performance by maintaining higher ethical standards.</p>
                </div>
            </div>
            <div class="timeline-classic-item">
                <div class="timeline-classic-item-aside"><img class="timeline-classic-item-image"
                        src="{{ url('front/images/images-timeline-2-390x250.png')}}" alt="" width="390" height="250">
                </div>
                <div class="timeline-classic-item-divider"></div>
                <div class="timeline-classic-item-main">
                    <p class="timeline-classic-item-title">Core Values</p>
                    <p class="thumbnail-classic-item-subtitle">Apurva Water Management System  Pvt. Ltd.will seek to go through:</p>
                    <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Continuosly upgrading knowledge.</p>
                    <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Excellent product quality & services.</p>
                    <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Responsible approach to the business.</p>
                    <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Continuosly upgrading knowledge.</p>
                    <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Complete satisfaction of our clients, employees & vendors.</p>
                </div>
            </div>
        </article>
    </div>
</section>
@include('front.layout.footer')