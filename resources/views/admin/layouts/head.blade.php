<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Students Management - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="default-instructor-image" content="{{ asset('admin/assets/images/iti_logo.svg') }}">
    <meta name="default-course-image" content="{{ asset('admin/assets/images/iti_logo.svg') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/admin-layout.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/admin-style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/admin-custom.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/course-style.css')}}">
</head>