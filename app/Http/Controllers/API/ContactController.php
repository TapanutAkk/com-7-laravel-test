<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\API\BaseController;
use Validator;

class ContactController extends BaseController
{
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $contact = Contact::create($input);
   
        return $this->sendResponse(new ContactResource($contact), 'Contact created successfully.');
    }
}
