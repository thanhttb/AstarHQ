<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChuaXepLichRequest extends Request {

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
				'className.required'=>'Vui lòng nhập tên học sinh',
				'description.required'=>'Vui lòng nhập tên học sinh',
				
		];
	}

}
