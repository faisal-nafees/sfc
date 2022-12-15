@extends('admin/layout')

@section('head')
  <style>
    .addSlide {
      position: relative;
      border: 2px dashed grey;
      border-radius: 10px;
      min-height: 400px;
      background-color: rgb(243, 243, 243);
      margin: 20px 0;
    }

    .addSlide p {
      width: 40px;
      height: 40px;
      padding: 2px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 100%;
      border: 1px solid rgb(255, 33, 33);
      background-color: red;
      color: white;
      font-weight: 600;
      font-size: 1.8rem;
      position: absolute;
      top: -20px;
      left: 20px;
    }

    .deleteSlide {
      left: 95% !important;
      top: 5px !important;
      border: #495057 !important;
      background-color: unset !important;
      z-index: 9;
    }

    .iframe-container {
      /* position: relative;
                overflow: hidden;
                padding-top: 26.25%;
                display: none; */

    }

    #video {
      width: 25% !important;
      height: 100%;
    }


    #floatingBtn {
      border-radius: 20px;
      position: fixed;
      bottom: 40px;
      right: 40px;
      box-shadow: 0px 1px 5px #00000059;
      z-index: 999;
    }

    *,
    *:before,
    *:after {
      box-sizing: border-box !important;
    }

    .Dcontainer {
      position: relative !important;
      top: 50% !important;
      left: 50% !important;
      height: 400px !important;
      /* opacity     : 0 !important;
                visibility  : hidden !important; */
      transform: translate(-50%, -50%) !important;
      cursor: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/106114/cursor.png") 20 20, auto !important;
    }

    .Dlist-item {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      height: 90px !important;
      width: 100% !important;

    }

    .Ditem-content {
      height: 100% !important;
      border: 0px solid rgba(123, 123, 123, 0.498039) !important;
      border-radius: 4px !important;
      color: rgb(153, 153, 153) !important;
      line-height: 90px !important;
      padding-left: 32px !important;
      font-size: 24px !important;
      font-weight: 400 !important;
      background-color: rgb(255, 255, 255) !important;
      box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px 0px !important;
      display: flex;
      align-content: center;
      justify-content: space-between;
    }

    .Dorder {
      width: 40px;
      height: 40px;
      padding: 2px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 100%;
      border: 1px solid rgba(255, 33, 33, 0);
      background-color: rgba(255, 0, 0, 0);
      color: rgb(240, 59, 59);
      font-weight: 600;
      font-size: 1.8rem;
      margin: 1.5rem 0 0 0;
    }

  </style>
@endsection

@section('content')
  <li class="breadcrumb-item active" aria-current="page"><a
      href="/admin/slides/index/{{ @$slide->subcategory_id }}">Slides</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
  </nav>
  <div class="row d-flex justify-content-center mt-5">
    @if (Session::has('message'))
      <div class="alert alert-success col-10 p-3 mt-3">
        <ul>
          <li>{{ Session::get('message') }}</li>
        </ul>
      </div>
    @endif
    @if (Session::has('error'))
      <div class="alert alert-danger col-10 p-3 mt-3">
        <ul>
          <li>{{ Session::get('error') }}</li>
        </ul>
      </div>
    @endif
    <div class="col-md-10 card p-5 mb-5">
      <form method="POST" class="text-center" action="/admin/slides/slideOrderUpdate/{{ $slide->id }}"
        enctype="multipart/form-data">
        @csrf
        <section class="Dcontainer">
          @for ($i = 1; $i <= count($slide->slideContents); $i++)
            <div class="Dlist-item">
              <div class="Ditem-content">
                <span class="Dorder">{{ $i }}</span>
                <input type="hidden" name="{{ 'slide_content' . $i }}" value="{{ $i }}">
                @if (@$slide->slideContents->where('slide_index', $i)->first()->image)
                  <img src="/storage/slideImages/{!! $slide->slideContents->where('slide_index', $i)->first()->image !!}" class="fluid w-25 h-100" alt="">
                @elseif(@$slide->slideContents->where('slide_index', $i)->first()->video)
                  <iframe id="video" src="{{ $slide->slideContents->where('slide_index', $i)->first()->video }}"
                    frameborder="0" allow="autoplay" allow="encrypted-media" allowfullscreen></iframe>
                @else
                  <div class="d-inline-block text-truncate justify-content-start align-item-center w-75 h-100">
                    <h5 style="line-height:unset;">
                      {{ $qas->find(explode(',', $slide->slideContents->where('slide_index', $i)->first()->qa_id)[0])->question . '?' }}
                    </h5>
                  </div>
                @endif
                </p>
              </div>
            </div>
          @endfor
        </section>
        <button type="submit" class="btn btn-primary mt-5 ">Save Order</button>
      </form>
    </div>
  </div>
@endsection

@section('finalScript')
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>
  <script>
    /* -------------------------------------------------------------------------- */
    /*                              Slide Drag Drop                               */
    /* -------------------------------------------------------------------------- */
    var rowSize = 100; // => container height / number of items
    var container = document.querySelector(".Dcontainer");
    var listItems = Array.from(document.querySelectorAll(".Dlist-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;
    $("input[name='slide_content1']").val();
    TweenLite.to(container, 0.5, {
      autoAlpha: 1
    });

    function changeIndex(item, to) {

      // Change position in array
      arrayMove(sortables, item.index, to);

      // Change element's position in DOM. Not always necessary. Just showing how.
      if (to === total - 1) {
        container.appendChild(item.element);
      } else {
        var i = item.index > to ? to : to + 1;
        container.insertBefore(item.element, container.children[i]);
      }

      // Set index for each sortable
      sortables.forEach((sortable, index) => sortable.setIndex(index));
    }

    function Sortable(element, index) {

      var content = element.querySelector(".Ditem-content");
      var order = element.querySelector(".Dorder");
      var input = element.querySelector("input");

      var animation = TweenLite.to(content, 0.3, {
        boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
        force3D: true,
        scale: 1.1,
        paused: true
      });

      var dragger = new Draggable(element, {
        onDragStart: downAction,
        onRelease: upAction,
        onDrag: dragAction,
        cursor: "inherit",
        type: "y"
      });

      // Public properties and methods
      var sortable = {
        dragger: dragger,
        element: element,
        index: index,
        setIndex: setIndex
      };

      TweenLite.set(element, {
        y: index * rowSize
      });

      function setIndex(index) {
        sortable.index = index;
        order.textContent = index + 1;
        input.value = index + 1;
        // input.setAttribute('name', 'slide_content'+(index + 1));
        // Don't layout if you're dragging
        if (!dragger.isDragging) layout();
      }

      function downAction() {
        animation.play();
        this.update();
      }

      function dragAction() {
        // Calculate the current index based on element's position
        var index = clamp(Math.round(this.y / rowSize), 0, total - 1);

        if (index !== sortable.index) {
          changeIndex(sortable, index);
        }
      }

      function upAction() {
        animation.reverse();
        layout();
      }

      function layout() {
        TweenLite.to(element, 0.3, {
          y: sortable.index * rowSize
        });
      }

      return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
      array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
      return value < a ? a : (value > b ? b : value);
    }

    /* --------------------------- Change Card Height --------------------------- */
    var parent = document.querySelector(".Dcontainer")
    var child1 = document.querySelector(".Dlist-item")
    var childeCount = document.querySelectorAll(".Dlist-item").length * 1.12
    var childHeight = (parseInt(window.getComputedStyle(child1).height) * childeCount) + "px"
    parent.style.paddingTop = childHeight
    /* -------------------------------------------------------------------------- */
  </script>
@endsection
