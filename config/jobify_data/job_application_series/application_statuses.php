<?php

return [
    'application_statuses' => [
        [
            'id' => 1,
            'name' => 'pending',
            'description' => 'application_submitted_waiting_for_review',
        ],
        [
            'id' => 2,
            'name' => 'reviewing',
            'description' => 'employer_is_reviewing_the_application',
        ],
        [
            'id' => 3,
            'name' => 'interview',
            'description' => 'candidate_has_been_invited_to_interview',
        ],
        [
            'id' => 4,
            'name' => 'offer',
            'description' => 'job_offer_has_been_made_to_the_candidate',
        ],
        [
            'id' => 5,
            'name' => 'hired',
            'description' => 'candidate_has_been_hired',
        ],
        [
            'id' => 6,
            'name' => 'rejected',
            'description' => 'application_was_rejected',
        ],
        [
            'id' => 7,
            'name' => 'withdrawn',
            'description' => 'candidate_withdrew_the_application',
        ],
        [
            'id' => 8,
            'name' => 'shortlisted',
            'description' => 'candidate_was_shortlisted_for_next_round',
        ],
        [
            'id' => 9,
            'name' => 'assessment',
            'description' => 'candidate_is_completing_an_assessment_test',
        ],
        [
            'id' => 10,
            'name' => 'on_hold',
            'description' => 'application_process_is_temporarily_paused',
        ],
        [
            'id' => 11,
            'name' => 'not_suitable',
            'description' => 'candidate_is_not_suitable_for_the_position',
        ],
    ],
];
