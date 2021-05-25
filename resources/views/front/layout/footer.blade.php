<!-- Page Footer-->
<footer class="section footer-standard bg-gray-modern">
    <div class="section-wave">
        <svg x="0px" y="0px" viewbox="0 0 1920 45" width="1920" height="45px" preserveaspectratio="none">
            <style type="text/css"></style>
            <path
                d="M1920,0c-82.8,0-108.8,44.4-192,44.4c-78.8,0-116.5-43.7-192-43.7c-77.1,0-115.9,44.4-192,44.4c-78.2,0-114.6-44.4-192-44.4c-78.4,0-115.3,44.4-192,44.4C883.1,45,841,0.6,768,0.6C691,0.6,652.8,45,576,45C502.4,45,461.9,0.6,385,0.6C306.5,0.6,267.9,45,191,45C115.1,45,78,0.6,0,0.6V45h1920V0z">
            </path>
        </svg>
    </div>
    <div class="footer-standard-main">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-4">
                    <div class="inset-right-1">
                        <h4>About Us</h4>
                        <p style="text-align: justify;">Apurva Water Manangement Systems Pvt. Ltd. established in the year 2000 provides complete water solution. AWMS has mastered itself in the field of designing, manufacturing, engineering and provides complete solution to any problem related to the water. We pride ourselves by being known by our customers for quality, reliability, assurance and reputed partners for innovation and complex engineering.</p>
                    </div>
                    <div class="group group-xs group-middle">
                        <a class="icon icon-sm icon-creative fab fa-facebook" href="#"></a>
                        <a class="icon icon-sm icon-creative fab fa-twitter" href="#"></a>
                        <a class="icon icon-sm icon-creative fab fa-instagram" href="#"></a>
                        <a class="icon icon-sm icon-creative fab fa-google" href="#"></a>
                        <a class="icon icon-sm icon-creative fab fa-linkedin" href="#"></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4">
                    <div class="box-1">
                        <h4>Contact Information</h4>
                        <ul class="list-sm list-footer">
                            <li class="object-inline"><span
                                    class="fa fa-map-marker"></span><a class="link-default"
                                    href="#">403, Sahajanand Complex, Shahibaug, Ahmedabad,<br> Gujarat, India -380004</a></li>
                            <li class="object-inline">
                                <span class="fa fa-mobile"></span>
                                <a class="link-default" href="tel:079-25624472">079-25624472 </a>/<a style="margin-left: 0px!important;" href="tel:079-25622434">079-25622434</a>
                            </li>
                            <li class="object-inline"><span class="fa fa-address-card"></span>
                                <a class="link-default" href="mailto:info@apurvawater.com">info@apurvawater.com</a>
                            </li>
                            <li class="object-inline" style="margin-top: 1px!important;"><span></span>
                                <a href="mailto:mkt@apurvawater.com">mkt@apurvawater.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-7 col-lg-4">
                    <form action="{{ route('front.contact.inqury') }}" method="post" class="rd-form rd-mailform form-inline" data-form-output="form-output-global"
                        data-form-type="subscribe">
                        {{ csrf_field() }}
                        <div class="form-wrap">
                            <input class="form-input" id="subscribe-form-2-name" type="name" name="name"
                                data-constraints="@Name @Required" placeholder="Enter Name" required>
                            <!-- <label class="form-label" for="subscribe-form-2-email">Name</label> -->
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="subscribe-form-2-email" type="email" name="email"
                                data-constraints="@Email @Required" placeholder="Enter Email" required>
                            <!-- <label class="form-label" for="subscribe-form-2-email">E-mail</label> -->
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="subscribe-form-2-subject" type="text" name="phone"
                                data-constraints="@Subject @Required" placeholder="Enter Phone" required>
                            <!-- <label class="form-label" for="subscribe-form-2-subject">Subject</label> -->
                        </div>
                        <div class="form-wrap">
                            <textarea class="form-input" id="subscribe-form-2-message" name="details"
                                data-constraints="@Details @Required" placeholder="Enter Message" required></textarea>
                            <!-- <label class="form-label" for="subscribe-form-2-message">Message</label> -->
                        </div>
                        <div class="form-wrap" style="text-align: right!important;">
                            <button class="button button-primary button-icon button-icon-only button-winona"
                                type="submit" aria-label="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        
        <div class="footer-standard-aside justify-content-center">
            <!-- Rights-->
            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>All
                    Rights Reserved.</span><span>&nbsp;</span><br class="d-sm-none"><Span>| Developed by </Span><a href="https://einzigartige.com/">Einzigartige</a></p>
        </div>
    </div>
</footer>
</div>
<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-container">
            <div class="cssload-double-torus"></div>
        </div>
    </div>
</div>
<div class="modal modal-custom fade" id="call-form">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Request a Callback</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <p>Please leave your phone number in the field below and we will call you back soon.</p>
                <form class="rd-form rd-mailform form-inline form-inline-custom" data-form-output="form-output-global"
                    data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                    <div class="form-wrap">
                        <input class="form-input" id="header-phone" type="text" name="phone"
                            data-constraints="@Numeric">
                        <label class="form-label" for="header-phone">Phone</label>
                    </div>
                    <div class="form-button">
                        <button class="button button-primary button-icon button-icon-only button-winona" type="submit"
                            aria-label="submit"><span class="icon mdi mdi-phone-in-talk"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ url('front/js/core.min.js')}}"></script>
<script src="{{ url('front/js/script.js')}}"></script>
</body>
</html>