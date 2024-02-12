<?php

namespace App\Http\Requests\Mission;

use App\Rules\ControllerDoesentHaveDetails;
use Illuminate\Foundation\Http\FormRequest;

class AssignMissionProcessesRequest extends FormRequest
{

    /**
     * @var string
     */
    private $type;

    public function __construct()
    {
        $this->type = request()->type;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->type == 'ci') {
            return hasRole('cdc');
        } elseif ($this->type == 'cc') {
            return hasRole('cdcr');
        }
        return;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'controller' => ['nullable', 'exists:users,id'],
            // 'pcf' => ['nullable', 'array'],
            // 'is_validator' => ['required', 'boolean']
        ];
    }
}
