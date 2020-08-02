<?php

class NumberToWord
{
    private $units = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    private $teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    private $tens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    /**
     * Takes a number and outputs a string to represent that number
     * e.g. numberToWord(34) will output "thirty four"
     *
     * @param integer $number
     * @return string
     */
    public function process(int $number)
    {
        if ($number < 20) {
            return $this->getUnit($number);
        }

        $units = $number % 10;
        $tens = $number / 10;
        $hundred = (int) floor($number / 100);

        if ($units === 0 && $hundred === 0) {
            return $this->getTen($tens);
        }
        
        if ($number < 100) {
            return $this->getTen($tens) . ' ' . $this->getUnit($units);
        }

        return $this->getHundred($hundred) . ' ' . $this->getTen($tens) . ' ' . $this->getUnit($units);
    }

    private function getUnit(int $number)
    {
        if ($number === 0) {
            return '';
        }

        if ($number > 9) {
            $teen = $number % 10;
            return $this->teens[$teen];
        }

        return $this->units[$number - 1];
    }

    private function getTen(int $number)
    {
        if ($number >= 10) {
            $number = $number - 10;
        }

        $parsed = $number % 10;

        if ($parsed === 0) {
            return 'and';
        }

        if ($parsed === 1) {
            return '';
        }

        return $this->tens[$parsed - 2];
    }

    private function getHundred(int $number)
    {
        return $this->units[$number - 1] . ' hundred';
    }
}

$numberToWord = new NumberToWord();
for ($i = 1; $i <= 999; $i++) {
    echo $numberToWord->process($i) . PHP_EOL;
}
