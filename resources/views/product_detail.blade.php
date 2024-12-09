@extends('layouts.home')
@section('styles')
<style>
   .StripeElement {
   box-sizing: border-box;
   height: 40px;
   padding: 10px 12px;
   border: 1px solid transparent;
   border-radius: 4px;
   background-color: white;
   box-shadow: 0 1px 3px 0 #e6ebf1;
   -webkit-transition: box-shadow 150ms ease;
   transition: box-shadow 150ms ease;
   }
   .StripeElement--focus {
   box-shadow: 0 1px 3px 0 #cfd7df;
   }
   .StripeElement--invalid {
   border-color: #fa755a;
   }
   .StripeElement--webkit-autofill {
   background-color: #fefde5 !important;
   }
</style>
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- ***** Product Area Starts ***** -->
<section class="section" id="product">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <div class="left-images">
               <img src="{{asset('public/images/tv_pic.jpg')}}" alt="">
            </div>
         </div>
         <div class="col-lg-4">
            <div class="right-content">
               <h4>{{$product->name}}</h4>
               <span>{{$product->description}}</span>
               <h4 id="tot">${{$product->price}}</h4>
               <div class="section-heading">
                  <h4>Enter Payment Card Details</h4>
               </div>
               <form id="card_info" action="{{ url('checkout') }}">
                  <input type="hidden" id="prod-price" value="{{$product->price}}" />
                  <div class="row">
                     <div class="col-lg-12">
                        <fieldset>
                           <input name="card-holder-name" type="text" id="card-holder-name" placeholder="Card Holder Name" maxlength="50">
                        </fieldset>
                        <div id="card-element"></div>
                     </div>
                  </div>
               </form>
               <div class="total">
                  <button class="btn-Stripe" id="card-button" data-secret="{{ $intent->client_secret }}">
                  Proceed to Buy
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ***** Product Area Ends ***** -->
@endsection
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
   const stripe = Stripe("{{ env('STRIPE_KEY') }}");
   
   const elements = stripe.elements();
   let style = {
   		base: {
   			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
   			fontSmoothing: 'antialiased',
   			fontSize: '14px',
   			fontStyle: 'italic',
   			fontWeight: '500',
   			color: '#aaa',
   			borderRadius: '0px',
   			border: '1px solid #7a7a7a',
   			boxShadow: 'none',
   			'::placeholder': {
   				color: '#aab7c4'
   			}
   		},
   		invalid: {
   			color: '#fa755a',
   			iconColor: '#fa755a'
   		}
   	}
   let cardElement = elements.create('card', {style: style})
   cardElement.mount('#card-element');
   
   const cardHolderName = document.getElementById('card-holder-name');
   const cardButton = document.getElementById('card-button');
   const clientSecret = cardButton.dataset.secret;
      let payment_method_data = null
   let paymentMethod = null;
   
   
   cardButton.addEventListener('click', async (e) => {
   	if(cardHolderName.value == null || cardHolderName.value == "") {
   		alert('Please fill the card holder name');
   		return false;
   	}
   	stripe.confirmCardSetup(
   		"{{ $intent->client_secret }}",
   		{
   			payment_method: {
   				card: cardElement,
   				billing_details: {name: cardHolderName.value}
   			}
   		}
   	).then(function (result) {
   		if (result.error) {
   			$('#card-button').text('Proceed to Buy');
   			alert('Sorry,could not process your request');
   		} else {
   			$('#card-button').text('Processing..');
   			paymentMethod = result.setupIntent.payment_method;
   			checkout(paymentMethod);
   		}
   	});
   });
   
   function checkout(paymentMethod) {
   	var cardform = $('#card_info');
   	var url = cardform.attr("action");
   	$.ajax({
   		type:"POST",
   		url: url,
   		data:{
   			"price":$('#prod-price').val(),
   			"payment_method":paymentMethod
   		},
   		headers: {
   			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		},
   		success: function (data) {
   			$('#card-button').text('Proceed to Buy');
   			alert('Your order has been placed');
   		},
   		error: function(XMLHttpRequest, textStatus, errorThrown) { 
   			$('#card-button').text('Proceed to Buy');
   			alert("Status: " + textStatus); alert("Error: " + errorThrown); 
   		}  
   	});
   }
   
</script>
@endsection