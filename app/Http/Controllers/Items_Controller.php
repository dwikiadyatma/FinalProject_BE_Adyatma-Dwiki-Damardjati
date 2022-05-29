<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Category;

class Items_Controller extends Controller
{
  


    public function show_item_cards(Request $request){
        $items = Item::all();
        return view(('shop'), compact('items'));
    }

    public function show_item_inventory(Request $request){
        $items = Item::all();
        return view(('admin-inventory'), compact('items'));
    }

    public function add() {
        $categories = Category::all();
        return view(('admin-add'), compact('categories'));
    }
    public function add_item(Request $request){
        
        $request->validate([
            'item_name' => ['required', 'string', 'max:80', 'min:5'],
            'item_price' => ['required', 'integer'],
            'item_quantity' => ['required', 'integer'],
        ]);

        $extension = $request->file('image')->getclientoriginalextension();
        $filename = $request-> item_name.'.'.$extension;
        $request->file('image')->storeAs('public/item_images/', $filename);

        Item::create([
            'category_id' => $request->category_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
            'picture_path' => $filename,
        ]);
        return redirect('/admin-inventory');
    }

    public function update_item($id){
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('admin-edit', compact('item', 'categories'));
    }

    public function admin_editing(Request $request, $id){

        $request->validate([
            'item_name' => ['required', 'string', 'max:80', 'min:5'],
            'item_price' => ['required', 'integer'],
            'item_quantity' => ['required', 'integer'],
        ]);

        $extension = $request->file('image')->getclientoriginalextension();
        $filename = $request-> item_name.'.'.$extension;
        $request->file('image')->storeAs('public/item_images/', $filename);

        Item::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
            'picture_path' => $filename,
        ]);
        return redirect('/admin-inventory');
    }

    public function delete_item($id){
        Item::destroy($id);
        Cart::destroy($id);
        return back();
    }

}