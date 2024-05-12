$(document).ready(function(e) {
    $('#setting').hide();
    $('#download').hide();
    $('#loadingmessage').hide();
    $('#file').change(function(e) {
        $('#loadingmessage').show();
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
                $('#setting').show();
                $('#loadingmessage').hide();
            },
            error: function(xhr, status, error) {
              var response = JSON.parse(xhr.responseText);
              $('#loadingmessage').hide();
              $('#validation_error').append('<div class="alert alert-danger">'+response.message+'</div');
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
        return `<embed src="${pdfUrl}" width="300" height="200" type="application/pdf">`;
    }

});
$("#compressBtn").click(function(event) {
    event.preventDefault();
    files = $('#files\\[\\]').val();
    result = JSON.parse(files);
    var btn = $('#compressBtn');
    btn.prop('disabled', true);
    $('#loadingmessage').show();
    var data = {
        files: result,
        dpi: $("#dpi").val(),
        imageQuality: $("#imageQuality").val(),
        mode: $("#mode").val(),
        colorModel: $("#colorModel").val(),
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
            $('#setting').show();
            $("#jobId").val(response.data.jobId);
            $('#count').val(response.data.job.count);
            $('#download').show();
            $('#loadingmessage').hide();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
