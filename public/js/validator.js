// function Validator(options){
//     var formElement =document.querySelector(options.form);

//     function validate(inputElement , rule){
//         var errorMessage = rule.test(inputElement.value);
//         var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
//         if(errorMessage){
//             errorElement.innerText = errorMessage;
//             inputElement.parentElement.classList.add('invalid');
//          }else{
//             errorElement.innerText = '';
//             inputElement.parentElement.classList.remove('invalid');
//         }

//     }

//     if(formElement){
//         options.rules.forEach(function (rule) {
//             var inputElement = formElement.querySelector(rule.selector);
//             if(inputElement){
//                 //trường hợp blur khỏi input
//                 inputElement.onblur = function () {
//                     validate(inputElement,rule);
//                 }

//                 //trường khi nhập vào
//                 inputElement.oninput =function() {
//                     var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
//                     errorElement.innerText = '';
//                     inputElement.parentElement.classList.remove('invalid');
//                 }
//             }
//         });
//     }
// }

// Validator.isTitle =function(selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             return value ? undefined : 'vui lòng nhập trường này!!!';
//         }
//     }
// }

// Validator.isSummary =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             return value ? undefined : 'vui lòng nhập trường này!!!';
//         }
//     }
// }

// Validator.isBudget =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             var regex = /^\d{1,9}(\.\d{1,2})?$/ ;
//             if(!value){
//                 return 'vui lòng nhập trường này!!!';
//             }
//             else
//                 return regex.test(value) ? undefined : 'Không phải số hoặc nhiều quá 9 số!!!';
//         }
//     }
// }
// Validator.isNumber =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             var regex = /^\d{1,3}?$/ ;
//             if(!value){
//                 return 'vui lòng nhập trường này!!!';
//             }
//             else
//                 return regex.test(value) ? undefined : 'Không phải số hoặc nhiều quá 3 số!!!';
//         }
//     }
// }
// Validator.isStartDay =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             var pattern = new RegExp("^(3[01]|(1[0-2]|0[1-9])/[12][0-9]|0[1-9])/[0-9]{4} (2[0-3]|[01]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$");
//             if(!value){
//                 return 'vui lòng nhập trường này!!!';
//             }
//             else
//                 return pattern.test(value) ? undefined : 'Không phải ngày hoặc sai định dạng!!!';
//         }
//     }
// }
// Validator.isEndday =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             var pattern = new RegExp("^(3[01]|(1[0-2]|0[1-9])/[12][0-9]|0[1-9])/[0-9]{4} (2[0-3]|[01]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$");
//             if(!value){
//                 return 'vui lòng nhập trường này!!!';
//             }
//             else
//                 return pattern.test(value) ? undefined : 'Không phải ngày hoặc sai định dạng!!!';
//         }
//     }
// }

// Validator.isLocation =function (selector){
//     return {
//         selector: selector,
//         test: function (value) {
//             // var regex = /^[a-zA-Z0-9 ]*$/ ;
//             if(!value){
//                 return 'vui lòng nhập trường này!!!';
//             }
//             // else
//             //     return regex.test(value) ? undefined : 'Địa điểm sai!!!';
//         }
//     }
// }

// Đối tượng `Validator`
function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        // Lấy ra các rules của selector
        var rules = selectorRules[rule.selector];

        // Lặp qua từng rule & kiểm tra
        // Nếu có lỗi thì dừng việc kiểm
        for (var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy element của form cần validate
    var formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function (e) {
            e.preventDefault();

            var isFormValid = true;

            // Lặp qua từng rules và validate
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Trường hợp submit với javascript
                if (typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInputs).reduce(function (values, input) {

                        switch(input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    }, {});
                    options.onSubmit(formValues);
                }
                // Trường hợp submit với hành vi mặc định
                else {
                    formElement.submit();
                }
            }
        }

        // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
        options.rules.forEach(function (rule) {

            // Lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function (inputElement) {
               // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function () {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
            });
        });
    }

}



// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined :  message || 'Vui lòng nhập trường này!!!'
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



