document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const login = e.target.login.value;
  const password = e.target.password.value;

  console.log("Login:", login);
  console.log("Password:", password);

  // Тут отправка на backend
  // fetch('/login', { method:'POST', body: JSON.stringify({login, password}) })
});
