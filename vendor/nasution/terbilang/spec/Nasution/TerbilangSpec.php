<?php namespace spec\Nasution;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TerbilangSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Nasution\Terbilang');
    }

    function it_can_convert_numbers_into_words()
    {
        $this->convert(0)->shouldReturn('Nol');
        $this->convert(1)->shouldReturn('Satu');
        $this->convert(2)->shouldReturn('Dua');
        $this->convert(3)->shouldReturn('Tiga');
        $this->convert(4)->shouldReturn('Empat');
        $this->convert(5)->shouldReturn('Lima');
        $this->convert(6)->shouldReturn('Enam');
        $this->convert(7)->shouldReturn('Tujuh');
        $this->convert(8)->shouldReturn('Delapan');
        $this->convert(9)->shouldReturn('Sembilan');
        $this->convert(10)->shouldReturn('Sepuluh');

        $this->convert(11)->shouldReturn('Sebelas');
        $this->convert(12)->shouldReturn('Dua Belas');
        $this->convert(13)->shouldReturn('Tiga Belas');
        $this->convert(14)->shouldReturn('Empat Belas');
        $this->convert(15)->shouldReturn('Lima Belas');
        $this->convert(16)->shouldReturn('Enam Belas');
        $this->convert(17)->shouldReturn('Tujuh Belas');
        $this->convert(18)->shouldReturn('Delapan Belas');
        $this->convert(19)->shouldReturn('Sembilan Belas');
        $this->convert(20)->shouldReturn('Dua Puluh');

        $this->convert(42)->shouldReturn('Empat Puluh Dua');

        $this->convert(99)->shouldReturn('Sembilan Puluh Sembilan');

        $this->convert(100)->shouldReturn('Seratus');

        $this->convert(121)->shouldReturn('Seratus Dua Puluh Satu');

        $this->convert(504)->shouldReturn('Lima Ratus Empat');

        $this->convert(554)->shouldReturn('Lima Ratus Lima Puluh Empat');

        $this->convert(1000)->shouldReturn('Seribua');

        $this->convert(20000)->shouldReturn('Dua Puluh Ribu');

        $this->convert(1000000)->shouldReturn('Satu Juta');

        $this->convert(1234567)->shouldReturn('Satu Juta Dua Ratus Tiga Puluh Empat Ribu Lima Ratus Enam Puluh Tujuh');
    }

    function it_can_convert_numbers_in_string()
    {
        $this->convert('1000000')->shouldReturn('Satu Juta');
        $this->convert('1234567')->shouldReturn('Satu Juta Dua Ratus Tiga Puluh Empat Ribu Lima Ratus Enam Puluh Tujuh');
    }

    function it_can_convert_numbers_with_dot_notations()
    {
        $this->convert('10.000.000')->shouldReturn('Sepuluh Juta');

        $this->convert('100.000.000')->shouldReturn('seratus Juta');

        $this->convert('1.000.000.000')->shouldReturn('Satu Milyar');

        $this->convert('1.000.000.000.000')->shouldReturn('Satu Triliun');

        $this->convert('1.000.000.000.000.000')->shouldReturn('Satu Kuadriliun');
    }

    function it_should_thown_an_error_if_value_is_not_numeric()
    {
        $this->shouldThrow('Nasution\NotNumbersException')->duringConvert('Wrong');
    }
}
