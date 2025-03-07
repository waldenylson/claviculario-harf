<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeyRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'department_id' => 'required|exists:departments,id',
      'number' => 'required|integer',
      'internal_hallway' => 'required|boolean',
      'eps' => 'required|boolean',
      'epms' => 'required|boolean',
      'comments' => 'nullable|string',
    ];
  }
}
