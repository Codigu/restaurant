<?php

namespace Copya\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO::enhance security feature
        // check if gate would be applicable here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->has('action') && $this->get('action') == 'restore'){
            return [
                'id' => 'exists:pages,id'
            ];
        } else {
            return [
                'title' => 'required',
                'content' => 'required'
            ];
        }

    }
}
