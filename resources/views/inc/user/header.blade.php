<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 text-center" href="/Dashboard">Safety First Consulting
    </a>
	<button type="button" id="open-chat-box" class="btn float-right	d-block d-sm-none" 	data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample" >
                <i class="fas fa-envelope fa-2x text-white"></i>
		
		</button>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button><button class="navbar-toggler position-absolute mr-5 pr-5 d-md-none collapsed border-0 ">
        {!! Request::path() === 'buy_class'
        ? '<a href="/my_cart" class="btn btn-light text-white border-0 ml-auto "
            style="background-color:#343a40!important"><i class="fas fa-shopping-cart nav-cart"><span
                    class="classCount">' .
                    (Session::get('cart') ? Session::get('cart')->getTotalQty() : '0') .
                    '</span>
            </i>
            &nbsp; &nbsp; Cart</a>'
        : '' !!}
    </button>
    {!! Request::path() === 'buy_class'
    ? '<a href="/my_cart" class="btn btn-light text-white border-0 dash-nav ml-auto "
        style="background-color:#343a40!important"><i class="fas fa-shopping-cart nav-cart"><span class="classCount">' .
                (Session::get('cart') ? Session::get('cart')->getTotalQty() : '0') .
                '</span>
        </i>
        &nbsp; &nbsp; Cart</a>'
    : '' !!}


    <ul class="navbar-nav px-3 dash-nav justify-content-center align-items-center flex-row">
        {{-- <li class="nav-item text-nowrap mr-3">
            <a href="/live-video-call" >
                <i class="fas fa-headset fa-2x text-white"></i>
            </a>
        </li> --}}
	
		<button type="button" id="open-chat-box" class="btn" 	data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample" >
                <i class="fas fa-envelope fa-2x text-white"></i>
		
		</button>
	
		
        <li class="nav-item text-nowrap">
            <a href="{{ route('logout') }}" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</nav>
