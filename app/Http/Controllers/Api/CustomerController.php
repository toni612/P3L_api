<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Customer;

class CustomerController extends Controller
{
    // SHOW ALL
    public function index(){
        $customer = Customer::all();

        if(count($customer) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'daa' => null
        ], 404);
    }

    public function getIDbyNama($nama) {
        $idCustomer = Customer::select('ID_CUSTOMER')->where('NAMA_CUSTOMER', '=', $nama)->get();
        if($idCustomer->isEmpty()){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        } else {
            return response([
                'message' => 'Customer Found',
                'data' => $idCustomer,
            ], 200);
        }
    }

    // CREATE
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'NAMA_CUSTOMER' => 'required|unique:customer',
            'TELEPON_CUSTOMER' => 'nullable|numeric',
            'EMAIL_CUSTOMER' => 'nullable|email:rfc,dns'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $customer = Customer::create($storeData);
        return response([
            'message' => 'Create Customer Success',
            'data' => $customer,
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id){
        $customer = Customer::find($id);
        if(is_null($customer)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'NAMA_CUSTOMER' => ['required', Rule::unique('customer')->ignore($customer)],
            'TELEPON_CUSTOMER' => 'nullable|numeric',
            'EMAIL_CUSTOMER' => 'nullable|email:rfc,dns'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $customer->NAMA_CUSTOMER = $updateData['NAMA_CUSTOMER'];
        if(!empty($updateData['TELEPON_CUSTOMER'])){
            $customer->TELEPON_CUSTOMER = $updateData['TELEPON_CUSTOMER'];
        } else {
            $customer->TELEPON_CUSTOMER = null;
        }
            
        if(!empty($updateData['EMAIL_CUSTOMER'])) {
            $customer->EMAIL_CUSTOMER = $updateData['EMAIL_CUSTOMER'];
        } else {
            $customer->EMAIL_CUSTOMER = null;
        }
            

        if($customer->save()){
            return response([
                'message' => 'Update Customer Success',
                'data' => $customer,
            ], 200);
        }
        
        return response([
            'message' => 'Update Customer Failed',
            'data' => null
        ], 400);
    }

    // DELETE
    public function destroy($id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        if($customer->delete()){
            return response([
                'message' => 'Delete Customer Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Delete Customer Failed',
            'data' => null
        ], 400);
    }
}
