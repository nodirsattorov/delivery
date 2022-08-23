<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::deepFilters()
            ->orderByDesc('id')
            ->with('botuser:id,tg_user_id,name,phone')
//            ->with(['orderitem' => function($query){
//                return $query->with('product');
//            }])
            ->paginate(15);
        //        $orders = Order::all();
        //dd($complaints);

        return view('pages.complaint.index',compact('complaints'));
    }

    public function status(Request $request)
    {
        //dd($request);
        $complaint = Complaint::find($request->get('id'));
        $complaint->status = $request->get('status');
        $complaint->save();

        return response()->json([
            'status' => true,
            'message' => "ok"
        ]);
    }
}
