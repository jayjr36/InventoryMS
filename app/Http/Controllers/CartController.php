<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BorrowingRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $table = 'carts';


    public function index()
    {
        // $requests = Cart::all();
        return view('admin.requests');
    }

    
    public function indexItems()
    {
        $pendingItems = Cart::where('status', 'pending')->get();
        $approvedItems = Cart::where('status', 'approved')->get();
        $rejectedItems = Cart::where('status', 'Rejected')->get();
        $clearedItems = Cart::where('status', 'Cleared')->get();

        return view('carts.index', compact('pendingItems', 'approvedItems', 'rejectedItems', 'clearedItems'));
    }

    public function addToCart(Request $request)
    {
        try {

            $userId = $request->input('user_id');
            $items = $request->input('items');
            $user = User::find($userId);
            $userName = $user->name;
            $userEmail = $user->email;

            foreach ($items as $item) {
                $cartItem = new Cart();
                $cartItem->user_id = $userId;
                $cartItem->user_name = $userName;
                $cartItem->user_email = $userEmail;
                $cartItem->item_id = $item['id'];
                $cartItem->item_name = $item['name'];
                $cartItem->item_model = $item['model'];
                $cartItem->quantity = $item['quantity'];
                $cartItem->status = 'pending';
                $cartItem->save();
            }

            return response()->json(['message' => 'Items added to cart successfully']);
        } catch (\Exception $e) {

            Log::error('Error adding items to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function fetchCartItems(Request $request)
    {
        try {
            $userId = Auth::id();
            $user = User::find($userId); // Fetch the user

            $cartItems = Cart::where('user_id', $userId)->get();
            $html = '<p class="display-5 text-center fw-bold">Items Requested</p>';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="table table-bordered table-striped">';
            $html .= '<thead class="thead-dark"><tr><th>Name</th><th>Model</th><th>Quantity</th><th>Request status</th><th>Name</th><th>Email</th>';

            // Check if the user is an admin (role_id = 1)
            if ($user->role_id == 1) {
                $html .= '<th>Actions</th>';
            }

            $html .= '</tr></thead>';
            $html .= '<tbody>';
            foreach ($cartItems as $item) {
                $html .= '<tr>';
                $html .= '<td>' . $item->item_name . '</td>';
                $html .= '<td>' . $item->item_model . '</td>';
                $html .= '<td>' . $item->quantity . '</td>';
                $html .= '<td>' . $item->status . '</td>';
                $html .= '<td>' . $item->user_name . '</td>';
                $html .= '<td>' . $item->user_email . '</td>';


                // Check if the user is an admin (role_id = 1)
                if ($user->role_id == 1) {
                    $html .= '<td>';
                    $html .= '<button class="btn btn-primary approve-btn" data-item-id="' . $item->id . '">Approve</button>';
                    $html .= '<button class="btn btn-secondary comment-btn" data-item-id="' . $item->id . '">Reject</button>';
                    $html .= '<button class="btn btn-success clear-btn" data-item-id="' . $item->id . '">Cleared</button>';

                    $html .= '</td>';
                }

                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            Log::error('Error fetching cart items: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function fetchCarts(Request $request)
{
    try {
        $userId = Auth::id();
        $user = User::find($userId);

        $cartItems = Cart::whereIn('status', ['pending', 'approved', 'Cleared', 'Rejected'])->get();

        // Return the view with data
        return view('myitems', compact('cartItems', 'user'));
    } catch (\Exception $e) {
        Log::error('Error fetching cart items: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
public function updateStatus(Request $request)
{
    Log::info('updateStatus called'); // Log at the start of the method

    try {
        $itemId = $request->input('item_id');
        $action = $request->input('action');

        Log::info('Received item_id: ' . $itemId . ', action: ' . $action); // Log received data

        $item = Cart::find($itemId);
        if (!$item) {
            Log::error('Item not found');
            return response()->json(['error' => 'Item not found'], 404);
        }

        if ($action === 'approve') {
            $item->status = 'approved';
            $item->save();
            Log::info('Item approved and saved.');

            $itemQuantity = $item->quantity;
            $itemInItemTable = Item::find($item->item_id);
            $itemInItemTable->quantity -= $itemQuantity;
            $itemInItemTable->save();
            Log::info('Item quantity updated in items table.');

            BorrowingRecord::create([
                'item_id' => $item->item_id,
                'user_name' => $item->user_name,
                'quantity' => $itemQuantity,
                'borrowed_at' => now(),
                'returned_at' => null,
            ]);
            Log::info('Borrowing record created.');

        } elseif ($action === 'comment') {
            $item->status = 'Rejected';
            $item->save();
            Log::info('Item rejected and saved.');
        } elseif ($action === 'clear') {
            $item->status = 'Cleared';
            $item->save();
            Log::info('Item cleared and saved.');

            $itemQuantity = $item->quantity;
            $itemInItemTable = Item::find($item->item_id);
            $itemInItemTable->quantity += $itemQuantity;
            $itemInItemTable->save();
            Log::info('Item quantity updated in items table.');
        }

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        Log::error('Error updating status: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
}


    // public function updateStatus(Request $request)
    // {
    //     try {
    //         $itemId = $request->input('item_id');
    //         $action = $request->input('action');

    //         $item = Cart::find($itemId);
    //         if (!$item) {
    //             return response()->json(['error' => 'Item not found'], 404);
    //         }

    //         if ($action === 'approve') {
    //             $item->status = 'approved';
    //             $item->save();

    //             $itemQuantity = $item->quantity;
    //             $itemCartQuantity = $item->quantity;
    //             $itemInItemTable = Item::find($item->item_id);
    //             $itemInItemTable->quantity -= $itemCartQuantity;
    //             $itemInItemTable->save();
    //         } elseif ($action === 'comment') {
    //             $item->status = 'Rejected';
    //             $item->save();
    //         } elseif ($action === 'clear') {
    //             $item->status = 'Cleared';
    //             $item->save();

    //             // Update quantity in items table by adding the quantity in carts table
    //             $itemQuantity = $item->quantity;
    //             $itemInItemTable = Item::find($item->item_id);
    //             $itemInItemTable->quantity += $itemQuantity;
    //             $itemInItemTable->save();
    //         }

    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         Log::error('Error updating status: ' . $e->getMessage());
    //         return response()->json(['error' => 'Internal Server Error'], 500);
    //     }
    // }
