@extends('classroom/layout')

@section('head')
<style>
    .buttons {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .cart-button {
        position: relative;
        outline: 0;
        background-color: blue;
        color: #fff;
        border: none;
        height: 40px;
        width: 180px;
        padding: 10px;
        border-radius: 5px;
        line-height: 0px;
        overflow: hidden;
        cursor: pointer
    }

    .cart-button:focus {
        outline: none !important
    }

    .cart-button .fa-shopping-cart {
        position: absolute;
        z-index: 2;
        top: 50%;
        left: -20%;
        font-size: 1.8em;
        transform: translate(-50%, -50%)
    }

    .cart-button .fa-square {
        position: absolute;
        z-index: 1;
        top: -20%;
        left: 53%;
        font-size: 0.8em;
        transform: translate(-50%, -50%)
    }

    .cart-button span {
        position: absolute;
        left: 50%;
        top: 50%;
        color: #fff;
        transform: translate(-50%, -50%)
    }

    .cart-button span.added {
        opacity: 0
    }

    .cart-button.clicked .fa-shopping-cart {
        animation: cart 1.5s ease-in forwards
    }

    .cart-button.clicked .fa-square {
        animation: box 1.5s ease-in forwards
    }

    .cart-button.clicked span.add-to-cart {
        animation: addcart 1.5s ease-in forwards
    }

    .cart-button.clicked span.added {
        animation: added 1.5s ease-in forwards
    }


    @keyframes cart {
        0% {
            left: -10%
        }

        40%,
        60% {
            left: 50%
        }

        100% {
            left: 110%
        }
    }

    @keyframes box {

        0%,
        40% {
            top: -20%
        }

        60% {
            top: 36%;
            left: 53%
        }

        100% {
            top: 40%;
            left: 112%
        }
    }

    @keyframes addcart {

        0%,
        30% {
            opacity: 1
        }

        30%,
        100% {
            opacity: 0
        }
    }

    @keyframes added {

        0%,
        80% {
            opacity: 0
        }

        100% {
            opacity: 1
        }
    }

</style>
<title>My Cart</title>
@endsection

@section('content')
@if ($errors->any() || session()->has('success') || session()->has('message'))
<div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session()->has('success') || session()->has('message'))
        <div class="alert alert-success mt-3">
            {{session('success') ?? session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>
@endif
<nav aria-label="breadcrumb">
    <ol class="breadcrumb ml-3">
        <li class="breadcrumb-item">My Cart</li>
    </ol>
</nav>

<div class="row   d-flex justify-content-start mx-0">
    <div class="col-sm-12">
        @if (Session::has('cart') && Session::get('cart')->getTotalQty() != 0)
        <div class="card my-3 ">
            <div class="card-body ">
                @foreach ($categories as $category)
                  @if (in_array($category->id, Session::get('cart')->getContents()))
                  <div class="d-flex align-items-center justify-content-between my-3">
                      <div class="row">
                          <h5 class="card-title col-sm-12">{{ $category->title }}</h5>
                          <h5 class="col-sm-12 text-info mr-5">${{ $category->price }}</h5>
                      </div>
                      {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                      <div>
                          <button onclick="removeFromCart(this, {{ $category->id }})"
                              class="ml-5 btn btn-danger float-right mr-1" style="display:{{ Session::get('cart') ?
                                      (in_array($category->id, Session::get('cart')->getContents()) != "" ? "" : "none" )
                                      : '' }}"><i class="fas fa-trash "></i>
                          </button>
                      </div>
                  </div>
                  @endif
                @endforeach
            </div>
        </div>
        <h5 class="d-inline"><strong>Total</strong></h5>
        <p class="display-4 font-weight-lighter float-right totalPrice">${{ $categories->sum('price')  }}</p>
        <form action="{{ route('checkout.paypal') }}" method="post" class="needs-validation" novalidate="">
            @csrf
            <button type="submit" class="mt-5 btn btn-warning btn-lg btn-block">Proceed to Checkout</button>
        </form>
        @else
        <div class="card my-3 ">
            <div class="card-body ">
                <p class="text-muted text-center">Cart is empty!</p>
            </div>
        </div>
        @endif


    </div>
</div>
@endsection

@section('script')
<script>
    function removeFromCart(e, id){
    $id = id;
    if($id !== ""){
        $.ajax({
            type:'GET',
            url:"{{ URL::to('/add_to_cart') }}",
            data:{id:$id, remove:true},
            success:function(data){
                if(data.cartQty || data.cartQty == '0') {
                    $(".totalPrice").text('$'+data.getTotalPrice)
                    $(e).parent().parent().fadeOut(500);
                    setTimeout(() => {
                    $(e).parent().parent().remove();
                    }, 500)
                }else{
                    alert('Unable to remove class from cart!!')
                }
            }
            });

    }else{
        alert('Unable to add class to cart!!')
    }
}
</script>
@endsection
