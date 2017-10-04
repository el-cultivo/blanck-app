<?php

namespace App\Http\Requests\Admin\Photos;

use App\Http\Requests\Request;

use App\Models\Photo;

class AssociatePhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user && $this->user->hasPermission('associate_photos') ) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        // dd($input);

        $rules = [
            "photoable_type"    => "required|in:".Photo::getImpodeCodesToAssociateModels(),
            "photoable_id"      => "required",
            "use"               => "required",
            "order"             => "present",
            "class"             => "present"
        ];

        if ( isset($input["order"]) && $input["order"] == "null") {
            $input["order"] .= "integer|min:0";
        }

        if (isset($input["photoable_type"])  ) {

            $table_name = Photo::getTableOfAssociateModelForCode($input["photoable_type"]);

            if ($table_name) {
                $rules["photoable_id"] .= "|exists:".$table_name.",id" ;
            }

            if(isset(Photo::$associable_models[$input["photoable_type"]])) 
            { 
                $photoable_class = Photo::$associable_models[$input["photoable_type"]]; 
                $rules['use'] .= '|in:' . implode(',', $photoable_class::$image_uses); 
            }
        }
        return $rules;
    }
}
