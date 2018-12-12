<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Faculty;
use App\ClassRoom;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $class = ClassRoom::where('id',$this->class_room_id)->first();
        $fac = Faculty::where('id',$class->faculty_id)->value('name');
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'class_room_id' =>$this->class_room_id,
            'fac' => $fac,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
