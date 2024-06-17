<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function createItem()
    {
        return view('admin.addItem');
    }

    public function storeItem(Request $request)
    {
        // Validate the request
        $request->validate([
            'itemName' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'model' => 'required|string',
            'quantity' => 'required|string',
        ]);

        try {
            // Handle image upload
            $imagePath = $request->file('image')->store('images', 'public');

            // Create and save the item
            Item::create([
                'name' => $request->input('itemName'),
                'image_path' => $imagePath,
                'model' => $request->input('model'),
                'quantity' => $request->input('quantity'),
            ]);

            return redirect()->route('item.create')->with('success', 'Item added successfully!');
        } catch (\Exception $e) {

            return redirect()->route('item.create')->with('error', 'Failed to add item. Please try again.');
        }
    }

    public function indexItem()
    {
        $items = Item::all();
        return view('admin.items', compact('items'));
    }

 

    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'itemName' => 'required|string',
           // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'model' => 'required|string',
            'quantity' => 'required|string',
        ]);
        try {
            $item = Item::find($id);
            $item->update($request->all());

            return redirect()->route('items.index')->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Failed to update item. Please try again.');
        }
    }

    public function destroyItem($id)
    {
        try {
            $item = Item::find($id);
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Failed to delete item. Please try again.');
        }
    }

    public function showItem($id)
    {
        $item = Item::find($id);
        return view('items.show', compact('item'));
    }

    public function editItem($id)
    {
            $item = Item::find($id);
            return view('admin.editItem', compact('item'));
        
    }
}