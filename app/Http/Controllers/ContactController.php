<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validData = $request->validate([
            'name'          => 'required|string',
            'phone'         => 'nullable|string',
            'email'         => 'nullable|string',
            'title'         => 'nullable|min:3',
            'description'   => 'required|min:3',
        ]);

        $product = new Contact();
        $product->name         = $request->name;
        $product->phone       = $request->phone;
        $product->email        = $request->email;
        $product->title         = $request->title;
        $product->description   = $request->description;
        $product->save();

        alert('done!', 'Your operation done successfully.', 'success')->autoClose(1000);
        return redirect(back());
    }
}
