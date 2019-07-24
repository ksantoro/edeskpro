<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'title'                 => 'nullable|max:255',
            'contact_owner_id'      => 'nullable|numeric|max:25',
            'contact_source'        => 'nullable|numeric|max:25',
            'contact_type_id'       => 'required|numeric|max:25',
            'email'                 => 'required|email|unique:tenant.contacts',
            'email_type_id'         => 'required|numeric|max:25',
            'phone'                 => 'required|numeric|regex:/[0-9]{10}/',
            'phone_type_id'         => 'required|numeric|max:25',
            'billing_address_type'  => 'required|numeric|max:25',
            'billing_street'        => 'required|max:255',
            'billing_suite'         => 'nullable|max:255',
            'billing_city'          => 'required|max:255',
            'billing_state'         => 'required|max:255',
            'billing_zip'           => 'required|max:255',
            'delivery_address_type' => 'required|numeric|max:25',
            'delivery_street'       => 'required|max:255',
            'delivery_suite'        => 'nullable|max:255',
            'delivery_city'         => 'required|max:255',
            'delivery_state'        => 'required|max:255',
            'delivery_zip'          => 'required|max:255',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'email'           => 'trim|lowercase',
            'first_name'      => 'trim|capitalize',
            'last_name'       => 'trim|capitalize',
            'title'           => 'trim|capitalize',
            'billing_street'  => 'trim|capitalize',
            'billing_suite'   => 'trim|capitalize',
            'billing_city'    => 'trim|capitalize',
            'billing_state'   => 'trim|uppercase',
            'delivery_street' => 'trim|capitalize',
            'delivery_suite'  => 'trim|capitalize',
            'delivery_city'   => 'trim|capitalize',
            'delivery_state'  => 'trim|uppercase',
        ];
    }
}
