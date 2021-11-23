export function menu()
{
    const btn = document.querySelector(".btn-active"); // boton de menu
    const nav = document.querySelector(".main__aside__nav") // menu de opciones

    btn.addEventListener('click', function(){
        nav.classList.toggle("main__aside__nav--hidden");
    });
}