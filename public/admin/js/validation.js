function Validator(options){

    var selectorRule = {};

    function validate(inputElement , rule){
        var errorMessage ;
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);

        var rules =selectorRule[rule.selector];

        for(var i=0; i< rules.length;i++){
            errorMessage =  rules[i](inputElement.value);
            if(errorMessage)
            break;
        }

        if(errorMessage){
            errorElement.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid');
        }else{
            errorElement.innerText = '';
            inputElement.parentElement.classList.remove('invalid');
        }
    }

    var formElement = document.querySelector(options.form);

    if(formElement){

        options.rules.forEach(function (rule) {

            if (Array.isArray(selectorRule[rule.selector])){
                selectorRule[rule.selector].push(rule.test);
            }else{
                selectorRule[rule.selector] = [rule.test];
            }

            var inputElement = formElement.querySelector(rule.selector);


            if(inputElement){
                inputElement.onblur =function () {
                    validate(inputElement , rule);
                }
                inputElement.oninput = function () {
                    var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    inputElement.parentElement.classList.remove('invalid');
                }
            }
        })
    }

}

Validator.isRequired = function(selector,message){
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : message || 'Vui lòng nhập trường này!!!';
        }
    };
}

Validator.isEmail = function(selector,message){
    return {
        selector: selector,
        test: function (value) {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            return regex.test(value) ? undefined : message || 'Không đúng định dạng Email!!!';
        }
    };
}

Validator.minLength = function(selector , min, message){
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} ký tự!!!`;
        }
    };
}

Validator.isPhone = function(selector,message){
    return {
        selector: selector,
        test: function (value) {
            var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            return regex.test(value) ? undefined : message || 'Không đúng định dạng số điện thoại!!! ';
        }
    };
}

Validator.isBudget =function (selector){
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\d{1,9}(\.\d{1,2})?$/ ;
            if(!value){
                return 'vui lòng nhập trường này!!!';
            }
            else
                return regex.test(value) ? undefined : 'Không phải số hoặc nhiều quá 9 số!!!';
        }
    }
}

Validator.isNumber =function (selector){
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\d{1,3}?$/ ;
            if(!value){
                return 'vui lòng nhập trường này!!!';
            }
            else
                return regex.test(value) ? undefined : 'Không phải số hoặc nhiều quá 3 số!!!';
        }
    }
}

Validator.isStartDay =function (selector){
    return {
        selector: selector,
        test: function (value) {
            var pattern = new RegExp("^(3[01]|(1[0-2]|0[1-9])/[012][0-9]|0[1-9])/[0-9]{4} (2[0-3]|[01]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$");
            if(!value){
                return 'vui lòng nhập trường này!!!';
            }
            else
                return pattern.test(value) ? undefined : 'Không phải ngày hoặc sai định dạng!!!';
        }
    }
}
