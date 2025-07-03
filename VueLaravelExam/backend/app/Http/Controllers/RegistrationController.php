<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\AccountInformation;
use App\Models\CompanyInformation;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:account_information,email',
            'username' => 'required|alpha_num|unique:account_information,username',
            'password' => 'required|min:8|confirmed',
            'type' => 'required|in:Buyer,Exhibitor,Visitor',

            'company_name' => 'required|string',
            'address_line' => 'required|string',
            'town_city' => 'required|string',
            'region_state' => 'required|string',
            'country' => 'required|string',
            'year_established' => 'required|digits:4|before_or_equal:' . date('Y'),
            'website' => 'nullable|url',
            'brochure' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $account = AccountInformation::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        $brochurePath = null;
        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        CompanyInformation::create([
            'account_id' => $account->id,
            'company_name' => $request->company_name,
            'address_line' => $request->address_line,
            'town_city' => $request->town_city,
            'region_state' => $request->region_state,
            'country' => $request->country,
            'year_established' => $request->year_established,
            'website' => $request->website,
            'brochure_path' => $brochurePath,
        ]);

        return response()->json(['message' => 'Registration successful.']);
    }

    public function getCountries()
    {
        return response()->json([
            'countries' => ['Philippines', 'USA', 'Canada', 'Japan', 'Germany']
        ]);
    }
}
