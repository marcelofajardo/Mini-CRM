<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $employee = Employee::find($this->route('employee'));
        return $employee && $this->user()->can('update', $employee);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'company' => ['required', 'exists:companies,id'],
            'email' => ['required', 'email:rfc,dns'],
            'phone' => ['required', 'min:11', 'max:15']
        ];
    }
}
