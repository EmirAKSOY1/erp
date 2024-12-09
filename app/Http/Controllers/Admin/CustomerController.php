<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::paginate(10);
        return view("admin.customers.index",compact("customers"));
    }
    public function create(){
        return view("admin.customers.create");
    }
    public function store(Request $request){
        $customer = new Customer();
        $customer->customer_type = $request->customer_type;
        if($request->customer_type == "individual"){
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->tc_number = $request->tc_number;
        }
        else{
            $customer->company_name = $request->company_name;
            $customer->company_full_name = $request->company_full_name;
            $customer->tax_office = $request->tax_office;
            $customer->vkn = $request->vkn;
            $customer->contact_person = $request->contact_person;
        }
        $customer->iban = $request->iban;
        $customer->country = $request->country;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->status = 'active';
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Müşteri Başarıyla Eklendi.');
    }
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}        
    public function destroy($id){
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
    
            return response()->json(['success' => 'Müşteri başarıyla silindi.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Müşteri silinirken bir hata oluştu.'], 500);
        }
    }  
    
}
