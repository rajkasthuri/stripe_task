<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Log;

class ProductController extends Controller
{
    
	public function viewProduct() {
		
		$products = Product::get();
		
		return view('products')->with('products',$products);
		
	}
	
	public function getProduct($productid) {
		
		$product = Product::find($productid);
		
		$user = new User;
		
		$intent = $user->createSetupIntent();
				
		return view('product_detail')->with('product',$product)->with('intent',$intent);
	}
	
	public function postStripePayment(Request $request) {
		$user = new User;
		$paymentMethod = $request->payment_method;
		$price = $request->price * 100;
		try {
			$user->createOrGetStripeCustomer();
			$user->updateDefaultPaymentMethod($paymentMethod);
			$user->charge($price, $paymentMethod,[
				'return_url' => route('paymentcompleted'),
			]);
	
		} catch (Exception $e) {
			
		}
	}
	
	public function paymentCompleted(Request $request) {
		
		// Receive Stripe response
	}
		
}
