<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at->format('d-m-Y'),
            'users' => $this->users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => substr($user->name, 0 , 2),
                    'avatar' => $user->avatar,
                    'avatar_url' => $user->avatarUrl
                ];
            }),
            'tags' => $this->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name
                ];
            }),
            'client' => \Gate::allows('view', $this->client) ? $this->client->name : '',
            'can_edit' => \Gate::allows('update', \App\Project::class),
            'can_delete' => \Gate::allows('delete', \App\Project::class),
        ];
    }
}
