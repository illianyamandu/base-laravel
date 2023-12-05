@extends('admin.list-view', [
    "createAction" => "admin.groups.create",
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
            "name" => "edit", 
            "route" => "admin.groups.edit"
        ],
        [
            "name" => "destroy",
            "route" => "admin.groups.destroy"
        ]
    ],
])
