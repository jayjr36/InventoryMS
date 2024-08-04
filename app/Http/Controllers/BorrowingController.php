<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\BorrowingRecord;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function create()
    {
        return view('borrowings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:items,barcode',
            'user_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'borrowed_at' => 'required|date',
        ]);

        $item = Item::where('barcode', $request->barcode)->first();

        if ($item->quantity < $request->quantity) {
            return redirect()->back()->withErrors('Not enough items in stock.');
        }

        $item->quantity -= $request->quantity;
        $item->save();

        BorrowingRecord::create([
            'item_id' => $item->id,
            'user_name' => $request->user_name,
            'quantity' => $request->quantity,
            'borrowed_at' => Carbon::parse($request->borrowed_at),
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Item borrowed successfully.');
    }

    public function index()
    {
        $borrowings = BorrowingRecord::with('item')->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function returnForm()
    {
        return view('borrowings.return');
    }

    public function returnItem(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:items,barcode',
            'user_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::where('barcode', $request->barcode)->first();
        $borrowing = BorrowingRecord::where('item_id', $item->id)
            ->where('user_name', $request->user_name)
            ->where('returned_at', null)
            ->first();

        if (!$borrowing || $borrowing->quantity < $request->quantity) {
            return redirect()->back()->withErrors('Invalid return quantity.');
        }

        $item->quantity += $request->quantity;
        $item->save();

        if ($borrowing->quantity == $request->quantity) {
            $borrowing->returned_at = Carbon::now();
        } else {
            $borrowing->quantity -= $request->quantity;
        }

        $borrowing->save();

        return redirect()->route('borrowings.index')->with('success', 'Item returned successfully.');
    }

    public function personIndex()
    {
        $user = Auth::user();

        $borrowingRecords = BorrowingRecord::where('user_name', $user->name)->get();

        return view('borrowings.personalList', compact('borrowingRecords'));
    }
}
