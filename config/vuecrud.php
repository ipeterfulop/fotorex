<?php

return [
    //default button labels and classes can be set up here
    //when generating the button faces, the __label__ placeholder in the html string
    //will be replaced by the translationLabel ran through the __ function
    'buttons' => [
        'details' => [
            'class'       => 'btn btn-outline-primary',
            'html'        => '<span title="__label__">?</span>',
            'translationLabel' => 'Details',
        ],
        'edit'   => [
            'class'       => 'btn btn-outline-secondary',
            'html'        => '<span title="__label__"><svg class="heroicon-svg" width="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.2322 5.23223L18.7677 8.76777M16.7322 3.73223C17.7085 2.75592 19.2914 2.75592 20.2677 3.73223C21.244 4.70854 21.244 6.29146 20.2677 7.26777L6.5 21.0355H3V17.4644L16.7322 3.73223Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>',
            'translationLabel' => 'Edit',
        ],
        'delete' => [
            'class'       => 'btn btn-outline-danger',
            'html'        => '<span title="__label__">✕</span>',
            'translationLabel' => 'Delete',
        ],
        'delete' => [
            'class'       => 'btn btn-outline-danger',
            'html'        => '<span title="__label__">✕</span>',
            'translationLabel' => 'Delete',
        ],
        'confirmDeletion' => [
            'class'       => 'btn btn-outline-danger',
            'html'        => '<span title="__label__">Törlés</span>',
            'translationLabel' => 'Törlés',
        ],
        'moveUp' => [
            'class'       => 'btn btn-outline-secondary',
            'html'        => '↑',
        ],
        'moveDown' => [
            'class'       => 'btn btn-outline-secondary',
            'html'        => '↓',
        ],

    ],
    'vueCrudDefaultView' => 'admin.model-manager'
];