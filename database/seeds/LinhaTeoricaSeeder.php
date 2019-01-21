<?php

use Illuminate\Database\Seeder;
use App\LinhaTeoricaModel as Linha;

class LinhaTeoricaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Linha::create([
            'tx_nome'    => 'Psicoanálise Infantil',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Psicoanálise Adolescente/Adulto',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Fenomenologia',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Análise do Comportamento Infantil',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Análise do Comportamento Adolescente/Adulto',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Sistêmica',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Psicodrama',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Terapia Cognitiva Comportamental',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

        Linha::create([
            'tx_nome'    => 'Sócio Histórica',
            'tx_desc'    => '-',
            'status'  => 'A',
        ]);

    }
}
