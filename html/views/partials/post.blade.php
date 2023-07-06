@if($is_comments_page)
  <div class="thing t3 tint-bg-down-2">
@else
  @if($is_last)
    {{-- hx-get="{!! Helpers::get_next_page($data) !!}" hx-select=".list-t3" --}}
    <section class="thing t3 tint-bg-down-2 {{ $data['over_18'] ? 'is-nsfw' : '' }}" hx-on="click: window.location.href='{{ Helpers::get_base_url() }}{{ $data['permalink'] }}'" hx-get="{!! Helpers::get_next_page($value['data']) !!}" hx-trigger="intersect once" hx-select=".list-t3 .thing" hx-swap="afterend" hx-indicator=".loading-indicator">
  @else
    <section class="thing t3 tint-bg-down-2 {{ $data['over_18'] ? 'is-nsfw' : '' }}" hx-on="click: window.location.href='{{ Helpers::get_base_url() }}{{ $data['permalink'] }}'" >
  @endif
@endif
  <div class="title tint-fg-up-65 ">{{ $data['title'] }}</div>
  @if($is_comments_page && $data['selftext_html'] ?? false)
    <div class="selftext">{!! htmlspecialchars_decode($data['selftext_html']) !!}</div>
  @endif
  @if($picture = Helpers::get_embeddable_picture($data))
    <div class="image" href="{{ $data['url'] }}">
      <img src="{{ $picture['src'] }}" />
    </div>
  @endif
  @if($video = Helpers::get_embeddable_video($data))
    <div class="video" style="background-image:url({{ $video['poster'] }}); background-size: cover;">
      <video style="aspect-ratio: {{ $video['width'] }}/{{ $video['height'] }};" id="video-{{ $data['name'] }}" controls playsinline muted loop></video>
      {{-- <video id="video-{{ $data['name'] }}"></video> --}}
      <script>
        (function(){
          var url = "{{ $video['dash_src'] }}";
          var player = dashjs.MediaPlayer().create();
          player.initialize(document.querySelector("#video-{{ $data['name'] }}"), url, true);
        })();
        //if(Hls.isSupported()) {
        //  var video = document.getElementById('video-{{ $data['name'] }}');
        //  video.style.aspectRatio = '{{ $video['width'] }}/{{ $video['height'] }}';
        //  video.muted = true;
        //  video.poster = '{{ $video['poster'] }}';
        //  video.autoplay = true;
        //  video.playsinline = true;
        //  var hls = new Hls();
        //  hls.loadSource('{{ $video['m3u8_src'] }}');
        //  hls.attachMedia(video);
        //  hls.on(Hls.Events.MANIFEST_PARSED,function() {
        //    video.play();
        //  });
        //}
      </script>
    </div>
  @endif
  @if($data['url'] ?? false)
    <a href="{{$data['url']}}" class="url tint-bg-up-2">
      <div class="url-icon tint-fg-up-35">{!! Helpers::embed('./img/link.svg') !!}</div>
      <div class="url-text tint-fg-up-35">
        <div>
          <span class="tint-fg-up-40">{{ Helpers::get_host($data['url']) }}</span><span class="tint-fg-up-18">{{ Helpers::get_path($data['url']) }}</span>
        </div>
      </div>
      <div class="url-icon tint-fg-up-35">{!! Helpers::embed('./img/chevron-right.svg') !!}</div>
    </a>
  @endif
  <div class="meta">
    <div class="tint-fg-up-35">{!! Helpers::embed('./img/arrow-up.svg') !!} {{ Helpers::formatk($data['ups']) }}</div>
    <div class="tint-fg-up-35">{!! Helpers::embed('./img/message-circle.svg') !!} {{ Helpers::formatk($data['num_comments']) }}</div>
    <div class="tint-fg-up-35">{!! Helpers::embed('./img/clock.svg') !!} {{ Helpers::relative_time($data['created_utc']) }}</div>
  </div>
</section>