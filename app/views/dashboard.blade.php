@extends('layouts.default')
    @section('content')
        @include('includes.alert')
        <div class="container">
            <div class="row">
                <!-- Card Projects -->
                <div class="col-md-9 col-md-offset-1">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-responsive" src="https://dc778.4shared.com/img/aOl-lJrB/s7/1388092ce08/city-high-rise-buildings-vecto">
                            <span class="card-title">Uniliver Mess</span>
                        </div>

                        <div class="card-content">
                            <p>The Whole Building Management System In a Single Website</p>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <style>
            .card {
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            }

            .card {
                margin-top: 10px;
                box-sizing: border-box;
                border-radius: 2px;
                background-clip: padding-box;
            }
            .card span.card-title {
                color: #000;
                font-size: 30px;
                font-weight: 300;
                text-transform: uppercase;
            }

            .card .card-image {
                position: relative;
                overflow: hidden;
            }
            .card .card-image img {
                border-radius: 2px 2px 0 0;
                background-clip: padding-box;
                position: relative;
                z-index: -1;
            }
            .card .card-image span.card-title {
                position: absolute;
                bottom: 0;
                left: 0;
                padding: 16px;
            }
            .card .card-content {
                padding: 16px;
                border-radius: 0 0 2px 2px;
                background-clip: padding-box;
                box-sizing: border-box;
            }
            .card .card-content p {
                margin: 0;
                color: inherit;
            }
            .card .card-content span.card-title {
                line-height: 48px;
            }
            .card .card-action {
                border-top: 1px solid rgba(160, 160, 160, 0.2);
                padding: 16px;
            }
            .card .card-action a {
                color: #ffab40;
                margin-right: 16px;
                transition: color 0.3s ease;
                text-transform: uppercase;
            }
            .card .card-action a:hover {
                color: #ffd8a6;
                text-decoration: none;
            }
        </style>
@stop