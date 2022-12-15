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

    @media only screen and (max-width: 600px) {

        .cart-button,
        .purchase,
        .remove-btn {
            width: 100% !important;
        }

        .purchase {
            margin: 1rem auto !important;
            padding: 0px !important;
        }
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
<title>Classes</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb ml-3">
        <li class="breadcrumb-item">Classes</li>
    </ol>
</nav>

<div class="row   d-flex justify-content-start mx-0">
    <div class="col-sm-12">
        @foreach ($categories as $category)
        <div class="card my-3 ">
            <div class="card-body row ">
                <div class="col-md-6 py-2">
                    <h5 class="card-title ">{{  $category->title }}</h5>
                    <h5 class="card-text text-info ">${{  $category->price }}</h5>
                </div>
                <div class="col-md-6">
                    @if (!in_array($category->id, auth()->user()->categories->pluck('id')->toArray()))
                    <button class="cart-button float-md-right my-3" style="{{ Session::get('cart') ?
                    (in_array($category->id, Session::get('cart')->getContents()) != "" ? "display: none;" : "" )
                     : '' }}" onclick="addToCart(this, {{ $category->id }})">
                        <span class="add-to-cart"> Add to cart</span>
                        <span class="added"><i class="fas fa-check"></i> Item added</span>
                        <i class="fa fa-shopping-cart"></i> <i class="fa fa-square"></i>
                    </button>
                    <button onclick="removeFromCart(this, {{ $category->id }})"
                        class="btn btn-danger remove-btn float-md-right my-3 mr-1" style="width: 180px; display:{{ Session::get('cart') ?
                        (in_array($category->id, Session::get('cart')->getContents()) != "" ? "" : "none" )
                         : 'none' }}"><i class="fas fa-trash "></i> Remove</button>
                    @else
                    <div class="p-3 purchase text-success text-center float-md-right my-3 mr-1" style="width: 180px; ">

                        <h5><i class="fas fa-check "></i> Purchased </h5>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection

@section('script')
<script>
    /* -------------------------------------------------------------------------- */
/*                              GLOBAL VARIABLES                              */
/* -------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------- */

function addToCart(e, id){
    $(e).attr('disabled', 'true')
    $id = id;
    if($id !== ""){
        $.ajax({
            type:'GET',
            url:"{{ URL::to('/add_to_cart') }}",
            data:{id:$id },
            success:function(data){
                if(data.cartQty) {
                    $('.classCount').html(data.cartQty);
                    e.classList.add('clicked');
                    setTimeout(() => {
                        $(e).addClass("bg-success")
                        // $(e).animate({'width': 'toggle'});
                    }, 1500)
                    setTimeout(() => {
                    $(e).fadeOut(200);
                    }, 2700)
                    setTimeout(() => {
                    $(e).next().fadeIn(200);
                    }, 3000)
                }else{
                    $(e).removeAttr('disabled')
                    alert('Unable to add class to cart!!')
                }
            }
            });

    }else{
        alert('Unable to add class to cart!!')
    }
}

function removeFromCart(e, id){
    $(e).attr('disabled', 'true')
    $id = id;
    if($id !== ""){
        $.ajax({
            type:'GET',
            url:"{{ URL::to('/add_to_cart') }}",
            data:{id:$id, remove:true},
            success:function(data){
                if(data.cartQty || data.cartQty == '0') {
                    $('.classCount').html(data.cartQty);
                    $(e).prev().removeClass('bg-success');
                    $(e).prev().removeClass('clicked');
                    $(e).fadeOut(100);
                    $(e).prev().animate({
                        'width': '180px'
                        },200, function(){
                        $(this).show();
                        });
                    $(e).prev().removeAttr('disabled')
                    $(e).removeAttr('disabled')
                }else{
                    $(e).removeAttr('disabled')
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
