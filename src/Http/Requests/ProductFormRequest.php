<?php
namespace Meccado\ManageProducts\Http\Requests;

use App\Http\Requests\Request as Request;

class ProductFormRequest extends Request{

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'name' 						=> 'required|min:3|max:255|unique:products',// name',
					'description' 		=> 'required|min:3',
					'sku'   					=> 'required|unique:products,sku,' . $this->get('id'),
					'price' 					=> 'required|numeric',
					'brands' 					=> 'required|array|min:1',
					'categories' 			=> 'required|array|min:1',
					'published_at'		=> 'required|date',
					'published'				=> 'required',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					//'name' 				=> 'required|min:3|unique:products',// title,'.$this->products,
					//'description' => 'required|min:2',
					//'price' 			=> 'required|numeric',
					//'sku'         => 'required|unique:products,sku,' . $this->get('id'),
					//'image'       => 'required|mimes:jpeg,bmp,png'
					//'product.title' => 'required|unique:products,title,'.Route::input('products').'|max:255',
				];
			}
			default:
			break;
		}
		return [];
	}

	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize()
	{
		return true;
	}
}
