<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Botuser;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // index
    public function index()
    {


        $orders = Order::deepFilters()
            ->orderByDesc('id')
            ->with('botuser')
            ->with(['orderitem' => function($query){
                return $query->with('product');
            }])

            ->paginate(15);

        return view('pages.order.index',compact('orders'));
    }

    public function status(Request $request)
    {
        $order = Order::find($request->get('order_id'));
        if($request->get('types') == 'st') $order->status_admin = $request->get('status');
        else $order->payment = $request->get('status');
        $order->save();

        if($request->get('status') == '5')
        {
            $orders = Order::where('id', $request->get('order_id'))
                ->with('botuser:id,tg_user_id,name,phone')
                ->with(['orderitem' => function($query){
                    return $query->with('product');
                }])
                ->first();

            $address = "";
            $comment = "";
            $text = "------------\n<b>🛒 Детали:</b>\n------------\n\n";
            $summa = 0;
            $count = 1;
            foreach ($orders->orderitem as $orderitem)
            {
                $text .= "<b>".$count.") ".$orderitem->product->name_ru."</b>\n".$orderitem->quantity." x ".number_format($orderitem->price, 0,' ',' ')." = ".number_format(($orderitem->quantity * $orderitem->price), 0,' ',' ')." сум\n\n";
                $summa += ($orderitem->quantity * $orderitem->price);
                $count++;
            }

            if($orders->address != "0") $address = "<b>Адрес: </b>".$orders->address."\n";
            $comment = "<b>Комментарий к заказу: </b>".(($orders->comment == 'no' || $orders->comment == "Izoh yo'q") ? 'Нет заметки' : $orders->comment)."\n\n";

            $message = "<b>Заказы: №".$orders->id.
                "\n<b>Тип заказа:</b> ".($orders->order_type == "delivery" ? "🚖 Доставка" : "🏃 Самовывоз").
                ($orders->order_type == "take_away" ? "\n<b>Время доставки: </b>".($orders->order_time) : '').
                "</b>\n<b>Имя:</b> ".$orders->botuser->name.
                "\n<b>Телефон:</b> +".$orders->botuser->phone."\n".
                $address.
                (($orders->order_type == "delivery" && strlen($orders->botuser->address)) ? "<b>Адрес в админ панеле: </b>".$orders->botuser->address : '').
                $comment.
                $text.
                "------------\n".
                "<b>💳 Сумма заказа: </b>".number_format($orders->summa - $orders->d_price, 0,' ',' ')." cум\n".
                ($orders->order_type != "take_away" ? ("<b>🚚 Цена доставки: </b>".number_format($orders->d_price, 0,' ',' ')."  cум\n") : "").
                "------------".
                "\n<b>Итого сумма: ".number_format($orders->summa, 0,' ',' ')." сум</b>";

            $this->sendByTelegram($message);

            if($orders->latitude && $orders->longitude)
                $this->sendByLocationTelegram($orders->latitude, $orders->longitude);

        }


        return response()->json([
            'status' => true,
            'message' => "ok"
        ]);
    }

    function sendByTelegram($message, $chatID = '-1001608154390')
    {
        $token  = config('constants.bot.token');
        $chatID = config('constants.bot.orders_group');

        $removeKeyboard = array('remove_keyboard' => true);
        $removeKeyboardEncoded = json_encode($removeKeyboard);

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=HTML&chat_id=" . $chatID."&reply_markup=".$removeKeyboardEncoded;
        $url = $url . "&text=" . urlencode($message);

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

    function sendByLocationTelegram($lat, $lang, $chatID = '-1001608154390')
    {
        $token  = config('constants.bot.token');
        $chatID = config('constants.bot.orders_group');

        $url = "https://api.telegram.org/bot" . $token . "/sendlocation?chat_id=".$chatID."&latitude=".$lat."&longitude=".$lang;
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
