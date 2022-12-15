<div class="addQuesAns  col-md-12 w-100 ">
  @foreach (explode(',', $slide->slideContents->where('slide_index', $slideCount)->first()->qa_id) as $qa_id)
    <div class="form-group  ">
      <label>Question:</label>
      <div class="input-group mb-3">
        <select name="{{ 'slide_content' . $slideCount }}[]"
          class="form-control slide_content{{ $slideCount }} qa-sel" onchange="verifyDuplicateQA(this)" required>
          <option value="">Select a question</option>
          @foreach ($qas as $qa)
            @if ($qa->subcategory_id == $slide->slideContents->where('slide_index', $slideCount)->first()->slide->subcategory_id)
              <option value="{{ $qa->id }}"
                {{ old('slide_content' . $slideCount, $qa_id) == $qa->id ? 'selected' : '' }}>
                {{ $qa->question }}</option>
            @endif
          @endforeach
        </select>

        <span class="input-group-text" onclick="deleteQA(this)"><i class="fas fa-trash"></i></span>
      </div>
    </div>
  @endforeach
  <input name="{{ 'cool_down' . $slideCount }}" id="{{ 'cool_down' . $slideCount }}" class="form-control"
    type="hidden" value="0" required="">

  {{-- Add New Q&A --}}
  <a href="javascript:;" onclick="addNewQa(this)" data-classname="addNewSlide"
    data-name="{{ 'slide_content' . $slideCount }}" class=" btn btn-primary "><i class="fas fa-plus"></i>
    Add New Q&A
  </a>
  <hr>
  {{-- Audio --}}
  <div class="pt-3">
    <x-admin.slide.audio :audio="@$slide->slideContents->where('slide_index', $slideCount)->first()->audio"
      :slideCount="$slideCount" />
  </div>
</div>
