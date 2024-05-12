$(document).ready(function(e) {
    $('#compression-settings').hide();
    $('#loading-message').hide();
    $('#download').hide();
    $('#ready').hide();
    $('#action').hide();

    $('#file').change(function(e) {
        $('#loading-message').show();
        $(document).find("div.alert-danger").remove();
        var files = $(this)[0].files;
        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('file[]', files[i]);
        }

        $.ajax({
            url: '/upload',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                handlePreviews(files);
                $('#files\\[\\]').val(JSON.stringify(response.data));
                $('#compression-settings').show();
                $('#loading-message').hide();
                $('#file').hide();
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                $('#loading-message').hide();
                $('#validation-error').append('<div class="alert alert-danger">' + response.message + '</div');
            }
        });
    });

    function handlePreviews(files) {
        if (!files.length) {
            return;
        }

        for (const file of files) {
            const reader = new FileReader();

            reader.onload = function(event) {
                const pdfUrl = event.target.result;

                if (!isPdf(file.type)) {
                    console.warn(`Skipping non-PDF file: ${file.name}`);
                    return;
                }

                const embed = createPdfEmbed(pdfUrl);
                $('#previewContainer').append(embed);
            };

            reader.readAsDataURL(file);
        }
    }

    function isPdf(mimeType) {
        return mimeType.startsWith('application/pdf');
    }

    function createPdfEmbed(pdfUrl) {
        return `<embed src="${pdfUrl}" width="100" height="100" type="application/pdf" class="mr-5">`;
    }
    $("#compressBtn").click(function(event) {
        event.preventDefault();
        files = $('#files\\[\\]').val();
        result = JSON.parse(files);
        var btn = $('#compressBtn');
        btn.prop('disabled', true);
        $('#loading-message').show();
        var data = {
            files: result,
            dpi: $("#dpi").val(),
            imageQuality: $("#image-quality").val(),
            mode: $("#mode").val(),
            colorModel: $("#color").val(),
        };

        $.ajax({
            type: "POST",
            url: "/compress",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
            data: data,
            success: function(response) {
                $('#files\\[\\]').val(JSON.stringify(response.data));
                $('#compression-settings').show();
                $("#jobId").val(response.data.jobId);
                $('#count').val(response.data.job.count);
                $('#download').show();
                $('#loading-message').hide();
                $('#select-file').hide();
                $('#ready').show();
                $('#previewContainer').hide();
                $('#action').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $("#preview").click(function(){
        $('#previewContainer').show();
    });
    $("#restart").click(function(){
        window.location.reload()
    });
})