<?php

namespace Fintech\Bell\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTriggerRequest extends FormRequest
{
    use \Fintech\Core\Traits\HasPaginateQuery;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['string', 'nullable', 'max:255'],
            'per_page' => ['integer', 'nullable', 'min:10', 'max:500'],
            'page' => ['integer', 'nullable', 'min:1'],
            'paginate' => ['boolean'],
            'sort' => ['string', 'nullable', 'min:2', 'max:255'],
            'dir' => ['string', 'min:3', 'max:4'],
            'with_detail' => ['boolean', 'nullable'],
            'trashed' => ['boolean', 'nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $options = $this->getPaginateOptions();

        $options['with_detail'] = false;

        $withDetail = $this->input('with_detail', '');

        if ($withDetail != null && strlen($withDetail) != 0) {
            $options['with_detail'] = $this->boolean('with_detail', true);
        }

        $this->merge($options);
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
