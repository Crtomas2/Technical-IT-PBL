<?php

namespace App\Actions\Fortify;

use App\Models\Promodiser;
use App\Models\promodiserUser as ModelsPromodiserUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class PromodiserUser implements PromodiserUser
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Promodiser;
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'Firstname' => ['required', 'string', 'max:255'],
            'Middlename' => ['required', 'string', 'max:255'],
            'Lastname' => ['required', 'string', 'max:255'],
            'Mobilenumber' => ['required', 'int', 'max:255', 'unique:promodisers'],
            'Storename' => ['required', 'string', 'max:255'],
            'Storelocation' => ['required', 'string', 'max:255'],
        ])->validate();

        return PromodiserUser::create([
            'Firstname' => $input['Firstname'],
            'Middlename' => $input['Middlename'],
            'Lastname' => $input['Lastname'],
            'Mobilenumber' => $input['Mobilenumber'],
            'Store_name' =>$input['Store_name'],
            'Store_location' => $input['Store_location'],
            
        ]);
    }
}

