<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Botuser;
use Illuminate\Http\Request;

class BotuserController extends Controller
{
    public function index()
    {


        $botusers = Botuser::deepFilters()
            ->orderByDesc('id')
            ->with('orders')
            ->paginate(15);

//        $orders = Order::all();

        return view('pages.botuser.index',compact('botusers'));
    }
    // edit page
    public function edit($id)
    {
        $botuser = Botuser::find($id);
        return view('pages.botuser.edit', compact('botuser'));
    }

    // edit page
    public function editaddress($id)
    {
        $botuser = Botuser::find($id);
        return view('pages.botuser.editaddress', compact('botuser'));
    }

    // update data
    public function update(Request $request, $id)
    {
        $botuser = Botuser::find($id);

        $botuser->address = $request->get('address');
        $botuser->save();

        return redirect()->route('botuserIndex');
    }

    public function updateaddress(Request $request, $id)
    {
        $botuser = Botuser::find($id);

        $botuser->address = $request->get('address');
        $botuser->save();

        return redirect()->route('orderIndex');
    }

}
