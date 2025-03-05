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
      'name' => 'required|string|max:255',
      'comments' => 'nullable|string',
    ];

    return $rules;
  }

  public function messages()
  {
    return [
      'name.required' => 'Nome do Departamento é Obrigatório!',
      'name.string' => 'Nome do Departamento deve ser um texto!',
      'name.max' => 'Nome do Departamento não pode ter mais que :max caracteres!',
      'comments.string' => 'Comentários devem ser um texto!',
    ];
  }
}
