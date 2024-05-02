<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);
        return [
            'url' => $url,
            'mime' => $mime,
            'mediable_id' => Post::factory(),
            'mediable_type' => function (array $attributes) {
                return Post::find($attributes['mediable_type'])->getMorphClass();
            }
        ];
    }

    function getUrl($type = 'post'): string
    {
        switch ($type) {
            case 'post':
                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4',
                    'https://images.unsplash.com/photo-1682695795798-1b31ea040caf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHx8',
                    'https://images.unsplash.com/photo-1707343843344-011332037abb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHw2fHx8ZW58MHx8fHx8',
                ];
                return $this->faker->randomElement($urls);
                break;

            case 'reel':
                $urls = [
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
                    'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/WeAreGoingOnBullrun.mp4',
                ];
                return $this->faker->randomElement($urls);
                break;

            default:
                # code...
                break;
        }
    }

    function getMime($url): string
    {
        if (str()->contains($url, 'gtv-videos-bucket')) {
            return 'video';
        } else if (str()->contains($url, 'images.unsplash.com')) {
            return 'image';
        }
    }

    function reel(): Factory
    {
        $url = $this->getUrl('reel');
        $mime = $this->getMime($url);

        return $this->state(function (array $attributes) use ($url, $mime) {
            return [
                'mime'=>$mime,
                'url'=>$url,
            ];
        });
    }

    function post(): Factory
    {
        $url = $this->getUrl('post');
        $mime = $this->getMime($url);

        return $this->state(function (array $attributes) use ($url, $mime) {
            return [
                'mime'=>$mime,
                'url'=>$url,
            ];
        });
    }
}