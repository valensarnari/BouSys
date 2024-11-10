document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll(".hidden");
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("mostrar");
      } else {
        entry.target.classList.remove("mostrar");
      }
    });
  });

  elements.forEach((element) => observer.observe(element));

  /* Función para cambiar el idioma y guardar la selección en localStorage */
  const changeLanguage = async (language) => {
    const requestJson = await fetch(`../../../../../bousys/languages/${language}.json`);
    const texts = await requestJson.json();
    document.querySelectorAll("[data-status]").forEach((element) => {
      const statusValue = element.getAttribute("data-status");
      element.innerHTML = texts.status[statusValue] || statusValue;
    });
    document.querySelectorAll("[data-action]").forEach((button) => {
      const actionKey = button.getAttribute("data-action");
      button.querySelector("span").innerHTML = texts.actions[actionKey] || actionKey;
    });
    const textsToChange = document.querySelectorAll("[data-section]");
    textsToChange.forEach((textToChange) => {
      const section = textToChange.dataset.section;
      const value = textToChange.dataset.value;
      textToChange.innerHTML = texts[section][value];
      if(section === "panel_registro_login.php" && value === "iniciar")
        document.getElementById("e").value = texts[section][value];
      if(section === "panel_registro_login.php" && value === "registrar")
        document.getElementById("Panel_Registro_boton").value = texts[section][value];
    });

    // Guardar el idioma seleccionado en localStorage
    localStorage.setItem("selectedLanguage", language);
  };

  // Elementos de las banderas
  const flagsElement = document.getElementById("flags");
  const flagsElement_es = document.getElementById("flag-es");
  const flagsElement_pt = document.getElementById("flag-pt");

  // Evento para cambiar a inglés
  flagsElement.addEventListener("click", (e) => {
    const language = e.target.parentElement.dataset.language || "en";
    changeLanguage(language);
  });

  // Evento para cambiar a español
  flagsElement_es.addEventListener("click", (e) => {
    const language = e.target.parentElement.dataset.language || "es";
    changeLanguage(language);
  });
  flagsElement_pt.addEventListener("click", (e) => {
    const language = e.target.parentElement.dataset.language || "pt";
    changeLanguage(language);
  });

  // Cargar el idioma guardado en localStorage al cargar la página
  const savedLanguage = localStorage.getItem("selectedLanguage") || "en"; // Por defecto, inglés
  changeLanguage(savedLanguage);
});