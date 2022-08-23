<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Current;
use Illuminate\Console\Command;

class sendOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        for($i = 0; $i < 5; $i ++)
        {
            //$this->sendByTelegram("okk");
            $orders = Order::where( 'status_admin', 0)
                ->with('botuser:id,tg_user_id,name,phone')
                ->with(['orderitem' => function($query){
                    return $query->with('product');
                }])
                ->first();
           if(isset($orders))
           {
               $orders->status_admin = 5;
               $orders->save();

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
                   ("\n<b>Способ оплаты: </b>").($orders->payment_method == 'naqd' ? "💵 Наличные" : "💳 Пластиковая карта").
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

        }

        for($i = 0; $i < 0; $i ++)
        {
            //$this->sendByTelegram("kokk");
            $currentTime = strtotime(date('Y-m-d H:i:s'));
            $orders = Order::where( 'status_otziv', 0)
                ->with('current')
                ->first();
            if(isset($orders))
            {

                $createdTime = (strtotime($orders->created_at) + 2 * 60 * 60);
                //$this->sendOtziv(($currentTime - $createdTime)." - ".(90 * 60), 'uz', '1371980494');
                if(($currentTime - $createdTime) >= (90 * 60))
                {

                    $orders->status_otziv = 1;
                    $orders->save();
                    $current = Current::where('tg_user_id', $orders->tg_user_id)
                        ->first();
                    $lang = $current->lang;
                    $message =__('panel.order_otziv.'.$lang.'.rate_text');
                    $chatId = $current->tg_user_id;
                    $this->sendOtziv($message, $lang, $chatId);

                    $current->menu = 'otziv_asked';
                    $current->save();
                }

            }
            //$this->sendByTelegram(json_encode($orders));
            //$this->sendByTelegram("ok");
        }
    }

    function sendByTelegram($message)
    {
        $token  = config('constants.bot.token');
        $chatID = config('constants.bot.orders_group');

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=HTML&chat_id=" . $chatID;
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
    function sendByLocationTelegram($lat, $lang)
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

    function sendOtziv($message, $lang = 'uz', $chatId)
    {
        $token  = config('constants.bot.token');
        $chatID = $chatId;//config('constants.bot.orders_group');

        $removeKeyboard = array(
            'resize_keyboard' => true,
            'keyboard' => [
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.rate5') ],
                ],
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.rate4') ],
                ],
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.rate3') ],
                ],
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.rate2') ],
                ],
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.rate1') ],
                ],
                [
                    ['text' => __('panel.order_otziv.'.$lang.'.back') ],
                ],
            ]
            );
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

}

