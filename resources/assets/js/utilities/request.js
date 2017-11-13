/**
 * Post Submit
 */
window.postSubmit = function(url, params) {
    var form = document.createElement('form');
    form.method = 'post';
    form.action = url;

    var token = document.createElement('input');
    token.name = '_token';
    token.type = 'hidden';
    token.value = document.head.querySelector('[name=csrf-token]').content;
    form.appendChild(token);

    for (key in params) {
        var input = document.createElement('input');
        input.name = key;
        input.type = 'hidden';
        input.value = params[key];

        form.appendChild(input);
    }


    document.body.appendChild(form);
    form.submit();
}
