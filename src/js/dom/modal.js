export function modal()
{
    const modal = document.querySelector('.modal');
    const overlay = document.querySelector('.overlay');
    const btnsCloseModal = document.querySelectorAll('.btn--close');
    const btnOpenModal = document.querySelector('.btn--show');

    function toggleElements()
    {
        modal.classList.toggle("modal--hidden");
        overlay.classList.toggle("modal--hidden");
    }

    const toggleModal = function(e) // abrir o cerrar el modal
    {
        e.preventDefault();
        toggleElements();
    }

   btnOpenModal.addEventListener('click', toggleModal); // abrir modal
   btnsCloseModal.forEach(btn => btn.addEventListener('click', toggleModal) ); // cerrar modal
   overlay.addEventListener('click', toggleModal); // cerrar modal
}