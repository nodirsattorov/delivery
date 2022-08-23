<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
class SettingsController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Settings::find(1);
        if($request->has('price'))
        {
            $data->d_price = $request->price;
            $data->min_price = $request->min_price;
            $data->bonus_price = $request->bonus_price;
            $data->save();
        }

        return view('pages.settings.index', compact('data'));
    }

}
