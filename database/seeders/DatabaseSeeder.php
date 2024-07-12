<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SalaryUnits;
use App\Models\SocialBenefits;
use App\Models\Deductions;
use App\Models\SolidarityFunds;
use App\Models\WithholdingsTaxes;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $salaryUnits = [
            ['unit' => 'SMMLV','value' => 1300000],
            ['unit' => 'UVT','value' => 47065]
        ];

        SalaryUnits::insert($salaryUnits);

        $max = (double)SalaryUnits::where('unit', 'SMMLV')->first()->value;
        

        $uvt = (double)SalaryUnits::where('unit', 'UVT')->first()->value;
        
        $socialBenefits = [
            ['concept' => 'Base Benifits','percentage' => 0.7,'value' => 0],
            ['concept' => 'Maximum Base','percentage' => 0.0,'value' => $max*25],
            ['concept' => 'Non-SS Base Limit','percentage' => 0.4,'value' => 0],
            ['concept' => 'Value Extra','percentage' => 0.0,'value' => 0],
            ['concept' => 'Health','percentage' => 0.04,'value' => $max*25*0.04],
            ['concept' => 'Pension','percentage' => 0.04,'value' => $max*25*0.04],
            ['concept' => 'Solidarity Fund','percentage' => 0.02,'value' => $max*25*0.02]
        ];
        SocialBenefits::insert($socialBenefits);

        $sfunds = [
            ['from' => 0,'to' => 4,'rate' => 0],
            ['from' => 4,'to' => 16,'rate' => 0.01],
            ['from' => 16,'to' => 17,'rate' => 0.012],
            ['from' => 17,'to' => 18,'rate' => 0.014],
            ['from' => 18,'to' => 19,'rate' => 0.016],
            ['from' => 19,'to' => 20,'rate' => 0.018],
            ['from' => 20,'to' => 21,'rate' => 0.02]
        ];
        SolidarityFunds::insert($sfunds);

        $deductions = [
            ['concept' => 'Prepaid medicine','UVTs Max' => 16, 'value' => 16*$uvt],
            ['concept' => 'Housing Interest','UVTs Max' => 100, 'value' => 100*$uvt],
        ];
        Deductions::insert($deductions);
        
        $taxes = [
            ['UVTRangeFrom' => 0,'UVTRangeTo' => 95,'marginalRate' => 0.0,'anyLess' => 0,'by' => 0.0,'further' => 0],
            ['UVTRangeFrom' => 95,'UVTRangeTo' => 150,'marginalRate' => 0.19,'anyLess' => 95,'by' => 0.19,'further' => 0],
            ['UVTRangeFrom' => 150,'UVTRangeTo' => 360,'marginalRate' => 0.28,'anyLess' => 150,'by' => 0.28,'further' => 10],
            ['UVTRangeFrom' => 360,'UVTRangeTo' => 640,'marginalRate' => 0.33,'anyLess' => 360,'by' => 0.33,'further' => 69],
            ['UVTRangeFrom' => 640,'UVTRangeTo' => 945,'marginalRate' => 0.35,'anyLess' => 640,'by' => 0.35,'further' => 162],
            ['UVTRangeFrom' => 945,'UVTRangeTo' => 2300,'marginalRate' => 0.37,'anyLess' => 945,'by' => 0.37,'further' => 268],
            ['UVTRangeFrom' => 2300,'UVTRangeTo' => 2300,'marginalRate' => 0.39,'anyLess' => 2300,'by' => 0.39,'further' => 770],
            
        ];
        WithholdingsTaxes::insert($taxes);

    }
}
