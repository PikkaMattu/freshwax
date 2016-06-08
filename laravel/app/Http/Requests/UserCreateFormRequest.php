<?php namespace freshwax\Http\Requests;

use freshwax\Http\Requests\Request;

use Auth;

class UserCreateFormRequest extends Request {

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
			'name' => 'required|unique:users',
			'email' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required'
		];
	}

}
