function sendRequest(url, data, method) {

    method = method.toUpperCase();

    if (method !== 'GET') {

        fetch(url, {
            method: method,
            body: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
            .then(responce => responce.json())
            .then(responce => console.log(responce))
    } else {
        fetch(url)
            .then(responce => responce.json())
            .then(responce => console.log(responce))
    }
}

