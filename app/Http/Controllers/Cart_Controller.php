<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Cart;
use App\Models\Invoice_History;
use App\Models\Invoice_Details;
use Illuminate\Support\Facades\Auth;

class Cart_Controller extends Controller
{
    //

    public function add_cart($item_id){
        Cart::create([
            'user_id' => Auth::user()->id,
            'item_id' => $item_id,
            'quantity' => 1,
        ]);
        return redirect('cart');
    }

    public function display_cart(){
        $cart_data = Cart::where('user_id', Auth::user()->id)->get();
        $total = 0;
        foreach ($cart_data as $cart_item){
            $total  += $cart_item->Item()->first()->item_price * $cart_item->quantity;
        }
        
        return view('cart',  ["cart_items" => $cart_data], ["total" => $total]);
    }

    public function update_cart($id){
        $cart_item = Cart::findOrFail($id);
        return view('edit-cart', compact('cart_item'));
    }

    public function cart_editing(Request $request, $id){

        $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        Cart::findOrFail($id)->update([
            'quantity' => $request->quantity,
        ]);
        return redirect('/cart');
    }

    public function delete_cartitem($id){
        Cart::destroy($id);
        return back();
    }

    public function checkout(Request $request){
        $cart_data = Cart::where('user_id', Auth::user()->id)->get();

        
            foreach ($cart_data as $cart_item){
                
                $item_quantity = Item::where('id', $cart_item->item_id)->first()->item_quantity;

                $cart_quantity = $cart_item->quantity;

                $result = $item_quantity - $cart_quantity;

                if($result < 0){
                    return redirect()->back();
                }
            }

        $hasil = Invoice_History::create([
            'user_id' => Auth::user()->id,
            'address' => $request->address,
            'postcode' => $request->postcode,
        ]);

        foreach ($cart_data as $cart_item){
            Invoice_Details::create([
                'invoice_history_id' => $hasil->id,
                'item_id' => $cart_item->item_id,
                'quantity' => $cart_item->quantity,
            ]);
        }
        foreach ($cart_data as $cart_item){
            $item = Item::where('id', $cart_item->item_id)->first();
            $item_quantity = $item->item_quantity;

            $cart_quantity = $cart_item->quantity;

            $result = $item_quantity - $cart_quantity;

            

           $item->update([
                'item_quantity' => $result,
            ]);
            $cart_item -> delete();
        }
        return redirect ('landing');
    }

    public function display_invoices(){
        $invoices = Invoice_History::all();
        
        return view('admin-view-invoices', ["invoices_data" => $invoices]);
    }

    public function view_invoice($id){
        $history_data = Invoice_History::findOrFail($id);
        $details_data = Invoice_Details::where('invoice_history_id', $history_data->id)->get();
        $total = 0;
        $array = array();
        
        foreach ($details_data as $data){
        array_push($array, $data->Item()->first());
        }

        foreach ($details_data as $data){
            $total  += $data->Item()->first()->item_price * $details_data->first()->quantity;
        }

        return view('admin-view-invoice', ["invoice_data" => $history_data, "invoice_items_quantity" => $details_data, "invoice_items" => $array, "total" => $total]);
    }

}
