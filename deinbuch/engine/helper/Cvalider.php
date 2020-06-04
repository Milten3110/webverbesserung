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
    //TODO: Not Best Practis Vlid, besser, wenn eine handler klasse die art des valides hat und damit
    //dan die regs zuweist womit dann geprüft wird.
    private function validSuche($input)
    {
        //?([A-z]|[0-9]){3,20}
        $reg_Suche = "/([A-z]|[0-9]){3,20}/";

        preg_match($reg_Suche, $input, $matches);

        if (strlen($matches[0]) > 2) {
            return true;
        } else {
            return false;
        }
    }


    private function validAccountName($input)
    {
        $reg = "/([A-z]|[0-9]|(-)|(_)|(#)){8,20}/";
        preg_match($reg, $input, $matches);
        if (isset($matches[0])) {
            if (strlen($matches[0]) >= 8 && strlen($matches[0]) <= 20) {
                return true;
            }
        } else {
            return false;
        }
    }

    private function validAccountPw($input)
    {
        $reg = "/([A-z]|[0-9]|(-)|(_)|(#)|(!)|(?)){8,20}/";
        preg_match($reg, $input, $matches);
        if (strlen($matches[0]) >= 8 && strlen($matches[0]) <= 20) {
            return true;
        } else {
            return false;
        }
    }

    private function validEmail($input)
    {
        $reg = "/([A-z]|[0-9]){3,20}(@)[A-z]{3,8}(.)[A-z]{2,5}/";
        preg_match($reg, $input, $match);
        if (strlen(@$match[0])) {
            return true;
        } else {
            return false;
        }
    }

    private function validVornameNachname($input)
    {
        $reg = "/[A-z]{3,30}/";
        preg_match($reg, $input, $match);
        if (strlen(@$match[0]) > 3) {
            return true;
        } else {
            return false;
        }
    }

    private function validNummer($input)
    {
        $reg = "/[0-9]{7,13}|\+49[0-9]{6,12}/";
        preg_match($reg, $input, $match);
        if (strlen(@$match[0]) > 7) {
            return true;
        } else {
            return false;
        }
    }

    private function validBundesland($input)
    {
        $reg = "/[A-z]{5,20}/";
        preg_match($reg, $input, $match);
        if (strlen($match[0]) > 4) {
            return true;
        } else {
            return false;
        }
    }

    private function validPlz($input)
    {
        $reg = "/[0-9]{5,5}/";
        preg_match($reg, $input, $match);
        if (strlen($match[0]) > 4) {
            return true;
        } else {
            return false;
        }
    }

    private function validOrt($input)
    {
        $reg = "/[A-z]{6,25}/";
        preg_match($reg, $input, $match);
        if (strlen($match[0]) > 4) {
            return true;
        } else {
            return false;
        }
    }

    private function validStrasse($input)
    {
        $reg = "/[A-z]{6,25}/";
        preg_match($reg, $input, $match);
        if (strlen($match[0]) > 4) {
            return true;
        } else {
            return false;
        }
    }

    private function validHsnr($input)
    {
        $reg = "/[0-9]{1,13}|[A-z]{1,5}[0-9]{1,5}|[0-9]{1,5}[A-z]{1,5}/";
        preg_match($reg, $input, $match);
        if (strlen($match[0]) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Global Functions
    public function validInput($artDerValidierung, $input)
    {
        $this->bool_IstValide = false;

        switch ($artDerValidierung) {
            case 'suche':
                $this->bool_IstValide = $this->validSuche($input);
                break;
            case 'accountName':
                return $this->validAccountName($input);
                break;
            case 'accountPw':
                return $this->validAccountPw($input);
                break;
            case 'email':
                return $this->validEmail($input);
                break;
            case 'vornachname':
                return $this->validVornameNachname($input);
                break;
            case 'nummer':
                //return $this->validNummer($input);
                return true;
                break;
            case 'bundesland':
                return $this->validBundesland($input);
                break;
            case 'ort':
                return $this->validOrt($input);
                break;
            case 'plz':
                return $this->validPlz($input);
                break;
            case 'strasse':
                return $this->validStrasse($input);
                break;
            case 'hsnr':
                return $this->validHsnr($input);
                break;
            default:
                # code...
                return false;
                break;
        }

        return $this->bool_IstValide;
    }
}
