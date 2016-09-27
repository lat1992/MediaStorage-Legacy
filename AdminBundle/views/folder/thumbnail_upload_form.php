<?php
    if (isset($_SESSION['permits'][PERMIT_UPLOAD_FILE])) {
?>

        <div id="fine-uploader" ></div>

        <script type="text/template" id="qq-template">
            <div class="qq-uploader-selector qq-uploader"  style="margin: 10px 0 10px 10px" qq-drop-area-text="<?= DROP_FILE_HERE ?>">
                <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                </div>
                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                    <span class="qq-upload-drop-area-text-selector"></span>
                </div>
                <div class="qq-upload-button-selector qq-upload-button">
                    <div><?= UPLOAD_A_FILE ?></div>
                </div>
                <span class="qq-drop-processing-selector qq-drop-processing">
                    <span><?= PROCESSSING_DROPPED_FILES ?></span>
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
                        <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel"><?= CANCEL ?></button>
                        <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry"><?= RETRY ?></button>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete"><?= DELETE ?></button>
                        <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    </li>
                </ul>

                <dialog class="qq-alert-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector"><?= CLOSE ?></button>
                    </div>
                </dialog>

                <dialog class="qq-confirm-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector"><?= NO ?></button>
                        <button type="button" class="qq-ok-button-selector"><?= YES ?></button>
                    </div>
                </dialog>

                <dialog class="qq-prompt-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <input type="text">
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector"><?= CANCEL ?></button>
                        <button type="button" class="qq-ok-button-selector"><?= OK ?></button>
                    </div>
                </dialog>
            </div>
        </script>

        <script src="AdminBundle/ressources/media_file/js/media_file.js"></script>

        <script>

            var manualUploader = new qq.FineUploader({
            element: document.getElementById('fine-uploader'),
            request: {
                endpoint: "?page=upload_thumbnail_admin&folder_id=<?= $_GET['folder_id'] ?>",
                uuidName: 'qquuid',
            },
            // deleteFile: {
            //     enabled: true,
            //     endpoint: "?page=upload_thumbnail_admin"
            // },
            // chunking: {
            //     enabled: true,
            //     success: {
            //         endpoint: "?page=upload_thumbnail_admin&done=1"
            //     }
            // },
            resume: {
                enabled: true
            },
            thumbnails: {
                maxCount: 1
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

                    document.getElementById('folder_image_preview').src = responseJSON['img_path'] + '?' + new Date().getTime();;
                },

                onAllComplete: function(){
                    // ajaxRefreshUploadList();
                }
            }
        });
        </script>
<?php
    }
?>