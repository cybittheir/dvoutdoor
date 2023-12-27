<?php

interface iTelegram
{

    function get_message();

    function get_command($query);

    function get_photo($query);

    function get_location($query);

    function get_audio($query);

    function get_video($query);

    function send_message($param);
    
    function send_text($param);
    
    function send_location($param);
    
    function send_file($param);
    
    function send_image($param);

    function send_audio($param);

    function send_video($param);

    function send_keyboard($param);

}

function getIncoming(iTelegram $message)
{
    
    return $message->get_message();

}


class TGBot Implements iTelegram
{

    public function __construct($token) {
        $this->token = $token; 
    }

    function get_message()
    {

        $tg_query=file_get_contents('php://input');
        $update = json_decode($tg_query,true);

        //получаем значение chat_id – идентификатор чата с пользователем, отправившим сообщение
        if (is_array($update)){
            $chatID=$update['message']['chat']['id'];
            $tgUserName=$update['message']['chat']['first_name'];
            $query_txt=$update['message']['text'];

            return compact('update','tg_query');
        } else {return false;}

    }

    function get_command($query)
    {
        echo "get1";
    }

    function get_photo($query)
    {
        echo "get2";
    }

    function get_location($query)
    {
        echo "get3";
    }

    function get_audio($query)
    {
        echo "get4";
    }

    function get_video($query)
    {
        echo "get5";
    }
    function send_message($param)
    {
        echo "send0";
    }
    
    function send_text($param)
    {
        echo "send1";
    }
    
    function send_location($param)
    {
        echo "send2";
    }
    
    function send_file($param)
    {
        echo "send3";
    }
    
    function send_image($param)
    {
        echo "send4";
    }

    function send_audio($param)
    {
        echo "send5";
    }

    function send_video($param)
    {
        echo "send6";
    }

    function send_keyboard($param)
    {
        echo "send7";
    }

}

?>