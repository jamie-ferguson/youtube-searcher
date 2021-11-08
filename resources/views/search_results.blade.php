@foreach ($data['videos'] as $video)
    <p>
        <a target="_blank" href="{{ $video['url'] }}">{{ $video['title'] }}</a><br>
        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}">
    </p>
@endforeach

@if ($data['prevPageToken'])
    <input type="button" class="submit" id="prevLink" data-token="{{ $data['prevPageToken'] }}" value="Previous" />
@endif

@if ($data['nextPageToken'])
    <input type="button" class="submit" id="nextLink" data-token="{{ $data['nextPageToken'] }}" value="Next" />
@endif
