<?php

namespace App\Http\Requests;

use App\Contracts\RoomRepositoryContract;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JoinRoomRequest extends FormRequest
{

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Room $room */
        $room = $this->route('room');

        return [
            'username' => [
                'required',
                'min:3',
                Rule::unique('players', 'username')
                    ->where('room_id', $room->id)
            ]
        ];
    }
}
