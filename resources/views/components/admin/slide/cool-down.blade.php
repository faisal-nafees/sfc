<div class="form-group">
  <label for="{{ 'cool_down' . $slideCount }}">Slide Cool Down Time(in Seconds)</label>
  <input name="{{ 'cool_down' . $slideCount }}" id="{{ 'cool_down' . $slideCount }}" class="form-control"
    type="number" value="{{ $slide->slideContents->where('slide_index', $slideCount)->first()->cool_down }}"
    required="">
</div>
