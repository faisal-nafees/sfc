{{-- Audio --}}
<div class="form-group">
  <label for="{{ 'slide_audio' . $slideCount }}">Audio</label>
  <br>
  @if (@$audio)
    <audio controls class="w-100">
      <source src="/storage/slides/audio/{{ $audio }}" type="audio/mp3">
      Your browser does not support the audio element. Please update your browser.
    </audio>
  @endif
  <input id="{{ 'slide_audio' . $slideCount }}" type="file" class="form-control-file"
    name="{{ 'slide_audio' . $slideCount }}" accept="audio/mp3, audio/wav, audio/ogg">
  <span class="text-danger">Max file size: 8MB</span>
  <br>
  <input type="hidden" name="{{ 'slide_audio_old' . $slideCount }}" id="{{ 'slide_audio_old' . $slideCount }}"
    value="{{ old('slide_audio_old' . $slideCount, $audio) }}">
  <a href="javascript:void(0)" onclick="removeAudio(this)" data-slide-count="{{ $slideCount }}"
    class="btn btn-danger mt-3">
    Remove Audio
  </a>
</div>
@php
$audio = null;
@endphp
