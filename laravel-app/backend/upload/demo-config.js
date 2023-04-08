$(function(){
    $('#drag-and-drop-zone').dmUploader({ 
      url: '/backend/upload',
      maxFileSize: 3000000, // 3 Megs 
      onDragEnter: function(){
        // Happens when dragging something over the DnD area
        this.addClass('active');
      },
      onDragLeave: function(){
        // Happens when dragging something OUT of the DnD area
        this.removeClass('active');
      },
      onInit: function(){
        // Plugin is ready to use
        ui_add_log('Penguin initialized :)', 'info');
      },
      onComplete: function(){
        // All files in the queue are processed (success or error)
        ui_add_log('All pending tranfers finished');
      },
      onNewFile: function(id, file){
        ui_add_log('New file added #' + id);
        ui_multi_add_file(id, file);
      },
      onBeforeUpload: function(id){
        ui_add_log('Starting the upload of #' + id);
        ui_multi_update_file_status(id, 'uploading', 'Uploading...');
        ui_multi_update_file_progress(id, 0, '', true);
      },
      onUploadCanceled: function(id) {
        // Happens when a file is directly canceled by the user.
        ui_multi_update_file_status(id, 'warning', 'Canceled by User');
        ui_multi_update_file_progress(id, 0, 'warning', false);
      },
      onUploadProgress: function(id, percent){
        // Updating file progress
        ui_multi_update_file_progress(id, percent);
      },
      onUploadSuccess: function(id, data){
         console.log(data);
        var obj = JSON.parse(data);
      });
  });
  