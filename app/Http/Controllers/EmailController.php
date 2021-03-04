<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Product;
use App\Mail\MelloMail;
use App\Mail\ProductMail;

class EmailController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dataEmail()
    {
        $products = Product::all();
        return view('data-email', compact('products'));
    }

    public function send(Request $request)
    {
        Mail::to($request->email)->send(new MelloMail($request->body));
        return back();
    }

    public function sendProductEmail($id)
    {
        $product = Product::findOrFail($id);
        Mail::to($product->customer_email)->send(new ProductMail($product));
        return back();
    }
}
