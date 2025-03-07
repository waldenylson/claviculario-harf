<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentPostRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $rules = [
      'name' => 'required|min:4|max:255',
      'comments' => 'required|string',
    ];

    return $rules;
  }

  public function messages()
  {
    return [
      'name.required' => 'Nome da Seção é Obrigatório!',
      'name.min' => 'Nome da Seção deve conter pelo menos :min caracteres!',
      'name.max' => 'Nome do Departamento não pode ter mais que :max caracteres!',
      'comments.required' => 'Observações são Obrigatórias!',
      'comments.string' => 'Observações devem ser um texto!',
    ];
  }
}
