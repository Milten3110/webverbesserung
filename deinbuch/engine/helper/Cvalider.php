<?php

class CValider
{
    //Global Klassen Values
    var $bool_IstValide;




    function __construct()
    {
        $this->bool_IstValide = false;
    }
    function __destruct()
    {
        
    }

    //Private Functions
    private function validSuche($input){
        //?([A-z]|[0-9]){3,20}
        $reg_Suche = "/([A-z]|[0-9]){3,20}/";
        
        preg_match($reg_Suche, $input, $matches);
        echo var_dump($matches);

        return false;
    }

    //Global Functions
    public function validInput($artDerValidierung, $input){
        
        switch ($artDerValidierung) {
            case 'suche':
                $this->validSuche($input);
                
                break;
            
            default:
                # code...
                break;
        }

        return $this->bool_IstValide;
    }
}