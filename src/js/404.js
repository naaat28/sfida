"use strict";


/*---------- ham ----------*/

const ham = document.querySelector(".js_hamburger");
const nav = document.querySelector(".js_nav");
const barElements = document.querySelectorAll(".m_hamburger-bar");
const body = document.querySelector(".js_body");

ham.addEventListener("click", () => {
  ham.classList.toggle("is-active");
  nav.classList.toggle("is-active");
  body.classList.toggle("is-active");
  document.body.classList.toggle("no-scroll");

  barElements.forEach((bar) => {
    bar.classList.toggle("change-color");
  });
});

const navLinks = document.querySelectorAll(".l_header-nav_link");
navLinks.forEach((navLink) => {
  navLink.addEventListener("click", () => {
    ham.classList.remove("is-active");
    nav.classList.remove("is-active");
    body.classList.remove("is-active");
  });
});






const rootStyles = getComputedStyle(document.documentElement);

const whiteColor = rootStyles.getPropertyValue("--white-color").trim();
const blackColor01 = rootStyles.getPropertyValue("--black-color01").trim();
const blackColor02 = rootStyles.getPropertyValue("--black-color02").trim();
const homeColor01 = rootStyles.getPropertyValue("--home-color01").trim();
const homeColor02 = rootStyles.getPropertyValue("--home-color02").trim();
const visitorColor01 = rootStyles.getPropertyValue("--visitor-color01").trim();
const visitorColor02 = rootStyles.getPropertyValue("--visitor-color02").trim();

document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const homeBtn = document.querySelector(".m_switching-home");
  const visitorBtn = document.querySelector(".m_switching-visitor");

    //home
    homeBtn.addEventListener("click", () => {
      body.classList.remove("visitor");
      body.classList.add("home");
      body.style.background = ""; //default(home)
      body.style.color = ""; //default(home)
      sessionStorage.setItem("mode", "home");
    });

    //visitor
    visitorBtn.addEventListener("click", () => {
      body.classList.remove("home");
      body.classList.add("visitor");
      body.style.background = whiteColor; //visitor
      body.style.color = blackColor02; //visitor
      sessionStorage.setItem("mode", "visitor");
    });

    body.classList.add("home");

  })