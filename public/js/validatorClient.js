
function Validator(options){

    var selectorRule = {};

    function validate(inputElement , rule){
        var errorMessage ;
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);

        var rules =selectorRule[rule.selector];

        for(var i=0; i< rules.length;i++){
            switch (inputElement.type){
                case 'radio':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector+':checked')
                    );
                    break;
                default:
                    errorMessage =  rules[i](inputElement.value);
            }
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

        formElement.onsubmit = function () {
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                validate(inputElement , rule);
            });
        }

        options.rules.forEach(function (rule) {

            if (Array.isArray(selectorRule[rule.selector])){
                selectorRule[rule.selector].push(rule.test);
            }else{
                selectorRule[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);
            Array.from(inputElements).forEach(function (inputElement) {
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
            });


        });
    }

}

Validator.isRequired = function(selector,message){
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message || 'Vui lòng nhập trường này!!!';
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


