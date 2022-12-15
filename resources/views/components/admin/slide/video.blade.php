<div class="addVideo  row mx-auto w-100">
  <div class="col-md-12 pb-3">
    <div class="form-group">
      <label for="slide_content{{ $slideCount }}">Video</label>
      <div class="d-block  iframe-container">
        <iframe width="560" height="315" id="video{{ $slideCount }}"
          src="{{ $slide->slideContents->where('slide_index', $slideCount)->first()->video }}" frameborder="0"
          allow="autoplay" allow="encrypted-media" allowfullscreen></iframe>
      </div>
      <input id="slide_content{{ $slideCount }}" onchange="onAddingURL(this)" type="text"
        class="form-control @error('slide_content' . $slideCount) is-invalid @enderror"
        name="slide_content{{ $slideCount }}" data-frame="video{{ $slideCount }}"
        value="{{ $slide->slideContents->where('slide_index', $slideCount)->first()->video }}" required>
      @error('slide_content{{ $slideCount }}')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>

  <div class="col-12">
    <hr>
  </div>
  {{-- Audio --}}
  <div class="col-12 ">
    <x-admin.slide.audio :audio="@$slide->slideContents->where('slide_index', $slideCount)->first()->audio"
      :slideCount="$slideCount" />
  </div>

  <div class="col-12">
    <hr>
  </div>
  {{-- Cool Down --}}
  <div class="col-md-4">
    <x-admin.slide.cool-down :slide="$slide" :slideCount="$slideCount" />
  </div>
</div>
