$(function () {
    $("#withdrawalMethod").change(function () {
        if ($(this).val() == "Bitcoin") {
            $("#beneficiaryField1").fadeIn();
            $("#beneficiaryField2").hide();
            $("#beneficiaryField3").hide();
            $("#beneficiaryField4").hide();
            $("#beneficiaryField5").hide();
            $("#beneficiaryField6").hide();
            $("#beneficiaryField7").hide();
        } else if ($(this).val() == "Litecoin") {
            $("#beneficiaryField2").fadeIn();
            $("#beneficiaryField1").hide();
            $("#beneficiaryField3").hide();
            $("#beneficiaryField4").hide();
            $("#beneficiaryField5").hide();
            $("#beneficiaryField6").hide();
            $("#beneficiaryField7").hide();
        } else if ($(this).val() == "Ethereum") {
            $("#beneficiaryField3").fadeIn();
            $("#beneficiaryField1").hide();
            $("#beneficiaryField2").hide();
            $("#beneficiaryField4").hide();
            $("#beneficiaryField5").hide();
            $("#beneficiaryField6").hide();
            $("#beneficiaryField7").hide();
        } else if ($(this).val() == "Bank Transfer") {
            $("#beneficiaryField4").fadeIn();
            $("#beneficiaryField5").fadeIn();
            $("#beneficiaryField6").fadeIn();
            $("#beneficiaryField7").fadeIn();
            $("#beneficiaryField1").hide();
            $("#beneficiaryField2").hide();
            $("#beneficiaryField3").hide();
        } else {
            $("#beneficiaryField1").hide();
            $("#beneficiaryField2").hide();
            $("#beneficiaryField3").hide();
            $("#beneficiaryField4").hide();
            $("#beneficiaryField5").hide();
            $("#beneficiaryField6").hide();
            $("#beneficiaryField7").hide();
        }
    });
    }); 
