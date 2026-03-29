<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Smart Finance | Go ahead</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('css/dashlite.css?ver=3.1.2')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('css/theme.css?ver=3.1.2')}}">
</head>

<body class="nk-body ui-rounder npc-default has-sidebar ">
    <div class="nk-app-root">
        @include('partials.sidebar')
        <div class="nk-main ">
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed nk-header-fluid is-light">
                    @include('partials.topbar')
                </div>
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            {{$slot}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.scriptfooter')
</body>

</html>
