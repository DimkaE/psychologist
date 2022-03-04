window.getQueryString = function (url, data) {
    const getQueryArray = (obj, path = [], result = []) =>
        Object.entries(obj).reduce((acc, [k, v]) => {
            path.push(k);
            if (v && !(k == 'page' && v == 1)) { //убрать page=1 из запроса
                if (v instanceof Object) {
                    getQueryArray(v, path, acc);
                } else {
                    acc.push(`${path.map((n, i) => i ? `[${n}]` : n).join('')}=${v}`);
                }
            }
            path.pop();
            return acc;
        }, result);
    const getQueryString = obj => getQueryArray(obj).join('&');
    const string = getQueryString(data);
    if (string != window.location.search) {
        let full_url = string ? url + '?' + string : url;
        window.history.pushState("", "", full_url);
    }
    return string;
}
