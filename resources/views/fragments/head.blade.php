<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Bloomify - ваш лучший выбор для заказа и доставки свежих цветов. Уникальные букеты и подарки для любого случая">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Herbalia | Магазин цветов' }}</title>
    <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
    <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
    @stack('head')
    @vite(['resources/scss/style.scss'])
</head>