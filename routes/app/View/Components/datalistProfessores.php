<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datalistProfessores extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $crud;
    public $header;
    public $data;
    public $hide;

    public function __construct($crud, $header, $data, $hide) {
        $this->crud = $crud;   
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
    }

    public function render() {

        return view('components.datalistProfessor');
    }
}