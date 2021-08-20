<?php

namespace App\Http\Controllers;

use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\locTrait;

class TaxRateController extends Controller
{
    use locTrait;

    public function index()
    {
        $taxrates = TaxRate::latest()->get();
        return view('admin.tax.taxrate',compact('taxrates'));
    }

    public function create()
    {
        $country = $this->countryArray();
        $state = array();
        $mode = 'create';
        return view('admin.tax.taxrateCreateOrEdit',compact('mode','country','state'));
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'identifier'=>'required|max:255|string|unique:tax_rates,identifier',
            'tax_rate'=>'required|numeric|min:0',
            'country' => 'nullable',
            'state' => 'nullable'
        ));


        $taxrate = new TaxRate;
        $taxrate->identifier = $request->identifier;
        $taxrate->tax_rate = $request->tax_rate;
        $taxrate->country = $request->country;
        $taxrate->state = $request->state;
        $taxrate->save();       

        session()->flash('success','Successfully Save');
        return redirect()->route('taxrate.index');
    }

    public function show(TaxRate $taxrate)
    {
        
    }

    public function edit(TaxRate $taxrate)
    {
        $country = $this->countryArray();
        $state = $this->stateArray($taxrate->country);
                
        $mode = 'edit';
        return view('admin.tax.taxrateCreateOrEdit',compact('taxrate','mode','country','state'));
    }

    public function update(Request $request, TaxRate $taxrate)
    {
        $this->validate($request, array(
            'identifier'=>[
                'required','string','max:255',
                Rule::unique('tax_rates')->ignore($taxrate->id),
            ],
            'tax_rate'=>'required|numeric|min:0',
            'country' => 'nullable',
            'state' => 'nullable'
        ));
//is_zip 	zip_code 	zip_from 	zip_to state 	country 	tax_rate 
        $taxrate->identifier = $request->identifier;
        $taxrate->tax_rate = $request->tax_rate;
        $taxrate->country = $request->country;
        $taxrate->state = $request->state;
        $taxrate->save();             

        session()->flash('success','Successfully Save');
        return redirect()->route('taxrate.index');
    }

    public function destroy(TaxRate $taxrate)
    {
        $taxrate->delete();
        session()->flash('success','Successfully Deleted');
        return redirect()->back();
    }
}
