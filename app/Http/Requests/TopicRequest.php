<?php

namespace PMU\Http\Requests;

class TopicRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [ 
				'level_id' => 'required|exists:levels,id',
				'title' => 'required|max:255|min:10',
				'description' => 'required|max:65000|min:100',
				'picture' => 'sometimes',
				'active' => 'sometimes',
				'file' => 'sometimes|image',
				'author_name' => 'sometimes',
				'author_office' => 'sometimes',
				'author_designation' => 'sometimes',
				'author_picture' => 'sometimes|image',
				'h1' => 'sometimes',
				'meta_title' => 'sometimes',
				'meta_description' => 'sometimes',
				'meta_keywords' => 'sometimes' 
		];
	}
}
