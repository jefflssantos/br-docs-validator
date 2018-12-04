<?php

namespace Jefflssantos\BrDocsValidator;


class BrDocsValidator
{
    protected $value;

    /**
    * Validate CPF or CNPJ.
    *
    * @param String $value
    */
    public function __construct(String $value)
    {
        $this->value = preg_replace('/\D/', '', $value);
    }

    /**
    * Validate CPF or CNPJ.
    *
    * @return Boolean
    */
    public function validateCPFOrCNPJ(): bool
    {
        if(! $this->isFitForChecking($this->value)) {
            return false;
        }

        if(strlen($this->value) == 11) {
            return $this->validateCPF();
        }

        if(strlen($this->value) == 14) {
           return $this->validateCNPJ();
        }

        return false;
    }

    /**
    * Validate CPF.
    *
    * @author Douglas Resende Maciel <eu@douglasresende.com>
    * @return Boolean
    */
    public function validateCPF(): bool
    {
        if(! $this->isFitForChecking($this->value)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $this->value[$i++] * $s--);

        if ($this->value[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $this->value[$i++] * $s--);

        if ($this->value[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    /**
    * Validate CNPJ.
    *
    * @author Douglas Resende Maciel <eu@douglasresende.com>
    * @return Boolean
    */
    public function validateCNPJ(): bool
    {
        if(! $this->isFitForChecking($this->value)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $this->value[$i] * $b[++$i]);

        if ($this->value[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $this->value[$i] * $b[$i++]);

        if ($this->value[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    /**
    * Validate CNPJ.
    * @param String $value
    * @return Boolean
    */

    protected function isFitForChecking(String $value): bool
    {
        $length = strlen($value);

        // precheck cpf
        if($length == 11 &&
            $value != "00000000000" &&
            $value != "11111111111" &&
            $value != "22222222222" &&
            $value != "33333333333" &&
            $value != "44444444444" &&
            $value != "55555555555" &&
            $value != "66666666666" &&
            $value != "77777777777" &&
            $value != "88888888888" &&
            $value != "99999999999"
        ) {
            return true;
        }

        // precheck cnpj
        if($length == 14 &&
            $value != "00000000000000" &&
            $value != "11111111111111" &&
            $value != "22222222222222" &&
            $value != "33333333333333" &&
            $value != "44444444444444" &&
            $value != "55555555555555" &&
            $value != "66666666666666" &&
            $value != "77777777777777" &&
            $value != "88888888888888" &&
            $value != "99999999999999"
        ) {
            return true;
        }

        return false;
    }
}