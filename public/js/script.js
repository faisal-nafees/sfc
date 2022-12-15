let defaultConfig = {
    text: "Something went wrong",
    duration: -1,
    destination: null,
    newWindow: true,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "right", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    // className: "bg-danger",
    style: {
        background: "#f44336",
    },
};

function xtoast(config) {
    let newConfig = updateObj(defaultConfig, config);
    newConfig.style.background = getComputedStyle(
        document.documentElement
    ).getPropertyValue("--" + config.type);
    Toastify(newConfig).showToast();
}

function updateObj(target, src) {
    const res = {};
    Object.keys(target).forEach((k) => (res[k] = src[k] ?? target[k]));
    return res;
}
