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
            <script>
                window.companies = {!! json_encode($companies) !!};
            </script>
            @elseif(!empty($examplecompanies))
            <script>
                window.companies = {!! json_encode($examplecompanies) !!};
            </script>
            @endif
            @if(!empty($examplecompaniesyears))
            <script>
                window.companiesyears = {!! json_encode($examplecompaniesyears) !!};
            </script>
            @endif

            <div class="row">
                <div class="col-sm-12 text-center panel">
                    <h1>
                        Simple Chart Converter App 
                        <button data-tooltip="This app was built with Laravel, vue.js, Mongo DB and vue-chart">?</button>

                    </h1>
                    <div class="col-sm-10">

                   <p><a href="{{ route('download', ['filename' => 'companies.xls']) }}">
                        Download this example
                    </a>
                    in which you can add your own data, once you have done, you can upload file here in xls format, and get your graphs just with your own datas.
                    <br>
                   </p>
                    <p class="text-left"><span class="small">
                    You can fork the project on <strong>
                    <a target="_blank" href="https://github.com/ruthqv/graphconverter"><i class="fa fa-github" aria-hidden="true"></i>
                        Github     </a>
                    </strong><br>
                     (RQThemes® MIT Licence)       
                    </span>
                    </p>

                    </div>

                    <div class="col-sm-2">
                    <form action="{{route('uploadExcel')}}" class="form-group" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <input class="form-control" name="file" type="file">
                            <button class="btn btn-success" type="submit">
                                Send
                            </button>
                        </input>
                    </form>
                    </div>

                </div>
            </div>
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
