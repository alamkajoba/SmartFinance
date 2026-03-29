<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Login | DashLite Admin Template</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('css/dashlite.css?ver=3.1.2')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('css/theme.css?ver=3.1.2')}}">
</head>

<body class="nk-body ui-rounder npc-default pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                    <div class="nk-content ">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        <script src="./assets/js/bundle.js?ver=3.1.2"></script>
        <script src="./assets/js/scripts.js?ver=3.1.2"></script>

</html>
