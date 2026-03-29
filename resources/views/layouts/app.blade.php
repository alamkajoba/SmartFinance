<!DOCTYPE html>
<html lang="zxx" class="js">

    //HEADER
    @include('partials.header')

    <body class="nk-body ui-rounder npc-default has-sidebar ">
        <div class="nk-app-root">  

            //SIDEBAR
            @include('partials.sidebar')
            <div class="nk-main ">
                <div class="nk-wrap "> 
                    //TOP BAR
                    @include('partials.topbar')
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        //SCRIPT FOOTER
        @include('partials.scriptfooter')
    </body>
</html>
