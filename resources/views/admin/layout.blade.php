<html lang="{{ app()->getLocale() }}">
    @include('admin.template.head')
    <body class="skin-purple-light sidebar-mini" style="height: auto; min-height: 100%;">
        <div class="wrapper" style="height: auto; min-height: 100%;">
            @include('admin.template.header')
            @include('admin.template.left')
            
            <div class="content-wrapper" style="min-height: 946px;">
                
                @include('admin.template.contentHeader')
                @include($page)
                
            </div>
            
            @include('admin.template.footer')

            @include('admin.template.setting')
        </div>
    </body>
</html>