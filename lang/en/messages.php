<?php

return [
    'register' => [
        'register' => 'Register',
        'already_registered' => 'Already registered?',
    ],

    'verify_email' => [
        'info' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
        'verification_link_sent' => 'A new verification link has been sent to the email address you provided during registration.',
        'resend_email' => 'Resend Verification Email',
        'logout' => 'Log Out',
    ],

    'login' => [
        'remember' => 'Remember me',
        'signin' => 'Log in',
        'forgot_password' => 'Forgot your password?',
        'register' => 'Create an account',
    ],

    'forgot_password' => [
        'info' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
        'reset_link' => 'Email Password Reset Link',
        'return_login' => 'Return to login',
        'reset_password' => 'Reset Password',
    ],

    'confirm_password' => [
        'info' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'confirm' => 'Confirm',
    ],

    'dashboard' => [
        'page_title' => 'Dashboard',
        'welcome' => 'You\'re logged in!',
    ],

    'profile' => [
        'page_title' => 'Profile',
        'edit' => [
            'title' => 'Profile Information',
            'info' => 'Update your account\'s profile information and email address.',
            'unverified_email' => 'Your email address is unverified.',
            'resend_email' => 'Click here to re-send the verification email.',
            'resend_info' => 'A new verification link has been sent to your email address.',
        ],
        'password' => [
            'title' => 'Update Password',
            'info' => 'Ensure your account is using a long, random password to stay secure.',
            'unverified_email' => 'Your email address is unverified.',
            'resend_email' => 'Click here to re-send the verification email.',
            'resend_info' => 'A new verification link has been sent to your email address.',
        ],
        'delete' => [
            'title' => 'Delete Account',
            'info' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
            'delete_account' => 'Delete Account',
            'confirm' => 'Are you sure you want to delete your account?',
            'confirm_info' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        ],
    ],

    'users' => [
        'index' => [
            'page_title' => 'Users',
            'add_user' => 'Add User',
            'not_found' => 'No records found',
        ],
        'create' => [
            'page_title' => 'Create User',
            'info' => 'Create a new user',
            'description' => 'Fill in the required fields and click save',
            'success' => 'User created.',
        ],
        'show' => [
            'page_title' => 'Show User',
            'info' => 'User Information',
            'description' => 'Show the user details.',
        ],
        'edit' => [
            'page_title' => 'Edit User',
            'info' => 'Edit the user information',
            'description' => 'Fill in the required fields and click save',
            'success' => 'User updated.',
        ],
        'delete' => [
            'confirm_delete_title' => 'Please Confirm',
            'confirm_delete_message' => 'Are you sure you want to delete the user?',
            'error' => 'Action not permitted',
            'success' => 'User deleted',
        ],
    ],

    'roles' => [
        'index' => [
            'page_title' => 'Roles',
            'add_role' => 'Add Role',
            'not_found' => 'No records found',
        ],
        'create' => [
            'page_title' => 'Create Role',
            'info' => 'Create a new role',
            'description' => 'Fill in the required fields and click save',
            'success' => 'Role created',
        ],
        'edit' => [
            'page_title' => 'Edit Role',
            'info' => 'Edit the role information',
            'success' => 'Role updated',
        ],
        'delete' => [
            'confirm_delete_title' => 'Please Confirm',
            'confirm_delete_message' => 'Are you sure you want to delete the user?',
            'success' => 'Role deleted',
        ],
    ],

    'header' => [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'roles' => 'Roles',
        'profile' => 'Profile',
        'logout' => 'Log Out',
    ],

    'fields' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'roles' => 'Roles',
        'created_at' => 'Created At',
    ],

    'common' => [
        'search' => 'Search',
        'show' => 'Show',
        'edit' => 'Edit',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'saved' => 'Saved',
        'delete' => 'Delete',
        'previous' => 'Previous',
        'next' => 'Next',
        'actions' => 'Actions',
        'back' => 'Back',
        'password_info_1'=> '* Password must be at least 8 characters',
        'password_info_2'=> '* Combination of uppercase, lowercase and numbers',
        'password_info_3'=> '* Use of special characters',
    ],
];
