$( document ).ready(function() {

    // $('form').on('change', '.parent_mediastorage', function (){
    //     var elem = this

    //     $(elem).nextAll('.parent_mediastorage').remove();
    //     $(elem).nextAll('.parent_mediastorage_label').remove();
    //     $(elem).nextAll('.parent_mediastorage_clear').remove();

    //     $.ajax({
    //         url: "?page=ajax_get_folder_by_parent_id_admin",
    //         type: 'GET',
    //         data: 'folder_id=' + this.value,
    //         success: function(result, status) {

    //             if (!result)
    //                 return;

    //             var data = JSON.parse(result);

    //             $html =
    //                 '<div class="clear" class="parent_mediastorage_clear"></div>' +
    //                 '<label for="id_parent_mediastorage" class="parent_mediastorage_label"></label>' +
    //                 '<select name="id_parent_mediastorage[]" id="id_parent_mediastorage" class="parent_mediastorage">' +
    //                     '<option value=""></option>'

    //             for (i = 0; i < data.length; i++) {
    //                  $html += '<option value="' + data[i].id + '">' + data[i].translate + '</option>';
    //             }

    //             $html += '</select>';

    //             $(elem).after($html);
    //         },
    //         error: function(result, status, error) {
    //             console.log('ERROR : ');
    //             console.log(error);
    //         }
    //     })
    // });

    $('form').on('change', '.folder_mediastorage', function (){
        var elem = this

        $(elem).nextAll('.folder_mediastorage').remove();
        $(elem).nextAll('.folder_mediastorage_label').remove();
        $(elem).nextAll('.folder_mediastorage_clear').remove();

        $.ajax({
            url: "?page=ajax_get_folder_by_parent_id_admin",
            type: 'GET',
            data: 'folder_id=' + this.value,
            success: function(result, status) {

                if (!result)
                    return;

                var data = JSON.parse(result);

                $html =
                    '<div class="clear" class="folder_mediastorage_clear"></div>' +
                    '<label for="id_folder_mediastorage" class="folder_mediastorage_label"></label>' +
                    '<select name="id_folder_mediastorage[]" id="id_folder_mediastorage" class="folder_mediastorage">' +
                        '<option value=""></option>'

                for (i = 0; i < data.length; i++) {
                     $html += '<option value="' + data[i].id + '">' + data[i].translate + '</option>';
                }

                $html += '</select>';

                $(elem).after($html);
            },
            error: function(result, status, error) {
                console.log('ERROR : ');
                console.log(error);
            }
        })
    });

    $('#more_info_show').on('click', function(){
        $('#more_info_hide').css('display', 'inline-block');
        $(this).css('display', 'none')
        $('#more_info_data').show();
    });

    $('#more_info_hide').on('click', function(){
        $('#more_info_show').css('display', 'inline-block');
        $(this).css('display', 'none')
        $('#more_info_data').hide();
    });

});
