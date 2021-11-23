export function modal()
{
    const modal = document.querySelector('.modal');
    const overlay = document.querySelector('.overlay');
    const btnsCloseModal = document.querySelectorAll('.btn--close');
    const btnOpenModal = document.querySelector('.btn--show');

    function togleElements()
    {
        modal.classList.toggle("modal--hidden");
        overlay.classList.toggle("modal--hidden");
    }

    const openModal = function(e) // abrir modal
    {
        e.preventDefault();
        togleElements();
    }

    const closeModal = function(e)// cerrar modal
    {
        e.preventDefault();
        togleElements();
    }

   btnOpenModal.addEventListener('click', openModal); // abrir modal
   btnsCloseModal.forEach(btn => btn.addEventListener('click', closeModal) ); // cerrar modal
   overlay.addEventListener('click', closeModal); // cerrar modal
}