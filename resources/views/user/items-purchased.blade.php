@extends('user.layouts.app')
@section('custom-header')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
@endsection
@section('app-main')
<div class="container" style="margin-top:5rem;overflow:scroll">
    <div class="row justify-content-center">
        <div class="col-lg-3 d-flex justify-content-center">
            <a href="#"><img src="{{ $product_info->image }}" alt="" class="img-fluid" style="height:15rem;"></a>
        </div>
        <div class="col-lg-5 align-self-end">
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
            <ul id="playlist" class="list-group border-top">
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
</div>

@endsection
@section('custom-footer')
<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
<script>
    const player = new Plyr('#audio');
    player.on('play',function(){
        player.currentTime = JSON.parse(localStorage.plyr).currentTime;
        setInterval(function(){
            localStorage.plyr = '{"volume":0.99,"muted":false,"currentTime":'+player.currentTime+'}'
        },100);
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
        audio[0].volume = 1;
        audio[0].play();
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
