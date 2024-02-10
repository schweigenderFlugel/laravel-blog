<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        # Cambiamos de false (por defecto) a true porque las autorizaciones van a ser manejadas por el controlador
        return true;

        # Sin embargo, esta autorización puede traer un problema de seguridad en materia de acceso a artículos
        # que no son públicos. Para solucionarlo debemos crear un archivo Policy 
        # (php artisan make:policy ArticlePolicy --model=Article)
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
        $slug = request()->isMethod('put') ? 'required|unique:articles,slug,'.$this->id : 'required|unique:articles'; 
        $image = request()->isMethod('put') ? 'nullable|mimes:jpeg,jpg,png,svg|max:8000,' : 'required|image'; 


        return [

            # Reglas de validación
            'title' => 'required|min:5|max:255', 
            'slug' => $slug, 
            'introduction' => 'required|min:10|max:255', 
            'body' => 'required', 
            'image' => $image, 
            'status' => 'required|boolean', 
            'category_id' => 'required|integer', 

        ];
    }
}
