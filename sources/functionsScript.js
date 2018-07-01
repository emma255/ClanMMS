function passwordValidator(metering) {
    "use strict";
    var meterValue = "";
    var pwdvalid2 = (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z]{7,}$/);

    if (metering.value.match(pwdvalid2)) {
        meterValue = "Strong";
    } else {
        if (metering.value.length > 4 && metering.value.length < 8) {
            meterValue = "fair";
        } else {
            meterValue = "weak";
        }
    }
    document.forms[0].meter.value = meterValue;
    return meterValue;
}

function emailValidator() {
    "use strict";
    var email = document.getElementsByName("mail")[0].value;
    var emailValid=/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    var errortxt=null;
    if (email.match(emailValid)) {
        errortxt = "valid";
    } else {
        var atInd=email.indexOf("@");
            var dotInd=email.indexOf(".");
              if (atInd===0){
                  errortxt="@ should not be the first character";
              } else if(dotInd-atInd===1 || dotInd-atInd===-1){
                  errortxt="there should be another non special character between @ and dot";
              } else if(email.lastIndexOf(".")-email.indexOf("@")){
                  errortxt="the domain name should have a dot character";
              }
        document.forms[0].notifier.value = errortxt;
}
    document.forms[0].notifier.value = errortxt;
}

function capitalizeFirstCharacter1(a_name) {
    "use strict";
    var ind1 = a_name.value.toUpperCase().charAt(0);
    var ind2 = a_name.value.charAt(0);
    document.forms[0].fname.value = a_name.value.replace(ind2, ind1);
}
function capitalizeFirstCharacter2(a_name) {
    "use strict";
    var ind1 = a_name.value.toUpperCase().charAt(0);
    var ind2 = a_name.value.charAt(0);
    document.forms[0].mname.value = a_name.value.replace(ind2, ind1);
}

function capitalizeFirstCharacter3(a_name) {
    "use strict";
    var ind1 = a_name.value.toUpperCase().charAt(0);
    var ind2 = a_name.value.charAt(0);
    document.forms[0].lname.value = a_name.value.replace(ind2, ind1);
}

function validatePhone() {
    "use strict";
    var message = "";
    var number = document.getElementsByName("phone")[0].value;
    var expr = /0(2|6|7)\d{8}/;

    if (number.match(expr)) {
        if (number.length > 10) {
            message = "The digits exceeded maximum limit that is 10 digits";
        } else {
            message = "valid";
        }
    } else {
        try {
            if (parseInt(number.charAt(0)) !== 0) {
                throw "errorAt0";
            } else if (isNaN(number)) {
                throw "errornan";
            } else if (number.length===10) {
                throw "errorAt2";
            } else if (number.length < 10) {
                throw "errorLess";
            } else{
                throw "errorUn";
            }
        } catch (error) {
            if (error === "errorAt0") {
                message = "The number should start with 0";
            } else if (error === "errorLess") {
                message = "the number should be 10 digits, not "+number.length;
            } else if (error === "errornan") {
                message = "It is not a number";
            } else if (error === "errorAt2") {
                if (parseInt(number.charAt(1)) === 2) {

                } else if (parseInt(number.charAt(1)) === 6 || parseInt(number.charAt(1)) === 7) {

                } else {
                    message = "The number should start with 07, 06, or 02, not "+number.charAt(1);
                }
            } else if(error==="errorUn"){
                message = "make sure you typpe a correct phone number";
            }
        }

        document.forms[0].phoneing.value = message;
    }
    document.forms[0].phoneing.value = message;
}