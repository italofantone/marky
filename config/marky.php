<?php

return [
    'html_input' => 'strip',                    // 'escape'|'allow'|'strip'

    'allow_unsafe_links' => false,              // true|false

    'table_of_contents' => [
        'html_class' => 'table-of-contents',
        'position' => 'top',                    // 'before-headings'|'placeholder'|'top'
        'style' => 'bullet',                    // 'bullet'|'ordered'
        'min_heading_level' => 1,
        'max_heading_level' => 6,
        'normalize' => 'relative',              // 'relative'|'flat'|'as-is'
        'placeholder' => null,                  // string|null
    ],

    'heading_permalink' => [
        'id_prefix' => '',
        'fragment_prefix' => '',
        'title' => 'Permalink',
        'symbol' => '# ',
    ],
];