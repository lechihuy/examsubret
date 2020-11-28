window.CKEditors = [];

window.setupBrowseImage = editor => {
    CKEditors.push(editor);
    CKFinder.setupCKEditor(editor);
}

window.browseThumbnail = img => {
    CKFinder.popup({
        language: 'vi',
        chooseFiles: true,
        onInit: function(finder) {
            // Config toolbar button
            finder.on('toolbar:reset:Main:folder', function( evt ) {
                let name = evt.data.folder.get('name');

                if (! isNumeric(name) && name != 'Giao diện') {
                    var UploadFiles = evt.data.toolbar.filter( function( button ) {
                        return button.get('name') === 'Upload';
                    });

                    evt.data.toolbar.remove(UploadFiles)
                }
            }, null, null, 1000);

            // Choose image
            finder.on('files:choose', function(evt) {
                let file = evt.data.files.first();
                let src = file.getUrl();
                img.attr('src', src+'?timestamp='+Date.now());
            });

            // Upload image
            finder.on('command:ok:FileUpload', function(evt) {
                addImage(evt.data.response);
            });

            // Upload dulicate image
            finder.on('command:error:FileUpload', function(evt) {
                if (evt.data.response.error.number == 201) {
                    addImage(evt.data.response);
                }
            });

            // Delete image
            finder.on('command:ok:DeleteFiles', function(evt) {
                deleteImage(evt.data.response);
                removeImageWhenDelete(evt.data.response);
            });

            // Rename image
            finder.on('command:ok:RenameFile', function(evt) {
                let res = evt.data.response;
                renameImage(res);
                let newImg = res.currentFolder.url + res.newName;
                let oldImg = res.currentFolder.url + res.name; 
                
                updateImageWhenRename(oldImg, newImg);
            });

            // Edit image
            finder.on('command:ok:SaveImage', function(evt) {
                updateImageWhenEdit(evt.data.response);
            });
        }
    });
}

function addImage(res) {
    $.ajax({
        url: $('input[name=store-image-route]').val(),
        type: 'POST',
        data: {
            url: res.currentFolder.url + res.fileName
        }
    });
}

function deleteImage(res)  {
    $.ajax({
        url: $('input[name=destroy-image-route]').val(),
        type: 'DELETE',
        data: {
            folder: res.currentFolder.url,
            files: res.files,
        }
    });
}

function removeImageWhenDelete(res)
{
    for (img of res.files) {
        img = res.currentFolder.url + img;

        // Replace CKEditor
        for (editor of CKEditors) {
            let content = editor.getData();
            const regex = new RegExp('\<img.*?src\=\"('+img+')\".*?\>', 'mg');
            
            editor.setData(content.replace(regex, ''));
        }

        // Replace thumbnail
        $(document).find('.single-choose-img').each(function() {
            if (remove_timestamp_url($(this).attr('src')) == img) {
                $(this).attr('src', $(this).attr('remove-src'));
            }
        });
    }
}

function renameImage(res)
{
    $.ajax({
        url: $('input[name=update-image-route]').val(),
        type: 'PUT',
        data: {
            folder: res.currentFolder.url,
            new_name: res.newName,
            old_name: res.name,
            action : 'rename',
        }
    });
}

function updateImageWhenRename(oldImg, newImg)
{
    // Replace CKEditor
    for (editor of CKEditors) {
        let content = editor.getData();
        editor.setData(content.replace(oldImg, newImg));
    }

    // Replace thumbnail
    $(document).find('.single-choose-img').each(function() {
        if (remove_timestamp_url($(this).attr('src')) == oldImg) {
            $(this).attr('src', newImg);
        }
    });

    // Replace thumbnail
    $(document).find('.only-thumbnail').each(function() {
        if (remove_timestamp_url($(this).attr('src')) == oldImg) {
            $(this).attr('src', newImg);
        }
    });
}

function updateImageWhenEdit(res) {
    img = remove_timestamp_url(res.currentFolder.url + res.file);

    // Replace CKEditor
    for (editor of CKEditors) {
        let content = editor.getData();
        editor.setData(content.replace(img, img+'?timestamp='+Date.now()));
    }

    // Replace thumbnail
    $(document).find('.single-choose-img').each(function() {
        if (remove_timestamp_url($(this).attr('src')) == img) {
            $(this).attr('src', img+'?timestamp='+Date.now());
        }
    });
}