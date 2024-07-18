document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const themeToggleKids = document.getElementById('theme-toggle-kids');
    const bodyClassList = document.body.classList;
    const soundKids = new Audio('/inf513/grupo05sc/proyecto2/eta/public/sounds/kids.mp3');
    const clickSoundKids = new Audio('/inf513/grupo05sc/proyecto2/eta/public/sounds/LuzSolart.mp3');

    if (!themeToggle) {
        console.error('Elemento con id "theme-toggle" no encontrado.');
        return;
    }
    
    if (!themeToggleKids) {
        console.error('Elemento con id "theme-toggle-kids" no encontrado.');
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

 // Función para activar el tema de niños
    function toggleThemeKids() {
         if (bodyClassList.contains('theme-kids')) {
             bodyClassList.remove('theme-kids');
            localStorage.removeItem('theme');
         } else {
             bodyClassList.remove('theme-teens', 'theme-adults');
             bodyClassList.add('theme-kids');
             localStorage.setItem('theme', 'theme-kids');
             soundKids.play();
         }
    }   


    themeToggle.addEventListener('click', toggleTheme);
    themeToggleKids.addEventListener('click', toggleThemeKids);

    // Restablecer temas al cambiar entre modo claro y oscuro
    const darkModeToggle = document.querySelector('.adminlte-darkmode-widget a');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function () {
            bodyClassList.remove('theme-teens', 'theme-adults', 'theme-kids');
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
        } else if (savedTheme === 'theme-kids') {
            if (themeToggle.querySelector('i')) {
            themeToggle.querySelector('i').classList.replace('fa-child', 'fa-user-tie');
            }
        }
    }
   
  // Aplicar tema a los modales cuando se abran
  const modalElements = document.querySelectorAll('.modal');
  modalElements.forEach(modal => {
      modal.addEventListener('show.bs.modal', function () {
          if (bodyClassList.contains('theme-teens')) {
              modal.classList.add('theme-teens');
              modal.classList.remove('theme-adults', 'theme-kids');
          } else if (bodyClassList.contains('theme-adults')) {
              modal.classList.add('theme-adults');
              modal.classList.remove('theme-teens', 'theme-kids');
          } else if (bodyClassList.contains('theme-kids')) {
              modal.classList.add('theme-kids');
              modal.classList.remove('theme-teens', 'theme-adults');
          }
      });
        // Mantener el tema aplicado cuando el modal se cierra
        modal.addEventListener('hidden.bs.modal', function () {
            if (bodyClassList.contains('theme-teens')) {
                modal.classList.add('theme-teens');
                modal.classList.remove('theme-adults', 'theme-kids');
            } else if (bodyClassList.contains('theme-adults')) {
                modal.classList.add('theme-adults');
                modal.classList.remove('theme-teens', 'theme-kids');
            } else if (bodyClassList.contains('theme-kids')) {
                modal.classList.add('theme-kids');
                modal.classList.remove('theme-teens', 'theme-adults');
            }
        });
    });
    document.addEventListener('click', function (event) {
        if (bodyClassList.contains('theme-kids')) {
            clickSoundKids.play();
        }
    }, true); // 'true' para capturar el evento en la fase de captura y asegurar que se registre antes que cualquier otra lógica de clic
});

