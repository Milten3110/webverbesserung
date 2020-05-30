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
        
        if(strlen($matches[0]) > 2 ){
            return true;
        }
        else{
            return false;
        }
    }

    //Global Functions
    public function validInput($artDerValidierung, $input){
        $this->bool_IstValide = false;

        switch ($artDerValidierung) {
            case 'suche':
                $this->bool_IstValide = $this->validSuche($input);
                
                break;
            
            default:
                # code...
                break;
        }

        return $this->bool_IstValide;
    }
}