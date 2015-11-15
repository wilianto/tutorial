var imgPath;
var destinationUrl = "http://192.168.1.102:8080/tutorial/cameraupload_server/upload.php";
var app = {
    initialize: function() {
        this.bindEvents();
    },
    bindEvents: function() {
        document.addEventListener("deviceready", this.onDeviceReady, false);
    },
    onDeviceReady: function() {
        document.getElementById("upload-btn").style.display = "none";
        document.getElementById("image-preview").style.display = "none";
        document.getElementById("loading").style.display = "none";
        document.getElementById("description").style.display = "none";
    },
    takePhoto: function(){
        navigator.camera.getPicture(function(imgData){
            imgPath = imgData;
            document.getElementById("image-preview").src = imgData;
            document.getElementById("upload-btn").style.display = "block";
            document.getElementById("image-preview").style.display = "block";
            document.getElementById("description").style.display = "block";
        }, function(error){
            alert(error);
        }, {
            quality: 50,
            destinationType: Camera.DestinationType.FILE_URI,
            correctOrientation: true
        });
    },
    uploadPhoto: function(){
        var options = new FileUploadOptions();
        options.fileKey = "photo";
        options.fileName = imgPath;
        options.mimeType = "image/jpeg";
        options.params = {
            description: document.getElementById("description").value
        };

        var fileTransfer = new FileTransfer();
        fileTransfer.onprogress = function(progressEvent){
            document.getElementById("loading").style.display = "block";
            if(progressEvent.lengthComputable){
                console.log(progressEvent.loaded + " of " + progressEvent.total);
                document.getElementById("loading-inner").style.width = progressEvent.loaded / progressEvent.total * 100 + "%";
            }else{
                document.getElementById("loading-inner").style.width = "100%";
            }
        }

        fileTransfer.upload(imgPath, destinationUrl, function(response){
            //on success
            alert(response.response);
        }, function(error){
            //on failed
            alert("An error has occured: Code=" + error.code);
        }, options);
    }
};

app.initialize();
