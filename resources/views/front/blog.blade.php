@include('front.layout.header')
<section class="breadcrumbs-custom bg-image context-dark"
    style="background-image: url(front/images/breadcrumbs-image-1.jpg);">
    <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
                <h6 class="breadcrumbs-custom-subtitle title-decorated">Pages</h6>
                <h1 class="breadcrumbs-custom-title">Blog</h1>
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
            @else
                <div class="col-md-12 scaleFadeInWrap text-center" style="display: block!important;">
                    <!-- Post Modern-->
                    <p>No data available in application blog</p>
                </div>
            @endif
        </div>
    </div>
</section>
@include('front.layout.footer')