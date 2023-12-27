<?php

class constr_obj 
{
    
    public function get_constr_obj($id,
                                    $city="Владивосток",
                                    $address,
                                    $reg_num="0",
                                    $type,
                                    $injob_date,
                                    $outjob_date="9999-12-31",
                                    $media="none")
    {

        return new constr_obj($id,
                                $city,
                                $address,
                                $reg_num,
                                $type,
                                $injob_date,
                                $outjob_date,
                                $media);

    }

    public function get_ID()
    
    {

        return $this->ID;
    }

    public function get_City()
    
    {

        return $this->City;
    }

    public function get_Address()
    
    {

        return $this->Address;
    }

    public function get_RegNum()
    
    {

        return $this->RegNum;
    }

    public function get_Type()
    
    {

        return $this->Type;
    }

    public function get_Injob_date()
    
    {

        return $this->Injob_date;
    }

    public function get_Outjob_date()
    
    {

        return $this->Outjob_date;
    }

    public function Media()
    
    {

        return $this->Media;
    }

    private $ID;
    private $City;
    private $Address;
    private $RegNum;
    private $Type;
    private $Injob_date;
    private $Outjob_date;
    private $Media;

    private function __construct ($id,
                                    $city="Владивосток",
                                    $address,
                                    $reg_num="0",
                                    $type,
                                    $injob_date,
                                    $outjob_date="9999-12-31",
                                    $media="0") 
    {
        $this->ID = $id;
        $this->City = $city;
        $this->Address = $address;
        $this->RegNum = $reg_num;
        $this->Type = $type;
        $this->Injob_date = $injob_date;
        $this->Outjob_date = $outjob_date;
        $this->Media = $media;

    }

}

?>
