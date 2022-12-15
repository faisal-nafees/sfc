@if (@$audio)
  <audio controls {{ $attributes }} style="width:100%">
    <source src="/storage/slides/audio/{{ $audio }}" type="audio/mp3">
    Your browser does not support the audio element. Please update your browser.
  </audio>
@endif
