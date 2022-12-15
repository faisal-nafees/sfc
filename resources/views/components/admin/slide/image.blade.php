<div class="addImage  w-100 row mx-auto">
  <div class="col-md-12 pb-3">
    <div class="form-group">
      <label for="{{ 'slide_content' . $slideCount }}">Image</label>
      <div class="d-block mb-3">
        <img src="/storage/slideImages/{!! $slide->slideContents->where('slide_index', $slideCount)->first()->image !!}" class="fluid" alt="">
      </div>
      <input id="{{ 'slide_content' . $slideCount }}" onchange="readURL(this)" type="file" class="form-control-file"
        name="{{ 'slide_content' . $slideCount }}" value="" accept="image/*">
      <input type="hidden" id="{{ 'default_slide_content' . $slideCount }}"
        name="{{ 'default_slide_content' . $slideCount }}"
        value="{{ $slide->slideContents->where('slide_index', $slideCount)->first()->image }}">
    </div>
  </div>
  <div class="col-12">
    <hr>
  </div>
  {{-- Audio --}}
  <div class="col-12">
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
