@include('front.layout.header')
<section class="breadcrumbs-custom bg-image context-dark"
style="background-image: url('{{ asset('/front/images/breadcrumbs-image-1.jpg') }}');">
 
    <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
                <h6 class="breadcrumbs-custom-subtitle title-decorated">Pages</h6>
                <h3 class="breadcrumbs-custom-title">Blog / {{$blog_data->title}}</h3>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg section-wave-offset">
    <div class="container">
        <div class="row row-50">
        <div class="col-lg-12">
            <article class="post-creative">
            <h3 class="post-creative-title">{{$blog_data->title}}</h3>
            <ul class="post-creative-meta">
                <li><span class="fa fa-calendar"></span>
                <time >{{$blog_data->created_at->format('d-m-Y')}}</time>
                </li>
                <li><span class="fa fa-file"></span><a href="#">News</a></li>
            </ul>
            <img src="<?php echo URL::to('/').'/storage/blog/'.$blog_data->image; ?>" alt="" width="770" height="458">
            <p>{{$blog_data->description}}</p>
            
           
            </article>
           
            <!-- <div class="section-sm section-bottom-0">
            <h3>Send a Comment</h3>
          
            <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                <div class="row row-10">
                <div class="col-md-6">
                    <div class="form-wrap">
                    <label class="form-label-outside" for="comment-first-name">First Name</label>
                    <input class="form-input" id="comment-first-name" type="text" name="name" data-constraints="@Required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-wrap">
                    <label class="form-label-outside" for="comment-last-name">Last Name</label>
                    <input class="form-input" id="comment-last-name" type="text" name="name" data-constraints="@Required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-wrap">
                    <label class="form-label-outside" for="comment-email">E-mail</label>
                    <input class="form-input" id="comment-email" type="email" name="email" data-constraints="@Email @Required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-wrap">
                    <label class="form-label-outside" for="comment-phone">Phone</label>
                    <input class="form-input" id="comment-phone" type="text" name="phone" data-constraints="@PhoneNumber">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-wrap">
                    <label class="form-label-outside" for="comment-message">Your Message</label>
                    <textarea class="form-input" id="comment-message" name="message" data-constraints="@Required"></textarea>
                    </div>
                </div>
                </div>
                <button class="button button-primary button-winona" type="submit">Submit</button>
            </form>
            </div>
        </div>
        </div> -->
    </div>
</section>
@include('front.layout.footer')