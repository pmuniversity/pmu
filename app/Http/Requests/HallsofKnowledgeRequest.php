<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HallsofKnowledgeRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image_1_web_picture' => 'required',
            'image_1_title' => 'required',
            'image_1_mobile_picture' => 'required',
            'image_1_url' => 'required',
            'image_2_web_picture' => 'required',
            'image_2_title' => 'required',
            'image_2_mobile_picture' => 'required',
            'image_2_url' => 'required',
            'image_3_web_picture' => 'required',
            'image_3_title' => 'required',
            'image_3_mobile_picture' => 'required',
            'image_3_url' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public
    function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public
    function messages()
    {
        return [
            //
        ];
    }
}
