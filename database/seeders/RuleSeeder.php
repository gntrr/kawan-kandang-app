<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            [
                'kode_rule' => 'R1',
                'nama_rule' => 'Rule 1',
                'if_condition' => 'G012 AND G023 AND G024',
                'then_condition' => 'P001'
            ],
            [
                'kode_rule' => 'R2',
                'nama_rule' => 'Rule 2',
                'if_condition' => 'G001 AND G003 AND G015 AND G021',
                'then_condition' => 'P002'
            ],
            [
                'kode_rule' => 'R3',
                'nama_rule' => 'Rule 3',
                'if_condition' => 'G013 AND G014 AND G019 AND G025',
                'then_condition' => 'P003'
            ],
            [
                'kode_rule' => 'R4',
                'nama_rule' => 'Rule 4',
                'if_condition' => 'G001 AND G002 AND G004 AND G010 AND G011 AND G020',
                'then_condition' => 'P004'
            ],
            [
                'kode_rule' => 'R5',
                'nama_rule' => 'Rule 5',
                'if_condition' => 'G001 AND G016 AND G023 AND G028',
                'then_condition' => 'P005'
            ],
            [
                'kode_rule' => 'R6',
                'nama_rule' => 'Rule 6',
                'if_condition' => 'G006 AND G009 AND G010 AND G030 AND G031',
                'then_condition' => 'P006'
            ],
            [
                'kode_rule' => 'R7',
                'nama_rule' => 'Rule 7',
                'if_condition' => 'G001 AND G032 AND G038 AND G039',
                'then_condition' => 'P007'
            ],
            [
                'kode_rule' => 'R8',
                'nama_rule' => 'Rule 8',
                'if_condition' => 'G002 AND G018 AND G029',
                'then_condition' => 'P008'
            ],
            [
                'kode_rule' => 'R9',
                'nama_rule' => 'Rule 9',
                'if_condition' => 'G001 AND G005 AND G009 AND G040',
                'then_condition' => 'P009'
            ],
            [
                'kode_rule' => 'R10',
                'nama_rule' => 'Rule 10',
                'if_condition' => 'G001 AND G022 AND G041',
                'then_condition' => 'P010'
            ],
            [
                'kode_rule' => 'R11',
                'nama_rule' => 'Rule 11',
                'if_condition' => 'G002 AND G036 AND G037 AND G042',
                'then_condition' => 'P011'
            ],
            [
                'kode_rule' => 'R12',
                'nama_rule' => 'Rule 12',
                'if_condition' => 'G001 AND G017 AND G035 AND G043',
                'then_condition' => 'P012'
            ],
            [
                'kode_rule' => 'R13',
                'nama_rule' => 'Rule 13',
                'if_condition' => 'G007 AND G008 AND G026 AND G027 AND G033 AND G034',
                'then_condition' => 'P013'
            ],
            [
                'kode_rule' => 'R14',
                'nama_rule' => 'Rule 14',
                'if_condition' => 'G008 AND G017 AND G044',
                'then_condition' => 'P014'
            ],
            [
                'kode_rule' => 'R15',
                'nama_rule' => 'Rule 15',
                'if_condition' => 'G001 AND G005 AND G004 AND G040',
                'then_condition' => 'P015'
            ],
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
}
