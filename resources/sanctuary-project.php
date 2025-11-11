<?php

return [
    'meta' => [
        'title' => 'FAAN Sanctuary Project-Ecuador',
        'description' => 'FAAN Sanctuary Project-Ecuador',
        'keywords' => 'animal sanctuary project,Proyecto de santuario de animale,Ecuador,Animal Rescue and Adoption',
        'ogTitle' => 'FAAN Sanctuary Project-Ecuador',
        'ogDescription' => 'FAAN Sanctuary Project-Ecuador',
        'ogLocale' => 'en_US'
    ],
    'header' => "FAAN's Current Sanctuary Project & Goals",
    'subtitle' => 'Keeping Animals Safe in Cuenca, Ecuador',
    'overview' => file_get_contents(__DIR__ . '/html-blocks/sanctuary-project/overview.html'),
    'community' => file_get_contents(__DIR__ . '/html-blocks/sanctuary-project/community.html'),
    'budget' => [
        'header' => file_get_contents(__DIR__ . '/html-blocks/sanctuary-project/budget.html'),
        'items' => json_decode(file_get_contents(__DIR__ . '/html-blocks/sanctuary-project/budget.json'))
    ],
    'total' => file_get_contents(__DIR__ . '/html-blocks/sanctuary-project/total.html'),
    'video' => '/storage/videos/superdogs.mp4',
    'image' => '/storage/images/superdogs-logo-en.png'
];
