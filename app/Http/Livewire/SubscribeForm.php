<?php

namespace App\Http\Livewire;

use App\Models\Subscribe;
use Livewire\Component;

class SubscribeForm extends Component
{
    public $email;
    protected $rules = [
        'email'=>['required','email','unique:subscribes,email'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(){
        $validatedData = $this->validate();

            $clubReg = Subscribe::create(['email' => $this->email ]);

            $this->email = '';

            session()->flash('ssuccess', "Newsletter subscription  succeed");

    }

    public function render()
    {
        return view('livewire.subscribe-form');
    }
}
