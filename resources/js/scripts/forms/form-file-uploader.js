/*=========================================================================================
    File Name: form-file-uploader.js
    Description: dropzone
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


Dropzone.autoDiscover = false;

let banner = $('#banner');
let fileOn = [];


Dropzone.options.myDropzone = {
    url: "/departamentos/store",
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    acceptedFiles: "image/*",
    accept: function(file) {
        let fileReader = new FileReader();

        fileReader.readAsDataURL(file);
        fileReader.onloadend = function() {

            let content = fileReader.result;
            $('#file').val(content);
            file.previewElement.classList.add("dz-success");
        }
        file.previewElement.classList.add("dz-complete");
    },
    init: function () {

        var wrapperThis = this;

        document.getElementById("submit-all").addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('process');
            wrapperThis.processQueue();
        });

        this.on("addedfile", function (file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

            // Listen to the click event
            removeButton.addEventListener("click", function () {
                // Make sure the button click doesn't submit the form:

                // Remove the file preview.
                wrapperThis.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });

        this.on('sendingmultiple', function (data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    },
    headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
};


$(function () {
  'use strict';

  var singleFile = $('#dpz-single-file');
  var multipleFiles = $('#dpz-multiple-files');
  var buttonSelect = $('#dpz-btn-select-files');
  var limitFiles = $('#dpz-file-limits');
  var acceptFiles = $('#dpz-accept-files');
  var removeThumb = $('#dpz-remove-thumb');
  var removeAllThumbs = $('#dpz-remove-all-thumb');

  // Basic example
  singleFile.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFiles: 1,
    addRemoveLinks: true,
  });

  // Multiple Files
  multipleFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 0.5, // MB
    clickable: true,
    addRemoveLinks: true
  });

  // Use Button To Select Files
  buttonSelect.dropzone({
    clickable: '#select-files' // Define the element that should be used as click trigger to select files.
  });

  // Limit File Size and No. Of Files
  limitFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 0.5, // MB
    maxFiles: 5,
    maxThumbnailFilesize: 1 // MB
  });

  // Accepted Only Files
  acceptFiles.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    acceptedFiles: 'image/*'
  });

  //Remove Thumbnail
  removeThumb.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    dictRemoveFile: ' Trash'
  });

  // Remove All Thumbnails
  removeAllThumbs.dropzone({
    paramName: 'file', // The name that will be used to transfer the file
    maxFilesize: 1, // MB
    init: function () {
      // Using a closure.
      var _this = this;

      // Setup the observer for the button.
      $('#clear-dropzone').on('click', function () {
        // Using "_this" here, because "this" doesn't point to the dropzone anymore
        _this.removeAllFiles();
        // If you want to cancel uploads as well, you
        // could also call _this.removeAllFiles(true);
      });
    }
  });

  var banner = $('#banner');
//   singleFile.on("addedfile", file => {
//     console.log("A file has been added");
//     console.log(file);
//     banner.val(file);
//   });



    // let myDropzone = $("#my-great-dropzone");

    // myDropzone.dropzone({
    //     paramName: "file", // The name that will be used to transfer the file
    //     maxFilesize: 2, // MB
    //     // addedfile: file => {
    //     //     console.log("A file has been added");
    //     //     console.log(file);
    //     //     banner.prop('files', file);
    //     //   }
    // });

    // $("#my-great-dropzone").dropzone({ 
    //     paramName: "file", // The name that will be used to transfer the file
    //     maxFilesize: 2, // MB
    //     addRemoveLinks : true,
    //     dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
    //     headers: {
    //         'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //     }
    // });

    // myDropzone.on("sending", function(file, xhr, formData) {
    //     console.log(file);
    //     console.log(formData);
    //     // Will send the filesize along with the file as POST data.
    //     formData.append("filesize", file.size);
    // });

    // myDropzone.on("addedfile", file => {
    //     console.log("A file has been added");
    //   });


     

    //   myDropzone.on("sending", function(file, xhr, formData) {
    //     console.log(file);
    //     console.log(formData);
    //     // Will send the filesize along with the file as POST data.
    //     formData.append("filesize", file.size);
    //   });

    //   myDropzone.on("addedfile", file => {
    //         console.log("A file has been added");
    //     });


});
