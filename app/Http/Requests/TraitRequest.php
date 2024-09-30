<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait TraitRequest
{
    /**
     * Set default values for pagination if not provided.
     *
     * This method checks if 'page' and 'per_page' parameters are present in
     * the request. If not, it sets default values for them. This is useful 
     * for ensuring that pagination is always handled consistently.
     *
     * @param int $page Default page number if 'page' is not provided (default: 1).
     * @param int $perPage Default number of items per page if 'per_page' is not provided (default: 12).
     * @return void
     */
    public function prepareForPagination($page = 1, $perPage = 12)
    {
        // Retrieve input data from the request instance
        $input = $this->all();
    
        // Check if 'page' is not present in the request, then set default value
        if (!isset($input['page'])) {
            $this->merge(['page' => $page]);
        }
    
        // Check if 'per_page' is not present in the request, then set default value
        if (!isset($input['per_page'])) {
            $this->merge(['per_page' => $perPage]);
        }
    }    

    /**
     * Handle validation failures by redirecting back with errors.
     *
     * This method is called when validation fails. It redirects the user back
     * to the previous page with error messages and input data. This helps in
     * displaying validation errors and retaining user input.
     *
     * @param Validator $validator The validator instance that contains the validation errors.
     * @return RedirectResponse Redirects the user back with error messages and input data.
     */
    public function failedValidation(Validator $validator)
    {
        // Redirect back with error messages and input data
        return redirect()->back()
            ->with([
                'error' => trans('exception.bad_request'), // Translate and show a generic error message
                'message' => $validator->getMessageBag()    // Pass validation errors
            ])->withInput(); // Retain the input data that was submitted
    }
}