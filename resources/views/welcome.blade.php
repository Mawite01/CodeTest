<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF24 Tools</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('css/bootstrap-toogle.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <header class="container py-3">
        <div class="row d-flex justify-content-between">
            <h1 class="col-md-6">PDF24 <span class="color-blue">Tools</span></h1>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <a href="#" class="me-3">Desktop Version</a>
                <a href="#" class="me-3">Contact</a>
                <a href="#" class="btn bg-blue text-white">All PDF Tools</a>
            </div>
        </div>
    </header>
    <section class="bg-blue">
        <div class="container">
            <div class=" py-3 row d-flex justify-content-between">
                <div class="ratings col-md-6">
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center type">
                    <i class="fa fa-check-circle">Free</i>
                    <i class="fa fa-check-circle">Online</i>
                    <i class="fa fa-check-circle">No Limits</i>
                </div>
            </div>
        </div>
    </section>
    <main class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4">Compress PDF</h2>
                <p>PDF compressor to reduce the size of PDF files quickly and easily</p>
            </div>

            <div class="row">
                <div class="dropzone">
                    <p id="select-file">Select files or drag and drop files into this area</p>
                    <p id="ready">Your Files are Ready!</p>
                    <input type="file" multiple id="file">
                    <div id="previewContainer"></div>
                    <div id="download">
                        <form action="{{route('download')}}" method="get">
                            @csrf
                            <input type="hidden" name="count" id="count">
                            <input type="hidden" id="jobId" name="jobId">
                            <button type="submit" class="btn btn-sm btn-warning">Dowload PDF</button>
                            <input type="" class="btn btn-sm btn-warning" value="Preview" id="preview">
                        </form>
                    </div>
                    <br>
                    <div id="action">
                        <button class="btn btn-sm btn-light" id="restart"><i class="fa fa-refresh text-danger">Restart</i></button>
                    </div>
                </div>
                <div id="validation-error" class="text-center">

                </div>
                <div id="loading-message" class="text-center">
                    <label for="">Loading.....</label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6 mt-3" id="compression-settings">
                    <div class="row compression-settings">

                        <span>Compression Settings</span>

                        <input type="hidden" id="files[]" name="files">
                        <input type="hidden" id="mode" value="normal">
                        <div class="col">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label>DPI</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="dpi" value="144" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label>Quality</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="image-quality" value="75" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="d-inline-block me-1">Color</div>
                                    <div class="form-check form-switch d-inline-block">
                                        <input type="checkbox" class="form-check-input" id="color" value="gray" checked style="cursor: pointer;">
                                        <label for="site_state" class="form-check-label">Gray</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="" class="btn btn-sm btn-warning text-center py-2 ml-5" id="compressBtn" value="Compress">
                    </div>


                </div>
            </div>

        </div>
        </div>
    </main>
    <section class="bg-light-blue">
        <div class="container">
            <div class=" py-3 row d-flex text-center">
                <h2>Information</h2>
                <div class="col-md-2"></div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <div class="information">
                        <i class="fa fa-check-circle-o"></i>Window
                        <i class="fa fa-check-circle-o"></i>Linux
                        <i class="fa fa-check-circle-o"></i>Mac
                        <i class="fa fa-check-circle-o"></i>iPhone
                        <i class="fa fa-check-circle-o"></i>Android
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>How to Compress PDF File</h5>
                        <span>Select your PDF files which you would like to compress or drop them into the file box and start the compression. A few seconds later you can download your compressed PDF files.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>Adjustable Quality</h5>
                        <span>You can adjust the compression quality so that you can tune the compression algorithm in order to get a perfect result. PDF files with images can be compressed better than PDF files with text only.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>Easy to use</h5>
                        <span>PDF24 makes it as easy and fast as possible for you to compress your files. You don't need to install any software, you only have to select your files and start the compression.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>Runs On Your System</h5>
                        <span>The compression tool does not need any special system in order to compress your PDF files. The app is browser based and works under all operating systems.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>No Installation Required</h5>
                        <span>You do not need to download and install any software. PDF files are compressed in the cloud on our servers. The app does not consume your system resources.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adjustable_quality">
                        <h5>Secure online compression</h5>
                        <span>The compression tool does not keep your files longer than necessary on our server. Your files and results will be deleted from our server after a short period of time.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <div class="container" id="tools">
        <h4>All tools</h4>
        <div class="row">
            <div class="col">
                <ul>
                    <li>Merge PDF</li>
                    <li>Split PDF</li>
                    <li>Compress PDF</li>
                    <li>Edit PDF</li>
                    <li>Sign PDF</li>
                    <li>PDF Converter</li>
                    <li>Convert to PDF</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>Images to PDF</li>
                    <li>PDF to Images</li>
                    <li>Extract PDF Images</li>
                    <li>Protect PDF</li>
                    <li>Unlock PDF</li>
                    <li>Rotate PDF pages</li>
                    <li>Remove PDF pages</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>Extract PDF pages</li>
                    <li>Sort PDF pages</li>
                    <li>Webpage to PDF</li>
                    <li>Create PDF job application</li>
                    <li>Create PDF with camera</li>
                    <li>PDF OCR</li>
                    <li>Add watermark</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>Add page numbers</li>
                    <li>View as PDF</li>
                    <li>PDF Overlay</li>
                    <li>Compare PDFs</li>
                    <li>Web optimize PDF</li>
                    <li>Annotate PDF</li>
                    <li>Redact PDF</li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li>Create PDF</li>
                    <li>PDF 24 Creator</li>
                    <li>PDF Printer</li>
                    <li>PDF Reader</li>
                    <li>Create invoice</li>
                    <li>Remove PDF metadata</li>
                    <li>Flatten PDF</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="bg-light-blue text-center mt-3">
        <span>© 2024 Geek Software GmbH — WE love PDF</span>
    </section>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-toogle.js')}}"></script>
    <script src="{{asset('js/bootstrap-bundle.min.js')}}"></script>
    <script src="{{asset('js/fileUpload.js')}}"></script>
</body>

</html>