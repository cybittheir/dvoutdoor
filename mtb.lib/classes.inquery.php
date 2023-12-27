
<?php

class inquery 

{
    public function getInquery ($update_id,
                                $chat_id,
                                $from_chat_id,
                                $text,
                                $photo="",
                                $audio="",
                                $video="",
                                $location="")
    {
        return new inquery ($update_id,
                            $chat_id,
                            $from_chat_id,
                            $text,
                            $photo,
                            $audio,
                            $video,
                            $location);
    }

    public function get_update_ID()
    {

        return $this->Update;

    }

    public function get_chat_ID()
    {

        return $this->Chat;

    }

    public function get_from_chat_ID()
    {

        return $this->FromChat;

    }

    public function get_Text()
    {

        return $this->Text;

    }

    public function get_Photo()
    {

        return $this->Photo;

    }

    public function get_Audio()
    {

        return $this->Audio;

    }

    public function get_Video()
    {

        return $this->Video;

    }

    public function get_Location()
    {

        return $this->Location;

    }

    private $Update;
    private $Chat;
    private $FromChat;
    private $Text;
    private $Photo;
    private $Audio;
    private $Video;
    private $Location;

    private function __construct($update_id,
                            $chat_id,
                            $from_chat_id,
                            $text,
                            $photo="",
                            $audio="",
                            $video="",
                            $location="")
    {

        $this->Update=$update_id;
        $this->Chat=$chat_id;
        $this->FromChat=$from_chat_id;
        $this->Text=$text;
        $this->Photo=$photo;
        $this->Audio=$audio;
        $this->Video=$video;
        $this->Location=$location;
    
    }


}

?>