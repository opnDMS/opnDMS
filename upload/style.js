document.addEventListener("DOMContentLoaded", function(event) { 

    let single = "File chosen";

    fileUploadStyling(single);

})

function fileUploadStyling(single){
    let input = document.querySelectorAll("input[type=file]");
    for (let i = 0; i < input.length; i++) {
        var inputFile = input[i];
        inputFile.addEventListener('change',function(e){

            var label = this.nextElementSibling;

            if(this.files && this.files.length > 0){
                label.innerHTML = this.files.length + ' ' + single;
            }else{
                label.innerHTML = this.files[0].name + ' ' + single;
            }
        });
    }
}