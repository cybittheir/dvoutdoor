<?php

class media
{

    public function get_media ($id,
                                $side,
                                $construction,    
                                $player="none",
                                $light_control="none",
                                $wifi_responder="none",
                                $camera="none",
                                $status="none",
                                $uptime="none",
                                $parameters="none")
    {

        return new media($id,
                        $side,
                        $construction,    
                        $player,
                        $light_control,
                        $wifi_responder,
                        $camera,
                        $status,
                        $uptime,
                        $parameters);

    }

    public function get_ID () {

        return $this->ID;

    }

    public function get_Side () {

        return $this->Side;

    }

    public function get_Construction () {

        return $this->Construction;

    }

    public function get_Player () {

        return $this->Player;

    }

    public function get_LightControl () {

        return $this->Light_Control;

    }

    public function get_WiFiResponder () {

        return $this->WiFi_responder;

    }

    public function get_Camera () {

        return $this->Camera;

    }

    public function get_Status () {

        return $this->Status;

    }

    public function get_UpTime () {

        return $this->UpTime;

    }

    public function get_Parameters () {

        return $this->Parameters;

    }

    private $ID;
    private $Side;
    private $Construction;
    private $Player;
    private $Light_Control;
    private $WiFi_responder;
    private $Camera;
    private $Status;
    private $UpTime;
    private $Parameters;

    private function __construct($id,
                                $side,
                                $construction,    
                                $player="none",
                                $light_control="none",
                                $wifi_responder="none",
                                $camera="none",
                                $status="none",
                                $uptime="none",
                                $parameters="none")
    {
        $this->ID = $id;
        $this->Side = $side;
        $this->Construction = $construction;
        $this->Player = $player;
        $this->Light_Control = $light_control;
        $this->WiFi_responder = $wifi_responder;
        $this->Camera = $camera;
        $this->Status = $status;
        $this->UpTime = $uptime;
        $this->Parameters = $parameters;
        
    }

}

?>