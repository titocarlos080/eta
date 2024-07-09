document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const bodyClassList = document.body.classList;

    if (!themeToggle) {
        console.error('Elemento con id "theme-toggle" no encontrado.');
        return;
    }

    // Función para alternar temas
    function toggleTheme() {
        if (bodyClassList.contains('theme-teens')) {
            bodyClassList.remove('theme-teens');
            bodyClassList.add('theme-adults');
            themeToggle.querySelector('i').classList.replace('fa-child', 'fa-user-tie');
            localStorage.setItem('theme', 'theme-adults');
        } else if (bodyClassList.contains('theme-adults')) {
            bodyClassList.remove('theme-adults');
            bodyClassList.add('theme-teens');
            themeToggle.querySelector('i').classList.replace('fa-user-tie', 'fa-child');
            localStorage.setItem('theme', 'theme-teens');
        } else {
            // Si no hay tema aplicado, aplicar el tema de jóvenes por defecto
            bodyClassList.add('theme-teens');
            themeToggle.querySelector('i').classList.replace('fa-user-tie', 'fa-child');
            localStorage.setItem('theme', 'theme-teens');
        }
    }

    themeToggle.addEventListener('click', toggleTheme);

    // Restablecer temas al cambiar entre modo claro y oscuro
    const darkModeToggle = document.querySelector('.adminlte-darkmode-widget a');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function () {
            bodyClassList.remove('theme-teens', 'theme-adults');
            localStorage.removeItem('theme');
        });
    }

    // Aplicar tema guardado
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        bodyClassList.add(savedTheme);
        if (savedTheme === 'theme-teens') {
            themeToggle.querySelector('i').classList.replace('fa-user-tie', 'fa-child');
        } else if (savedTheme === 'theme-adults') {
            themeToggle.querySelector('i').classList.replace('fa-child', 'fa-user-tie');
        }
    }

    // Aplicar tema a los modales cuando se abran
    const modalElements = document.querySelectorAll('.modal');
    modalElements.forEach(modal => {
        modal.addEventListener('show.bs.modal', function () {
            if (bodyClassList.contains('theme-teens')) {
                modal.classList.add('theme-teens');
                modal.classList.remove('theme-adults');
            } else if (bodyClassList.contains('theme-adults')) {
                modal.classList.add('theme-adults');
                modal.classList.remove('theme-teens');
            }
        });

        // Mantener el tema aplicado cuando el modal se cierra
        modal.addEventListener('hidden.bs.modal', function () {
            if (bodyClassList.contains('theme-teens')) {
                modal.classList.add('theme-teens');
                modal.classList.remove('theme-adults');
            } else if (bodyClassList.contains('theme-adults')) {
                modal.classList.add('theme-adults');
                modal.classList.remove('theme-teens');
            }
        });
    });
});
