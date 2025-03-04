"use strict";

/*------------ privacy policy ------------*/
const privacyModal = document.querySelector(".js_privacy-modal");
const privacyModalOpen = document.querySelector(".js_privacy-modalOpen");
const privacyModalClose = document.querySelector(".js_privacy-modalClose");

privacyModalOpen.addEventListener("click", (event) => {
  event.preventDefault();
  privacyModal.classList.add("is-open");
  document.body.classList.add("no-scroll");
});

privacyModalClose.addEventListener("click", () => {
  privacyModal.classList.remove("is-open");
  document.body.classList.remove("no-scroll");
});

privacyModal.addEventListener("click", (event) => {
  if (!event.target.closest(".m_privacy-modal_inner")) {
    privacyModal.classList.remove("is-open");
    document.body.classList.remove("no-scroll");
  }
});



const privacyLabel = document.querySelector('.contact_privacy_checkbox');

privacyLabel.addEventListener('click', function() {
  const checkbox = privacyLabel.querySelector('input[type="checkbox"]');

  if (checkbox.checked) {
    privacyLabel.classList.add('is-checked');
  } else {
    privacyLabel.classList.remove('is-checked');
  }
});