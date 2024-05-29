<?php

class Validators
{
    public function formattingCPF(string $cpf)
    {
        $cpf = trim($cpf);
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);

        return $cpf;
    }
}