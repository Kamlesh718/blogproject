"user strict";

const navLinks = document.querySelector(".nav-links");
const navOpenBtn = document.querySelector("#open-nav-btn");
const navCloseBtn = document.querySelector("#close-nav-btn");
const hamburgerIcon = document.querySelector(".hamburger-icon");
const sideBar = document.querySelector("aside");
const showSideBarBtn = document.querySelector("#show-sidebar-btn");
const hideSideBarBtn = document.querySelector("#hide-sidebar-btn");

// Opens nav
const navOpen = function () {
  // navLinks.style.display = "flex";
  // navOpenBtn.style.display = "none";
  navCloseBtn.style.display = "inline-block";
  navLinks.classList.remove("hidden");
  hamburgerIcon.classList.add("hidden");
};

// Close nav
const navClose = function () {
  // navLinks.style.display = "none";
  // navOpenBtn.style.display = "inline-block";
  navCloseBtn.style.display = "none";
  hamburgerIcon.classList.remove("hidden");
  navLinks.classList.add("hidden");
};

navOpenBtn.addEventListener("click", navOpen);
navCloseBtn.addEventListener("click", navClose);

// SIDEBAR ON MOBILE DEVICES

// SHOW SIDE BAR
const showSideBar = function () {
  sideBar.style.left = "0";
  showSideBarBtn.style.display = "none";
  hideSideBarBtn.style.display = "inline-block";
};

// HIDE SIDE BAR
const hideSideBar = function () {
  sideBar.style.left = "-100%";
  hideSideBarBtn.style.display = "none";
  showSideBarBtn.style.display = "inline-block";
};
showSideBarBtn.addEventListener("click", showSideBar);
hideSideBarBtn.addEventListener("click", hideSideBar);
