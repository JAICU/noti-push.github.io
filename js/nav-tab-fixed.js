import { resaltaSiEstasEn } from "../lib/js/resaltaSiEstasEn.js"

export class NavTabFixed extends HTMLElement {

 connectedCallback() {
  this.classList.add("md-tab", "fixed")

  this.innerHTML = /* HTML */`
   <a ${resaltaSiEstasEn(["/noti-push/index.html", "", "/"])} href="index.html">
    <span class="material-symbols-outlined">home</span>
    Notificaciones
   </a>

    <a ${resaltaSiEstasEn(["/noti-push/ayuda.html"])} href="ayuda.html">
    <span class="material-symbols-outlined">help</span>
    Ayuda
   </a>`
 }

}

customElements.define("nav-tab-fixed", NavTabFixed)