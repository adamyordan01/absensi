<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RankAndGroup;

class RankAndGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RankAndGroup::create([
            'group' => '-',
            'rank' => '-',
        ]);
        RankAndGroup::create([
            'group' => 'I A',
            'rank' => 'Juru Muda',
        ]);
        RankAndGroup::create([
            'group' => 'I B',
            'rank' => 'Juru Muda Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'I C',
            'rank' => 'Juru',
        ]);
        RankAndGroup::create([
            'group' => 'I DJ',
            'rank' => 'uru Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'II A',
            'rank' => 'Pengatur Muda',
        ]);
        RankAndGroup::create([
            'group' => 'II B',
            'rank' => 'Pengatur Muda Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'II C',
            'rank' => 'Pengatur',
        ]);
        RankAndGroup::create([
            'group' => 'II D',
            'rank' => 'Pengatur Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'III A',
            'rank' => 'Penata Muda',
        ]);
        RankAndGroup::create([
            'group' => 'III B',
            'rank' => 'Penata Muda Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'III C',
            'rank' => 'Penata',
        ]);
        RankAndGroup::create([
            'group' => 'III D',
            'rank' => 'Penata Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'IV A',
            'rank' => 'Pembina',
        ]);
        RankAndGroup::create([
            'group' => 'IV B',
            'rank' => 'Pembina Tingkat 1',
        ]);
        RankAndGroup::create([
            'group' => 'IV C',
            'rank' => 'Pembina Utama Muda',
        ]);
        RankAndGroup::create([
            'group' => 'IV D',
            'rank' => 'Pembina Utama Madya',
        ]);
        RankAndGroup::create([
            'group' => 'IV E',
            'rank' => 'Pembina Utama',
        ]);
    }
}
