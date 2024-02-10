<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
         # El operador ternario significa que cuando un artículo se actualiza ignora ese slug ya existe. Si no lo ignora, 
        # no va actualizar el artículo
        $slug = request()->isMethod('put') ? 'required|unique:categories,slug,'.$this->id : 'required|unique:categories'; 
        $image = request()->isMethod('put') ? 'nullable|image' : 'required|image'; 

        return [
            
            # Reglas de validación
            'title' => 'required|min:5|max:255', 
            'slug' => $slug, 
            'image' => $image, 
            'is_featured' => 'required|boolean', 
            'status' => 'required|boolean', 

        ];
    }
}
