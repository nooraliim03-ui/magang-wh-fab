<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlcUploadFrn;
use App\Models\User;

class BlcUploadFrnSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $data = [
            [
                'kp' => 'UQL4006158',
                'style' => '326H041C',
                'country' => 'JP',
                'item' => 'Shell',
                'color' => 'Beige',
                'relax' => 'Ok 14/3. 22.30',
                'qty_request' => 1200,
                'blc' => -200,
                'podo' => '2026-04-15',
                'kendala' => 'Material delay',
                'keterangan' => 'Urgent shipment'
            ],
            [
                'kp' => 'UQL4012209',
                'style' => '327K052D',
                'country' => 'KR',
                'item' => 'Body',
                'color' => 'Black',
                'relax' => 'Ok 14/3. 22.30',
                'qty_request' => 850,
                'blc' => -100,
                'podo' => '2026-04-15',                
                'kendala' => null,
                'keterangan' => 'Production running'
            ],
            [
                'kp' => 'UQL3987741',
                'style' => '325G089A',
                'country' => 'US',
                'item' => 'Lining',
                'color' => 'Navy',
                'relax' => 'Ok 14/3. 22.30',
                'qty_request' => 1600,
                'blc' => -700,
                'podo' => '2026-04-15',
                'kendala' => 'Material shortage',
                'keterangan' => 'Waiting supplier'
            ],
            [
                'kp' => 'UQL4028810',
                'style' => '328M113E',
                'country' => 'JP',
                'item' => 'Shell',
                'color' => 'Olive',            
                'relax' => 'Ok 14/3. 22.30',
                'qty_request' => 1000,
                'blc' => 150,
                'podo' => '2026-04-15',
                'kendala' => null,
                'keterangan' => 'Extra production'
            ]
        ];

        foreach ($data as $item) {

            BlcUploadFrn::create([
                'kp' => $item['kp'],
                'user_id' => $users->random()->id,
                'style' => $item['style'],
                'country' => $item['country'],
                'item' => $item['item'],
                'color' => $item['color'],
                'relax' => $item['relax'],
                'qty_request' => $item['qty_request'],
                'blc' => $item['blc'],
                'podo' => $item['podo'],
                'kendala' => $item['kendala'],
                'keterangan' => $item['keterangan'],
            ]);

        }
    }
}