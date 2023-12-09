@extends('admin.list-view', [
    "createAction" => route('users.create'),
    "title" => "Usuários",
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
            "route" => "users.edit"
        ],
        [
            "name" => "destroy",
            "route" => "users.destroy"
        ]
    ],
])
