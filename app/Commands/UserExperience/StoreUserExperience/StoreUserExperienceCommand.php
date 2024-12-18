<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Commands\CommandInterface;
use App\Enums\DefaultContentType;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $position,
        public readonly bool $isWorking,
        public readonly string $startDate,
        public readonly string|null $endDate,
        public readonly array|null $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = collect($request->get('attachments', []))
            ->map(function ($attachment, $key) use ($request) {
                if($attachment['content_type_id']  == DefaultContentType::IMAGE->value)
                {
                    $image = $request->file("attachments.$key.image");

                    return [
                        'title' => $attachment['title'],
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id'],
                        'image' => $image ?? null,
                    ];
                }
                elseif($attachment['content_type_id']  == DefaultContentType::URL->value) {
                    $url = $request->input("attachments.$key.url");

                    return [
                        'title' => $attachment['title'],
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id'],
                        'url' => $url ?? null,
                    ];
                }
                elseif($attachment['content_type_id'] == DefaultContentType::VIDEO->value){
                    $video = $request->file("attachments.$key.video");

                    return [
                        'title' => $attachment['title'],
                        'description' => $attachment['description'],
                        'content_type_id' => $attachment['content_type_id'],
                        'video' => $video ?? null,
                    ];
                }else{
                    return null;
                }
            })
            ->toArray();

        return new self(
            name: $request->get('name'),
            position: $request->get('position'),
            isWorking: $request->get('is_working'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}
