<?php

class possessive
{
    // Kişisel ayarlar
    private static $encoding = "UTF-8";
    private static $conjunction = "'"; // bağlaç
    private static $vowels = "aeıioüuü"; //sesli harfler

    //sistem tarafından tanımlanacaklar
    private static $vocable;
    private static $_vocable;
    private static $PossessiveSuffixes;

    /**
     * Kelimeye iyelik eki ekler.
     * @param $_vocable
     * @param string $addtoend
     * @param null $forming
     * @return string
     */
    static function add($_vocable, $addtoend = '', $forming = null)
    {
        self::$vocable = $_vocable;

        $possessive = self::possession(self::lastLetter());
        self::$_vocable = self::$vocable."".self::$conjunction."".$possessive." ".$addtoend;
        self::$_vocable = ($forming != null) ? self::setFoming($forming) : self::$_vocable;
        return self::$_vocable;
    }

    /**
     * Kullanıcıyı ilgilendirmeyen bir fonksiyondur. Amacı ise son harfi ve uygun iyelik eklerini verir.
     * @return false|string
     */
    private static function lastLetter()
    {
        if (strrchr(self::$vowels, substr(mb_strtolower(self::$vocable, self::$encoding), -1))) {
            $controlLetter = substr(mb_strtolower(self::$vocable, self::$encoding), -1);
            self::$PossessiveSuffixes = array('nın', 'nin', 'nun', 'nün');
        } else {
            $controlLetter = substr(mb_strtolower(self::$vocable, self::$encoding), -2, 1);
            self::$PossessiveSuffixes = array('ın', 'in', 'un', 'ün');
        }
        return $controlLetter;
    }

    /**
     * Kullanıcıyı ilgilendirmeyen bir fonksiyondur. Görevi ise uyumlu iyelik ekini bulmaktır.
     * @param $controlLatter
     * @return string
     */
    private static function possession($controlLatter)
    {
        switch ($controlLatter) {
            case "a":
            case "ı":
                $iyelik = self::$PossessiveSuffixes[0];
                break;
            case "e":
            case "i":
                $iyelik = self::$PossessiveSuffixes[1];
                break;
            case "o":
            case "u":
                $iyelik = self::$PossessiveSuffixes[2];
                break;
            case "ö":
            case "ü":
                $iyelik = self::$PossessiveSuffixes[3];
                break;
            default:
                $iyelik = 'nın';
                break;
        }
        return $iyelik;
    }

    /**
     * Kullanıcıyı ilgilendirmeyen fonksiyondur. Biçimlendirme yapar.
     * @return string
     */
    private static function setFoming($forming)
    {
        switch($forming) {
            case "tolower":
                return mb_strtolower(self::$_vocable,self::$encoding);
                break;
            case "toupper":
                return mb_strtoupper(self::$_vocable,self::$encoding);
                break;
            case "tofirstupper":
                return ucfirst(mb_strtolower(self::$_vocable,self::$encoding));
                break;
        }
    }
}
