(function () {
  try {
    localStorage.setItem("device_check", "ok");
  } catch (e) {
    alert("Le site nécessite l’activation des cookies.");
    return;
  }

  setTimeout(() => {
    window.location.href = "index.html";
  }, 3000);
})();
