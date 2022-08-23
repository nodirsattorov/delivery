<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Botuser;
use App\Models\Mailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{
    public function index()
    {


        $mailings = Mailing::deepFilters()
            ->orderByDesc('id')
            ->paginate(15);
//        $orders = Order::all();
        //dd($mailings);

        return view('pages.mailing.index',compact('mailings'));
    }

    // add mailing page
    public function add()
    {
        return view('pages.mailing.add');
    }

    //create category
    public function create(Request $request)
    {

        $this->validate($request,[
            'text' => 'required'
        ]);

        $mailing = Mailing::create([
            'text' => $request->get('text'),
            'photo' => '0',
            'status' => '0',
            'total' => '0',
            'current' => '0'
        ]);

        if ($request->hasFile('photo'))
        {
            $file = $request->photo;
            $name = (microtime(true)*10000).'.'.$file->extension();
            $mailing->photo = $name;
            $mailing->save();

            // upload file to files folder
            $file->move($mailing->public_path(), $name);
        }

        return redirect()->route('mailingIndex');
    }

    // edit page
    public function edit($id)
    {
        $mailing = Mailing::find($id);
        return view('pages.mailing.edit',compact('mailing'));
    }

    // update data
    public function update(Request $request,$id)
    {
        //dd($request);
        $mailing = Mailing::find($id);

        $mailing->text = $request->get('text');

        if ($request->hasFile('photo'))
        {
            $file = $request->photo;
            $name = (microtime(true)*10000).'.'.$file->extension();
            $mailing->photo = $name;
            // upload file to files folder
            $file->move($mailing->public_path(), $name);
        }
        $mailing->save();

        return redirect()->route('mailingIndex');
    }

    // delete permission
    public function destroy($id)
    {
        $mailing = Mailing::find($id);
        $mailing->delete();
        return redirect()->back();
    }

    public function status(Request $request)
    {
        //dd($request);
        $mailing = Mailing::find($request->get('mailing_id'));
        $mailing->status = $request->get('status');
        $mailing->save();

        if($request->get('status') == '1')
        {
            $text = $mailing->text;

            $text = str_replace("<p>", "",$text);
            $text = str_replace("</p>", "",$text);
            $text = str_replace("<br />", "",$text);



            $string = htmlentities($text, null, 'utf-8');
            $content = str_replace("&amp;nbsp;", "", $string);
            $content = html_entity_decode($content);
            $text = $content;

            $result = $this->sendPhoto($mailing->photo, $text);
        }
        else
        {
            $count = Botuser::count();
            $mailing->total = $count;
            $mailing->save();
        }
        return response()->json([
            'status' => true,
            'message' => "ok"
        ]);
    }


    function sendPhoto($photo,$message)
    {
        $token  = config('constants.bot.token');
        $chatID = config('constants.bot.orders_group');
        $photoUrl = config('constants.bot.photo_url');

        $url = "https://api.telegram.org/bot" . $token . "/sendPhoto?parse_mode=HTML&chat_id=" . $chatID."&photo=".$photoUrl.$photo;

        $url = $url . "&caption=" . urlencode($message);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-type:application/json']);

        //ssl settings
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}
