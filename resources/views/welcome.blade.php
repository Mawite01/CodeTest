<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compress PDF</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Compress PDF</h1>
        <input type="file" name="file[]" multiple id="file">
        <div id="validation_error"></div>
        <div id='loadingmessage'>
            <img src={{asset('img/loading.gif')}}>
        </div>
        <form id="compressForm">
            <input type="hidden" id="files[]" name="files">
            <div id="setting">
                <input type="hidden" name="" id="mode" value="normal">
                DPI<input type="number" id="dpi" value="144">
                Quality<input type="number" id="imageQuality" value="75">
                Color <select name="color" id="colorModel">
                    <option value="no change">No Change</option>
                    <option value="red">Red</option>
                    <option value="gray">Gray</option>
                </select>

                <input type="text" class="btn btn-info" id="compressBtn" value="Compress">
            </div>
        </form>
        <div id="previewContainer" class="mt-3"></div>
       <div class='download'>
        <form action="{{route('download')}}" method="get" id="download">
        @csrf
            <input type="hidden" name="count" id="count">
            <input type="hidden" id="jobId" name="jobId">
        <button type="submit" class="btn btn-success">Dowload PDF</button>
        </form>
        </div>
    </div>


    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/fileUpload.js')}}"></script>
</body>

</html>