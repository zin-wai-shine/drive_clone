<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Control extends Component
{
    public $folder, $folderId, $fileId, $link, $external;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($folder='', $folderId='', $fileId='', $link='', $external='')
    {
        $this->fileId = $fileId;
        $this->folder = $folder;
        $this->folderId = $folderId;
        $this->link = $link;
        $this->external = $external;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.control');
    }
}
