# Evochii App 🐣🚀

Bienvenidos al **Ecosistema Evochii (v3.6.5)**, una plataforma de productividad gamificada construida con Laravel 11. Evochii transforma la manera en la que gestionas tus hábitos, tareas y bienestar diario vinculando tu progreso real al estado de un compañero virtual (tu Evochii).

## 🌟 Estado Actual (v3.6.5 - Ecosistema Sincronizado)

El ecosistema ha alcanzado un alto nivel de madurez visual y funcional, integrando persistencia global, soporte multi-idioma nativo y una interfaz dinámica reactiva.

### Características Principales:

* **🌌 Modo Dual Global (Light/Dark):** Sincronización instantánea de tema visual mediante LocalStorage. Fondos translúcidos (Glassmorphism), sombras responsivas y gradientes de neón adaptables sin FOUC (Flash of Unstyled Content).
* **🌍 Localización e I18N Dinámico:** Soporte real integrado para 5 idiomas (Español, Inglés, Portugués, Alemán, Francés) intercambiables al vuelo desde el portal de Acceso y el Centro de Control.
* **🧬 Biodiversidad Evochii (16 Especies):** Desde pollitos, tigres y pandas hasta alienígenas, fantasmas y unicornios.
* **🎭 Anatomía Dinámica y Reactiva:** Cada especie tiene reglas biológicas que activan o desactivan picos, hocicos y sonrojos orgánicos (dependiendo de si el avatar es biológico o robótico/etéreo).
* **⚡ Gemelo Digital y Biometría:** Tres métricas centrales (Foco, Energía y Zen) que alteran directamente las animaciones del avatar (Idle, Happy, Tired, Stressed, Focus) y su estado visual (ojos, parpadeos, suspiros).
* **📅 Sistema de Hábitos:** Seguimiento diario de rutinas y descansos que alimentan las métricas vitales.

---

## 🛠 Instalación y Despliegue Local (DDEV)

Este proyecto está optimizado para entornos de desarrollo basados en **DDEV** y **Docker**.

1. Cierra el repositorio:
   ```bash
   git clone https://github.com/cdelhierro5/evochiiapp.git
   cd evochiiapp
   ```
2. Inicializa DDEV:
   ```bash
   ddev start
   ```
3. Instala dependencias:
   ```bash
   ddev composer install
   ddev npm install && ddev npm run build
   ```
4. Configura el entorno y migra la Base de Datos:
   ```bash
   cp .env.example .env
   ddev artisan key:generate
   ddev artisan migrate
   ```
5. Accede localmente a:
   `https://tamagochi-rrss.ddev.site`

## 👨‍💻 Autor

Proyecto desarrollado por [cdelhierro5](https://github.com/cdelhierro5).
