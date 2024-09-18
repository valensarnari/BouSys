/*----------------------------TRANSLATOR---------------------------------*/
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
  /*flags.UK*/
  const flagsElement = document.getElementById("flags");
  const textsToChange = document.querySelectorAll("[data-section]");
  const changeLanguage = async (language) => {
    const requestJson = await fetch("../languages/en.json");
    const texts = await requestJson.json();
    for (const textToChange of textsToChange) {
      const section = textToChange.dataset.section;
      const value = textToChange.dataset.value;
      textToChange.innerHTML = texts[section][value];
    }
  };
  flagsElement.addEventListener("click", (e) => {
    changeLanguage(e.target.parentElement.dataset.language);
  });
  /*flags.ES*/
  const flagsElement_es = document.getElementById("flag-es");
  const textsToChange_es = document.querySelectorAll("[data-section]");
  const changeLanguage_es = async (language) => {
    const requestJson = await fetch("../languages/es.json");
    const texts = await requestJson.json();
    for (const textToChange of textsToChange_es) {
      const section = textToChange.dataset.section;
      const value = textToChange.dataset.value;
      textToChange.innerHTML = texts[section][value];
    }
  };
  flagsElement_es.addEventListener("click", (e) => {
    changeLanguage_es(e.target.parentElement.dataset.language);
  });
}); /*-----------------------------------------end line---------------------------*/
/*------------------Intersection Observer-------------- */
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
});
