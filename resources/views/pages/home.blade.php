@extends('layouts.main')
@section('content')
    <div class="container">

        <div class="starter-template">
            <h1>Software Craig wrote to manage his businesses. </h1>
            <h3>Inventory Management, Point Of Sale, Book Keeping, & Office </h3>
            <p class="lead">
                Easy to use
                <br>
                Built for Retail, Real Estate, Schools.
                <br>
                Enter your own paperwork or use our bookkeeping service: Mail in your paper work with the provided envelopes and we will enter them for less than you can
                <br>
                Use your own Credit Card Processors or use ours which will probably be chaper than yours: Wholesale pricing + 0.1% + $.09 per transaction
                <br>
            </p>

            <div class="features">
                <ul class = "main_features">
                <li>Asset Tracking (Inventory</li>
                    <ul class="subfeatures">
                        <li>Fast Purchase Ordering</li>
                        <li>Unlimited Inventory Locations</li>
                        <li>Unique SKU's within products - for example unique pricing</li>
                        <li>Inventory Transferring</li>
                    </ul>
                <li>Point of Sale</li>
                <li>Book Keeping</li>

                <li>Office Keeping</li>
                    <ul class="subfeatures">
                        <li>Rich Text Documents</li>
                        <li>Todo's</li>
                        <li>Calender</li>
                        <li>Image Management</li>
                        <li>Internal Messaging</li>
                    </ul>
            </ul>
            </div>
        </div>

    </div>
    <style>
        .features{

            border : 1px solid red;
        }
        .subfeatures{
            font-size:0.8em;
        }
        .main_features{
            font-size:1.5em;
        }
    </style>
@stop
