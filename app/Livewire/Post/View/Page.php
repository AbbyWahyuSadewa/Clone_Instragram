<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;

class Page extends Component
{

    public $post;

    function mount()
    {
        $this->post = Post::findOrFail($this->post);
    }

    public function render()
    {
        return <<<'HTML'
        <main class="bg-white min-h-screen max-w-2xl mx-auto flex flex-col border gap-y-4 px-5">
            <div class="my-auto border px-2 h-[calc(45rem_-_3.5rem)]">
                <livewire:post.view.item :post="$this->post" />
            </div>
        </main>
        HTML;
    }
}