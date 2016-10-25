<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChoxeplopRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
				

			//
		];
	}
	public function message()
	{
		return[
				'lastName.required'=>'Vui lòng nhập tên học sinh',
				'firstName.required'=>'Vui lòng nhập tên học sinh',
				'parentName.required'=>'Vui lòng nhập tên phụ huynh',
				'parentPhone.required'=>'Vui lòng nhập số điện thoại Phụ huynh',
				'class.required'=>'Vui lòng nhập khối lớp',

		];
	}

}
