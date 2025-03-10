<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeyMovementPostRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'key_id' => 'required|exists:keys,id',
      'harf_staff_id' => 'required|exists:harf_staff,id',
      'user_id' => 'required|exists:users,id',
      'movement_type' => 'required|string',
      'out' => 'required|date',
      'return' => 'nullable|date',
      'comments' => 'nullable|string',
    ];
  }
}
