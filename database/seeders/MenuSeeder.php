<?php

namespace Database\Seeders;

use Efectn\Menu\Models\MenuItems;
use Efectn\Menu\Models\Menus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menus::create([
            "name" => "Landing Page"
        ]);
        MenuItems::create([
            "label" => "Home",
            "link" => "/",
            "parent_id" => 0,
            "sort"=>0,
            "menu_id"=>1,
            "depth"=>0
        ]);
        MenuItems::create([
            "label" => "News",
            "link" => "/news",
            "parent_id" => 0,
            "sort"=>0,
            "menu_id"=>1,
            "depth"=>0
        ]);
       

    }
}
