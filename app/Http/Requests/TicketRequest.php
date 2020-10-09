<?php

namespace App\Http\Requests;

use App\Tickets;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        $ticket = Tickets::find($this->route('ticket'))->first();
//        return $this->user()->role == 'admin' || $ticket->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject'=>'required',
            'ticket_text'=>'required',
        ];
    }

//    public function messages()
//    {
//        return [];
//    }
}
