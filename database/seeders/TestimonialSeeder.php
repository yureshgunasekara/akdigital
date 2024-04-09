<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
               'name' => 'Adam Olive', 
               'designation' => 'Full-Stack Developer',
               'rating' => 5,
               'image' => 'assets/img/avatars/image-4.jpg',
               'comment' => 'The code was well-organized and easy to follow, and the support team was quick to answer any questions I had. My client was thrilled with the final result.'
            ],
            [
               'name' => 'Michel Bardel', 
               'designation' => 'MERn Stack Developer',
               'rating' => 4.5,
               'image' => 'assets/img/avatars/image-5.jpg',
               'comment' => 'I was blown away by the quality and flexibility of this web template. It was so easy to use and customize to my specific needs.'
            ],
            [
               'name' => 'Alejandro Liano', 
               'designation' => 'Front-End Developer',
               'rating' => 5,
               'image' => 'assets/img/avatars/image-6.jpg',
               'comment' => 'I was blown away by the quality and flexibility of this web template. It was so easy to use and customize to my specific needs.'
            ],
            [
               'name' => 'Adam Olive', 
               'designation' => 'Full-Stack Developer',
               'rating' => 5,
               'image' => 'assets/img/avatars/team-1.jpeg',
               'comment' => 'The code was well-organized and easy to follow, and the support team was quick to answer any questions I had. My client was thrilled with the final result.'
            ],
            [
               'name' => 'Michel Bardel', 
               'designation' => 'MERn Stack Developer',
               'rating' => 4.5,
               'image' => 'assets/img/avatars/team-2.jpeg',
               'comment' => 'I was blown away by the quality and flexibility of this web template. It was so easy to use and customize to my specific needs.'
            ],
            [
               'name' => 'Alejandro Liano', 
               'designation' => 'Front-End Developer',
               'rating' => 5,
               'image' => 'assets/img/avatars/team-3.jpeg',
               'comment' => 'I was blown away by the quality and flexibility of this web template. It was so easy to use and customize to my specific needs.'
            ],
        ];


        foreach($testimonials as $item){
            Testimonial::create([
                'name' => $item['name'],
                'designation' => $item['designation'],
                'rating' => $item['rating'],
                'image' => $item['image'],
                'comment' => $item['comment'],
            ]);
        }
    }
}
