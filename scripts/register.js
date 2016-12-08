$(function(){
    function getColorCode(i) {
        if(i <= 2) {
            return "btn-success";
        }
        else if(i >= 5) {
            return "btn-danger";
        }
        return "btn-info";
    }
    
    function getUsername() {
        var formGrade = $("#userbtn");
        return formGrade.val();
    }
    
    function getPassword() {
        var formGrade = $("#passbtn");
        return formGrade.val();
    }
    
    function getGrade(){
        var formGrade = $("#gradebtn");
        return formGrade.val();
    }
    
    function UpdatePreview() {
        $("#user").text(getUsername());
        $("#pass").text(getPassword());
        $("#grade").text(getGrade());
    }
    
    function UpdateSubmitButton() {
        var Button = $("#subbtn");
        Button.removeClass("btn-success");
        Button.removeClass("btn-danger");
        Button.removeClass("btn-info");
        Button.removeClass("btn-primary");
        Button.removeClass("btn-default");
        Button.addClass(getColorCode(parseInt(getGrade())));
        UpdatePreview();//Update information in preview
    }
    
    //Color submit button on change
    $('#gradebtn').change( function(){
        UpdateSubmitButton();
    });
    
    //Update preview on change
    $('input').change( function(){
        UpdatePreview();
    });
    
    var hide = true;
    $("#previewtable").hide();//hide previewTable by default
    UpdateSubmitButton();//Set The color of the Submit button once
    
    //Show or hide preview
    $("#preview").click(function(){//This is the worst way to solve this
        if(hide){
            UpdatePreview();//this may not be neccessary here
            $("#previewtable").show(); 
            hide = false;
        }
        else {
            $("#previewtable").hide();
            hide = true; 
        }
    });
});




