<!DOCTYPE html>
<html lang="zxx" class="js">
@include('partials.header')

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
