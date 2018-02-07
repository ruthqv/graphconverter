<!DOCTYPE doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                    <meta content="{{ csrf_token() }}" name="csrf-token">
                      <link rel="shortcut icon" href="/favicon.ico">

                        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
                         
                        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
                        <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>

                            <title>
                                Graphs Big Data Programming
                            </title>
                        </link>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body>

        <div class="container">
            @if(!empty($error))
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endif
            @if(!empty($companies))
            @include('form')

            <script>
                window.companies = {!! json_encode($companies) !!};
            </script>
            @elseif(!empty($examplecompanies))
            @include('form')

            <script>
                window.companies = {!! json_encode($examplecompanies) !!};
            </script>
            @endif
            <div class="col-sm-12">
                <div id="app">
                    <router-view>
                    </router-view>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}">
        </script>
    </body>
</html>
