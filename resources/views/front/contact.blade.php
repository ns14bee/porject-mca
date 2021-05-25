@include('front.layout.header')
<!-- Breadcrumbs -->
<section class="breadcrumbs-custom bg-image context-dark"
    style="background-image: url(front/images/breadcrumbs-image-1.jpg);">
    <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
                <h6 class="breadcrumbs-custom-subtitle title-decorated">Contacts</h6>
                <h1 class="breadcrumbs-custom-title">Contacts</h1>
            </div>
        </div>
    </div>
</section>
<section class="section section-sm">
    <div class="container">
        <div class="layout-bordered" style="text-align: inherit!important;">
            <div class="layout-bordered-item wow-outer">
                <div class="layout-bordered-item-inner wow slideInUp">
                    <div class="icon icon-lg fa fa-mobile text-primary"></div>
                    <ul class="list-0">
                        <li><a class="link-default" href="tel:079-25624472">079-25624472</a></li>
                        <li><a class="link-default" href="tel:079-25622434">079-25622434</a></li>
                    </ul>
                </div>
            </div>
            <div class="layout-bordered-item wow-outer">
                <div class="layout-bordered-item-inner wow slideInUp">
                    <div class="icon icon-lg fa fa-address-card text-primary"></div>
                    <ul class="list-0">
                        <li><a class="link-default" href="mailto:info@apurvawater.com">info@apurvawater.com</a></li>
                        <li><a class="link-default" href="mailto:mkt@apurvawater.com">mkt@apurvawater.com</a></li>
                    </ul>                    
                </div>
            </div>
            <div class="layout-bordered-item wow-outer">
                <div class="layout-bordered-item-inner wow slideInUp">
                    <div class="icon icon-lg fa fa-map-marker text-primary"></div><a class="link-default"
                        href="#">403, Sahajanand Complex, Shahibaug, Ahmedabad,  Gujarat, India -380004</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-gray-100">
    <div class="range justify-content-xl-between">
        <div class="cell-xl-6 align-self-center container">
            <div class="row">
                <div class="col-lg-9 cell-inner">
                    <div class="section-lg">
                        <h3 class="wow-outer"><span class="wow slideInDown">Contact Us</span></h3>
                        <!-- RD Mailform-->
                        <form action="{{ route('front.contact.inqury') }}" method="post" class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact">
                        {{ csrf_field() }}
                            <div class="row row-10">
                                <div class="col-12 wow-outer">
                                    <div class="form-wrap wow fadeSlideInUp">
                                        <label class="form-label-outside" for="name">Full Name</label>
                                        <input class="form-input" id="name" type="text" name="name"
                                        placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 wow-outer">
                                    <div class="form-wrap wow fadeSlideInUp">
                                        <label class="form-label-outside" for="email">E-mail</label>
                                        <input class="form-input" id="email" type="email" name="email"
                                        placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 wow-outer">
                                    <div class="form-wrap wow fadeSlideInUp">
                                        <label class="form-label-outside" for="phone">Phone</label>
                                        <input class="form-input" id="phone" type="text" name="phone"
                                        placeholder="Enter Phone" required>
                                    </div>
                                </div>
                                <div class="col-12 wow-outer">
                                    <div class="form-wrap wow fadeSlideInUp">
                                        <label class="form-label-outside" for="details">Your Message</label>
                                        <textarea class="form-input" id="details" name="details"
                                        placeholder="Enter Message" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="group group-middle">
                                <div class="wow-outer">
                                    <button class="button button-primary button-winona wow slideInRight"
                                        type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="cell-xl-5 height-fill wow fadeIn" style="padding-top:90px;height:510px;width:450px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14686.34420232038!2d72.58752443014897!3d23.038966459114526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e840c95555555%3A0xb010179073ce617c!2sApurva%20Water%20Management%20Systems!5e0!3m2!1sen!2sin!4v1619377291643!5m2!1sen!2sin" width="400" height="100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>
@include('front.layout.footer')