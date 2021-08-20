<?php

namespace App\Http\Livewire;

use App\Mail\ClubRequest;
use App\Models\ClubReg;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $c1st,$c2nd, $clubName, $email, $phone, $subject, $contactPerson, $message, $captcha ;

    public function mount()
    {
        $this->c1st = rand(0,9);
        $this->c2nd = rand(0,9);
    }

    protected $rules = [
        'clubName'=>['required','string','max:200'],
        'email'=>['required','email','unique:club_regs,email'],
        'phone'=>['required','string'],
        'subject'=>['required','string'],
        'contactPerson'=>['required','string'],
        'message'=>['required','string'],
        'captcha'=>['required','string'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMail(){
        //dd($this->captcha);
        $validatedData = $this->validate();

        if($this->captcha == $this->c1st+$this->c2nd){

            $clubReg = ClubReg::create([
                'clubName' => $this->clubName,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'contactPerson' => $this->contactPerson,
                'message' => $this->message,
            ]);

            Mail::to(config('settings.appEmail'))->send(new ClubRequest($clubReg));

            $this->clubName = '';
            $this->email = '';
            $this->phone = '';
            $this->subject = '';
            $this->contactPerson = '';
            $this->message = '';
            $this->c1st = rand(0,9);
            $this->c2nd = rand(0,9);

            session()->flash('success', "Message sent");
        }else{
            session()->flash('warning', "Captcha not current");
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
