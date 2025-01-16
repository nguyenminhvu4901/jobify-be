<?php

namespace App\Services\UserCertification;

use App\Enums\DefaultContentType;
use App\Traits\ImageHandler;
use App\Traits\VideoHandler;

class UserCertificationService
{
    use ImageHandler, VideoHandler;

    public function processAttachment($attachment)
    {
        return $this->processSaveAttachment($attachment);
    }

    private function processSaveAttachment($attachment)
    {
        $user = auth()->user();

        if ($attachment['content_type_id'] == DefaultContentType::IMAGE->value) {
            $path = 'images/profiles/' . extractEmailPrefix($user->email) . '/certifications';
            $pathStorage = $this->storeImage($attachment['content'], $path, $user);

        } elseif ($attachment['content_type_id'] == DefaultContentType::URL->value) {
            $pathStorage = $attachment['content'];

        } elseif ($attachment['content_type_id'] == DefaultContentType::VIDEO->value) {
            $path = 'videos/profiles/' . extractEmailPrefix($user->email) . '/certifications';
            $pathStorage = $this->storeVideo($attachment['content'], $path, $user);

        } else {
            return null;
        }

        return $pathStorage;
    }
}
