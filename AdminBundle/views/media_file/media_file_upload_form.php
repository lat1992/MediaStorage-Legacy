<?php
    if (isset($_SESSION['permits'][PERMIT_UPLOAD_FILE])) {
?>

        <div id="fine-uploader"></div>

        <script type="text/template" id="qq-template">
            <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                </div>
                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                    <span class="qq-upload-drop-area-text-selector"></span>
                </div>
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Upload a file</div>
                </div>
                <span class="qq-drop-processing-selector qq-drop-processing">
                    <span>Processing dropped files...</span>
                    <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                </span>
                <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                    <li>
                        <div class="qq-progress-bar-container-selector">
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                        </div>
                        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                        <!--<img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>-->
                        <span class="qq-upload-file-selector qq-upload-file"></span>
                        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                        <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                        <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    </li>
                </ul>

                <dialog class="qq-alert-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Close</button>
                    </div>
                </dialog>

                <dialog class="qq-confirm-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">No</button>
                        <button type="button" class="qq-ok-button-selector">Yes</button>
                    </div>
                </dialog>

                <dialog class="qq-prompt-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <input type="text">
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">Cancel</button>
                        <button type="button" class="qq-ok-button-selector">Ok</button>
                    </div>
                </dialog>
            </div>
        </script>

        <script src="AdminBundle/ressources/media_file/js/media_file.js"></script>

        <script>

            function ajaxRefreshUploadList() {
                $.ajax({
                    url: "?page=ajax_refresh_upload_list",
                    type: 'GET',
                    success: function(result, status) {

                        if (!result)
                            return;

                        var data = JSON.parse(result);
                        console.log(data);

                        var $html =
                            '<tbody>' +
                                '<tr>' +
                                    '<th></th>' +
                                    '<th>' . FILENAME . '</th>' +
                                    '<th>' . RIGHT_DOWNLOAD . '</th>' +
                                    '<th>' . RIGHT_ADDTOCART . '</th>' +
                                '</tr>'
                        ;

                        for(var i = 0; i < data.length; i++) {
                            $html +=
                                '<tr>' +
                                    '<td><input type="checkbox" name="media_file_mediastorage[' + data[i].id + '] value="1" /></td>' +
                                    '<td>' + data[i].filename + '</td>' +
                                    '<td>' + data[i].right_download + '</td>' +
                                    '<td>' + data[i].right_addtocart + '</td>' +
                                '</tr>'
                            ;
                        }

                        $html +=
                            '</tbody>'
                        ;




                        $('#upload_list').html($html);

                        // $html =
                        //     '<div class="clear" class="folder_mediastorage_clear"></div>' +
                        //     '<label for="id_folder_mediastorage" class="folder_mediastorage_label"></label>' +
                        //     '<select name="id_folder_mediastorage[]" id="id_folder_mediastorage" class="folder_mediastorage">' +
                        //         '<option value=""></option>'

                        // for (i = 0; i < data.length; i++) {
                        //      $html += '<option value="' + data[i].id + '">' + data[i].translate + '</option>';
                        // }

                        // $html += '</select>';

                        // $(elem).after($html);
                    },
                    error: function(result, status, error) {
                        console.log('ERROR : ');
                        console.log(error);
                    }
                });
            }

            var manualUploader = new qq.FineUploader({
            element: document.getElementById('fine-uploader'),
            request: {
                endpoint: "?page=upload_media_file_admin"
            },
            /*deleteFile: {
                enabled: true,
                endpoint: "vendor/fineuploader/php-traditional-server/endpoint.php"
            },*/
            chunking: {
                enabled: true,
                concurrent: {
                    enabled: true
                },
                success: {
                    endpoint: "?page=upload_media_file_admin&done=1"
                }
            },
            resume: {
                enabled: true
            },
            thumbnails: {
                maxCount: 0
            },
            retry: {
                enableAuto: true,
                showButton: true
            },
            callbacks:{
                onError: function(id, name, errorReason, xhrOrXdr) {
                    console.log(qq.format("Error on file number {} - {}.  Reason: {}", id, name, errorReason));
                },

                onComplete: function(id, name, responseJSON, xhr) {
                    console.log('success : ' + JSON.stringify(responseJSON));
                },

                onAllComplete: function(){
                    ajaxRefreshUploadList();
                }
            }
        });

        </script>
<?php
    }
?>