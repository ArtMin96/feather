<?php

namespace App\View\Components;

use App\Helpers\Classes;
use Illuminate\View\Component;

class SuccessAlert extends Component
{

    public $type;
    public $dismissible;
    public $message;
    public $attrs;

    /**
     * Create a new component instance.
     *
     * @param array $all
     * @param string $type
     * @param string $message
     * @param string $class
     * @param bool $dismissible
     */
    public function __construct(
        $all = [],
        $type = '',
        $message = '',
        $class = '',
        $dismissible = false
    )
    {
        $this->type = $type ?: $all['type'] ?? '';
        $this->dismissible = $dismissible ?: $all['dismissible'] ?? false;
        $this->message = $message ?: $all['message'] ?? '';
        $this->attrs = [
            'class' => $class ?: $all['class'] ?? '',
        ];
        $this->attrs['class'] = Classes::get([
            $this->type ? 'bg-' . $this->type : '',
            $this->dismissible ? 'alert-dismissible fade show' : '',
            $this->attrs['class']
        ]);
        $this->attrs = \array_filter($this->attrs);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.success-alert');
    }
}
