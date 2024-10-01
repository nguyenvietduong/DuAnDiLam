<?php

// resources/lang/en/messages.php
return [
    'system'    => [
        'button'    => [
            'confirm'   => [
                'title'             => 'Are you sure?',
                'text'              => 'You won\'t be able to revert this!',

                'confirmButtonText' => 'Yes, i agree!',
                'cancelButtonText'  => [
                    'button'    => 'No, cancel!',
                    'title'     => 'Cancelled',
                    'text'      => 'Action has been cancelled.',
                ]
            ],
            'add'       => 'Add',
            'addNew'    => 'Add new',
            'create'    => 'Create',
            'edit'      => 'Edit',
            'update'    => 'Update',
            'delete'    => 'Delete',
            'detail'    => 'Detail',
            'viewCV'    => 'View CV',
            'approval'  => 'Approval',
            'cancel'    => 'Cancel',
            'reject'    => 'Reject',
            'clear'     => 'Clear',
            'reset'     => 'Reset',
            'save'      => 'Save',
            'printCV'   => 'Print CV',
            'search'    => 'Search',
            'upload_image' => 'Upload',
            'previous'  => 'Previous',
            'next'      => 'Next',
        ],
        'alert' => [
            'success'   =>  'Success! The task has been completed.',
            'error'     =>  [
                'title' => 'Oops...',
                'text'  => 'Something went wrong!',
            ]
        ],
        'table' => [
            'title'         => 'List Of',
        ]
    ],
    'welcome'               => 'Welcome to our application!',
    'hello'                 => 'Hello',
    'language' => [
        'english'    => 'English',
        'vietnamese' => 'Vietnamese',
    ],
    'time' => [
        'morning' => [
            'greeting' => 'Good morning',
        ],
        'afternoon' => [
            'greeting' => 'Good afternoon',
        ],
        'evening' => [
            'greeting' => 'Good evening',
        ],
        'night' => [
            'greeting' => 'Good night',
        ],
    ],
    'quotes' => [
        '1' => '“Life is what happens when you’re busy making other plans.” - John Lennon',
        '2' => '“Live as if you were to die tomorrow. Learn as if you were to live forever.” - Mahatma Gandhi',
        '3' => '“Success is not a destination, it’s a journey.” - Zig Ziglar',
        '4' => '“Good things come to those who wait, but only the things left by those who hustle.” - Abraham Lincoln',
        '5' => '“The only thing standing between you and your dream is the willingness to work for it.” - Joel Brown',
    ],
    'account' => [
        'role' => [
            'user'      => 'User',
            'sysadmin'  => 'Admin',
        ],
        'user' => [
            'title' => 'Account User',
            'index' => [
                'route' => 'admin.user.index',
            ],
            'create' => [
                'route' => 'admin.user.create',
            ],
            'store' => [
                'route' => 'admin.user.store',
            ],
            'edit' => [
                'route' => 'admin.user.edit',
            ],
            'update' => [
                'route' => 'admin.user.update',
            ],
            'destroy' => [
                'route' => 'admin.user.destroy',
            ]
        ],
        'admin' => [
            'title' => 'Account Admin',
            'index' => [
                'route' => 'admin.admin.index',
            ],
            'create' => [
                'route' => 'admin.admin.create',
            ],
            'store' => [
                'route' => 'admin.admin.store',
            ],
            'edit' => [
                'route' => 'admin.admin.edit',
            ],
            'update' => [
                'route' => 'admin.admin.update',
            ],
            'destroy' => [
                'route' => 'admin.admin.destroy',
            ]
        ],
    ],
    'category' => [
        'title' => 'Category',
        'index' => [
            'route' => 'admin.category.index',
        ],
        'create' => [
            'route' => 'admin.category.create',
        ],
        'store' => [
            'route' => 'admin.category.store',
        ],
        'edit' => [
            'route' => 'admin.category.edit',
        ],
        'update' => [
            'route' => 'admin.category.update',
        ],
        'destroy' => [
            'route' => 'admin.category.destroy',
        ]
    ],
    'tag' => [
        'title' => 'Tag',
        'index' => [
            'route' => 'admin.tag.index',
        ],
        'create' => [
            'route' => 'admin.tag.create',
        ],
        'store' => [
            'route' => 'admin.tag.store',
        ],
        'edit' => [
            'route' => 'admin.tag.edit',
        ],
        'update' => [
            'route' => 'admin.tag.update',
        ],
        'destroy' => [
            'route' => 'admin.tag.destroy',
        ]
    ],
    'post' => [
        'title' => 'Post',
        'status_post' => [
            'public'    => 'Public',
            'draft'     => 'Draft'
        ],
        'index' => [
            'route' => 'admin.post.index',
        ],
        'create' => [
            'route' => 'admin.post.create',
        ],
        'store' => [
            'route' => 'admin.post.store',
        ],
        'edit' => [
            'route' => 'admin.post.edit',
        ],
        'update' => [
            'route' => 'admin.post.update',
        ],
        'destroy' => [
            'route' => 'admin.post.destroy',
        ]
    ],
    'version' => '<b>Version</b> :version',
    'copyright' => '<strong>Copyright © :year <a href=":link" title=":name" target="_blank">:name</a>.</strong> All rights reserved.',
    'created' => 'Created successfully!',
    'updated' => 'Updated successfully!',
    'deleted' => 'Deleted successfully!',
    'confirmDelete' => 'Are you sure you want to delete this item?',
];
