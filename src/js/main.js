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

/*---------- color change ----------*/

// CSS変数をjsに取り込む
const rootStyles = getComputedStyle(document.documentElement);

const whiteColor = rootStyles.getPropertyValue("--white-color").trim();
const blackColor01 = rootStyles.getPropertyValue("--black-color01").trim();
const blackColor02 = rootStyles.getPropertyValue("--black-color02").trim();
const homeColor01 = rootStyles.getPropertyValue("--home-color01").trim();
const homeColor02 = rootStyles.getPropertyValue("--home-color02").trim();
const visitorColor01 = rootStyles.getPropertyValue("--visitor-color01").trim();
const visitorColor02 = rootStyles.getPropertyValue("--visitor-color02").trim();

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

const mode = sessionStorage.getItem("mode");
if (mode === "home") {
  body.classList.add("home");
} else if (mode === "visitor") {
  body.classList.add("visitor");
  body.style.background = whiteColor; //visitor
  body.style.color = blackColor02; //visitor
} else {
  //default(home)
  body.classList.add("home");
}

/*---------- kv ----------*/
const slideshow = new Swiper(".js_slideshow", {
  speed: 2000,
  effect: "fade",
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
});

/*---------- swiper ----------*/

const swiper = new Swiper(".swiper", {
  loop: true,
  speed: 8000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
  },
  // slidesPerView: "auto",
  slidesPerView: 1.5,
  breakpoints: {
    400: {
      slidesPerView: 1.8,
    },
    768: {
      slidesPerView: 3.3,
    },
    900: {
      slidesPerView: 3,
    },
    1080: {
      slidesPerView: 4,
    },
  },
  on: {
    resize: function () {
      swiper.autoplay.start();
    },
  },
});

/*------------ news modal ------------*/
const newsModals = document.querySelectorAll(".js_news-modal");
const newsModalOpen = document.querySelectorAll(".js_news-modalOpen");
const newsModalClose = document.querySelectorAll(".js_news-modalClose");

function openModal(targetModal) {
  if (targetModal && targetModal.classList) {
    targetModal.classList.add("is-open");
    document.body.classList.add("no-scroll");
  }
}

function closeModal(targetModal) {
  if (targetModal && targetModal.classList) {
    targetModal.classList.remove("is-open");
    document.body.classList.remove("no-scroll");
  }
}

// モーダルを開く
newsModalOpen.forEach((element) => {
  const targetModalId = element.getAttribute("data-modal-target");
  const targetModal = document.getElementById(targetModalId);

  element.addEventListener("click", (event) => {
    event.preventDefault();
    if (targetModal) {
      openModal(targetModal);
    }
  });
});

// モーダルを閉じる
newsModalClose.forEach((element) => {
  element.addEventListener("click", () => {
    const targetModalId = element.getAttribute("data-modal");
    const targetModal = document.getElementById(targetModalId);
    if (targetModal) { 
      closeModal(targetModal);
    }
  });
});

// モーダル外をクリックでも閉じる
newsModals.forEach((modal) => {
  modal.addEventListener("click", (event) => {
    if (!event.target.closest(".m_news-modal_inner")) {
      closeModal(modal);
    }
  });
});

// 前後のモーダルへの切り替え
newsModals.forEach((modal, index) => {
  const prevBtn = modal.querySelector(".m_news-modal-prev");
  const nextBtn = modal.querySelector(".m_news-modal-next");

  if (prevBtn) {
    prevBtn.addEventListener("click", (event) => {
      event.preventDefault();
      const prevModalIndex = (index - 1 + newsModals.length) % newsModals.length;
      closeModal(modal);
      openModal(newsModals[prevModalIndex]);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", (event) => {
      event.preventDefault();
      const nextModalIndex = (index + 1) % newsModals.length;
      closeModal(modal);
      openModal(newsModals[nextModalIndex]);
    });
  }
});
