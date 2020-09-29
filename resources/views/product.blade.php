@extends('layouts.template')

@section('content')

@php

    // print_r($data);

    // print_r($data["productBrandList"]);
    if (isset($data["inputs"])){
        // print_r($data["inputs"]);
    }

    if (isset($data["brandResult"])){
        // print_r($data["brandResult"]);
    }
    
@endphp

    <link href="{{ asset('resources/css/quill.snow.css') }}" rel="stylesheet">

    <div class="container pad-top-30 pad-bot-30">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang("messages.manage_products")</h2>
                <form class="product_update_form" id="product_update_form" enctype='multipart/form-data' action='{{$data["config"]["formAction"]}}' method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product->id ?? null }}">
                    <div class="row align-items-end">

                        <div class="col">
                            <label for="product_brand_dropdown">@lang("messages.product_brand")</label>
                            <select id="product_brand_dropdown" name="product_brand_dropdown" class="form-control" value="{{ $product->product_brand_code ?? old('product_brand_dropdown') }}">
                                <option>Select...</option>
                                @foreach($data["productBrandList"] as $productBrand)
                                    <option value="{{$productBrand['code']}}" {{ $selectedProductBrandCode === $productBrand['code'] ? 'selected' : '' }}>{{$productBrand['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="new_brand_checkbox" id="new_brand_checkbox"> 
                            <label for="new_brand_checkbox">
                                @lang('messages.new_brand')
                            </label>
                        </div>
                        
                    </div>

                    <div class="row align-items-end pad-top-10" id="new_product_brand_container" style="display: none;">
                        <div class="col">
                            <label for="new_product_brand_code">@lang("messages.new_product_brand_code")</label>
                            <input type="text" class="form-control" name="new_product_brand_code" id="new_product_brand_code" 
                            placeholder="@lang('messages.new_product_brand_code')">
                        </div>
                        <div class="col">
                            <label for="new_product_brand_name">@lang("messages.new_product_brand_name")</label>
                            <input type="text" class="form-control" name="new_product_brand_name" id="new_product_brand_name" 
                            placeholder="@lang('messages.new_product_brand_name')">
                        </div>
                        <div class="col">
                            <label for="new_product_brand_description">@lang("messages.new_product_brand_description")</label>
                            <input type="text" class="form-control" name="new_product_brand_description" id="new_product_brand_description" 
                            placeholder="@lang('messages.new_product_brand_description')">
                        </div>

                    </div>

                    <div class="row align-items-end pad-top-10">
                        <div class="col">
                            <label for="product_name_textbox">@lang("messages.product_name")</label>
                            <input type="text" name="product_name_textbox" class="form-control" placeholder="@lang('messages.product_name')" 
                            value = "{{ $product->name ?? old('product_name_textbox') }}" required>
                            <div class="invalid-feedback">
                                @lang("validation.product_name_required")
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-end pad-top-10">
                        <div class="col">
                            <label>@lang("messages.product_description")</label>
                            <div class="editor_full">
                                <div id="document_full" class="ql-scroll-y"></div>
                            </div>
                            <textarea name="product_description_textarea" id="product_description_textarea" style="display: none;">{{ $product->description ?? old('product_description_textarea') }}</textarea>
                        </div>
                    </div>

                    <div class="row align-items-end pad-top-10">
                        <div class="col">
                            <label for="product_image_file">@lang("messages.product_image")</label>
                            <input type="file" class="form-control form-control-file" id="product_image_file" name="product_image_file" accept="image/*">
                        </div>
                        <div class="col">
                            <label>@lang("messages.image_preview")</label><br />
                            <img src="{{ asset($productDisplayImage) }}" id="preview" class="img-thumbnail">
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-end pad-top-10">
                        <div class="col">
                            <input type="submit" class="btn btn-primary" value="@lang('messages.save_product')">
                        </div>
                    </div>                    

                </form>

            </div>
        </div>
    </div>

    <!-- <script src="resources/js/sprite.svg.js"></script> -->
    <script src="{{ asset('resources/js/quill.js') }}"></script>
    
    <script>
        // New Brand Checkbox logic
        $("#new_brand_checkbox").change(function(){
            var newBrandTextbox = $("#new_product_brand_container");
            var productBrandDropdown = $("#product_brand_dropdown");
            
            var newBrandCodeTextbox = $("#new_product_brand_code");
            var newBrandNameTextbox = $("#new_product_brand_name");
            if (this.checked){
                newBrandTextbox.show(300);
                productBrandDropdown.prop("disabled", true);
                newBrandCodeTextbox.prop("required", true);
                newBrandNameTextbox.prop("required", true);
            }else{
                newBrandTextbox.hide(300);
                productBrandDropdown.prop("disabled", false);
                newBrandCodeTextbox.prop("required", false);
                newBrandNameTextbox.prop("required", false);
            }
        });

        // Product image preview logic
        /*
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });*/
        $('#product_image_file').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });


        // Description rich text area quill JS
        var toolbarOptions = [
            [{
            'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],

            [{
            'header': 1
            }, {
            'header': 2
            }], // custom button values
            [{
            'list': 'ordered'
            }, {
            'list': 'bullet'
            }],
            [{
            'script': 'sub'
            }, {
            'script': 'super'
            }], // superscript/subscript
            [{
            'indent': '-1'
            }, {
            'indent': '+1'
            }], // outdent/indent
            [{
            'direction': 'rtl'
            }], // text direction

            [{
            'size': ['small', false, 'large', 'huge']
            }], // custom dropdown

            [{
            'color': []
            }, {
            'background': []
            }], // dropdown with defaults from theme
            [{
            'font': []
            }],
            [{
            'align': []
            }],
            ['link', 'image'],

            ['clean'] // remove formatting button
        ];
        
        var quillFull = new Quill('#document_full', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
        placeholder: "Write something..."
        });

        $("#test_quill").click(function(){
            alert(quillFull.container.firstChild.innerHTML);
        });

        function htmlDecode(input){
            var e = document.createElement('textarea');
            e.innerHTML = input;
            // handle case of empty input
            return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
        }

        $("#product_update_form").on("submit",function(){
            $("#product_description_textarea").val(quillFull.container.firstChild.innerHTML);
        });

        quillFull.root.innerHTML = (htmlDecode("{{ $product->description ?? old('product_description_textarea') }}"));
    </script>

@endsection