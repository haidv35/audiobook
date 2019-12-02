@extends('user.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
@endsection
@section('app-main')
<div class="container" style="margin-top:5rem;overflow:scroll">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-3 d-flex justify-content-center">
                    <a href="#"><img src="{{ $product_info->image }}" alt="" class="img-fluid" style="height:15rem;"></a>
                </div>
                <div class="col-lg-9">
                    <h4>{{ $product_info->title }} gồm: {{ count($product_links) }} phần</h4>
                    @php
                        $product_link = explode('/',parse_url($product_links[0]->content)['path']);
                        if(isset($product_link) && isset($product_link[3])){
                            $product_link = $product_link[3];
                        }
                        else{
                            $product_link = '';
                        }
                    @endphp
                    @if ($product_link != '')
                        <audio id="audio" controls>
                            <source
                                src="https://www.googleapis.com/drive/v3/files/{{ $product_link }}?alt=media&key=AIzaSyAgaMIobc0MLNnfZAHIpY8OgNqsnGExMZ8"
                                type="audio/mp3" />
                        </audio>
                    @endif
                    <ul id="playlist" class="list-group border-top" style="max-height:122px;overflow:scroll">
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($product_links as $item)
                            @php
                                $product_link = explode('/',parse_url($item->content)['path']);
                                if(isset($product_link) && isset($product_link[3])){
                                    $product_link = $product_link[3];
                                }
                                else{
                                    $product_link = '';
                                }
                            @endphp
                            @if ($product_link != '')
                                <li class="active list-group-item">
                                    <a href="https://www.googleapis.com/drive/v3/files/{{ $product_link }}?alt=media&key=AIzaSyAgaMIobc0MLNnfZAHIpY8OgNqsnGExMZ8">{{$item->product->title . " - part " . $counter}}</a>
                                </li>
                            @endif
                            @php
                            $counter++;
                            @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div id="fb-root"></div>
                <div class="fb-comments" data-href="{{ URL::to('/user/purchased/').$product_info->id }}" data-order-by="time" data-width="" data-numposts="10" data-mobile=""></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                @foreach ($recommendProduct as $item)
                <div class="col-lg-12 mt-2">
                    <div href="#" class="list-group-item list-group-item-action" target="_blank">
                        <div class="row">
                            <div class="col-6 ">
                                <div class="list-group-item-figure">
                                    <img src="{{ $item->image}}" alt="" style="height:8rem;width:6em;" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <p data-toggle="tooltip" data-placement="top" title="{{ $item->title }}">{{ $item->title }}</p>
                                </div>
                                <div class="row">
                                    <a name="" id="" class="" href="/product-details/{{ $item->id }}" role="button">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-footer')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=773358413132697&autoLogAppEvents=1"></script>
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
    const player = new Plyr('#audio');
    player.volume = 1;
    player.on("play",function(){
        if(localStorage.plyr == null){
            localStorage.plyr = '{"volume":1,"muted":false,"currentTime":'+player.currentTime+'}'
        }
        else{
            player.currentTime = JSON.parse(localStorage.plyr).currentTime;
            setInterval(function(){
                localStorage.plyr = '{"volume":1,"muted":false,"currentTime":'+player.currentTime+'}'
            },100);
        }
    });

    var audio;
    var playlist;
    var tracks;
    var current;

    init();
    function init() {
        current = 0;
        audio = $('audio');
        playlist = $('#playlist');
        tracks = playlist.find('li a');
        len = tracks.length - 1;
        // audio[0].volume = 1;
        // audio[0].play();
        playlist.find('a').click(function (e) {
            e.preventDefault();
            link = $(this);
            current = link.parent().index();
            run(link, audio[0]);
        });
        audio[0].addEventListener('ended', function (e) {
            current++;
            if (current == len) {
                current = 0;
                link = playlist.find('a')[0];
            } else {
                link = playlist.find('a')[current];
            }
            run($(link), audio[0]);
        });
    }
    function run(link, player) {
        player.src = link.attr('href');
        par = link.parent();
        par.addClass('active').siblings().removeClass('active');
        audio[0].load();
        audio[0].play();
    }
</script>
@endsection
