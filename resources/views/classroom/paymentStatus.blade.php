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
<title>Payment</title>
@endsection

@section('content')

@if (Session::has('success'))
<div class="ml-3 card text-center " style="height: 100vh">
    <div class="card-body">
        <div class="text-success display-1 my-3"
            style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <p style="padding:2.8rem;"><i class="checkmark ">✓</i></p>
        </div>
        <h1 class="text-success">Payment Successful</h1>
        <a href="/Dashboard" class="btn btn-outline-secondary ">Return to Dashboard</a>
    </div>
</div>

@elseif(count($errors))
<div class="ml-3 card text-center" style="height: 100vh">
    <div class="card-body">
        <div class="text-danger display-1 my-3"
            style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <p style="padding:2.8rem;"><i class="fas fa-times"></i></p>
        </div>
        <h1 class="text-danger">Payment Failed</h1>
        @forelse ($errors as $error)
        <p>{{ $error }}</p>
        @empty

        @endforelse
        <a href="/my_cart" class="btn btn-outline-secondary ">Return to Cart</a>
    </div>
</div>

@elseif(Session::has('canceled'))
<div class="ml-3 card text-center" style="height: 100vh">
    <div class="card-body">
        <div class="text-warning display-1 my-3"
            style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <p style="padding:2.8rem;"><i class="fas fa-exclamation"></i></p>
        </div>
        <h1 class="text-warning">Payment Canceled</h1>
        <a href="/my_cart" class="btn btn-outline-secondary ">Return to Cart</a>
    </div>
</div>

@endif

@endsection

@section('script')
<script>
    $('#same-address').on('change', function(){
        if($('#same-address')[0].checked){
            $('#shipping_address').slideUp();
        }else{
            $('#shipping_address').slideDown();
        }
    })
</script>
@endsection
