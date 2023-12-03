@extends('admin.list-view', [
    "tableItems" => [
        [
            "columnName" => "Nome",
            "indexName" => "name",
            "extraStyle" => "font-medium text-gray-900 whitespace-nowrap dark:text-white"
        ],
        [
            "columnName" => "E-mail",
            "indexName" => "email"
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
