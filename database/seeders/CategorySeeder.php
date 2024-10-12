<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $seragamSekolah = Category::create(['name' => 'Seragam Sekolah']);
        Category::create(['name' => 'Seragam Sekolah SD', 'parent_id' => $seragamSekolah->id]);
        Category::create(['name' => 'Seragam Sekolah SMP', 'parent_id' => $seragamSekolah->id]);
        Category::create(['name' => 'Seragam Sekolah SMA', 'parent_id' => $seragamSekolah->id]);

        $seragamPramuka = Category::create(['name' => 'Seragam Pramuka']);
        Category::create(['name' => 'Seragam Pramuka Siaga', 'parent_id' => $seragamPramuka->id]);
        Category::create(['name' => 'Seragam Pramuka Penggalang', 'parent_id' => $seragamPramuka->id]);
        Category::create(['name' => 'Seragam Pramuka Penegak', 'parent_id' => $seragamPramuka->id]);
        Category::create(['name' => 'Seragam Pramuka Pembina', 'parent_id' => $seragamPramuka->id]);

        Category::create(['name' => 'Seragam Dinas']);
    }
}
