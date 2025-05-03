<?php

namespace App\Swaggers\Schemas\UserEducation;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CurrentUserEducationResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=2),
 *     @OA\Property(property="user_id", type="integer", example=123),
 *     @OA\Property(property="school_name", type="string", example="Harvard University"),
 *     @OA\Property(property="degree", type="string", example="Bachelor of Science"),
 *     @OA\Property(property="field_of_study", type="string", example="Computer Science"),
 *     @OA\Property(property="start_year", type="integer", example=2015),
 *     @OA\Property(property="end_year", type="integer", example=2019)
 * )
 */

class CurrentUserEducationResourceSwagger
{

}
