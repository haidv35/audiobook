<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y-sm">
    <div class="container">
        <h3 class="text-dark">Nghe thử</h3>
        <div class="row ml-3 justify-content-center">
            @foreach ($demoLinks as $item)
                <div class="col-lg-4 py-2 mr-4" style="background:#fff">
                    <div class="row">
                        <div class="col-12">
                            <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url={{ $item->demo_link }}&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{ route('product-details',['id'=>$item->id,'path'=>$item->path])}}">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ========================= SECTION  END// ========================= -->

