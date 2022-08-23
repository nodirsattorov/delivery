<?php

namespace App\Console\Commands;

use App\Models\Botuser;
use App\Models\Mailing;
use Illuminate\Console\Command;

class sendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send a message to all users';

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
        $mailing = Mailing::where('status', 2)
            ->orderBy('id')
            ->first();

        if(1)
        {
            $startTime      = microtime(true) * 10000;
            $currentTime    = microtime(true) * 10000;
            $text = $mailing->text;
            $text = str_replace("<p>", "",$text);
            $text = str_replace("</p>", "",$text);
            $text = str_replace("<br />", "",$text);
            $string = htmlentities($text, null, 'utf-8');
            $content = str_replace("&amp;nbsp;", "", $string);
            $content = html_entity_decode($content);
            $text = $content;
            $count = 1;
            while(($currentTime - $startTime) < 500000 && $count > 0)
            {
                $subCurrentTime    = microtime(true) * 10000;

                $users = Botuser::where('sendmessage', 0)
                    ->orderBy('id')
                    ->take(20)
                    ->get();
                $count = 0;
                foreach ($users as $user):
                    $count += 1;
                    $this->sendPhoto($mailing->photo, $text, $user->tg_user_id);
                endforeach;

                Botuser::where('sendmessage', 0)->orderBy('id')->take($count)->update(['sendmessage' => 1]);

                if($count == 0)
                {
                    Botuser::where('sendmessage', 1)
                        ->orderBy('id')
                        ->update(['sendmessage' => 0]);

                    Mailing::where('status', 2)
                        ->orderBy('id')
                        ->take(1)
                        ->update(['current' => $mailing->total]);

                    Mailing::where('status', 2)
                        ->orderBy('id')
                        ->take(1)
                        ->update(['status' => 3]);
                }
                $currentTime    = microtime(true) * 10000;
                if(($currentTime - $subCurrentTime) < 10000) sleep(1);
            }
        }
    }

    function sendPhoto($photo, $message, $chatID = '-1001608154390')
    {
        $token  = config('constants.bot.token');
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
