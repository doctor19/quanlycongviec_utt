<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MstClassUpdateRequest extends FormRequest
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
    public function messages()
    {
        return [
            'cls_name.required' => 'Vui lòng nhập tên lớp',
            'cls_name.unique' => 'Tên lớp đã tồn tại',
            'cls_name.max' => 'Tên lớp dài quá 150 kí tự',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        session(['screen' => 'edit']);
        session(['id' => $this->id]);
        return [
            'cls_name'    => ['required','max:150',Rule::unique('mst_class')->where(function ($query) {
                return $query->where('cls_delete_flag', 1)->where('id','!=',$this->id);
            })]
        ];
    }
}
