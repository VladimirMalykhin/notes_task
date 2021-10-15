<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/notes' => [[['_route' => 'notes', '_controller' => 'App\\Controller\\NotesController::getNotes'], null, ['GET' => 0], null, true, false, null]],
        '/create' => [[['_route' => 'create_notes', '_controller' => 'App\\Controller\\NotesController::create'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/update/([^/]++)(*:23)'
                .'|/note/([^/]++)(*:44)'
                .'|/delete/([^/]++)(*:67)'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:102)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        23 => [[['_route' => 'update_notes', '_controller' => 'App\\Controller\\NotesController::updateNote'], ['number'], ['POST' => 0], null, false, true, null]],
        44 => [[['_route' => 'one_note', '_controller' => 'App\\Controller\\NotesController::get_note'], ['number'], ['GET' => 0], null, false, true, null]],
        67 => [[['_route' => 'delete_note', '_controller' => 'App\\Controller\\NotesController::delete'], ['number'], ['DELETE' => 0], null, false, true, null]],
        102 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
