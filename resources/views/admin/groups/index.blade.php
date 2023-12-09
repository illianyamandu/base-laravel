@extends('admin.list-view', [
    "createAction" => route('groups.create'),
    "title" => "Grupos",
    "tableItems" => [
        [
            "columnName" => "Nome",
            "indexName" => "name",
            "extraStyle" => "font-medium text-gray-900 whitespace-nowrap dark:text-white"
        ],
        [
            "columnName" => "Slug",
            "indexName" => "slug"
        ]
    ],
    "actions" => [
        [
            "name" => "show", 
            "route" => "groups.show"
        ],
        [
            "name" => "edit", 
            "route" => "groups.edit"
        ],
        [
            "name" => "destroy",
            "route" => "#"
        ]
    ],
])
