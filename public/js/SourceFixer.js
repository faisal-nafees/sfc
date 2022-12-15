const currentUrl = new URL(window.location.href);

// Canonical URL
let canonicalUrl = new URL("https://sfc.kdeproduction.net");

// add host in this array, you don't want to fix src elements for
if (['safetyfirstconsulting.org', 'sfc.kdeproduction.net'].indexOf(currentUrl.hostname) === -1) {
    // fix http issue
    canonicalUrl.protocol = currentUrl.protocol;

    let localSrc = `[src^="${currentUrl.origin}"]`;
    let tags = ["img", "iframe", "video", "audio"];
    tags.map((tag) => {
        return tag + localSrc + "," + tag + `[src^="/"]`;
    });
    let srcElSelector = tags.join(",");
    let srcEls = document.querySelectorAll(srcElSelector);

    function fixSrc(srcEls) {
        srcEls.forEach(function (srcEl) {

            if (srcEl.getAttribute("src").includes(currentUrl.origin)) {
                srcEl.setAttribute(
                    "src",
                    srcEl
                        .getAttribute("src")
                        .replace(currentUrl.origin, canonicalUrl.origin)
                );
            } else if (
                srcEl.getAttribute("src").charAt(0) == "/" &&
                !srcEl.getAttribute("src").charAt(0) != "//"
            ) {
                srcEl.setAttribute(
                    "src",
                    canonicalUrl.origin + srcEl.getAttribute("src")
                );
            }
        });
        document
            .querySelectorAll('[style^="background"]')
            .forEach(function (srcEl) {
                if (srcEl.style.backgroundImage.includes(currentUrl.origin)) {
                    srcEl.style.backgroundImage =
                        srcEl.style.backgroundImage.replace(
                            currentUrl.origin,
                            canonicalUrl.origin
                        );
                } else if (srcEl.style.background.includes(currentUrl.origin)) {
                    srcEl.style.background = srcEl.style.background.replace(
                        currentUrl.origin,
                        canonicalUrl.origin
                    );
                }
            });
    }
    fixSrc(srcEls);
    let fixSrcCount = 0;
    let fixSrcInterval = 3000;


    var myFunction = function () {
        let srcEls = document.querySelectorAll(srcElSelector);
        fixSrc(srcEls);
        if (fixSrcCount < 5) {
            fixSrcInterval += 1500;
            fixSrcCount++;
            setTimeout(myFunction, fixSrcInterval);
            console.log("fixSrcCount");
        }
    };
    setTimeout(myFunction, fixSrcInterval);
    // set dev overlay indicator
    document.querySelector('body').insertAdjacentHTML('beforeend', `
<div id="dev-overlay" style="position: fixed;
opacity: 0.1;
inset: 50%;
transform: translate3d(-50px, -50px, 0px);
z-index: 9999999;
pointer-events: none;
">
    <h1>DEV</h1>
</div>
`)
}
