<?php namespace Nasution;

class Terbilang
{
    public static function convert($number)
    {
        $number = str_replace('.', '', $number);

        if ( ! is_numeric($number)) throw new NotNumbersException;

        $base    = array('Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        $numeric = array('1000000000000000', '1000000000000', '1000000000000', 1000000000, 1000000, 1000, 100, 10, 1);
        $unit    = array('Kuadriliun', 'Triliun', 'Biliun', 'Milyar', 'Juta', 'Ribu', 'ratus', 'puluh', '');
        $str     = null;

        $i = 0;

        if ($number == 0)
        {
            $str = 'Nol';
        }
        else
        {
            while ($number != 0)
            {
                $count = (int)($number / $numeric[$i]);

                if ($count >= 10)
                {
                    $str .= static::convert($count) . ' ' . $unit[$i] . ' ';
                }
                elseif ($count > 0 && $count < 10)
                {
                    $str .= $base[$count] . ' ' . $unit[$i] . ' ';
                }

                $number -= $numeric[$i] * $count;

                $i++;
            }

            $str = preg_replace('/Satu puluh (\w+)/i', '\1 belas', $str);
            $str = preg_replace('/Satu (Ribu|ratus|puluh|belas)/', 'Se\1', $str);
            $str = preg_replace('/\s{2,}/', ' ', trim($str));
        }

        return $str;
    }
}
