<nav class="navbar">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=dashboard/">
            <img src="<?php echo APP_URL; ?>app/views/img/logoAcema.png" alt="acema" width="112" height="30">
        </a>
        <div class="navbar-burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="<?php echo APP_URL; ?>?views=dashboard/">
                Registro
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                    Herramientas
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>?views=inventario/">
                        Inventario
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL; ?>?views=usuario/">
                       Usuario
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Administrador
                </a>
                <div class="navbar-dropdown is-boxed">
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>?views=logOut/">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
    padding: 0.5rem 1rem;
}

.navbar-item {
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar-item:hover,
.navbar-link:hover {
    color: #485fc7; /* Cambia el color al pasar el mouse */
}

.navbar-burger {
    display: none;
    cursor: pointer;
}

.navbar-burger span {
    background-color: #fff;
    display: block;
    height: 2px;
    width: 18px;
    margin: 3px 0;
}

.navbar-menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

@media screen and (max-width: 768px) {
    .navbar-burger {
        display: block;
    }

    .navbar-menu {
        display: none;
        flex-direction: column;
        background-color: #6d8ecb; 
        padding: 1rem;
    }

    .navbar-menu.is-active {
        display: flex;
    }

    .navbar-dropdown {
        background-color: transparent;
        box-shadow: none;
        transform: none;
        opacity: 1;
        position: static;
    }
}

.navbar-item img {
    max-width: 100%;
    height: auto;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.querySelector('.navbar-menu');

        burger.addEventListener('click', () => {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    });
</script>
