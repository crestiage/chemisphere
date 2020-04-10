@extends('layouts.template')

@section('content')

@php
    // print_r($data["productBrandList"]);
@endphp

    <div class="container pad-top-30 pad-bot-30">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang("messages.manage_products")</h2>
                <form class="product-update-form">
                    <div class="form-group">
                        <label for="product_brand_dropdown">@lang("messages.product_brand")</label>
                        <select id="product_brand_dropdown" name="product_brand_dropdown" class="form-control">
                            <option>Select...</option>
                            @foreach($data["productBrandList"] as $productBrand)
                                <option value="{{$productBrand['code']}}">{{$productBrand['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection