@extends('layouts.home')
@section('content')
<!-- ***** Products Area Starts ***** -->
<section class="section" id="products">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-heading">
               <h2>Our Products</h2>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         @foreach($products as $product)
         <div class="col-lg-4">
            <div class="item">
               <div class="thumb">
                  <img src="{{asset('public/images/tv_pic.jpg')}}" alt="">
               </div>
               <div class="down-content">
                  <h4>{{$product->name}}</h4>
                  <span>$ {{$product->price}}</span>
               </div>
            </div>
            <a href="{{url('product')}}/{{$product->id}}" target="_blank"><button class="btn-Stripe">
            Buy Now
            </button></a>
         </div>
         @endforeach
      </div>
   </div>
</section>
<!-- ***** Products Area Ends ***** -->
@endsection