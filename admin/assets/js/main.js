let emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
let phonePattern = /^(010|011|012|015)\d{8}$/;
let idPattern = /^[0-9]{16}$/;
var firEmail = true;
var firPass = true;
var firName = true;
var firPhone = true;
var firUniv = true;
var firID = true;
var lable_email, lable_pass, label_name, label_phone, label_univ, label_id;
var email, pass, nam, phone, univ, id;
console.log('fi');//بيطبع
function valid_id() {
  if (firID) {
    return;
  }
  let idVal = id.value.trim();
  if (idPattern.test(idVal)) {
    label_id.innerText = "vaild ID";
  } else {
    label_id.innerText = "invaild ID(14 digit)";
  }
}

function valid_univ() {
  if (firUniv) {
    return;
  }
  let univVal = univ.value.trim();
  if (!univVal == "") {
    label_univ.innerText = "vaild University";
  } else {
    label_univ.innerText = "invaild University";
  }
}

function valid_phone() {
  if (firPhone) {
    return;
  }
  let phoneVal = phone.value.trim();
  if (phonePattern.test(phoneVal)) {
    label_phone.innerText = "vaild Phone";
  } else {
    label_phone.innerText = "invaild Phone";
  }
}

function valid_name() {
  if (firName) {
    return;
  }
  let nameVal = nam.value.trim();
  if (nameVal.length > 2) {
    label_name.innerText = "vaild Name";
  } else {
    label_name.innerText = "invaild Name";
  }
}

function valid_email() {
  if (firEmail) {
    return;
  }
  const emailField = document.getElementById('studentEmail');
  const label = document.querySelector("label[for='studentEmail']");
  let emailVal = emailField.value.trim();
  if (emailPattern.test(emailVal)) {
    label.innerText = "valid Email";
    emailField.style.borderColor = "#28a745";
  } else {
    label.innerText = "invalid Email";
    emailField.style.borderColor = "var(--main-color)";
  }
}

function valid_pass() {
  if (firPass) {
    return;
  }
  const passwordField = document.getElementById('studentPassword');
  const label = document.querySelector("label[for='studentPassword']");
  let passVal = passwordField.value.trim();
  if (passVal !== "") {
    label.innerText = "valid password";
    passwordField.style.borderColor = "#28a745";
  } else {
    label.innerText = "invalid password";
    passwordField.style.borderColor = "var(--main-color)";
  }
}

function valid_email_admin() {
  if (firEmail) {
    return;
  }
  const emailField = document.getElementById("adminEmail");
  const label = document.querySelector("label[for='adminEmail']");
  let emailVal = emailField.value.trim();
  if (emailPattern.test(emailVal)) {
    label.innerText = "valid Email";
    emailField.style.borderColor = "#28a745";
  } else {
    label.innerText = "invalid Email";
    emailField.style.borderColor = "var(--main-color)";
  }
}

function valid_pass_admin() {
  if (firPass) {
    return;
  }
  const passwordField = document.getElementById("adminPassword");
  const label = document.querySelector("label[for='adminPassword']");
  let passVal = passwordField.value.trim();
  if (passVal !== "") {
    label.innerText = "valid password";
    passwordField.style.borderColor = "#28a745";
  } else {
    label.innerText = "invalid password";
    passwordField.style.borderColor = "var(--main-color)";
  }
}

function check1(e) {
  const email = document.getElementById('studentEmail');
  const password = document.getElementById('studentPassword');
  let emailVal = email.value.trim();
  let passVal = password.value.trim();
  
  if (!emailPattern.test(emailVal) || passVal == "") {
    e.preventDefault();
  }

  if (!emailPattern.test(emailVal)) {
    const label_email = document.querySelector("label[for='studentEmail']");
    email.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    label_email.innerText = "invalid Email";
    firEmail = false;
  }

  if (passVal == "") {
    const label_pass = document.querySelector("label[for='studentPassword']");
    password.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    label_pass.innerText = "invalid password";
    firPass = false;
  }
}

function check3(e) {
  const email = document.getElementById("adminEmail");
  const password = document.getElementById("adminPassword");
  let emailVal = email.value.trim();
  let passVal = password.value.trim();

  if (!emailPattern.test(emailVal) || passVal == "") {
    e.preventDefault();
  }

  if (!emailPattern.test(emailVal)) {
    const label_email = document.querySelector("label[for='adminEmail']");
    email.style.cssText =
      "animation: move .4s;border-color: var(--main-color);";
    label_email.innerText = "invalid Email";
    firEmail = false;
  }

  if (passVal == "") {
    const label_pass = document.querySelector("label[for='adminPassword']");
    password.style.cssText =
      "animation: move .4s;border-color: var(--main-color);";
    label_pass.innerText = "invalid password";
    firPass = false;
  }
}

function check2(e) {
  nam = document.querySelector("form div input[name='name']");
  let nameVal = nam.value.trim();
  email = document.querySelector("form div input[name='email']");
  let emailVal = email.value.trim();
  pass = document.querySelector("form div input[name='password']");
  let passVal = pass.value.trim();
  phone = document.querySelector("form div input[name='phone']");
  let phoneVal = phone.value.trim();
  univ = document.querySelector("form div input[name='university']");
  let univVal = univ.value.trim();
  id = document.querySelector("form div input[name='id']");
  let idVal = id.value.trim();

  if (
    !emailPattern.test(emailVal) ||
    passVal == "" ||
    nameVal.length < 3 ||
    !emailPattern.test(emailVal) ||
    !phonePattern.test(phoneVal) ||
    univVal == "" ||
    !idPattern.test(idVal)
  ) {
    e.preventDefault();
  }

  if (!emailPattern.test(emailVal)) {
    lable_email = document.querySelector("form div label[for='email']");
    email.style.cssText =
      "animation: move .4s;border-color: var(--main-color);";
    lable_email.innerText = "invaild Email";
    firEmail = false;
  }

  if (passVal == "") {
    lable_pass = document.querySelector("form div label[for='password']");
    pass.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    lable_pass.innerText = "invaild password";
    firPass = false;
  }

  if (nameVal.length < 3) {
    label_name = document.querySelector("form div label[for='name']");
    nam.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    label_name.innerText = "invaild Name";
    firName = false;
  }

  if (!phonePattern.test(phoneVal)) {
    label_phone = document.querySelector("form div label[for='phone']");
    phone.style.cssText =
      "animation: move .4s;border-color: var(--main-color);";
    label_phone.innerText = "invaild Phone";
    firPhone = false;
  }

  if (univVal == "") {
    label_univ = document.querySelector("form div label[for='university']");
    univ.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    label_univ.innerText = "invaild University";
    firUniv = false;
  }

  if (!idPattern.test(idVal)) {
    label_id = document.querySelector("form div label[for='id']");
    id.style.cssText = "animation: move .4s;border-color: var(--main-color);";
    label_id.innerText = "invaild ID(14 digit)";
    firID = false;
  }
}
