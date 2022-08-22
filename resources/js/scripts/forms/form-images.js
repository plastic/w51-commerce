/*=========================================================================================
    File Name: form-images.js
    Description: Images
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


function readfiles(files) {
  console.log(files)
  console.log(files[0])
    if($('#files').attr('multiple')){
        $('#files')[0].files  = files;
    }else{

    const dataTransfer = new DataTransfer;
     //Add new files from the event's DataTransfer
     for(let i = 0; i < 1; i++)
       dataTransfer.items.add(files[i])

     //Add existing files from the input element
    //  for(let i = 0; i < InputElement.files.length; i++)
    //    dataTransfer.items.add(InputElement.files[i])

    $('#files')[0].files  = dataTransfer.files;

  }

  console.log($('#files')[0].files);

  $('#files').change();
}


var holder = document.getElementById('actions');
holder.onmousedown = function () { this.className = 'dropzone dropzone-area hover blocked';  };
holder.onmouseup = function () {   this.className = 'dropzone dropzone-area hover';};
holder.ondragover = function () {  this.className = 'dropzone dropzone-area hover'; return false; };
holder.ondragend = function () { this.className = 'dropzone dropzone-area';  return false; };
holder.ondrop = function(e) {
  this.className = 'dropzone dropzone-area';
  e.preventDefault();
  console.log(e.dataTransfer.files);

  if( !this.classList.contains('blocked')){
      readfiles(e.dataTransfer.files);
  }
}

var _URL = window.URL || window.webkitURL;
let myimages;
let onRemove = false;
let imagesWrapper = $('#actions .actions');


var inputElement = document.getElementById("files");
inputElement.onclick  = function(event) {
    $('.dropzone ').removeClass('hover');
}

//Images
inputElement.onchange = function(event) {

    if ($(this)[0].files.length  == 0 && !onRemove) {
        console.log("Suspect Cancel was hit, no files selected.");
        console.log(myimages);
        $(this)[0].files = myimages;
    }


    if($(this).attr('limit') &&  $(this)[0].files.length > $(this).attr('limit')){

        Swal.fire({
            icon: 'warning',
            title: "Aviso!",
            text: "Você só pode enviar " + $(this).attr('limit') + " arquivos por campo.",
            type: "error",
            confirmButtonColor: '#ff9f43',
            confirmButtonText: "OK"
        });

        //toastr.warning( "Você só pode enviar " + $(this).attr('limit') + " arquivos por campo.","Aviso!",{closeButton:true,tapToDismiss:false})

        const dataTransfer = new DataTransfer;
        for(let i = 0; i < $(this).attr('limit'); i++)
        dataTransfer.items.add($(this)[0].files[i])

        $(this)[0].files  = dataTransfer.files;
    }

    var maxWidth = $(this).attr('width');
    var maxHeight = $(this).attr('height');
    var maxSize = $(this).attr('filesize') * 1024;

    var file, img;
    if ((file = this.files[0])) {

        if(file.size > maxSize ){
            Swal.fire({
                icon: 'error',
                title: "Ops!",
                text: "Tamanho de arquivo inválido",
                type: "error",
                confirmButtonColor: '#d33',
                confirmButtonText: "OK"
            });
            $('#files').val('').change();
            $('.dropzone ').removeClass('hover');
            return;
        }

        img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function () {

            if(this.width > maxWidth || this.height > maxHeight ){
                Swal.fire({
                    icon: 'error',
                    title: "Ops!",
                    text: "Tamanho de imagem inválido",
                    type: "error",
                    confirmButtonColor: '#d33',
                    confirmButtonText: "OK"
                });
                $('#files').val('').change();
                $('.dropzone ').removeClass('hover');
                return;
            }

            _URL.revokeObjectURL(objectUrl);
        };
        img.onerror = function() {
            Swal.fire({
                icon: 'error',
                title: "Ops!",
                text: "Formarto de arquivo inválido",
                type: "error",
                confirmButtonColor: '#d33',
                confirmButtonText: "OK"
            });
            $('#files').val('').change();
            $('.dropzone ').removeClass('hover');
            return;
        };
        img.src = objectUrl;
    }

  $('#allImagesWrapper .card-newthumb').remove();
  var imgs = $(this)[0].files;
  console.log(imgs);


  if(imgs.length > 0){
    $('.dz-message').addClass('filled');
  }else{
    $('.dz-message').removeClass('filled');
  }

  myimages = imgs;
  Array.from(imgs).forEach(function(img, index){
      var card = document.createElement("span");
      card.classList = 'card-newthumb dz-preview dz-processing dz-image-preview dz-error dz-complete';
      card.dataset.uploadname = img.name;

      var cardlink = document.createElement("a");
      cardlink.classList = 'btn btn-outline-danger btn-sm justCreatedCard w-100';
      cardlink.href = '#';
      cardlink.innerHTML= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
      cardlink.addEventListener("click", function(){
    removeImage(event, img ,card);
  }, false);

      var cardimageWrapper = document.createElement("div");
      cardimageWrapper.classList= 'dz-image';

      var cardimage = document.createElement("img");
      cardimage.src = URL.createObjectURL(img);

      cardimageWrapper.append(cardimage);

      var cardetails = document.createElement("div");
      cardetails.classList= 'dz-details';

      var cardsize = document.createElement("div");
      cardsize.classList= 'dz-size';


      var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
      var i = parseInt(Math.floor(Math.log(img.size) / Math.log(1024)));
      var fileconvertedsize = '<strong>' + Math.round(img.size / Math.pow(1024, i), 2) + '</strong> ' + sizes[i];

      var cardsizespan = document.createElement("span");
      cardsizespan.innerHTML = fileconvertedsize;
      cardsize.append(cardsizespan);

      var cardfilename = document.createElement("div");
      cardfilename.classList= 'dz-filename';

      var cardfilenamespan = document.createElement("span");
      cardfilenamespan.innerHTML = img.name;
      cardfilename.append(cardfilenamespan);

      cardetails.append(cardsize);
      cardetails.append(cardfilename);

      var cardmark = document.createElement("div");
      cardmark.classList= 'dz-success-mark';

      card.append(cardimageWrapper);
      card.append(cardetails);
      card.append(cardmark);
      card.append(cardlink);


      img.onload = function() {
        URL.revokeObjectURL(cardimage.src) // free memory
      }

      imagesWrapper.append(card);

  })
  $('.dropzone ').removeClass('hover');
  onRemove = false;
}

let fileArray;
let imagesValue;
function removeImage(event, image, parent){
  event.preventDefault();

  const dt = new DataTransfer()
  const input = document.getElementById('files')
  const { files } = input
  Array.from(files).forEach(function(file){
      if (file.name !== image.name && file.lastModified !== image.lastModified)
      dt.items.add(file) // here you exclude the file. thus removing it.
  });

  input.files = dt.files // Assign the updates list
  console.log( $('.custom-images-input')[0].files);
  onRemove = true;
  $('#files').change();

 parent.remove();
}


sortable('#allImagesWrapper', {
  orientation: 'horizontal', // Defaults to 'vertical'
  items: '.card-newthumb',
  forcePlaceholderSize: true,
  placeholderClass: 'ph-class',
  dropTargetContainerClass: 'is-drop-target', // Defaults to false
  itemSerializer: (serializedItem, sortableContainer) => {
    return {
      position:  serializedItem.index + 1,
      html: serializedItem.html
    }
  }
});

sortable('#allImagesWrapper')[0].addEventListener('sortupdate', function(e) {
 // console.log(e.detail);
  var order = sortable('#allImagesWrapper', 'serialize')[0].items;
  var data = [];
  order.forEach(function(item){
      var firsttPart = item.html.split('uploadname="')[1];
      var imgString = firsttPart.split('"')[0];
      data.push(imgString);
  })
  $('#serialized').val(data);
});

function removeOne(event){
    event.preventDefault();

    $('#files').val("").change();
}

function removeThis(event, este){
  event.preventDefault();

  Swal.fire({
      title:  'Remover imagem?',
      html:  'Esta ação é irreversível e irá remover a imagem do banco.',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#d33',
      confirmButtonText:  'OK',
      customClass: {
          actions: 'my-actions',
          cancelButton: 'order-1',
          denyButton: 'order-1',
          confirmButton: 'order-2',
      }
  }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.value) {

          este.closest('.card-newthumb').addClass('hidden');
          var url = este.attr('href');

           $.ajax({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              type: 'GET',
              url:url,
              success: function (result) {
              console.log(result);
                if (result) {
                  este.closest('.card-newthumb').remove();
                  onRemove = true;
                  return true;
                } else {
                  Swal.fire('Ocorreu um erro', '', 'error');
                  este.closest('.card-newthumb').removeClass('hidden');
                  return false;
                }
              },
            });

      } else if (result.dismiss == 'cancel' ) {

      }
  })


}

