<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertDismiss extends Component
{
    public $type;
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type,$message)
    {
        $this->type = !empty($type) ? $type : 'secondary';
        $this->message = !empty($message) ? $message : 'Message';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert-dismiss');
    }
}
