document.addEventListener("DOMContentLoaded", function(event) { 

    let single = "file chosen";

    fileUploadStyling(single);

    removeSelectBottomBorders();
});

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


/* <select> styling */

function removeSelectBottomBorders(){
    //add html event listener
    $("html").on("click keydown touchstart", (e) => {
        let tmpSelectItem = selectItem;
        
        if (e.target.tagName != "OPTION" && e.target.tagName != "SELECT") {
            //$("html").trigger("focus");
            console.debug("CLICK OUTSIDE OF SELECT!");
            if ($("select").hasClass("bottom-flat")) {
                $("select").removeClass("bottom-flat");
                $("html").unbind("click keydown touchstart");
            }
        }
    });
    //select all <select> tags
    let input = $("select");
    console.log(input.length);
    //cycle through all selected select tags
    for (let i = 0; i < input.length; i++) {
        var selectItem = input[i];
        $(selectItem).on("click keydown touchstart", (e) => {
            if (e.target.tagName == "SELECT") {
                if (!$(e.target).hasClass("bottom-flat")) {
                    $(e.target).addClass("bottom-flat");
                } else if ($(e.target).hasClass("bottom-flat")) {
                    $(e.target).removeClass("bottom-flat");
                    $("html").unbind("click keydown touchstart");
                }
            } else if (e.target.tagName == "OPTION") {
                if ($(e.target).parent().hasClass("bottom-flat")) {
                    $(e.target).parent().removeClass("bottom-flat");
                    $("html").unbind("click keydown touchstart");
                };
            } else {
                //$("html").unbind("click keydown touchstart");
                console.warn("last Else triggered")
            };
            });
}};

