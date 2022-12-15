<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column pl-0">

      <li class="nav-item">
        <a class="nav-link text-center" href="/">
          <img class="img-fluid nav-logo sm" src="/img/Safety%20First%20Logo%20Invert.png">
        </a>
      </li>
      <li class="nav-item  d-sm-block d-md-none">
        <a href="{{ route('logout') }}" class="nav-link text-end d-inline-block"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
        </form>
      </li>
      <p class="text-muted pl-3 pt-3 mb-0">Main</p>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'Dashboard' ? 'active' : '' }}" href="/Dashboard">
          <span data-feather="home"></span>
          <i class="fas fa-tachometer-alt feather"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'my_certificates' ? 'active' : '' }}" href="/my_certificates">
          <i class="fas fa-certificate feather"></i>
          My Certs
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'buy_class' ? 'active' : '' }}" href="/buy_class">
          <i class="fas fa-shopping-cart feather"></i>
          Buy Class
        </a>
      </li>

      @if (count(Auth::user()->categories))
        <p class="text-muted pl-3 pt-3 mb-0">Classes</p>
        @php
          $slideProgress = @auth()->user()->slideprogress;
          @endphp
          @foreach (Auth::user()->categories->where('active', 'Y') as $category)
            <li class="nav-item sub-menu">
              <a class="nav-link {{ str_contains(Request::path(), 'slideShow/' . $category->id) ? 'active' : 'collapsed' }}"
                href="#submenu{{ $category->id }}" data-toggle="collapse" data-target="#submenu{{ $category->id }}"
                aria-expanded="{{ str_contains(Request::path(), 'slideShow/' . $category->id) ? 'true' : 'false' }}">
                <span class="d-sm-inline">
                  {{ $category['title'] }}
                </span><i class="fas fa-chevron-left pr-2"></i>
              </a>
              @if (count($category->subcategories) > 0)
                <div
                  class="collapse sub-menu {{ str_contains(Request::path(), 'slideShow/' . $category->id) ? 'show' : '' }}"
                  id="submenu{{ $category->id }}">
                  <ul class=" flex-column pl-2 nav pt-2">

                    @foreach ($category->subcategories->where('active', 'Y') as $subcategory)
                      <li class=" nav-item front">

                        <a href="/slideShow/{{ $category->id }}/{{ $subcategory->id }}/{{ '1' }}"
                          class="nav-link  d-flex justify-content-between
                                                    {{ str_contains(Request::path(), 'slideShow/' . $category->id . '/' . $subcategory->id) ? 'act' : '' }}">

                          {{-- Result --}}
                          <span style="display:inline-block; width:10%; padding:0 1rem 0 0;">
                            @if (@$slideProgress && ($userProg = $slideProgress->where('slide_id', @$subcategory->slide['id'])->first()))
                              @php
                                $progress = floor(($userProg->progress / $userProg->slide->total_slide) * 100);
                                if ($userProg->progress >= $userProg->slide->total_slide) {
                                    if ($userProg->result == 'P') {
                                        echo '<i class="fas fa-check text-success"></i>';
                                    } elseif ($userProg->result == 'F') {
                                        echo '<i class="fas fa-times text-danger"></i>';
                                    } else {
                                        echo '<i class="far fa-circle "></i><i class="fas fa-circle "></i>';
                                    }
                                } else {
                                    echo '<i class="far fa-circle "></i><i class="fas fa-circle "></i>';
                                }

                              @endphp
                            @else
                              @php
                                $userProg = null;
                              @endphp
                              <i class="far fa-circle "></i><i class="fas fa-circle "></i>
                            @endif
                          </span>

                          {{-- Lesson Title --}}
                          <span class="mr-auto " data-text="{{ $subcategory->title }}">
                            {{ $subcategory->title }}
                          </span>
                          {{-- Progress --}}
                          @if (@$userProg)
                            <span class="ml-auto text-muted">
                              <b>{{ @$progress ? $progress . '%' : '' }}</b>
                            </span>
                          @endif
                        </a>
                        @php
                          $result = '';
                        @endphp
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </li>
          @endforeach

        @endif
      </ul>
    </div>
  </nav>
