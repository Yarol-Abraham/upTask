
function hideMessage()
{
    const element = document.querySelector(".alert");
    if(element) element.parentElement.removeChild(element);
}

export function message(type = "", msg = "", parent = null)
{
    const html = `<p class="alert alert-${type}">${msg}</p>`;
    if(parent) parent.insertAdjacentHTML('afterbegin', html);
    window.setTimeout(hideMessage, 3 * 1000);
}