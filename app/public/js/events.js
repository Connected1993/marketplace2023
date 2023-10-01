let states = {}
document.body.addEventListener('click', e => {
    return false;
    console.log(states)
    let elem = e.target;
    let state = elem.getAttribute('state');

    if (state && !states[state]) {
        let addModule = document.createElement('script');
        addModule.type = 'module';
        addModule.textContent = `import {sendRequest} from '/app/public/js/${state}.js'; ${state}();`;
        document.head.appendChild(addModule);
        states[state] = 1
    }

    Object.keys(states).forEach(f => {

        if (f === state) {
            console.log(state)

        }
    })

});