document.addEventListener("DOMContentLoaded", function(event) { 

    let single = "file chosen";

    fileUploadStyling(single);

})

function fileUploadStyling(single){
    let inputFile = $(":file");
        $(inputFile).on("change", function(e) {

            var label = $("#file-input-label");

            if(this.files && this.files.length > 0){
                $(label).text(this.files.length + ' ' + single);
                console.log("file selected");
            }else{
                $(label).text(this.files[0].name + ' ' + single);
                console.log("file selected");
            }
        });
    };