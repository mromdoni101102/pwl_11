<?php

namespace App\Http\Requests;


use App\Traits\Apiresponse;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Spatie\FlareClient\Http\Response as HttpResponse;

abstract class ApiRequest extends FormRequest
{
    use Apiresponse;
    /**
     * Determine if the user is authorized to make this request.
     */

    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiError(
            $validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY,
        ));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException($this->apiError(
            null,
            Response::HTTP_UNAUTHORIZED
        ));
    }

    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         'todo' => 'required|string|max:255',
    //         'label' => 'nullable|string',
    //         'done' => 'nullabel|boolean',
    //     ];
    // }
}
