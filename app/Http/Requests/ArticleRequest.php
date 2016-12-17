<?php

namespace PMU\Http\Requests;

class ArticleRequest extends Request {
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
				'topic_id' => 'required|exists:topics,id',
				'type_title' => 'required',
				'source_url' => 'required|url|max:255',
				'title' => 'required|max:255',
				'description' => 'required|max:65000',
				'file' => 'sometimes|image',
				'author_name' => 'sometimes',
				'author_office' => 'sometimes',
				'author_designation' => 'sometimes',
				'author_picture' => 'sometimes|image' 
		];
	}
}
