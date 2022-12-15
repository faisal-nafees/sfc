<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky sm pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'admin/dashboard' ? 'active' : '' }}" href="/admin/dashboard">
          <span data-feather="home"></span>
          <i class="fas fa-tachometer-alt feather"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item sub-menu">
        @php
            $subRoutes = [
                            'admin/user_answers',
                            'admin/Manage-Client-Accounts',
                            'admin/Add-New-Client',
                            'admin/agreements',
                            'admin/user_answers',
                            'admin/Clients',
                        ];

            foreach ($subRoutes as $key => $value) {
                if(str_contains(Request::path(), $value)){
                    $user_manag = true;
                    break;
                }else{
                    $user_manag = false;
                }
            }

        @endphp
        <a class="nav-link {{ $user_manag ? 'active' : 'collapsed' }} text-truncate" href="#user-manag"
          data-toggle="collapse" data-target="#user-manag"><i class="fas fa-user feather"></i> <span
            class="">Client Management
          </span> <i class="fas fa-chevron-left pr-2"></i></a>
        <div class="collapse {{ $user_manag ? 'show' : '' }}" id="user-manag">
          <ul class="flex-column pl-2 nav py-2">
            <li class="nav-item ">
              <a href="/admin/Clients"
                class="nav-link  {{ Request::path() === 'admin/Clients' ? 'act' : '' }} ">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i>
                  All Clients</span>
              </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/Add-New-Client"
                class="nav-link {{ str_contains(Request::path(), 'admin/Add-New-Client') ? 'act' : '' }} ">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i>
                  Add New Client</span>
              </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/Manage-Client-Accounts"
                class="nav-link {{ Request::path() == 'admin/Manage-Client-Accounts' ? 'act' : '' }} ">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i>
                  Manage Accounts</span>
              </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/user_answers"
                class="nav-link {{ str_contains(Request::path(), 'admin/user_answers') ? 'act' : '' }}">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Client Answers</span> </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/agreements"
                class="nav-link {{ str_contains(Request::path(), 'admin/agreements') ? 'act' : '' }}">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Client Agreements</span> </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item sub-menu">
        @php
          if (Request::path() == 'admin/category' || str_contains(Request::path(), 'admin/subcategory/') || str_contains(Request::path(), 'admin/qas/') || str_contains(Request::path(), 'admin/qa/') || str_contains(Request::path(), 'admin/slides/')) {
              $Management = true;
          } else {
              $Management = false;
          }
        @endphp
        <a class="nav-link {{ $Management ? 'active' : 'collapsed' }} text-truncate" href="#submenu1"
          data-toggle="collapse" data-target="#submenu1"><i class="fa fa-table feather"></i> <span
            class="">Management
          </span> <i class="fas fa-chevron-left pr-2"></i></a>
        <div class="collapse {{ $Management ? 'show' : '' }}" id="submenu1">
          <ul class="flex-column pl-2 nav py-2">
            <li class="nav-item ">
              <a href="/admin/category" class="nav-link {{ Request::path() == 'admin/category' ? 'act' : '' }} ">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Classes</span>
              </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/subcategory/cat"
                class="nav-link {{ str_contains(Request::path(), 'admin/subcategory/') ? 'act' : '' }}">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Lessons</span> </a>
            </li>
            <li class="nav-item ">
              <a href="/admin/qas/cat"
                class="nav-link
                                {{ str_contains(Request::path(), 'admin/qas/') ? 'act' : '' }}">
                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Q & A</span></a>
            </li>
            <li class="nav-item ">
              <a href="/admin/slides/cat"
                class="nav-link
                                {{ str_contains(Request::path(), 'admin/slides/') ? 'act' : '' }} ">

                <span><i class="far fa-circle"></i><i class="fas fa-circle"></i> Slides</span></a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'admin/Add-New-Admin' ? 'active' : '' }}"
          href="/admin/Add-New-Admin">
          <i class="fas fa-crown feather"></i> Add New Admin
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'admin/reset_progress' ? 'active' : '' }}"
          href="/admin/reset_progress">
          <i class="fas fa-undo feather"></i> Reset Progress
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() === 'admin/analytics' ? 'active' : '' }}" href="/admin/analytics">
          <i class="fas fa-chart-bar feather"></i> Analytics
        </a>
      </li>
    </ul>
  </div>
</nav>
