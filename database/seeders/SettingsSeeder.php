<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a arcu magna. Pellentesque ac sapien feugiat, rutrum lectus in, elementum dolor. Cras placerat lorem id sem gravida, tincidunt aliquam metus ullamcorper. Curabitur vitae vehicula tortor. Etiam a magna egestas, ultricies eros nec, fringilla justo. Maecenas nec odio in arcu sagittis vulputate ac vel massa. In vel odio non sapien scelerisque vehicula quis at est. Aenean id viverra arcu. Duis eros lorem, convallis viverra iaculis vel, venenatis non turpis. Phasellus sed leo purus. Ut tincidunt posuere sem, a rhoncus urna tincidunt ac.';
        settings()->set([
            'website_name' => 'Laravel',
            'description' => $loremIpsum,
            'address' => 'Jl. Raya Mojosari 2 Kepanjen',
            'phone' => '(0341) 399099',
            'whatsapp' => '082244812291',
            'youtube' => 'https://www.youtube.com/@UNIRAMALANGChannelOfficial',
            'instagram' => 'https://www.instagram.com/erasitesgroup',
        ]);
    }
}
