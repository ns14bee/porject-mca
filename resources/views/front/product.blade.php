@include('front.layout.header')
<style>
.imgproduct img {
	display: inline-block;
	max-width: 100%;
	height: 520px!important;
}
.selectimgproduct img {
	display: inline-block;
	max-width: 100%;
	height: 410px!important;
}
</style>
<section class="breadcrumbs-custom bg-image context-dark"
    style="background-image: url(front/images/breadcrumbs-image-1.jpg);">
    <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
                <h6 class="breadcrumbs-custom-subtitle title-decorated">Pages</h6>
                <h1 class="breadcrumbs-custom-title">Product</h1>
            </div>
        </div>
    </div>
</section>
<section class="section section-md section-wave-offset">

    @if(isset($product_datas))
        @foreach($product_datas as $key=>$product_data)
            <br>
            <div class="container">
                <h6 style="color:#000;"><b>{{$product_data->name}}</b></h6>
                <div class="row row-50 justify-content-lg-between flex-lg-row-reverse offset-top-1">
                <div class="col-lg-7 col-xl-6">
                    <h4 class="wow-outer"><span class="wow slideInDown">Product Price : <div class="button button-sm button-primary-outline button-winona"><div class="content-original">Get Latest Price</div><div class="content-dubbed">Get Latest Price</div></div></span></h4>
                    <!-- Bootstrap collapse-->
                    <div class="card-group-custom card-group-corporate wow-outer" id="accordion{{$product_data->id}}" role="tablist" aria-multiselectable="false">
                        <!-- Bootstrap card-->
                        <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".05s">
                            <div class="card-header" id="accordion{{$product_data->id}}-heading-1" role="tab">
                                <div class="card-title"><a role="button" data-toggle="collapse" data-parent="#accordion{{$product_data->id}}" href="#accordion{{$product_data->id}}-collapse-1" aria-controls="accordion{{$product_data->id}}-collapse-1" aria-expanded="true">Product Details :
                                    <div class="card-arrow"></div></a></div>
                            </div>
                            <div class="collapse show" id="accordion{{$product_data->id}}-collapse-1" role="tabpanel" aria-labelledby="accordion{{$product_data->id}}-heading-1">
                                <div class="card-body">
                                    <p>Installation Type: {{$product_data->installation_type}}</p>
                                    <p>Industry: {{$product_data->industry}}</p>
                                    <p>Water Source: {{$product_data->water_source}}</p>
                                    <p>Product Range: {{$product_data->product_range}}</p>
                                    <p>Frequency: {{$product_data->frequency}}</p>
                                    <p>Power Source: {{$product_data->power_source}}</p>
                                </div>
                            </div>
                            </article>
                            <!-- Bootstrap card-->
                            <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".1s">
                            <div class="card-header" id="accordion{{$product_data->id}}-heading-2" role="tab">
                                <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion{{$product_data->id}}" href="#accordion{{$product_data->id}}-collapse-2" aria-controls="accordion{{$product_data->id}}-collapse-2" aria-expanded="false">Product Description :
                                    <div class="card-arrow"></div></a></div>
                            </div>
                            <div class="collapse" id="accordion{{$product_data->id}}-collapse-2" role="tabpanel" aria-labelledby="accordion{{$product_data->id}}-heading-2">
                                <div class="card-body">
                                <p>{{$product_data->description}}</p>
                                </div>
                            </div>
                        </article>
                        <div class="button button-lg button-primary button-winona"><div class="content-original" data-toggle="modal" data-target="#myModal<?php echo $product_data->id ?>">Yes! I am Interested</div><div class="content-dubbed" data-toggle="modal" data-target="#myModal<?php echo $product_data->id ?>">Yes! I am Interested</div></div>
                        <!-- Bootstrap card-->
                    </div>
                </div>
                <div class="col-lg-5 wow-outer imgproduct">
                    <img class="wow slideInLeft" src="<?php $image_data = App\Helpers\Helper::displayProductPath().$product_data->image; echo $image_data;?>" alt="{{$product_data->image}}" width="470"/>
                </div>
                </div>
            </div>            
            <div class="modal video-modal fade" id="myModal<?php echo $product_data->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModal<?php echo $product_data->id ?>">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" style="overflow-y: auto; overflow-x:hidden;">
                        <section>
                            <div class="modal-body row" id="add_cart_modal">
                                <div class="col-md-5 modal_body_left selectimgproduct">
                                    <img height="300" src="<?php $image_data = App\Helpers\Helper::displayProductPath().$product_data->image; echo $image_data;?>" alt="{{$product_data->image}}" width="470" id="modal_cart_img" class="wow slideInLeft"/>
                                    <div class="card-body">
                                        <span style="font-size: 13.5px!important;color:#000;">Installation Type: {{$product_data->installation_type}}</span><br>
                                        <span style="font-size: 13.5px!important;color:#000;">Industry: {{$product_data->industry}}</span><br>
                                        <span style="font-size: 13.5px!important;color:#000;">Water Source: {{$product_data->water_source}}</span><br>
                                        <span style="font-size: 13.5px!important;color:#000;">Product Range: {{$product_data->product_range}}</span><br>
                                        <span style="font-size: 13.5px!important;color:#000;">Frequency: {{$product_data->frequency}}</span>
                                    </div>
                                </div>
                                <div class="col-md-7 modal_body_right">
                                    <h4>{{$product_data->name}}</h4>
                                    <p>Ask Price by adding a few details of your requirement</p>
                                    <hr>
                                    <div class="modal_body_right_cart simpleCart_shelfItem">
                                        <form action="{{route('front.product.mail', [$product_data->id])}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="item_name" value="{{$product_data->name}}">  
                                            <input type="hidden" name="iteam_frequency" value="{{$product_data->frequency}}">
                                            <input type="hidden" name="iteam_price" value="{{$product_data->price}}">
                                            <div  class="md-5">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Why Do you need this:</label><br>
                                                        <input type="radio" id="why_do_need" name="why_do_need" checked> For selling
                                                        <input type="radio" id="why_do_need" name="why_do_need"> For business Use
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Industry:</label><br>
                                                        <input type="checkbox" id="why_industry" name="why_industry[] " value="Sugar Industry"> Sugar Industry
                                                        <input type="checkbox" id="why_industry" name="why_industry[]" value="Daily Industry"> Daily Industry
                                                        <input type="checkbox" id="why_industry" name="why_industry[]" value="other" > other
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>End use of Treated Wate:</label><br>
                                                        <input type="checkbox" id="end_use_treated_wate" name="end_use_treated_wate[]" value="Landscape Irrigation"> Landscape Irrigation 
                                                        <input type="checkbox" id="end_use_treated_wate" name="end_use_treated_wate[]" value="Discharge to Sewer"> Discharge to Sewer
                                                        <input type="checkbox" id="end_use_treated_wate" name="end_use_treated_wate[]" value="other" > other
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email Address:</label><br>
                                                        <input type="email" class="form-control" id="email_product" name="email_product" placeholder="Enter Email" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Contact Number:</label><br>
                                                        <input type="text" class="form-control" id="contact_product" name="contact_product" placeholder="+91 9090909090" pattern="[789][0-9]{9}" required/>
                                                        <small>Enter number only</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Requirement Details:</label><br>
                                                        <textarea class="form-control" id="reminder_details" name="reminder_details" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right!important;">Close</button>
                                            <button type="submit" value="Submit" name="submit" id="submit_btn" class="btn" style="float: right!important;margin-right:5px;">Submit</button>
                                        </form>
                                    </div>
                                    <br>
                                    <div style="padding-top:30px;"></div>
                                    <hr>
                                    <p>Your Contact Information: <a class="link-default" href="tel:079-25624472">079-25624472</a></p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        @endforeach
      <div class="container">  
        {{ $product_datas->links('pagination::bootstrap-4') }}
      </div>
    @endif

</section>
@include('front.layout.footer')