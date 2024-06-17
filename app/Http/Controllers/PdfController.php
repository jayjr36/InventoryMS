<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function usersPdf()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.users', compact('users'));

        return $pdf->stream('users.pdf');
    }

    public function itemsPdf()
    {
        $items = Item::all();

        $pdf = PDF::loadView('pdf.allitems', compact('items'));

        return $pdf->stream('Inventories.pdf');
    }


    public function debtsPdf()
{
    $items = Cart::where('status', 'approved')->get();

    $pdf = PDF::loadView('pdf.debts', compact('items'));

    return $pdf->stream('Debts.pdf');
}

public function requestPdf()
{
    $items = Cart::where('status', 'pending')->get();

    $pdf = PDF::loadView('pdf.pending', compact('items'));

    return $pdf->stream('Requests.pdf');
}

public function clearedPdf()
{
    $items = Cart::where('status', 'Cleared')->get();

    $pdf = PDF::loadView('pdf.clear', compact('items'));

    return $pdf->stream('Cleared.pdf');
}

}
