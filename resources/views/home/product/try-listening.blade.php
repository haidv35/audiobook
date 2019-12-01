<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y-sm">
    <div class="container">
        <h3 class="text-dark">Nghe thử</h3>
        <div class="row ml-3 justify-content-center">
            @foreach ($demoLinks as $item)
                <div class="col-lg-4 py-5 mr-4 d-flex" style="background:#fff">
                    <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url={{ $item->demo_link }}&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ========================= SECTION  END// ========================= -->

